<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Reservation\Domain\Model\Workstation;

interface WorkstationRepositoryInterface
{
    public function findOneByIdOrFail(string $id): Workstation;

    public function save(Workstation $workstation): void;

    public function remove(Workstation $workstation): void;
}
