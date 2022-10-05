<?php

declare(strict_types=1);

namespace App\Workstation\Application\UseCase\Workstation\UpdateWorkstation;

use App\Workstation\Application\UseCase\Workstation\UpdateWorkstation\ValueObject\UpdateWorkstationInputVO;
use App\Workstation\Application\UseCase\Workstation\UpdateWorkstation\ValueObject\UpdateWorkstationOutputVO;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;

class UpdateWorkstation
{
    private const SETTER_PREFIX = 'set';

    public function __construct(private readonly WorkstationRepositoryInterface $workstationRepository)
    {
    }

    public function handle(UpdateWorkstationInputVO $inputVO): UpdateWorkstationOutputVO
    {
        $workstation = $this->workstationRepository->findOneByIdOrFail($inputVO->id);

        foreach ($inputVO->paramsToUpdate as $param) {
            $workstation->{\sprintf('%s%s', self::SETTER_PREFIX, \ucfirst($param))}($inputVO->{$param});
        }

        $this->workstationRepository->save($workstation);

        return UpdateWorkstationOutputVO::createFromModel($workstation);
    }
}
