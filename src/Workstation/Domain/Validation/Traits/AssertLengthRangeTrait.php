<?php

declare(strict_types=1);

namespace Workstation\Domain\Validation\Traits;

use App\Workstation\Domain\Exception\InvalidArgumentException;

trait AssertLengthRangeTrait
{
    public function assertValueRangeLength(string $value, int $min, int $max): void
    {
        if (\strlen($value) < $min || \strlen($value) > $max) {
            throw InvalidArgumentException::createFromMinAndMaxLength($min, $max);
        }
    }
}
