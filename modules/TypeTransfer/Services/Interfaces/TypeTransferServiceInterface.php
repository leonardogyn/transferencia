<?php

namespace Modules\TypeTransfer\Services\Interfaces;

interface TypeTransferServiceInterface
{
    public function list();
    public function create(array $data);
    public function update($model, $id);
    public function delete($model);
}
