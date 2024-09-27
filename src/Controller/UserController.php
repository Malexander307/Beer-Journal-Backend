<?php

namespace App\Controller;

use App\DTO\LoginDTO;
use App\DTO\UserCreateDTO;
use App\HTTPResource\Auth\AuthResource;
use App\Request\Auth\LoginRequest;
use App\Request\Auth\RegistrationRequest;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends BaseController
{
    #[Route('/registration', name: 'registration', methods: ['POST'])]
    public function registration(UserService $userService, RegistrationRequest $request): JsonResponse
    {
        $data = $request->getRequest()->toArray();

        $user = $userService->createUser(new UserCreateDTO($data['name'], $data['password']));

        return $this->successResponse(new AuthResource($user));
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(UserService $userService, LoginRequest $request): JsonResponse
    {
        $data = $request->getRequest()->toArray();
        try {
            $authData = $userService->login(new LoginDTO($data['name'], $data['password']));
        } catch (NotFoundHttpException|BadRequestHttpException $exception) {
            return $this->errorResponse($exception->getMessage(), (array)$exception->getMessage(), $exception->getStatusCode());
        }

        return $this->successResponse(new AuthResource($authData));
    }
}
