<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Notification;
use App\Http\Requests\ImageRequest;


class LocationController extends Controller {

	protected $location;

    protected $upload_folder = 'location';

    public function __construct(Location $location){
        $this->location = $location;
    }
    
    public function index()
    {
        $location = $this->location->select('id','title')->get();
        return view('Admin::pages.location.index')->with(compact('location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin::pages.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ImageRequest $imgrequest, Location $location)
    {
        $order = $this->location->orderBy('order','DESC')->first();
        count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;

        // if($imgrequest->hasFile('img')){
        //     $file = $imgrequest->file('img');
        //     $destinationPath = public_path().'/upload'.'/'.$this->upload_folder;
        //     $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
        //     $filename = time().'_'.$name;

        //     $file->move($destinationPath,$filename);

        //     // $size = getimagesize($file);
        //     // if($size[0] > 620){
        //     //     \Image::make($file->getRealPath())->resize(620,null,function($constraint){$constraint->aspectRatio();})->save($destinationPath.'/'.$filename);
        //     // }else{
        //     //     $file->move($destinationPath,$filename);
        //     // }

        //     $img_url = asset('public/upload').'/'.$this->upload_folder.'/'.$filename;
        //     // $img_alt = \GetNameImage::make('\/',$filename);
        // }else{
        //     $img_url = asset('public/assets/backend/img/image_thumbnail.gif');
        //     // $img_alt = \GetNameImage::make('\/',$img_url);
        // }


        $data = [
            'title'=>$request->title,
            'slug' => \Unicode::make($request->title),
            'id_city' => $request->id_city,
            'id_center' => $request->id_center,
            'status'=> $request->status,
            'order'=>$current
        ];
        $this->location->create($data);
        Notification::success('Created');
        return  redirect()->route('admin.location.index');
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
        $location = $this->location->find($id);
        return view('Admin::pages.location.view')->with(compact('location'));
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
        // if($imgrequest->hasFile('img')){
        //     $file = $imgrequest->file('img');
        //     $destinationPath = public_path().'/upload'.'/'.$this->upload_folder;
        //     $name = preg_replace('/\s+/', '', $file->getClientOriginalName());
        //     $filename = time().'_'.$name;

        //     $file->move($destinationPath,$filename);

        //     // $size = getimagesize($file);
        //     // if($size[0] > 620){
        //     //     \Image::make($file->getRealPath())->resize(620,null,function($constraint){$constraint->aspectRatio();})->save($destinationPath.'/'.$filename);
        //     // }else{
        //     //     $file->move($destinationPath,$filename);
        //     // }

        //     $img_url = asset('public/upload').'/'.$this->upload_folder.'/'.$filename;
        // }else{
        //     $img_url = $request->input('img-bk');
        // }

        $location = $this->location->find($id);
        $location->title = $request->title;
        $location->slug = \Unicode::make($request->title);
        $location->id_city = $request->input('id_city');
        $location->id_center = $request->input('id_center');
        $location->status = $request->status;
        $location->order = $request->order;
        $location->save();

        Notification::success('Updated');
        return  redirect()->route('admin.location.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->location->destroy($id);
        \Notification::success('Remove Successful');
        return redirect()->route('admin.location.index');
    }

    public function deleteAll(Request $request){
        if(!$request->ajax()){
            return view('404');
        }else{
            $data = $request->arr;
            if($data){
                $this->location->destroy($data);
                return response()->json(array('msg'=>'ok'));
            }else{
                return response()->json(array('msg'=>'error'));
            }
        }
    }

    public function checkRelate(Request $request){
        $location = $this->location->find($request->dataid);
        $count = $location->image()->get()->count();
        if($count > 0){
            return response()->json(['msg'=>'yes']);
        }else{
            $location->delete();
            return response()->json(['msg'=>'done']);
        }
    }
	
}