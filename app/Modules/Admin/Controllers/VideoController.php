<?php namespace App\Modules\Admin\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;

use App\Repositories\VideoRepository;
use App\Repositories\CommonRepository;
use App\Models\Tour;
use App\Models\Album;
use Notification;

class VideoController extends Controller {

	protected $videoRepo;
	protected $tour;
	protected $album;
	protected $common;
	protected $_default_img = "asset('public/assets/backend/img/image_thumbnail.gif')";
	protected $_upload_folder = "public/upload/video";

	public function __construct(VideoRepository $video, CommonRepository $common, Tour $tour,  Album $album)
	{
		$this->videoRepo = $video;
		$this->album = $album;
		$this->tour = $tour;
		$this->common = $common;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$inst = $this->videoRepo->getAll();
		return view('Admin::pages.video.index', compact('inst'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tour = $this->tour->where('status',1)->lists('tour_code', 'id');
		return view('Admin::pages.video.create', compact('tour'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, ImageRequest $imgrequest)
	{
		$order = $this->videoRepo->getOrder();

		if($request->hasFile('img'))
		{
			$img_url = $this->common->uploadImage($request,$imgrequest->file('img'),$this->_upload_folder,$resize=true,555,292);
		}else{
			$img_url = $this->_default_img;
		}

		$data = [
			'title' => $request->input('title'),
			'img_url' => $img_url,
			'album_id' => $request->input('album_id'),
			'video_url' => $request->input('video_url'),
			'order' => $order,
		];

		$this->videoRepo->postCreate($data);
		Notification::success('Created !');
		return redirect()->route('admin.video.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$inst = $this->videoRepo->getFindID($id);
		$tour = $this->tour->where('status',1)->lists('tour_code', 'id');
		$album = $this->album->lists('title', 'id');
		return view('Admin::pages.video.view', compact('inst', 'tour', 'album'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, ImageRequest $imgrequest ,$id)
	{
		if($request->hasFile('img'))
		{
			$img_url = $this->common->uploadImage($request,$imgrequest->file('img'),$this->_upload_folder,$resize=true,555,292);
		}else{
			$img_url = $request->input('img-bk');
		}
		$data = [
			'title' => $request->input('title'),
			'img_url' => $img_url,
			'album_id' => $request->input('album_id'),
			'video_url' => $request->input('video_url'),
			'order' => $request->input('order'),
			'status' => $request->input('status')
		];
		$this->videoRepo->postUpdate($id, $data);
		Notification::success('Updated !');
		return redirect()->route('admin.video.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->videoRepo->delete($id);
		return redirect()->route('admin.video.index');
	}

	public function postAjaxGetAlbum(Request $request)
	{
		if(!$request->ajax())
		{
			abort('404', 'Not Access');
		}else{
			$tour_id = $request->input('tour_id');
			$album = $this->album->where('status', 1)->where('tour_id', $tour_id)->lists('title', 'id');
			$view = view('Admin::ajax.getAlbumVideo', compact('album'))->render();
			return response()->json(['rs' => $view, 'code' => 200], 200);
		}
	}

	public function deleteAll(Request $request)
	{

	}

}
