<?php

namespace App\Controller;

use App\HTTPResource\Beer\BeerResource;
use App\Repository\BeerRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class BeerController extends BaseController
{
    #[Route('/beers', name: 'get_beers', methods: ['GET'])]
    public function index(BeerRepository $repository): JsonResponse
    {
        return $this->successResponse(BeerResource::collection($repository->findAll()));
    }
}
