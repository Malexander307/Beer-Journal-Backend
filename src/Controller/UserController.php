<?php

namespace App\Controller;

use App\DTO\UserCreateDTO;
use App\Request\RegistrationRequest;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends BaseController
{
    #[Route('/users', name: 'create_user', methods: ['POST'])]
    public function store(UserService $userService, RegistrationRequest $request, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getRequest()->toArray();

        $user = $userService->createUser(new UserCreateDTO($data['name'], $data['email'], $data['password']));

        return $this->successResponse(json_decode($serializer->serialize($user, 'json', [
            AbstractNormalizer::GROUPS => ['user_details']
        ])));
    }
}
