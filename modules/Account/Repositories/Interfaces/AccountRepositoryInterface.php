<?php

namespace Modules\Account\Repositories\Interfaces;

interface AccountRepositoryInterface
{
    public function all();
    public function find($id, $param);
    public function create(array $data);
    public function update($update);
}
