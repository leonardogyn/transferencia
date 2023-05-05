<?php

namespace Modules\User\Services;

use Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use Modules\User\Services\Interfaces\UserServiceInterface;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list()
    {
        return $this->userRepository->all();
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    public function create(array $user)
    {
        $user['id'] = Uuid::uuid4()->toString();
        $user['password'] = Hash::make($user['password']);
        return $this->userRepository->create($user);
    }

    public function update($model, $id)
    {
    }
    public function delete($model)
    {
    }
}
