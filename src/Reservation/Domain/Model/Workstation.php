<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model;

class Workstation
{
    public const NAME_MIN_LENGTH = 2;
    public const NAME_MAX_LENGTH = 10;

    public function __construct(
        private readonly string $id,
        private ?string $name,
        private ?string $floor,
        private ?string $office,
        private ?bool $isActive
    ) {
    }

    public static function create(string $id, ?string $name, ?string $floor, ?string $office): self
    {
        return new static($id, $name, $floor, $office, false);
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

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function toggleActive(): void
    {
        $this->isActive = !$this->isActive;
    }
}
