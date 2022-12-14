<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Workstation\GetWorkstationById\ValueObject;

use App\Reservation\Domain\Model\Workstation;

class GetWorkstationByIdOutputVO
{
    private function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $floor,
        public readonly string $office,
    ) {
    }

    public static function create(Workstation $workstation): self
    {
        return new self(
            $workstation->id(),
            $workstation->name(),
            $workstation->floor(),
            $workstation->office(),
        );
    }
}
