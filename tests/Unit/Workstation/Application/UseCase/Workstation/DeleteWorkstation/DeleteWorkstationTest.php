<?php

declare(strict_types=1);

namespace App\Tests\Unit\Workstation\Application\UseCase\Workstation\DeleteWorkstation;

use App\Workstation\Application\UseCase\Workstation\DeleteWorkstation\DeleteWorkstation;
use App\Workstation\Application\UseCase\Workstation\DeleteWorkstation\ValueObject\DeleteWorkstationInputVO;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Workstation\Domain\Model\Workstation;

class DeleteWorkstationTest extends TestCase
{
    private WorkstationRepositoryInterface|MockObject $workstationRepository;

    private DeleteWorkstation $useCase;

    public function setUp(): void
    {
        $this->workstationRepository = $this->createMock(WorkstationRepositoryInterface::class);

        $this->useCase = new DeleteWorkstation($this->workstationRepository);
    }

    public function testDeleteWorkstation(): void
    {
        $workstationId = '37fb348b-891a-4b1c-a4e4-a4a68a3c6bae';

        $workstation = Workstation::create(
            $workstationId,
            'Juan',
            'peter@api.com',
            'Fake street 123',
            30,
            '37fb348b-891a-4b1c-a4e4-a4a68a3c6111',
        );

        $inputVO = DeleteWorkstationInputVO::create($workstationId);

        $this->workstationRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($workstationId)
            ->willReturn($workstation);

        $this->workstationRepository
            ->expects($this->once())
            ->method('remove')
            ->with($workstation);

        $this->useCase->handle($inputVO);
    }
}