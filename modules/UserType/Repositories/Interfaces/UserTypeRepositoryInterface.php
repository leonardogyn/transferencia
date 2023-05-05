<?php

namespace Modules\UserType\Repositories\Interfaces;

interface UserTypeRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
}
