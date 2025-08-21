<?php

namespace App\Controller;

use App\DTO\Beer\CreateBeerDTO;
use App\DTO\Beer\UpdateBeerDTO;
use App\Entity\Beer;
use App\Repository\BeerRepository;
use App\Request\Beer\CreateBeerRequest;
use App\Request\Beer\UpdateBeerRequest;
use App\Service\BeerService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BeerController extends BaseController
{
    #[Route('/beers', name: 'get_beers', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator, BeerRepository $repository, SerializerInterface $serializer): JsonResponse
    {
        $pagination = $paginator->paginate(
            $repository->createQueryBuilder('b')->getQuery(),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        $data = [
            'data' => json_decode($serializer->serialize($pagination->getItems(), 'json', ['groups' => ['beer_detail']])),
            'pagination' => [
                'current_page' => $pagination->getCurrentPageNumber(),
                'total_pages' => $pagination->getPageCount(),
                'total_items' => $pagination->getTotalItemCount(),
            ]
        ];

        return $this->successResponse($data);
    }

    #[Route('/beers', name: 'create_beer', methods: ['POST'])]
    public function create(CreateBeerRequest $request, BeerService $service, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getRequest()->toArray();

        $beer = $service->create(new CreateBeerDTO(
            $data['name'],
            $data['description'],
            $data['image_url']
        ));

        $beerData = $serializer->serialize($beer, 'json', ['groups' => ['beer_detail']]);
        return $this->successResponse($beerData);
    }

    #[Route('/beers/{id}', name: 'update_beer', methods: ['PUT'])]
    public function update(Beer $beer, UpdateBeerRequest $request, BeerService $service, SerializerInterface $serializer): JsonResponse
    {
        $data = $request->getRequest()->toArray();

        $beer = $service->update($beer, new UpdateBeerDTO($data['name'], $data['description'], $data['image_url']));

        $beerData = $serializer->serialize($beer, 'json', ['groups' => ['beer_detail']]);
        return $this->successResponse($beerData);
    }

    #[Route('/beers/{id}', name: 'delete_beer', methods: ['DELETE'])]
    public function delete(Beer $beer, BeerService $service, SerializerInterface $serializer): JsonResponse
    {
        $beer = $service->delete($beer);

        $beerData = $serializer->serialize($beer, 'json', ['groups' => ['beer_detail']]);
        return $this->successResponse($beerData);
    }
}
