<?php

declare(strict_types=1);

namespace App\Workstation\Application\UseCase\Workstation\CreateWorkstation\ValueObject;

class CreateWorkstationOutputValueObject
{
    public function __construct(public readonly string $id)
    {
    }
}