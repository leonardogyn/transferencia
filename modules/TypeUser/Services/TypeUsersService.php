<?php

namespace Modules\TypeUser\Services;

use Modules\TypeUser\Repositories\Interfaces\TypeUsersRepositoryInterface;
use Modules\TypeUser\Services\Interfaces\TypeUsersServiceInterface;

class TypeUsersService implements TypeUsersServiceInterface
{

    protected $typeUserRepository;

    public function __construct(TypeUsersRepositoryInterface $typeUserRepository)
    {
        $this->typeUserRepository = $typeUserRepository;
    }

    public function list()
    {
        return $this->typeUserRepository->all();
    }

    public function find($id)
    {
        return $this->typeUserRepository->find($id);
    }

    public function create(array $typeUser)
    {
        return $this->typeUserRepository->create($typeUser);
    }

    public function update($model, $id)
    {
    }
    public function delete($model)
    {
    }
}
