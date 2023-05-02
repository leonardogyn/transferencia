<?php

namespace Modules\TypeTransfer\Repositories\Interfaces;

interface TypeTransferRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
}
