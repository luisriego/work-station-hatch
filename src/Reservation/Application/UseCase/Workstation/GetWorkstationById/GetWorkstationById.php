<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Workstation\GetWorkstationById;

use App\Reservation\Application\UseCase\Workstation\GetWorkstationById\ValueObject\GetWorkstationByIdInputVO;
use App\Reservation\Application\UseCase\Workstation\GetWorkstationById\ValueObject\GetWorkstationByIdOutputVO;
use App\Reservation\Domain\Repository\WorkstationRepositoryInterface;

class GetWorkstationById
{
    public function __construct(private readonly WorkstationRepositoryInterface $workstationRepository)
    {
    }

    public function handle(GetWorkstationByIdInputVO $vo): GetWorkstationByIdOutputVO
    {
        return GetWorkstationByIdOutputVO::create($this->workstationRepository->findOneByIdOrFail($vo->id));
    }
}
