<?php
namespace App\Repositories;

use App\Models\Country;

class CountryRepository{
  protected $country;

  public function __construst(Country $country){
    $this->country = $country;
  }

  public function getAll(){
    return $this->country->select('id','name','status','order','img_avatar')->orderBy('id','DESC')->get();
  }

  public function getFindID($id){
    return $this->country->find($id);
  }

  public function postUpdate($id,$data){
    return $this->country->where('id',$id)->update($data);
  }

  public function postCreate($data){
    return $this->country->create($data);
  }

  public function delete($id){
    $this->country->destroy($id);
  }

  public function deleteAll($data){
    $this->country->destroy($data);
  }

  public function getOrder(){
    $order = $this->country->orderBy('order','DESC')->first();
    count($order) == 0 ?  $current = 1 :  $current = $order->order +1 ;
    return $current;
  }

}
