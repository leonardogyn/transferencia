<?php

namespace Modules\User\Repositories;

use App\Http\Repositories\BaseRepository;

use App\Http\Repositories\Interfaces\BaseRepositoryInterface;
use Modules\User\Entities\User;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $baseRepository, User $user)
    {
        $this->repository = $baseRepository;
        $this->repository->entity($user);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $user)
    {
        return $this->repository->create($user);
    }
}
