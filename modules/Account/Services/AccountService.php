<?php

namespace Modules\Account\Services;

use Modules\Account\Repositories\Interfaces\AccountRepositoryInterface;
use Modules\Account\Services\Interfaces\AccountServiceInterface;
use Ramsey\Uuid\Uuid;

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
        $account['id'] = Uuid::uuid4()->toString();
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
