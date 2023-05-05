<?php

namespace App\Http\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all();
    public function find($value, $param = null);
    public function findByUuid($uuid);
    public function findBy($criteria = null, $param = null);
    public function create(array $data);
    public function update($entity);
    public function paginate(int $perPage, array $criteria = []);
}
