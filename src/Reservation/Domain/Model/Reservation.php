<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model;


class Reservation
{
    public function __construct(
        private readonly string $id,
        private \DateTime $startDate,
        private \DateTime $endDate,
        private readonly Workstation $workstation,
        private readonly string $userId,
        private readonly \DateTime $createdOn,
        private readonly bool $isActive)
    {
    }

    public static function create(
        string $id,
        \DateTime $startDate,
        \DateTime $endDate,
        Workstation $workstation,
        ?string $userId): self
    {
        return new static($id, $startDate, $endDate, $workstation, $userId, new \DateTime('now'), true);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function startDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function endDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function workstation(): Workstation
    {
        return $this->workstation;
    }

    public function setWorkstation(Workstation $workstation): void
    {
        $this->workstation = $workstation;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function createdOn(): \DateTime
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTime $createdOn): void
    {
        $this->createdOn = $createdOn;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function toggleActive(): void
    {
        $this->isActive = !$this->isActive;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'workstation' => $this->workstation->id(),
            'user' => $this->userId,
        ];
    }
}