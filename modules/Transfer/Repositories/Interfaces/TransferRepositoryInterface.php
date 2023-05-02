<?php

namespace Modules\Transfer\Repositories\Interfaces;

interface TransferRepositoryInterface
{
    public function all();
    public function find($id, $param = null);
    public function create(array $data);
}
