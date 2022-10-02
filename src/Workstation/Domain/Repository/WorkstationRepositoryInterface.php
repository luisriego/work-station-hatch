<?php

declare(strict_types=1);

namespace App\Workstation\Domain\Repository;

use Workstation\Domain\Model\Workstation;

interface WorkstationRepositoryInterface
{
    public function findOneByIdOrFail(string $id): Workstation;
    public function save(Workstation $workstation): void;
}
