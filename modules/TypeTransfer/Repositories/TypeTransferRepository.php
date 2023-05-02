<?php

namespace Modules\TypeTransfer\Repositories;

use Modules\TypeTransfer\Entities\TypeTransfer;
use App\Http\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\TypeTransfer\Repositories\Interfaces\TypeTransferRepositoryInterface;

class TypeTransferRepository implements TypeTransferRepositoryInterface
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $baseRepository, TypeTransfer $typeTransfer)
    {
        $this->repository = $baseRepository;
        $this->repository->entity($typeTransfer);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $typeTransfer)
    {
        return $this->repository->create($typeTransfer);
    }
}
