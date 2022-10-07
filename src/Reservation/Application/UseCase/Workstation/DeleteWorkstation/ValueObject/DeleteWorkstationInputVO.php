<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Workstation\DeleteWorkstation\ValueObject;


use App\Reservation\Domain\Exception\InvalidArgumentException;

class DeleteWorkstationInputVO
{
    public function __construct(public readonly string $id)
    {
    }

    public static function create(?string $id): self
    {
        if (is_null($id)) {
            throw InvalidArgumentException::createFromMessage('Workstation ID can\'t be null');
        }

        return new static($id);
    }
}
