<?php

declare(strict_types=1);

namespace App\Workstation\Application\UseCase\Workstation\GetWorkstationById;

use App\Workstation\Application\UseCase\Workstation\GetWorkstationById\ValueObject\GetWorkstationByIdInputVO;
use App\Workstation\Application\UseCase\Workstation\GetWorkstationById\ValueObject\GetWorkstationByIdOutputVO;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;

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
