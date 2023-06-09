<?php

namespace Modules\Transfer\Services\Interfaces;

interface TransferServiceInterface
{
    public function list();
    public function find($id, $param = null);
    public function create(array $data);
    public function update($entity);
}
