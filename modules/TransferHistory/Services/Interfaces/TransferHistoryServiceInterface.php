<?php

namespace Modules\TransferHistory\Services\Interfaces;

interface TransferHistoryServiceInterface
{
    public function list();
    public function find($id);
    public function create(array $data);
}
