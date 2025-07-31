<?php

namespace App\Controller;

use App\DTO\Beer\CreateBeerDTO;
use App\DTO\Beer\UpdateBeerDTO;
use App\Entity\Beer;
use App\HTTPResource\MobileAPI\Beer\BeerResource;
use App\Repository\BeerRepository;
use App\Request\Beer\CreateBeerRequest;
use App\Request\Beer\UpdateBeerRequest;
use App\Service\BeerService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BeerController extends BaseController
{
    #[Route('/beers', name: 'get_beers', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator, BeerRepository $repository): JsonResponse
    {
        $pagination = $paginator->paginate(
            $repository->createQueryBuilder('b')->getQuery(),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        return $this->successResponse([
            'data' => BeerResource::collection($pagination->getItems()),
            'pagination' => [
                'current_page' => $pagination->getCurrentPageNumber(),
                'total_pages' => $pagination->getPageCount(),
                'total_items' => $pagination->getTotalItemCount(),
            ]
        ]);
    }

    #[Route('/beers', name: 'create_beer', methods: ['POST'])]
    public function create(CreateBeerRequest $request, BeerService $service): JsonResponse
    {
        $data = $request->getRequest()->toArray();

        $beer = $service->create(new CreateBeerDTO(
            $data['name'],
            $data['description'],
            $data['image_url']
        ));

        return $this->successResponse(new BeerResource($beer));
    }

    #[Route('/beers/{id}', name: 'update_beer', methods: ['PUT'])]
    public function update(Beer $beer, UpdateBeerRequest $request, BeerService $service): JsonResponse
    {
        $data = $request->getRequest()->toArray();

        $beer = $service->update($beer, new UpdateBeerDTO($data['name'], $data['description'], $data['image_url']));

        return $this->successResponse(new BeerResource($beer));
    }

    #[Route('/beers/{id}', name: 'delete_beer', methods: ['DELETE'])]
    public function delete(Beer $beer, BeerService $service): JsonResponse
    {
        $beer = $service->delete($beer);

        return $this->successResponse(new BeerResource($beer));
    }
}
