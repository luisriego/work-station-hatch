<?php

declare(strict_types=1);

namespace App\Workstation\Application\UseCase\Workstation\UpdateWorkstation\ValueObject;

use Workstation\Domain\Model\Workstation;

class UpdateWorkstationOutputVO
{
    private function __construct(public readonly array $workstationData)
    {
    }

    public static function createFromModel(Workstation $workstation): self
    {
        return new static([
            'id' => $workstation->id(),
            'name' => $workstation->name(),
            'floor' => $workstation->floor(),
            'office' => $workstation->office(),
        ]);
    }
}
