<?php

namespace Modules\TypeTransfer\Repositories\Interfaces;

interface TypeTransferRepositoryInterface
{
    public function all();
    public function findByUuid($uuid);
    public function create(array $data);
}
