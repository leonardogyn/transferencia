<?php

namespace Modules\TransferHistory\Services;

use Modules\TransferHistory\Repositories\Interfaces\TransferHistoryRepositoryInterface;
use Modules\TransferHistory\Services\Interfaces\TransferHistoryServiceInterface;
use Ramsey\Uuid\Uuid;

class TransferHistoryService implements TransferHistoryServiceInterface
{

    protected $transferHistoryRepository;

    public function __construct(TransferHistoryRepositoryInterface $transferHistoryRepository)
    {
        $this->transferHistoryRepository = $transferHistoryRepository;
    }

    public function list()
    {
        return $this->transferHistoryRepository->all();
    }

    public function find($id)
    {
        return $this->transferHistoryRepository->find($id);
    }

    public function create(array $transferHistory)
    {
        $transferHistory['id'] = Uuid::uuid4()->toString();
        return $this->transferHistoryRepository->create($transferHistory);
    }

}
