<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController extends AbstractController
{
    public function successResponse(mixed $data = null, string $message = 'success', int $code = 200): JsonResponse
    {
        return $this->json([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function errorResponse(string $message = '', array $errors = [], int $code = 500): JsonResponse
    {
        return $this->json([
            'status' => $code,
            'message' => $message,
            'error' => $errors
        ]);
    }
}