<?php

declare(strict_types=1);

namespace Workstation\Domain\Model;

class Workstation
{
    public function __construct(private readonly string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
