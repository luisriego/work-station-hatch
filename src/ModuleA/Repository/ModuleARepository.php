<?php

declare(strict_types=1);

namespace ModuleA\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use ModuleA\Entity\ModuleA;

class ModuleARepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModuleA::class);
    }
}