<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Notification;
use  App\Http\Requests\ImageRequest;
use App\Repositories\AlbumRepository;
use App\Repositories\CommonRepository;
use App\Models\Tour;

class AlbumController extends Controller {

  protected $_upload_folder = 'public/upload/album';
	protected $_default_img = "asset('public/assets/backend/img/image_thumbnail.gif')";

  protected $album;

  public function __construct(AlbumRepository $albumRepo)
  {
    $this->album = $albumRepo;
  }

  public function index()
  {
    $all = $this->album->getAll();
    return view('Admin::pages.album.index', compact('all'));
  }

  public function create()
  {
    $tour_list = Tour::where('status', 1)->lists('tour_code','id');
    return view('Admin::pages.album.create', compact('tour_list'));
  }

  public function store(Request $request, ImageRequest $imgrequest)
  {
    if($request->hasFile('img')){
      $common = new CommonRepository;
      $img_url = $common->uploadImage($request,$imgrequest->file('img'),$this->_upload_folder,$resize=true,555,292);
    }else{
      $img_url = $this->_default_img;
    }

    $data = [
      'title' => $request->input('title'),
      'slug' => \Unicode::make($request->input('title')),
      'status' => $request->input('status'),
      'tour_id' => $request->input('tour_id'),
      'img_url' => $img_url
    ];
    if($this->album->getFirstByWhere('slug',  \Unicode::make($request->input('title')) )){
        Notification::error('Album already exists !');
        return redirect()->back()->withInput();
    }
    $this->album->createItem($data);

    Notification::success('Create Successfull.');
    return redirect()->route('admin.album.index');
  }

  public function edit($id)
  {
    $tour_list = Tour::where('status', 1)->lists('tour_code','id');
    $album = $this->album->getByID($id);

    return view ('Admin::pages.album.view', compact('tour_list', 'album'));
  }

  public function update(Request $request, ImageRequest $imgrequest, $id)
  {
    if($request->hasFile('img')){
      $common = new CommonRepository;
      $img_url = $common->uploadImage($request,$imgrequest->file('img'),$this->_upload_folder,$resize=true,555,292);
    }else{
      $img_url = $request->input('img-bk');
    }

    $data = [
      'title' => $request->input('title'),
      'slug' => \Unicode::make($request->input('title')),
      'status' => $request->input('status'),
      'tour_id' => $request->input('tour_id'),
      'img_url' => $img_url
    ];
    // dd($data);
    $this->album->updateByID($id, $data);

    Notification::success('Update Successfull.');
    return redirect()->route('admin.album.index');
  }

  public function destroy($id)
  {
    $this->album->deleteByID($id);
    Notification::success('Remove Successfull.');
    return redirect()->route('admin.album.index');
  }

  public function deleteAll(Request $request)
  {
    if(!$request->ajax()){
        abort(404);
    }else{
        $data = $request->arr;
        $this->album->deleteAll($data);
    }
  }
}
