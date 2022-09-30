<?php

declare(strict_types=1);

namespace ModuleA\Entity;

class ModuleA
{
    public function __construct(private readonly string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}