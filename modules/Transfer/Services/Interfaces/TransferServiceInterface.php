<?php

namespace Modules\Transfer\Services\Interfaces;

interface TransferServiceInterface
{
    public function list();
    public function create(array $data);
    public function update($model, $id);
    public function delete($model);
}
