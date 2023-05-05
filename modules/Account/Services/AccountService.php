<?php

namespace Modules\Account\Services;

use Modules\Account\Repositories\Interfaces\AccountRepositoryInterface;
use Modules\Account\Services\Interfaces\AccountServiceInterface;

class AccountService implements AccountServiceInterface
{

    protected $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function list()
    {
        return $this->accountRepository->all();
    }

    public function find($id, $param = null)
    {
        return $this->accountRepository->find($id, $param);
    }

    public function create(array $account)
    {
        return $this->accountRepository->create($account);
    }

    public function update($model)
    {
        return $this->accountRepository->update($model);
    }
    public function delete($model)
    {
    }
}
