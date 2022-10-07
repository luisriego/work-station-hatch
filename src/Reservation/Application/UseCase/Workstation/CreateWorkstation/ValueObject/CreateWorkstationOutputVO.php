<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Workstation\CreateWorkstation\ValueObject;

class CreateWorkstationOutputVO
{
    public function __construct(public readonly string $id)
    {
    }
}
