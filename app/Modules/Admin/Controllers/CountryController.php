<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Notification;
use App\Http\Requests\ImageRequest;
use App\Models\Image as ImgModel;

use App\Repositories\CountryRepository;
use App\Repositories\MediaRepository;
use App\Repositories\Eloquent\CommonRepository;
use Datatables;


class CountryController extends Controller {

	protected $country;
	protected $media;
	protected $common;

    protected $upload_folder = 'country';
    protected $upload_web_banner = 'country/web';
    protected $upload_mobile_banner = 'country/mobile';

	public function __construct(CountryRepository $country, CommonRepository $common, MediaRepository $media){
		$this->country = $country;
		$this->media = $media;
		$this->common = $common;
	}

	public function index()
    {
        // $country = $this->country->select('id','name','status','order','img_avatar')->get();
        return view('Admin::pages.country.index');
    }

	public function getData(Request $request)
	{
		$country = $this->country->select(['id', 'name', 'order', 'status']);
            return Datatables::of($country)
            ->addColumn('action', function($country){
                return '<a href="'.route('admin.country.edit', $country->id).'" class="btn btn-info btn-xs inline-block-span"> Edit </a>
                <form method="POST" action=" '.route('admin.country.destroy', $country->id).' " accept-charset="UTF-8" class="inline-block-span" style="display:inline-block">
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="_token" type="hidden" value="'.csrf_token().'">
                               <button class="btn  btn-danger btn-xs remove-btn" type="button" attrid=" '.route('admin.country.destroy', $country->id).' " onclick="confirm_remove(this);" > Remove </button>
               </form>' ;
           })->editColumn('order', function($country){
               return "<input type='text' name='order' class='form-control' data-id= '".$country->id."' value= '".$country->order."' />";
           })->editColumn('status', function($country){
               $status = $country->status ? 'checked' : '';
               $country_id =$country->id;
               return '
                    <input type="checkbox"   name="status" value="1" '.$status.'   data-id ="'.$country_id.'">
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
        return view('Admin::pages.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ImageRequest $imgrequest, Country $country)
    {
        $order = $this->country->getOrder();
		if($imgrequest->hasFile('img')){
			$img_url = $this->common->uploadImage($request, $request->file('img'), $this->upload_folder, false);
			$img_url = $this->common->getPath($img_url, asset(''));
		}else{
			$img_url = "";
		}
		if($imgrequest->hasFile('img_share')){
			$img_share = $this->common->uploadImage($request, $request->file('img_share'), $this->upload_folder, false);
			$img_share = $this->common->getPath($img_share, asset(''));
		}else{
			$img_share = "";
		}
        $data = [
            'name'=>$request->name,
            'slug' => \Unicode::make($request->name),
            'description' => $request->description,
            'multi_countries' => $request->multi_countries,
            'home_show' => $request->home_show,
            'status'=> $request->status,
            'img_avatar'=> $img_url,
			'meta_keyword' => $request->meta_keyword,
			'meta_description' => $request->meta_description,
			'meta_share' => $request->$img_share,
            'order'=>$order
        ];
        $country = $this->country->create($data);

		if($imgrequest->hasFile('web')){
			foreach($request->file('web') as $k=>$thumb){
			  $img_web = $this->common->uploadImage($request, $thumb, $this->upload_web_banner,$resize = false);
			  $img_web = $this->common->getPath($img_web, asset(''));

			  $order = $this->media->getOrder();
			  $country->medias()->save(new \App\Models\Media([
				'img_url' => $this->common->getPath($img_web, asset('public/upload')),
				'order'=>$order,
				'type' => 1
			  ]));
			}
		}
		if($imgrequest->hasFile('mobile')){
			foreach($request->file('mobile') as $k=>$thumb){
			  $img_mobile = $this->common->uploadImage($request, $thumb, $this->upload_mobile_banner,$resize = false);
			  $img_mobile = $this->common->getPath($img_mobile, asset(''));

			  $order = $this->media->getOrder();
			  $country->medias()->save(new \App\Models\Media([
				'img_url' => $this->common->getPath($img_mobile, asset('public/upload')),
				'order'=>$order,
				'type' => 2
			  ]));
			}
		}

        Notification::success('Created');
        return  redirect()->route('admin.country.index');
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
        $country = $this->country->find($id,['*'], ['medias']);
        return view('Admin::pages.country.view')->with(compact('country'));
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
            $file = $imgrequest->file('img');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;

            $file->move($destinationPath,$filename);

            // $size = getimagesize($file);
            // if($size[0] > 620){
            //     \Image::make($file->getRealPath())->resize(620,null,function($constraint){$constraint->aspectRatio();})->save($destinationPath.'/'.$filename);
            // }else{
            //     $file->move($destinationPath,$filename);
            // }

            $img_url = asset('public/upload').'/'.$this->upload_folder.'/'.$filename;
        }else{
            $img_url = $request->input('img-bk');
        }

        if($imgrequest->hasFile('imgslide')){
            $file = $imgrequest->file('imgslide');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder.'/'.$this->upload_sub_folder;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;

            // $file->move($destinationPath,$filename);
             $filename_resize = $destinationPath.'/'.$filename;
            $size = getimagesize($file);
            // dd($size);
            \Image::make($file->getRealPath())->resize(660,325)->save($filename_resize);
            // if($size[0] > 660){

            // }else{
            //     $file->move($destinationPath,$filename);
            // }

            $imgslide_url = asset('public/upload').'/'.$this->upload_folder.'/'.$this->upload_sub_folder.'/'.$filename;
        }else{
            $imgslide_url = $request->input('imgslide-bk');
        }

        $country = $this->country->find($id);
        $country->name = $request->name;
        $country->slug = \Unicode::make($request->name);
        $country->description = $request->description;
        $country->multi_countries = $request->multi_countries;
        $country->home_show = $request->home_show;
        $country->img_avatar = $img_url;
        $country->img_slide = $imgslide_url;
        $country->status = $request->status;
        $country->order = $request->order;
        $country->save();

        if($imgrequest->hasFile('img-banner')){
            $file = $imgrequest->file('img-banner');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder.'/'.$this->upload_folder_banner;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;

            $filename_resize = $destinationPath.'/'.$filename;
             \Image::make($file->getRealPath())->resize(1170,350)->save($filename_resize);
            $imgbanner_url = asset('public/upload').'/'.$this->upload_folder.'/'.$this->upload_folder_banner.'/'.$filename;

            $order_img = ImgModel::orderBy('order','DESC')->first();
            count($order_img) == 0 ?  $current = 1 :  $current = $order_img->order +1 ;

            $image = new ImgModel(['img_url'=>$imgbanner_url,'status'=>1,'order'=>$current,'type'=>'banner_country']);
            $country->images()->save($image);
        }

        if($imgrequest->hasFile('img-banner-mobile')){
            $file = $imgrequest->file('img-banner-mobile');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder.'/'.$this->upload_folder_banner;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;

            $filename_resize = $destinationPath.'/'.$filename;
             \Image::make($file->getRealPath())->resize(800,600)->save($filename_resize);
            $imgbanner_url_mobile = asset('public/upload').'/'.$this->upload_folder.'/'.$this->upload_folder_banner.'/'.$filename;

            $order_img = ImgModel::orderBy('order','DESC')->first();
            count($order_img) == 0 ?  $current = 1 :  $current = $order_img->order +1 ;

            $image = new ImgModel(['img_url'=>$imgbanner_url_mobile,'status'=>1,'order'=>$current,'type'=>'banner_country_mobile']);
            $country->images()->save($image);
        }

        Notification::success('Updated');
        return  redirect()->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->country->destroy($id);
        \Notification::success('Remove Successful');
        return redirect()->route('admin.country.index');
    }

    public function deleteAll(Request $request){
		if(!$request->ajax()){
			abort(404);
		}else{
			 $data = $request->arr;
			 $response = $this->country->deleteAll($data);
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
                $obj = $this->country->find($k);
                $obj->update($upt);
            }
            return response()->json(['msg' =>'ok', 'code'=>200], 200);
        }
    }

}
