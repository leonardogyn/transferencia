<?php

namespace Modules\Account\Repositories\Interfaces;

interface AccountRepositoryInterface
{
    public function all();
    public function findByUuid($uuid);
    public function create(array $data);
}
