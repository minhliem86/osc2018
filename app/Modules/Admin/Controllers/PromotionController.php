<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Notification;
use App\Http\Requests\ImageRequest;
use App\Repositories\PromotionRepository;
use App\Repositories\Eloquent\CommonRepository;
use Databases;


class PromotionController extends Controller {

		protected $promotion;
		protected $common;

    protected $upload_folder = 'public/upload/promotion';

		public function __construct(PromotionRepository $promotion, CommonRepository $common){
			$this->promotion = $promotion;
			$this->common = $common;
		}

		public function index()
    {
        return view('Admin::pages.promotion.index');
    }

		public function getData(Request $request)
		{
			$promotion = $this->promotion->select(['id', 'name','order', 'status']);
			return Datatables::of($promotion)
			->addColumn('action', function($promotion){
					return '<a href="'.route('admin.promotion.edit', $promotion->id).'" class="btn btn-info btn-xs inline-block-span"> Edit </a>
					<form method="POST" action=" '.route('admin.promotion.destroy', $promotion->id).' " accept-charset="UTF-8" class="inline-block-span" style="display:inline-block">
							<input name="_method" type="hidden" value="DELETE">
							<input name="_token" type="hidden" value="'.csrf_token().'">
												 <button class="btn  btn-danger btn-xs remove-btn" type="button" attrid=" '.route('admin.promotion.destroy', $promotion->id).' " onclick="confirm_remove(this);" > Remove </button>
				 </form>' ;
		 })->editColumn('order', function($promotion){
				 return "<input type='text' name='order' class='form-control' data-id= '".$promotion->id."' value= '".$promotion->order."' />";
		 })->editColumn('status', function($promotion){
				 $status = $promotion->status ? 'checked' : '';
				 $promotion_id =$promotion->id;
				 return '
							<input type="checkbox"   name="status" value="1" '.$status.'   data-id ="'.$promotion_id.'">
				';
		 })->filter(function($query) use ($request){
				if ($request->has('name')) {
						$query->where('name', 'like', "%{$request->input('name')}%");
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
        return view('Admin::pages.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ImageRequest $imgrequest, Promotion $promotion)
    {
				$order = $this->promotion->getOrder();

				if($imgrequest->hasFile('img_avatar')){
					$img_avatar = $this->common->uploadImage($request, $request->file('img_avatar'), $this->upload_folder, false);
					$img_avatar = $this->common->getPath($img_avatar, asset('public/upload/'));
				}else{
					$img_avatar ="";
				}

				if($imgrequest->hasFile('img_icon')){
					$img_icon = $this->common->uploadImage($request, $request->file('img_icon'), $this->upload_folder, false);
					$img_icon = $this->common->getPath($img_icon, asset('public/upload/'));
				}else{
					$img_icon ="";
				}

        $data = [
            'name'=>$request->name,
            'slug' => \Unicode::make($request->name),
            'img_icon' => $img_icon,
            'img_avatar' => $img_avatar,
            'description' => $request->input('description'),
            'content' => $request->input('content'),
            'order'=>$order
        ];

        $this->promotion->create($data);
        Notification::success('Created');
        return  redirect()->route('admin.promotion.index');
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
        $promotion = $this->promotion->find($id);
        return view('Admin::pages.promotion.view')->with(compact('promotion'));
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
				$img_avatar =$request->file('img-avatar-bk');
			}

			if($imgrequest->hasFile('img_icon')){
				$img_icon = $this->common->uploadImage($request, $request->file('img_icon'), $this->upload_folder, false);
				$img_icon = $this->common->getPath($img_icon, asset('public/upload/'));
			}else{
				$img_icon =$request->input('img-icon-bk');
			}

			$data = [
					'name'=>$request->name,
					'slug' => \Unicode::make($request->name),
					'img_icon' => $img_icon,
					'img_avatar' => $img_avatar,
					'description' => $request->input('description'),
					'content' => $request->input('content'),
					'status'=> $request->status,
					'order'=>$request->order
			];
			$this->promotion->update($data, $id);
      Notification::success('Updated');
      return  redirect()->route('admin.promotion.index');
    }

		/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->promotion->delete($id);
        \Notification::success('Remove Successful');
        return redirect()->route('admin.promotion.index');
    }

    public function deleteAll(Request $request){
		if(!$request->ajax()){
			abort(404);
		}else{
			 $data = $request->arr;
			 $response = $this->promotion->deleteAll($data);
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
                $obj = $this->promotion->find($k);
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
            $this->promotion->update(['status' => $value], $id);
            return response()->json(['msg' =>'ok', 'code'=>200], 200);
        }
    }

}
