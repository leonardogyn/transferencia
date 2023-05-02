<?php

namespace Modules\TypeUser\Repositories\Interfaces;

interface TypeUsersRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
}
