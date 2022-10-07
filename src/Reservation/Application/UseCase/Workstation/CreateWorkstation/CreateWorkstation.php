<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Workstation\CreateWorkstation;

use App\Reservation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationInputVO;
use App\Reservation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationOutputVO;
use App\Reservation\Domain\Model\Workstation;
use App\Reservation\Domain\Repository\WorkstationRepositoryInterface;
use Symfony\Component\Uid\Uuid;

class CreateWorkstation
{
    public function __construct(private readonly WorkstationRepositoryInterface $workstationRepository)
    {
    }

    public function handle(CreateWorkstationInputVO $valueObject): CreateWorkstationOutputVO
    {
        $workstation = Workstation::create(
            Uuid::v4()->toRfc4122(),
            $valueObject->name,
            $valueObject->floor,
            $valueObject->office
        );

        $this->workstationRepository->save($workstation);

        return new CreateWorkstationOutputVO($workstation->id());
    }
}
