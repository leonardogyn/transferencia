<?php

namespace Modules\TypeUser\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\TypeUser\Entities\TypeUsers;
use App\Http\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\TypeUser\Repositories\Interfaces\TypeUsersRepositoryInterface;

class TypeUsersRepository implements TypeUsersRepositoryInterface
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $baseRepository, TypeUsers $typeUser)
    {
        $this->repository = $baseRepository;
        $this->repository->entity($typeUser);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $typeUser)
    {
        return $this->repository->create($typeUser);
    }
}
