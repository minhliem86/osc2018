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
use Datatables;


class PhotoController extends Controller {

  protected $photo;
  protected $tour;
  protected $album;
  protected $_upload_folder = 'public/upload/image';
  protected $_upload_folder_thumb = 'public/upload/image/thumbs';

  public function __construct(UploadRepository $image, Tour $tour, Album $album, Photo $photo){
      $this->image = $image;
      $this->tour = $tour;
      $this->album = $album;
      $this->photo = $photo;
  }

  public function index()
  {
      return view('Admin::pages.photo.index');
  }

  public function anyData(Request $request){
    //   $photo =  $this->image->getAll();
    //   $photo = Photo::with('albums')->select('photos.*');
      $photo = \DB::table('albums')
      ->join('photos', 'photos.album_id' , '=','albums.id')
      ->select([ 'photos.id AS photo_id', 'photos.img_url','photos.order', 'albums.title' ]);
      return Datatables::of($photo)
      ->addColumn('action',  function($photo) {
          return '<a href="'.route('admin.photo.edit', $photo->photo_id).'" class="btn btn-info btn-xs"> Edit </a>
          <form method="POST" action=" '.route('admin.photo.destroy', $photo->photo_id).' " accept-charset="UTF-8" class="inline">
              <input name="_method" type="hidden" value="DELETE">
              <input name="_token" type="hidden" value="'.csrf_token().'">
							<button class="btn  btn-danger btn-xs remove-btn" type="button" attrid=" '.route('admin.photo.destroy', $photo->photo_id).' " onclick="confirm_remove(this);" > Remove </button>
			</form>' ;
      })->addColumn('updateOrder', function ($photo){
          return "<input type='text' name='order' class='form-control' data-id= '".$photo->photo_id."' value= '".$photo->order."' />";
      })->editColumn('img_url', function($photo){
          return '<img src=" '.$photo->img_url. ' " class="img-responsive" width="150" /> ';
      })->filter(function($query) use ($request){
            if ($request->has('name')) {
                $query->where('albums.title', 'like', "%{$request->get('name')}%");
            }
      })->setRowId('id')->make(true);
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
      $img_url = $common->uploadImage($request,$imgrequest->file('img'),$this->_upload_folder,$resize=false,1200,630);
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

  public function getQuickEditPhoto()
  {
    //   $album = $this->album->lists('title', 'id');
      $tour = $this->tour->where('status',1)->lists('tour_code','id');
      return view('Admin::pages.photo.quickEdit', compact('tour'));
  }

  public function postAjaxGetAlbum(Request $request)
  {
       if(!$request->ajax()){
          abort('404', 'Not Access');
       }else{
           $tour_id = $request->data_tour;

           $album = $this->album->where('tour_id', $tour_id)->lists('title','id');
           if(count($album) > 0){
               $view = view('Admin::ajax.loadAlbumOption', compact('album'))->render();
               return response()->json(['msg' => $view, 'code' => 200], 200);
           }else{
               return response()->json(['msg' => 'Chưa có Album trong Tour', 'code' => 500], 200);
           }

       }
  }

  public function postAjaxGetPhoto(Request $request)
  {
      if(!$request->ajax())
      {
          abort('404', 'Not Access');
      }else{
          $album_id = $request->data;
          $photo = $this->photo->where('album_id', $album_id)->select('id', 'title', 'img_url')->get();
          if(!$photo->isEmpty()){
              $view = view('Admin::ajax.loadPhotoQuickEdit', compact('photo'))->render();
              return response()->json(['msg' => $view, 'code' => 200], 200);
          }else{
              return response()->json(['msg' => 'Không có hình ảnh trong Album', 'code' => 500], 200);
          }

      }
  }

  public function postAjaxEditPhoto(Request $request)
  {
      if(!$request->ajax())
      {
          abort('404', 'Not Access');
      }else{
          $data = $request->input('data');
          foreach($data as $k => $v){
              $upt  =  [
                  'title' => $v,
              ];
              $obj = $this->photo->find($k);
              $obj->update($upt);
          }
          return response()->json(['msg' => 'ok', 'code'=>200], 200);
      }
  }

  public function postAjaxUpdateOrder(Request $request)
  {
      if(!$request->ajax())
      {
          abort('404', 'Not Access');
      }else{
          $data = $request->input('data');
          foreach($data as $k => $v){
              $upt  =  [
                  'order' => $v,
              ];
              $obj = $this->photo->find($k);
              $obj->update($upt);
          }
          return response()->json(['msg' =>'ok', 'code'=>200], 200);
      }
  }

}
