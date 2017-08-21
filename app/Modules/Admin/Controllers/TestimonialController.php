<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Notification;
use App\Http\Requests\ImageRequest;
use App\Repositories\TestimonialRepository;
use App\Repositories\Eloquent\CommonRepository;
use Databases;

class TestimonialController extends Controller {

	protected $testimonial;
	protected $common;

    protected $upload_folder = 'public/upload/testimonial';
    protected $upload_sub_folder = 'public/upload/testimonial/slide';

    public function __construct(Testimonial $testimonial){
        $this->testimonial = $testimonial;
    }

    public function index()
    {
        return view('Admin::pages.testimonial.index');
    }

		public function getData(Request $request)
		{
			$testimonial = $this->testimonial->select(['id', 'title','order', 'status','author']);
			return Datatables::of($testimonial)
			->addColumn('action', function($testimonial){
					return '<a href="'.route('admin.testimonial.edit', $testimonial->id).'" class="btn btn-info btn-xs inline-block-span"> Edit </a>
					<form method="POST" action=" '.route('admin.testimonial.destroy', $testimonial->id).' " accept-charset="UTF-8" class="inline-block-span" style="display:inline-block">
							<input name="_method" type="hidden" value="DELETE">
							<input name="_token" type="hidden" value="'.csrf_token().'">
												 <button class="btn  btn-danger btn-xs remove-btn" type="button" attrid=" '.route('admin.testimonial.destroy', $testimonial->id).' " onclick="confirm_remove(this);" > Remove </button>
				 </form>' ;
		 })->editColumn('order', function($testimonial){
				 return "<input type='text' name='order' class='form-control' data-id= '".$testimonial->id."' value= '".$testimonial->order."' />";
		 })->editColumn('status', function($testimonial){
				 $status = $testimonial->status ? 'checked' : '';
				 $testimonial_id =$testimonial->id;
				 return '
							<input type="checkbox"   name="status" value="1" '.$status.'   data-id ="'.$testimonial_id.'">
				';
		 })->filter(function($query) use ($request){
				if ($request->has('name')) {
						$query->where('title', 'like', "%{$request->input('name')}%");
				}
			})->setRowId('id')->make(true);
		}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin::pages.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ImageRequest $imgrequest, Testimonial $testimonial)
    {
				$order = $this->testimonial->getOrder();

				if($imgrequest->hasFile('img_avatar')){
					$img_avatar = $this->common->uploadImage($request, $request->file('img_avatar'), $this->upload_folder, false);
					$img_avatar = $this->common->getPath($img_avatar, asset('public/upload/'));
				}else{
					$img_avatar ="";
				}

        $data = [
            'title'=>$request->title,
            'slug' => \Unicode::make($request->title),
            'author' => $request->author,
            'description' => $request->description,
            'content' => $request->content,
            'img_avatar' => $img_avatar,
            'order'=>$order
        ];
        $this->testimonial->create($data);
        Notification::success('Created');
        return  redirect()->route('admin.testimonial.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = $this->testimonial->find($id);
        return view('Admin::pages.testimonial.view')->with(compact('testimonial'));
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
				if($imgrequest->hasFile('img_avatar')){
					$img_avatar = $this->common->uploadImage($request, $request->file('img_avatar'), $this->upload_folder, false);
					$img_avatar = $this->common->getPath($img_avatar, asset('public/upload/'));
				}else{
					$img_avatar =$request->input('img-avatar-bk');
				}

				$data = [
						'title'=>$request->title,
						'slug' => \Unicode::make($request->title),
						'author' => $request->author,
						'description' => $request->description,
						'content' => $request->content,
						'img_avatar' => $img_avatar,
						'status'=> $request->status,
						'order'=>$request->order,
				];
				$this->testimonial->update($data, $id);
        Notification::success('Updated');
        return  redirect()->route('admin.testimonial.index');
    }

		/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->testimonial->delete($id);
        \Notification::success('Remove Successful');
        return redirect()->route('admin.testimonial.index');
    }

    public function deleteAll(Request $request){
		if(!$request->ajax()){
			abort(404);
		}else{
			 $data = $request->arr;
			 $response = $this->testimonial->deleteAll($data);
			 return response()->json(['msg' => 'ok']);
		}
    }

    public function AjaxRemovePhoto(Request $request){
		if(!$request->ajax()){
            abort('404', 'Not Access');
        }else{
            $id = $request->input('id_photo');
            $this->media->delete($id);
            return response()->json([
                'mes' => 'Deleted',
                'error'=> false,
            ], 200);
        }
    }

	public function AjaxUpdatePhoto(Request $request){
		if(!$request->ajax()){
            abort('404', 'Not Access');
        }else{
            $id = $request->input('id_photo');
            $order = $request->input('value');
            $photo = $this->media->update(['order'=>$order], $id);

            return response()->json([
                'mes' => 'Update Order',
                'error'=> false,
            ], 200);
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
                $obj = $this->testimonial->find($k);
                $obj->update($upt);
            }
            return response()->json(['msg' =>'ok', 'code'=>200], 200);
        }
    }

	public function postAjaxUpdateStatus(Request $request)
    {
        if(!$request->ajax())
        {
            abort('404', 'Not Access');
        }else{
            $value = $request->input('value');
            $id = $request->input('id');
            $this->testimonial->update(['status' => $value], $id);
            return response()->json(['msg' =>'ok', 'code'=>200], 200);
        }
    }

}
