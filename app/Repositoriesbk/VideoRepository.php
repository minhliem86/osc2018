<?php
namespace App\Repositories;

use App\Models\Video;

class VideoRepository{
  protected $video;

  public function __construct(Video $video){
    $this->video = $video;
  }

  public function getAll(){
    $inst = $this->video->all(['id','title','img_url','video_url','status','album_id']);
    return $inst;
  }

  public function getFindID($id){
    return $this->video->find($id);
  }

  public function postUpdate($id,$data){
    return $this->video->where('id',$id)->update($data);
  }

  public function postCreate($data){
    return $this->video->create($data);
  }

  public function delete($id){
    $this->video->destroy($id);
  }

  public function deleteAll($data){
    $this->video->destroy($data);
  }

  public function getOrder(){
    $order = $this->video->orderBy('order','DESC')->first();
    count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;
    return $current;
  }

}
