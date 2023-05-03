<?php

namespace Modules\Transfer\Repositories;

use App\Http\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\Transfer\Entities\Transfer;
use Modules\Transfer\Repositories\Interfaces\TransferRepositoryInterface;

class TransferRepository implements TransferRepositoryInterface
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

    public function find($id, $param = null)
    {
        return $this->repository->find($id, $param = null);
    }

    public function create(array $transfer)
    {
        return $this->repository->create($transfer);
    }

    public function update($entity)
    {
        return $this->repository->update($entity);
    }
}
