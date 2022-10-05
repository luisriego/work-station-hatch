<?php

declare(strict_types=1);

namespace App\Tests\Unit\Workstation\Application\UseCase\Workstation\UpdateWorkstation;

use App\Workstation\Application\UseCase\Workstation\UpdateWorkstation\UpdateWorkstation;
use App\Workstation\Application\UseCase\Workstation\UpdateWorkstation\ValueObject\UpdateWorkstationInputVO;
use App\Workstation\Application\UseCase\Workstation\UpdateWorkstation\ValueObject\UpdateWorkstationOutputVO;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Workstation\Domain\Model\Workstation;

class UpdateWorkstationTest extends TestCase
{
    private const DATA = [
        'id' => '37fb348b-891a-4b1c-a4e4-a4a68a3c6bae',
        'name' => '1234',
        'floor' => '19',
        'office' => 'Belo Horizonte',
    ];

    private const DATA_TO_UPDATE = [
        'id' => '37fb348b-891a-4b1c-a4e4-a4a68a3c6bae',
        'name' => '4321',
        'floor' => '18',
        'office' => 'Sâo Luis',
        'keys' => [
            'name',
            'floor',
            'office',
        ],
    ];

    private WorkstationRepositoryInterface|MockObject $workstationRepository;
    private UpdateWorkstationInputVO $inputVO;
    private UpdateWorkstation $useCase;

    public function setUp(): void
    {
        $this->workstationRepository = $this->createMock(WorkstationRepositoryInterface::class);
        $this->inputVO = UpdateWorkstationInputVO::create(
            self::DATA_TO_UPDATE['id'],
            self::DATA_TO_UPDATE['name'],
            self::DATA_TO_UPDATE['floor'],
            self::DATA_TO_UPDATE['office'],
            self::DATA_TO_UPDATE['keys']
        );
        $this->useCase = new UpdateWorkstation($this->workstationRepository);
    }

    public function testUpdateWorkstation(): void
    {
        $workstation = Workstation::create(
            self::DATA['id'],
            self::DATA['name'],
            self::DATA['floor'],
            self::DATA['office'],
        );

        $this->workstationRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($this->inputVO->id)
            ->willReturn($workstation);


        $this->workstationRepository
            ->expects($this->once())
            ->method('save')
            ->with(
                $this->callback(function (Workstation $workstation): bool {
                    return $workstation->name() === $this->inputVO->name
                        && $workstation->floor() === $this->inputVO->floor
                        && $workstation->office() === $this->inputVO->office;
                })
            );

        $responseVO = $this->useCase->handle($this->inputVO);

        self::assertInstanceOf(updateWorkstationOutputVO::class, $responseVO);
    }
}