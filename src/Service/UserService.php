<?php

namespace App\Service;

use App\DTO\AuthDTO;
use App\DTO\LoginDTO;
use App\DTO\UserCreateDTO;
use App\Entity\User;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private JWTTokenManagerInterface $jwtManager
    )
    {
    }

    public function createUser(UserCreateDTO $userCreateDTO): AuthDTO
    {
        $user = new User();

        $user->setName($userCreateDTO->name);
        $user->setPassword($userCreateDTO->password);
        $this->userRepository->create($user);

        return new AuthDTO(
            $this->jwtManager->create($user),
            $user
        );
    }

    public function login(LoginDTO $loginDTO): AuthDTO
    {
        $user = $this->userRepository->getUser($loginDTO->name);

        if ($user === null) {
            throw new NotFoundHttpException('There is now user with this name.');
        }

        //TODO:change after adding hashing of passwords
        if ($user->getPassword() !== $loginDTO->password) {
            throw new BadRequestHttpException('Wrong password.');
        }

        return new AuthDTO(
            $this->jwtManager->create($user),
            $user
        );
    }
}