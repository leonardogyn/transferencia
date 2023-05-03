<?php

namespace Modules\TransferHistory\Repositories;

use Modules\TransferHistory\Entities\TransferHistory;
use App\Http\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\TransferHistory\Repositories\Interfaces\TransferHistoryRepositoryInterface;

class TransferHistoryRepository implements TransferHistoryRepositoryInterface
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $baseRepository, TransferHistory $transferHistory)
    {
        $this->repository = $baseRepository;
        $this->repository->entity($transferHistory);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id, $param = null)
    {
        return $this->repository->find($id, $param);
    }

    public function create(array $transferHistory)
    {
        return $this->repository->create($transferHistory);
    }
}
