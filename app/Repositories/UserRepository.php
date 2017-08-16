<?php
namespace App\Repositories;

use App\Repositories\Contract\RestfulInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\User;
use Auth;

class UserRepository{

    public function getModel()
    {
        return get_class(new Country);
    }

  public function __construct(){
    $this->auth = Auth::admin();
  }

  public function getList(){
    return $this->model->whereNotIn('id',[$this->auth->get()->id])->get();
  }

  public function getView($id){
    return $this->model->find($id);
  }

  public function postUpdate($id, $data){
    $inst =  $this->getView($id);
    return $inst->update($data);
  }

  public function delete($id){
    $this->model->destroy($id);
  }

  public function deleteAll($data){
    $this->model->destroy($data);
  }



}
