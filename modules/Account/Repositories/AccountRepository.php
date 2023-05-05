<?php

namespace Modules\Account\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Account\Entities\Account;
use Modules\Account\Repositories\Interfaces\AccountRepositoryInterface;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    public function __construct(Account $account)
    {
        $this->model = $account;
    }
}
