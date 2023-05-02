<?php

namespace Modules\Transfer\Services;

use Modules\Transfer\Repositories\Interfaces\TransferRepositoryInterface;
use Modules\Transfer\Services\Interfaces\TransferServiceInterface;

class TransferService implements TransferServiceInterface
{

    protected $transferRepository;

    public function __construct(TransferRepositoryInterface $transferRepository)
    {
        $this->transferRepository = $transferRepository;
    }

    public function list()
    {
        return $this->transferRepository->all();
    }

    public function create(array $transfer)
    {
        return $this->transferRepository->create($transfer);
    }

    public function update($model, $id)
    {
    }
    public function delete($model)
    {
    }
}
