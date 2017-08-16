<?php
namespace App\Repositories;

use App\Models\User;
use Auth;

class UserRepository{
  protected $user;

  public function __construct(User $user){
    $this->user =  $user;
    $this->auth = Auth::admin();
  }

  public function getList(){
    return $this->user->whereNotIn('id',[$this->auth->get()->id])->get();
  }

  public function getView($id){
    return $this->user->find($id);
  }

  public function postUpdate($id, $data){
    $inst =  $this->getView($id);
    return $inst->update($data);
  }

  public function delete($id){
    $this->user->destroy($id);
  }

  public function deleteAll($data){
    $this->user->destroy($data);
  }



}
