<?php

declare(strict_types=1);

namespace App\Workstation\Application\UseCase\Workstation\CreateWorkstation;

use App\Workstation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationInputValueObject;
use App\Workstation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationOutputValueObject;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use Workstation\Domain\Model\Workstation;

class CreateWorkstation
{
    public function __construct(private readonly WorkstationRepositoryInterface $workstationRepository)
    {
    }

    public function handle(CreateWorkstationInputValueObject $valueObject): CreateWorkstationOutputValueObject
    {
        $workstation = Workstation::create(
            Uuid::v4()->toRfc4122(),
            $valueObject->name,
            $valueObject->floor,
            $valueObject->office
        );

        $this->workstationRepository->save($workstation);

        return new CreateWorkstationOutputValueObject($workstation->getId());
    }
}