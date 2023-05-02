<?php

namespace Modules\User\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
}
