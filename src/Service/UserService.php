<?php

namespace App\Service;

use App\DTO\UserCreateDTO;
use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function createUser(UserCreateDTO $userCreateDTO): User
    {
        $user = new User();

        $user->setName($userCreateDTO->name);
        $user->setEmail($userCreateDTO->email);
        $user->setPassword($userCreateDTO->password);
        $this->userRepository->create($user);

        return $user;
    }
}