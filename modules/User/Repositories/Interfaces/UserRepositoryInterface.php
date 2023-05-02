<?php

namespace Modules\User\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function all();
    public function findByUuid($uuid);
    public function create(array $data);
}
