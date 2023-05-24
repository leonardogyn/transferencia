<?php

namespace Modules\UserType\Services;

use Modules\UserType\Repositories\Interfaces\UserTypeRepositoryInterface;
use Modules\UserType\Services\Interfaces\UserTypeServiceInterface;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class UserTypeService implements UserTypeServiceInterface
{

    protected $userTypeRepository;

    public function __construct(UserTypeRepositoryInterface $userTypeRepository)
    {
        $this->userTypeRepository = $userTypeRepository;
    }

    public function list()
    {
        return $this->userTypeRepository->all();
    }

    public function find($id)
    {
        return $this->userTypeRepository->find($id);
    }

    public function create(array $userType)
    {
        $userType['id'] = Uuid::uuid4()->toString();
        $userType['flag'] = Str::upper($userType['flag']);
        return $this->userTypeRepository->create($userType);
    }

    public function update($model, $id)
    {
    }
    public function delete($model)
    {
        $delete = $this->find($model['id']);
        return $delete->delete();
    }
}
