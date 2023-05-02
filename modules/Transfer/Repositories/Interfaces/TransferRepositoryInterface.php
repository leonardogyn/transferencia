<?php

namespace Modules\Transfer\Repositories\Interfaces;

interface TransferRepositoryInterface
{
    public function all();
    public function findByUuid($uuid);
    public function create(array $data);
}
