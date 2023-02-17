<?php


namespace App\Contracts\Repositories;


use Prettus\Repository\Contracts\RepositoryInterface;

interface AnswerRepository extends RepositoryInterface
{
    public function getAll();

    public function getByWhereInIds($ids);

    public function getById($id);

    public function getByWhere($where);

    public function checkByWhere($where);

    public function insertNewRecord($array);

    public function updateById($array, $id);

    public function updateFieldsByWhere($where, $field);

    public function deleteById($id);

    public function deleteByWhere($where);

    public function updateOrInsert($where, $update);

    public function getByWhereFirst($where);

}
