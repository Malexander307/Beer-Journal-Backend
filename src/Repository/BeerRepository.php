<?php

namespace App\Repository;

use App\Entity\Beer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Beer>
 */
class BeerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Beer::class);
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function createOrUpdate(Beer $beer): Beer
    {
        $this->entityManager->persist($beer);
        $this->entityManager->flush();

        return $beer;
    }

    public function delete(Beer $beer): Beer
    {
        $this->entityManager->remove($beer);
        $this->entityManager->flush();

        return $beer;
    }
}
