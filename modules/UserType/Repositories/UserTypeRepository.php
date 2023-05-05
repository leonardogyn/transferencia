<?php

namespace Modules\UserType\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\UserType\Entities\UserType;
use Modules\UserType\Repositories\Interfaces\UserTypeRepositoryInterface;

class UserTypeRepository extends BaseRepository implements UserTypeRepositoryInterface
{
    public function __construct(UserType $userType)
    {
        $this->model = $userType;
    }
}
