<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Reservation\Domain\Model\Reservation;

interface ReservationRepositoryInterface
{
    public function findOneByIdOrFail(string $id): Reservation;

    public function save(Reservation $reservation): void;

    public function remove(Reservation $reservation): void;
}
