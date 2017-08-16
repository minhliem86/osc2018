<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Notification;

use App\Models\Photo;
use App\Models\Album;
use App\Models\Tour;
use App\Http\Requests\ImageRequest;
use App\Repositories\UploadRepository;
use App\Repositories\CommonRepository;


class PhotoController extends Controller {

  protected $photo;
  protected $tour;
  protected $album;
  protected $_upload_folder = 'public/upload/image';
  protected $_upload_folder_thumb = 'public/upload/image/thumbs';

  public function __construct(UploadRepository $image, Tour $tour, Album $album){
      $this->image = $image;
      $this->tour = $tour;
      $this->album = $album;
  }

  public function index()
  {
      $photo = $this->image->getAll();
    //   dd($photo);
      return view('Admin::pages.photo.index')->with(compact('photo'));
  }

  public function create()
  {
      $list_album = $this->image->getListAlbum();
      $list_tour = $this->tour->where('status',1)->lists('tour_code','id');
      return view('Admin::pages.photo.create',compact('list_tour'));
  }

public function postUpload(Request $request)
{
  $input = $request->all();
  $response = $this->image->upload($input);
  return $response;
}
  public function edit($id)
  {
      $image = $this->image->getFindID($id);
      $list_album = $this->image->getListAlbum();
      return view('Admin::pages.photo.view')->with(compact('image','list_album'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request,ImageRequest $imgrequest, $id)
  {
    if($imgrequest->hasFile('img')){
      $common = new CommonRepository;
      $img_url = $common->uploadImage($request,$imgrequest->file('img'),$this->_upload_folder,$resize=true,1200,630);
      $thumbnail_url = $common->uploadImage($request,$imgrequest->file('img'),$this->_upload_folder_thumb,$resize=true,400,210);

    }else{
      $img_url = $request->input('img-bk');
      $thumbnail_url = $request->input('img-thumb-bk');
    }
    $arr_filename = explode('/',$img_url);
    $filename = end($arr_filename);

    $data = [
      'title'=>$request->title,
      'img_url' => $img_url,
      'thumbnail_url' => $thumbnail_url,
      'status'=> $request->status,
      'order'=>$request->order,
      'album_id' => $request->album_id,
      'filename' => $filename,
    ];
    $this->image->postUpdate($id,$data);
    Notification::success('Updated');
    return  redirect()->route('admin.photo.index');
  }

  public function postDelete(Request $request)
  {
      $response = $this->image->delete($request->input('id'));
      return $response;
  }
 public function destroy($id){
     $response = $this->image->delete($id);
     \Notification::success('Remove Successful');
     return redirect()->route('admin.photo.index');
 }

 public function deleteAll(Request $request){
     if(!$request->ajax()){
         abort(404);
     }else{
          $data = $request->arr;
          $response = $this->image->deleteAll($data);
          return response()->json(['msg' => 'ok']);
    }
  }

  public function loadAlbum(Request $request)
  {
    if(!$request->ajax()){
      abort(404);
    }else{
      $tour_id = $request->input('id');
      try {
        $list_album = $this->album->where('tour_id', $tour_id)->lists('title', 'id');
        if(!count($list_album)){
            return response()->json(['error'=> false, 'msg' => 'Cần tạo Album trước khi up ảnh'], 200);
        }
        $view = view('Admin::ajax.loadAlbum', compact('list_album'))->render();
        return response()->json(['error'=> true, 'msg' => $view], 200);
      } catch (Exception $e) {
        return response()->json(['error'=> false, 'msg' => 'Cần tạo Album trước khi up ảnh'], 200);
      }
    }
  }

}
