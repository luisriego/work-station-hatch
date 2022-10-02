<?php

declare(strict_types=1);

namespace App\Workstation\Adapter\Database\ORM\Doctrine;

use App\Workstation\Domain\Exception\ResourceNotFoundException;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Workstation\Domain\Model\Workstation;

class DoctrineWorkstationRepository implements WorkstationRepositoryInterface
{
    private readonly ServiceEntityRepository $repository;
    private readonly ObjectManager|EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new ServiceEntityRepository($managerRegistry, Workstation::class);
        $this->manager = $managerRegistry->getManager('workstation_em');
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
}
