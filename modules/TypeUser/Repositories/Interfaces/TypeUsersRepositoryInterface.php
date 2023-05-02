<?php

namespace Modules\TypeUser\Repositories\Interfaces;

interface TypeUsersRepositoryInterface
{
    public function all();
    public function findByUuid($uuid);
    public function create(array $data);
}
