<?php

declare(strict_types=1);

namespace App\Reservation\Adapter\Database\ORM\Doctrine\Repository;

use App\Reservation\Domain\Exception\ResourceNotFoundException;
use App\Reservation\Domain\Model\Reservation;
use App\Reservation\Domain\Repository\ReservationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class DoctrineReservationRepository implements ReservationRepositoryInterface
{
    private readonly ServiceEntityRepository $repository;
    private readonly ObjectManager|EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new ServiceEntityRepository($managerRegistry, Reservation::class);
        $this->manager = $managerRegistry->getManager();
    }

    public function findOneByIdOrFail(string $id): Reservation
    {
        if (null === $reservation = $this->repository->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Reservation::class, $id);
        }

        return $reservation;
    }

    public function save(Reservation $reservation): void
    {
        $this->manager->persist($this->repository);
        $this->manager->flush();
    }

    public function remove(Reservation $reservation): void
    {
        $this->manager->remove($reservation);
        $this->manager->flush();
    }
}
