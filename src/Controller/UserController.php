<?php

namespace App\Controller;

use App\DTO\Auth\LoginDTO;
use App\DTO\User\UserCreateDTO;
use App\Request\Auth\LoginRequest;
use App\Request\Auth\RegistrationRequest;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends BaseController
{
    #[Route('/registration', name: 'registration', methods: ['POST'])]
    public function registration(UserService $userService, RegistrationRequest $request, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getRequest()->toArray();

        $user = $userService->createUser(new UserCreateDTO($data['name'], $data['password']));

        $userArr = $serializer->normalize($user, null, ['groups' => ['user_detail']]);

        return $this->successResponse([
            'token' => $user->token,
            'user' => $userArr
        ]);
    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(UserService $userService, LoginRequest $request, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getRequest()->toArray();
        try {
            $authData = $userService->login(new LoginDTO($data['name'], $data['password']));
        } catch (NotFoundHttpException|BadRequestHttpException $exception) {
            return $this->errorResponse($exception->getMessage(), (array)$exception->getMessage(), $exception->getStatusCode());
        }

        $userArr = $serializer->normalize($authData->user, null, ['groups' => ['user_detail']]);
        return $this->successResponse([
            'token' => $authData->token,
            'user' => $userArr
        ]);
    }

    #[Route('/admin/login', name: 'admin_login', methods: ['POST'])]
    public function adminLogin(UserService $userService, LoginRequest $request, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getRequest()->toArray();
        try {
            $authData = $userService->adminLogin(new LoginDTO($data['name'], $data['password']));
        } catch (NotFoundHttpException|BadRequestHttpException $exception) {
            return $this->errorResponse($exception->getMessage(), (array)$exception->getMessage(), $exception->getStatusCode());
        }

        $userArr = $serializer->normalize($authData->user, null, ['groups' => ['user_detail']]);
        return $this->successResponse([
            'token' => $authData->token,
            'user' => $userArr
        ]);
    }
}
