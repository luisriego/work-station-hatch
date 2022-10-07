<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Workstation\UpdateWorkstation\ValueObject;

use App\Reservation\Domain\Model\Workstation;
use App\Reservation\Domain\Validation\Traits\AssertLengthRangeTrait;
use App\Reservation\Domain\Validation\Traits\AssertNotNullTrait;

class UpdateWorkstationInputVO
{
    use AssertLengthRangeTrait;
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    private function __construct(
        public readonly ?string $id,
        public readonly ?string $name,
        public readonly ?string $floor,
        public readonly ?string $office,
        public readonly array $paramsToUpdate
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);

        if (!\is_null($this->name)) {
            $this->assertValueRangeLength($this->name, Workstation::NAME_MIN_LENGTH, Workstation::NAME_MAX_LENGTH);
        }
    }

    public static function create(?string $id, ?string $name, ?string $floor, ?string $office, array $paramsToUpdate): self
    {
        return new static($id, $name, $floor, $office, $paramsToUpdate);
    }
}
