<?php

declare(strict_types=1);

namespace App\Workstation\Application\UseCase\Workstation\CreateWorkstation\ValueObject;

class CreateWorkstationInputVO
{
    private function __construct(
        public readonly ?string $name,
        public readonly ?string $floor,
        public readonly ?string $office
    ) {
    }

    public static function create(?string $name, ?string $floor, ?string $office): self
    {
        return new static($name, $floor, $office);
    }
}
