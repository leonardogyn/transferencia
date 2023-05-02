<?php

namespace Modules\Transfer\Repositories;

use App\Http\Repositories\BaseRepository;

use App\Http\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\Transfer\Entities\Transfer;
use Modules\Transfer\Repositories\Interfaces\TransferRepositoryInterface;

class TransferRepository extends BaseRepository implements TransferRepositoryInterface
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $baseRepository, Transfer $transfer)
    {
        $this->repository = $baseRepository;
        $this->repository->entity($transfer);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function findByUuid($uuid)
    {
        return $this->repository->findByUuid($uuid);
    }

    public function create(array $transfer)
    {
        return $this->repository->create($transfer);
    }
}
