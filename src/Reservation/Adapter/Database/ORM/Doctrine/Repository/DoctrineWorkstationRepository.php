<?php

declare(strict_types=1);

namespace App\Reservation\Adapter\Database\ORM\Doctrine\Repository;

use App\Reservation\Domain\Exception\ResourceNotFoundException;
use App\Reservation\Domain\Model\Reservation;
use App\Reservation\Domain\Model\Workstation;
use App\Reservation\Domain\Repository\WorkstationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class DoctrineWorkstationRepository implements WorkstationRepositoryInterface
{
    private readonly ServiceEntityRepository $repository;
    private readonly ObjectManager|EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new ServiceEntityRepository($managerRegistry, Reservation::class);
        $this->manager = $managerRegistry->getManager();
    }

    public function findOneByIdOrFail(string $id): Workstation
    {
        if (null === $workstation = $this->repository->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Workstation::class, $id);
        }

        return $workstation;
    }

    public function save(Workstation $workstation): void
    {
        $this->manager->persist($workstation);
        $this->manager->flush();
    }

    public function remove(Workstation $workstation): void
    {
        $this->manager->remove($workstation);
        $this->manager->flush();
    }
}
