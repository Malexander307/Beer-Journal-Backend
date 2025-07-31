<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Beer\CreateBeerDTO;
use App\DTO\Beer\UpdateBeerDTO;
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

        $this->repository->createOrUpdate($beer);

        return $beer;
    }

    public function update(Beer $beer, UpdateBeerDTO $updateBeerDTO): Beer
    {
        $beer->setName($updateBeerDTO->name);
        $beer->setDescription($updateBeerDTO->description);
        $beer->setImageUrl($updateBeerDTO->imageUrl);

        $this->repository->createOrUpdate($beer);

        return $beer;
    }

    public function delete(Beer $beer): Beer
    {
        return $this->repository->delete($beer);
    }
}