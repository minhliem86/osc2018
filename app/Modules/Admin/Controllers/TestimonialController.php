<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Notification;
use App\Http\Requests\ImageRequest;


class TestimonialController extends Controller {

	protected $testimonial;

    protected $upload_folder = 'testimonial';
    protected $upload_sub_folder = 'slide';

    public function __construct(Testimonial $testimonial){
        $this->testimonial = $testimonial;
    }
    
    public function index()
    {
        $testimonial = $this->testimonial->select('id','title','author','img_avatar')->get();
        return view('Admin::pages.testimonial.index')->with(compact('testimonial'));
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
        $order = $this->testimonial->orderBy('order','DESC')->first();
        count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;

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
            // $img_alt = \GetNameImage::make('\/',$filename);
        }else{
            $img_url = asset('public/assets/backend/img/image_thumbnail.gif');
            // $img_alt = \GetNameImage::make('\/',$img_url);
        }

        if($imgrequest->hasFile('imgslide')){
            $file = $imgrequest->file('imgslide');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder.'/'.$this->upload_sub_folder;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;

            // $file->move($destinationPath,$filename);

            $filename_resize = $destinationPath.'/'.$filename;
            $size = getimagesize($file);
            \Image::make($file->getRealPath())->resize(760,500)->save($filename_resize);

            $imgslide_url = asset('public/upload').'/'.$this->upload_folder.'/'.$this->upload_sub_folder.'/'.$filename;
            // $img_alt = \GetNameImage::make('\/',$filename);
        }else{
            $imgslide_url = asset('public/assets/frontend/images/default-img/testimonial-default.jpg');
            // $img_alt = \GetNameImage::make('\/',$img_url);
        }


        $data = [
            'title'=>$request->title,
            'slug' => \Unicode::make($request->title),
            'author' => $request->author,
            'description' => $request->description,
            'content' => $request->content,
            'focus' => $request->focus,
            'img_avatar' => $img_url,
            'img_slides' => $imgslide_url,
            'status'=> $request->status,
            'order'=>$current
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
            \Image::make($file->getRealPath())->resize(760,500)->save($filename_resize);

            $imgslide_url = asset('public/upload').'/'.$this->upload_folder.'/'.$this->upload_sub_folder.'/'.$filename;
        }else{
            $imgslide_url = $request->input('imgslide-bk');
        }

        $testimonial = $this->testimonial->find($id);
        $testimonial->title = $request->title;
        $testimonial->slug = \Unicode::make($request->title);
        $testimonial->author = $request->input('author');
        $testimonial->description = $request->input('description');
        $testimonial->content = $request->input('content');
        $testimonial->focus = $request->input('focus');
        $testimonial->img_avatar = $img_url;
        $testimonial->img_slides = $imgslide_url;
        $testimonial->status = $request->status;
        $testimonial->order = $request->order;
        $testimonial->save();

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
        $this->testimonial->destroy($id);
        \Notification::success('Remove Successful');
        return redirect()->route('admin.testimonial.index');
    }

    public function deleteAll(Request $request){
        if(!$request->ajax()){
            return view('404');
        }else{
            $data = $request->arr;
            if($data){
                $this->testimonial->destroy($data);
                return response()->json(array('msg'=>'ok'));
            }else{
                return response()->json(array('msg'=>'error'));
            }
        }
    }

    public function checkRelate(Request $request){
        $testimonial = $this->testimonial->find($request->dataid);
        $count = $testimonial->image()->get()->count();
        if($count > 0){
            return response()->json(['msg'=>'yes']);
        }else{
            $testimonial->delete();
            return response()->json(['msg'=>'done']);
        }
    }
	
}