<?php

namespace Modules\Account\Repositories;

use App\Http\Repositories\BaseRepository;

use App\Http\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\Account\Entities\Account;
use Modules\Account\Repositories\Interfaces\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $baseRepository, Account $account)
    {
        $this->repository = $baseRepository;
        $this->repository->entity($account);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id, $param = null)
    {
        return $this->repository->find($id, $param);
    }

    public function create(array $account)
    {
        return $this->repository->create($account);
    }
}
