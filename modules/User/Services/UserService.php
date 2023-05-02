<?php

namespace Modules\User\Services;

use Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use Modules\User\Services\Interfaces\UserServiceInterface;

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

    public function create(array $user)
    {
        return $this->userRepository->create($user);
    }

    public function update($model, $id)
    {
    }
    public function delete($model)
    {
    }
}
