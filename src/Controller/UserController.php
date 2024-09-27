<?php

namespace App\Controller;

use App\DTO\UserCreateDTO;
use App\HTTPResource\Auth\AuthResource;
use App\HTTPResource\User\UserResource;
use App\Request\RegistrationRequest;
use App\Service\UserService;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends BaseController
{
    #[Route('/users', name: 'create_user', methods: ['POST'])]
    public function store(UserService $userService, RegistrationRequest $request, JWTTokenManagerInterface $jwtManager): JsonResponse
    {
        $data = $request->getRequest()->toArray();

        $user = $userService->createUser(new UserCreateDTO($data['name'], $data['password']), $jwtManager);

        return $this->successResponse(new AuthResource($user));
    }
}
