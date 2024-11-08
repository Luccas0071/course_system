<?php

namespace App\Services;

use App\Repositories\UserRepository;


class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser()
    {
        return $this->userRepository->all();
    }

    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->create($data);
    }

    public function updateUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->update($data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}