<?php

namespace Modules\UserType\Services\Interfaces;

interface UserTypeServiceInterface
{
    public function list();
    public function find($id);
    public function create(array $data);
    public function update($model, $id);
    public function delete($model);
}
