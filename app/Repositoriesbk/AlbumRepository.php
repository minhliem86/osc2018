<?php
namespace App\Repositories;

use App\Repositories\Contract\CrudInterface;
use App\Models\Album;


class AlbumRepository implements CrudInterface{

  public $_inst;

  public function __construct(Album $album)
  {
    $this->_inst = $album;
  }

  public function getAll()
  {
    return $this->_inst->all();
  }

  public function getByID($id)
  {
    return $this->_inst->find($id);
  }

  public function getFirstByWhere($column, $cond)
  {
    return $this->_inst->where($column, $cond)->first();
  }

  public function getAllByWhere($column, $cond)
  {
    return $this->_inst->where($column, $cond)->get();
  }

  public function createItem($data)
  {
    return $this->_inst->create($data);
  }

  public function updateByID($id, $data)
  {
    $obj = $this->_inst->find($id);
    return $obj->update($data);
  }

  public function deleteByID($id)
  {
    $this->_inst->destroy($id);
  }

  public function deleteAll($dataID = null)
  {
    if($dataID != null){
        $this->_inst->destroy($dataID);
        return response()->json(array('msg'=>'ok'));
    }
    return response()->json(array('msg'=>'error'));
  }



}
