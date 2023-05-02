<?php

namespace Modules\Account\Services\Interfaces;

interface AccountServiceInterface
{
    public function list();
    public function find($id, $param = null);
    public function create(array $data);
    public function update($model, $id);
    public function delete($model);
}
