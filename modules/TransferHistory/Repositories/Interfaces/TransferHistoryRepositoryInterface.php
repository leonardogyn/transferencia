<?php

namespace Modules\TransferHistory\Repositories\Interfaces;

interface TransferHistoryRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
}
