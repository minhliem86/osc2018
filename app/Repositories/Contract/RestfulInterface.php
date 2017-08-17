<?php
namespace App\Repositories\Contract;

interface RestfulInterface{

  public function all($columns = array('*'));

  public function select($columns = ['*']);

  public function paginate($limit = null, $columns = array('*'));

  public function find($id, $columns = array('*'));

  public function findByField($field, $value, $columns = array('*'));

  public function findWhereIn( $field, array $values, $columns = array('*'));

  public function findWhereNotIn( $field, array $values, $columns = array('*'));

  public function create(array $attributes);

  public function update(array $attributes, $id);

  public function delete($id);

  public function deleteAll($dataID);

  public function getOrder();

  public function lists($column1 = 'name', $column2 = 'id');

}
