<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Location;
use App\Models\Country;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Notification;
use App\Http\Requests\ImageRequest;
use App\Repositories\CommonRepository;


class CourseController extends Controller {

		protected $tour;

    protected $upload_folder = 'tour';
    protected $upload_folder2 = 'schedule';
    protected $tour_upload_func = 'public/upload/tour';

    public function __construct(Tour $tour){
        $this->tour = $tour;
    }

    public function index()
    {
        $tour = $this->tour->select('id','title','start','end','price','age')
        ->with(['location'=>function($query){$query->select('title');}])->get();
        return view('Admin::pages.tour.index')->with(compact('tour'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Country::select('id')->first()){
            Notification::error('Create Country first, Please!');
            return view('Admin::pages.country.index');
        }
        if(!Location::select('id')->first()){
            Notification::error('Create Location first, Please!');
            return view('Admin::pages.location.index');
        }
        $location = Location::lists('title','id');
        $country = Country::lists('name','id');
        return view('Admin::pages.tour.create',compact('location','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ImageRequest $imgrequest, Tour $tour)
    {
        $order = $this->tour->orderBy('order','DESC')->first();
        count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;

        if($imgrequest->hasFile('img')){
            $file = $imgrequest->file('img');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;


            $file_resize = $destinationPath.'/'.$filename;

            \Image::make($file->getRealPath())->resize(720,440)->save($file_resize);


            $img_url = asset('public/upload').'/'.$this->upload_folder.'/'.$filename;
            // $img_alt = \GetNameImage::make('\/',$filename);
        }else{
            $img_url = asset('public/assets/frontend/images/default-img/country-default.jpg');
            // $img_alt = \GetNameImage::make('\/',$img_url);
        }
        if($imgrequest->hasFile('img-sharing')){
            $file = $imgrequest->file('img-sharing');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;

            // $file->move($destinationPath,$filename);

            // $size = getimagesize($file);
            $file_resize = $destinationPath.'/'.$filename;

            \Image::make($file->getRealPath())->resize(600,315)->save($file_resize);
            // if($size[0] > 620){
            //     \Image::make($file->getRealPath())->resize(620,null,function($constraint){$constraint->aspectRatio();})->save($destinationPath.'/'.$filename);
            // }else{
            //     $file->move($destinationPath,$filename);
            // }

            $img_sharing = asset('public/upload').'/'.$this->upload_folder.'/'.$filename;
            // $img_alt = \GetNameImage::make('\/',$filename);
        }else{
            $img_sharing = asset('public/assets/frontend/images/default-img/country-default.jpg');
            // $img_alt = \GetNameImage::make('\/',$img_url);
        }

				if($imgrequest->hasFile('banner_desktop')){
					$common = new CommonRepository;
		      $banner_desktop = $common->uploadImage($request,$imgrequest->file('banner_desktop'),$this->tour_upload_func,$resize=true,1170,350);
				}

				if($imgrequest->hasFile('banner_mobile')){
					$common = new CommonRepository;
		      $banner_mobile = $common->uploadImage($request,$imgrequest->file('banner_mobile'),$this->tour_upload_func,$resize=true,768,450);
				}

        $data = [
            'title'=>$request->title,
            'slug' => \Unicode::make($request->title),
            'description' => $request->description,
            'content' => $request->content,
            'partner' => $request->partner,
            'stay' => $request->stay,
            'week' => $request->week,
            'start' => $request->start,
            'end' => $request->end,
            'price' => $request->price,
            'age' => $request->age,
            'img_avatar' => $img_url,
            'img_sharing' => $img_sharing,
            'country_id' => $request->country_id,
            'status'=> $request->status,
            'order'=>$current,
						'banner_desktop' => $banner_desktop,
						'banner_mobile' => $banner_mobile,
						'tour_code' => $request->tour_code,
        ];

        /* --- SCHEDULE --- */

        // $arr_data = [];
        // $arr_img = [];
        // if($imgrequest->hasFile('scheduleimg')){
        //     foreach($imgrequest->file('scheduleimg') as $key=>$img_item)
        //     {
        //         // $file = $imgrequest->file('scheduleimg');
        //         $destinationPath = public_path().'/upload'.'/'.$this->upload_folder2;
        //         $name = preg_replace('/\s+/', '', $img_item->getClientOriginalName());
        //         $filename = time().'_'.$name;
        //         $img_item->move($destinationPath,$filename);

        //         $img_url = asset('public/upload').'/'.$this->upload_folder2.'/'.$filename;

        //         array_push($arr_img, $img_url);
        //     }
        //     // $img_alt = \GetNameImage::make('\/',$filename);
        // }
        // foreach($request->input('scheduletitle') as $key=>$v){
        //     array_push($arr_data, new Schedule([
        //         'title'=>$v,
        //         'content'=> $request->input('schedulecontent')[$key],
        //         'img_avatar' => $arr_img[$key],
        //         'status' => 1
        //     ]));
        // }

        $tour = $this->tour->create($data);
        // $tour->schedule()->saveMany($arr_data);
        $tour->location()->attach($request->location_id);
        Notification::success('Created');
        return  redirect()->route('admin.course.index');
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
        $tour = $this->tour->with('schedule')->find($id);
        $country = Country::lists('name','id');
        $location = Location::lists('title','id');
        return view('Admin::pages.tour.view')->with(compact('tour','country','location'));
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

            $file_resize = $destinationPath.'/'.$filename;
            \Image::make($file->getRealPath())->resize(720,440)->save($file_resize);

            // $file->move($destinationPath,$filename);

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
        if($imgrequest->hasFile('img-sharing')){
            $file = $imgrequest->file('img-sharing');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;

            // $file->move($destinationPath,$filename);

            // $size = getimagesize($file);
            $file_resize = $destinationPath.'/'.$filename;

            \Image::make($file->getRealPath())->resize(600,315)->save($file_resize);
            // if($size[0] > 620){
            //     \Image::make($file->getRealPath())->resize(620,null,function($constraint){$constraint->aspectRatio();})->save($destinationPath.'/'.$filename);
            // }else{
            //     $file->move($destinationPath,$filename);
            // }

            $img_sharing = asset('public/upload').'/'.$this->upload_folder.'/'.$filename;
            // $img_alt = \GetNameImage::make('\/',$filename);
        }else{
            $img_sharing = $request->input('img-bk-sharing');
            // $img_alt = \GetNameImage::make('\/',$img_url);
        }


				if($imgrequest->hasFile('banner_desktop')){
					$common = new CommonRepository;
					$banner_desktop = $common->uploadImage($request,$imgrequest->file('banner_desktop'),$this->tour_upload_func,$resize=true,1170,350);
				}else{
					$banner_desktop = $imgrequest->input('bk-banner-desktop');
				}

				if($imgrequest->hasFile('banner_mobile')){
					$common = new CommonRepository;
					$banner_mobile = $common->uploadImage($request,$imgrequest->file('banner_mobile'),$this->tour_upload_func,$resize=true,768,450);
				}else {
					$banner_mobile = $imgrequest->input('bk-banner-mobile');
				}



        $tour = $this->tour->find($id);
        $tour->title = $request->title;
        $tour->slug = \Unicode::make($request->title);
        $tour->description = $request->input('description');
        $tour->content = $request->input('content');
        $tour->img_avatar = $img_url;
        $tour->img_sharing = $img_sharing;
        $tour->partner = $request->input('partner');
        $tour->stay = $request->input('stay');
        $tour->week = $request->input('week');
        $tour->start = $request->input('start');
        $tour->end = $request->input('end');
        $tour->price = $request->input('price');
        $tour->age = $request->input('age');
        $tour->country_id = $request->input('country_id');
        $tour->status = $request->status;
        $tour->order = $request->order;
        $tour->banner_desktop = $banner_desktop;
        $tour->banner_mobile = $banner_mobile;
				$tour->tour_code = $request->tour_code;
        $tour->save();

        /*SCHEDULE TOUR*/
        // foreach($request->input('schedule_id') as $key=>$v){
        //     $schedule = Schedule::find($v);
        //     $schedule->title = $request->input('scheduletitle')[$key];
        //     $schedule->content = $request->input('schedulecontent')[$key];
        //     $schedule->save();
        // }
        // $tour->location()->sync([$request->location_id]);

        Notification::success('Updated');
        return  redirect()->route('admin.course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->tour->destroy($id);
        \Notification::success('Remove Successful');
        return redirect()->route('admin.course.index');
    }

    public function deleteAll(Request $request){
        if(!$request->ajax()){
            return view('404');
        }else{
            $data = $request->arr;
            if($data){
                $this->tour->destroy($data);
                return response()->json(array('msg'=>'ok'));
            }else{
                return response()->json(array('msg'=>'error'));
            }
        }
    }

    public function checkRelate(Request $request){
        $tour = $this->tour->find($request->dataid);
        $count = $tour->image()->get()->count();
        if($count > 0){
            return response()->json(['msg'=>'yes']);
        }else{
            $tour->delete();
            return response()->json(['msg'=>'done']);
        }
    }

}
