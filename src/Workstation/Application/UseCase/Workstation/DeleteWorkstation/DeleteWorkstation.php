<?php

declare(strict_types=1);

namespace App\Workstation\Application\UseCase\Workstation\DeleteWorkstation;

use App\Workstation\Application\UseCase\Workstation\DeleteWorkstation\ValueObject\DeleteWorkstationInputVO;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;

class DeleteWorkstation
{
    public function __construct(private readonly WorkstationRepositoryInterface $workstationRepository)
    {
    }

    public function handle(DeleteWorkstationInputVO $inputVO): void
    {
        $workstation = $this->workstationRepository->findOneByIdOrFail($inputVO->id);

        $this->workstationRepository->remove($workstation);
    }
}
