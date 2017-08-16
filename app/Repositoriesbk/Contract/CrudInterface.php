<?php
namespace App\Repositories\Contract;

interface CrudInterface{
  public function getAll();

  public function getByID($id);

  public function getFirstByWhere($column, $cond);

  public function getAllByWhere($column, $cond);

  public function createItem($data);

  public function updateByID($id, $data);

  public function deleteByID($id);

  public function deleteAll($dataId);

}
