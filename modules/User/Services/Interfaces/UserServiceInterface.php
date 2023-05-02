<?php

namespace Modules\User\Services\Interfaces;

interface UserServiceInterface
{
    public function list();
    public function create(array $data);
    public function update($model, $id);
    public function delete($model);
}
