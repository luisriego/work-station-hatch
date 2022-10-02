<?php

declare(strict_types=1);

namespace Workstation\Domain\Model;

class Workstation
{
    public function __construct(
        private readonly string $id,
        private ?string $name,
        private ?string $floor,
        private ?string $office
    ) {
    }

    public static function create(string $id, ?string $name, ?string $floor, ?string $office): self
    {
        return new static($id, $name, $floor, $office);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function floor(): string
    {
        return $this->floor;
    }

    public function setFloor(string $floor): void
    {
        $this->floor = $floor;
    }

    public function office(): string
    {
        return $this->office;
    }

    public function setOffice(string $office): void
    {
        $this->office = $office;
    }
}
