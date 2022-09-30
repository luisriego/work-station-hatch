<?php

declare(strict_types=1);

namespace Workstation\Entity;

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