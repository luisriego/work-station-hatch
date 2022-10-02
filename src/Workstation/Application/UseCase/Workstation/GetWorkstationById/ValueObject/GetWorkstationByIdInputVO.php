<?php

declare(strict_types=1);

namespace App\Workstation\Application\UseCase\Workstation\GetWorkstationById\ValueObject;

use Workstation\Domain\Validation\Traits\AssertNotNullTrait;

class GetWorkstationByIdInputVO
{
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    public function __construct(public readonly ?string $id)
    {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(?string $id): self
    {
        return new static($id);
    }
}
