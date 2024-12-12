<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CreateBeerDTO;
use App\Entity\Beer;
use App\Repository\BeerRepository;

class BeerService
{
    public function __construct(
        private BeerRepository $repository,
    )
    {
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    public function create(CreateBeerDTO $createBeerDTO): Beer
    {
        $beer = new Beer();

        $beer->setName($createBeerDTO->name);
        $beer->setDescription($createBeerDTO->description);
        $beer->setImageUrl($createBeerDTO->imageUrl);

        $this->repository->create($beer);

        return $beer;
    }
}