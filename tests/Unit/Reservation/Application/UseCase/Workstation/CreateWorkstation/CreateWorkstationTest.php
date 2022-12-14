<?php

declare(strict_types=1);

namespace App\Tests\Unit\Reservation\Application\UseCase\Workstation\CreateWorkstation;


use App\Reservation\Application\UseCase\Workstation\CreateWorkstation\CreateWorkstation;
use App\Reservation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationInputVO;
use App\Reservation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationOutputVO;
use App\Reservation\Domain\Model\Workstation;
use App\Reservation\Domain\Repository\WorkstationRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class CreateWorkstationTest extends TestCase
{
    private const VALUES = [
        'name' => '1234',
        'floor' => '19',
        'office' => 'Belo Horizonte',
    ];

    private WorkstationRepositoryInterface|MockObject $workstationRepository;
    private CreateWorkstation $useCase;

    public function setUp(): void
    {
        $this->workstationRepository = $this->createMock(WorkstationRepositoryInterface::class);
        $this->useCase = new CreateWorkstation($this->workstationRepository);
    }

    public function testCreateWorkstation(): void
    {
        $valueObject = CreateWorkstationInputVO::create(
            self::VALUES['name'],
            self::VALUES['floor'],
            self::VALUES['office'],
        );

        $this->workstationRepository
            ->expects($this->once())
            ->method('save')
            ->with(
                $this->callback(function (Workstation $workstation): bool {
                    return $workstation->name() === self::VALUES['name']
                        && $workstation->floor() === self::VALUES['floor']
                        && $workstation->office() === self::VALUES['office'];
                })
            );

        $responseValueObject = $this->useCase->handle($valueObject);

        self::assertInstanceOf(CreateWorkstationOutputVO::class, $responseValueObject);
    }
}