<?php

namespace Modules\TypeTransfer\Services;

use Modules\TypeTransfer\Repositories\Interfaces\TypeTransferRepositoryInterface;
use Modules\TypeTransfer\Services\Interfaces\TypeTransferServiceInterface;

class TypeTransferService implements TypeTransferServiceInterface
{

    protected $typeTransferRepository;

    public function __construct(TypeTransferRepositoryInterface $typeTransferRepository)
    {
        $this->typeTransferRepository = $typeTransferRepository;
    }

    public function list()
    {
        return $this->typeTransferRepository->all();
    }

    public function create(array $typeTransfer)
    {
        return $this->typeTransferRepository->create($typeTransfer);
    }

    public function update($model, $id)
    {
    }
    public function delete($model)
    {
    }
}
