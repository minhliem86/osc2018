<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Notification;
use App\Http\Requests\ImageRequest;


class ImageController extends Controller {

	protected $image;

    protected $upload_folder = 'image';

    public function __construct(Image $image){
        $this->image = $image;
    }
    
    public function index()
    {
        $image = $this->image->select('id','img_url','type')->get();
        return view('Admin::pages.image.index')->with(compact('image'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin::pages.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ImageRequest $imgrequest, Image $image)
    {
        $order = $this->image->orderBy('order','DESC')->first();
        count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;

        if($imgrequest->hasFile('img')){
            $file = $imgrequest->file('img');
            $destinationPath = 'public/upload'.'/'.$this->upload_folder;
            $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filename = time().'_'.$name;

            // $file->move($destinationPath,$filename);

            if($request->input('type') && $request->input('type') == 'banner'){
                $banner_width = 2000;
                $banner_height = 400;

                $size = getimagesize($file);
                if($size[0] > $banner_width){
                    \Image::make($file->getRealPath())->resize($banner_width,$banner_height)->save($destinationPath.'/'.$filename);
                }else{
                    $file->move($destinationPath,$filename);
                }
            }else{
                $file->move($destinationPath,$filename);
            }

            $img_url = asset('public/upload').'/'.$this->upload_folder.'/'.$filename;
            $img_alt = \GetNameImage::make('\/',$filename);
        }else{
            $img_url = asset('public/assets/backend/img/image_thumbnail.gif');
            $img_alt = \GetNameImage::make('\/',$img_url);
        }


        $data = [
            'img_url'=>$img_url,
            'img_alt'=>$img_alt,
            'type' =>$request->type,
            'status'=> $request->status,
            'order'=>$current
        ];
        $this->image->create($data);
        Notification::success('Created');
        return  redirect()->route('admin.image.index');
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
        $image = $this->image->find($id);
        return view('Admin::pages.image.view')->with(compact('image'));
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

            // $file->move($destinationPath,$filename);

            if($request->input('type') && $request->input('type') == 'banner'){
                $banner_width = 2000;
                $banner_height = 400;
                
                $filename_resize = $destinationPath.$filename;
                $size = getimagesize($file);
                if($size[0] > $banner_width){
                    \Image::make($file->getRealPath())->resize($banner_width,$banner_height)->save($filename_resize);
                }else{
                    $file->move($destinationPath,$filename);
                }
            }else{
                $file->move($destinationPath,$filename);
            }

            $img_url = asset('public/upload').'/'.$this->upload_folder.'/'.$filename;
            $img_alt = \GetNameImage::make('\/',$filename);
        }else{
            $img_url = $request->input('img-bk');
            $img_alt = \GetNameImage::make('\/',$img_url);
        }

        $image = $this->image->find($id);
        $image->img_url = $img_url;
        $image->img_alt = $img_alt;
        $image->type = $request->type;
        $image->status = $request->status;
        $image->order = $request->order;
        $image->save();

        Notification::success('Updated');
        return  redirect()->route('admin.image.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->image->destroy($id);
        \Notification::success('Remove Successful');
        return redirect()->route('admin.image.index');
    }

    public function deleteAll(Request $request){
        if(!$request->ajax()){
            return view('404');
        }else{
            $data = $request->arr;
            if($data){
                $this->image->destroy($data);
                return response()->json(array('msg'=>'ok'));
            }else{
                return response()->json(array('msg'=>'error'));
            }
        }
    }

    public function checkRelate(Request $request){
        $image = $this->image->find($request->dataid);
        $count = $image->image()->get()->count();
        if($count > 0){
            return response()->json(['msg'=>'yes']);
        }else{
            $image->delete();
            return response()->json(['msg'=>'done']);
        }
    }
	
}