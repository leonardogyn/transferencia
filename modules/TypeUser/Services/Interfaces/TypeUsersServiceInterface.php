<?php

namespace Modules\TypeUser\Services\Interfaces;

interface TypeUsersServiceInterface
{
    public function list();
    public function find($id);
    public function create(array $data);
    public function update($model, $id);
    public function delete($model);
}
