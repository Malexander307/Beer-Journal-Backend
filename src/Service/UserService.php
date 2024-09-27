<?php

namespace App\Service;

use App\DTO\AuthDTO;
use App\DTO\UserCreateDTO;
use App\Entity\User;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function createUser(UserCreateDTO $userCreateDTO, JWTTokenManagerInterface $jwtManager): AuthDTO
    {
        $user = new User();

        $user->setName($userCreateDTO->name);
        $user->setPassword($userCreateDTO->password);
        $this->userRepository->create($user);

        return new AuthDTO(
            $jwtManager->create($user),
            $user
        );
    }
}