<?php

namespace Modules\TypeTransfer\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\TypeTransfer\Entities\TypeTransfer;
use App\Http\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\TypeTransfer\Repositories\Interfaces\TypeTransferRepositoryInterface;

class TypeTransferRepository extends BaseRepository implements TypeTransferRepositoryInterface
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

    public function findByUuid($uuid)
    {
        return $this->repository->findByUuid($uuid);
    }

    public function create(array $typeTransfer)
    {
        return $this->repository->create($typeTransfer);
    }
}
