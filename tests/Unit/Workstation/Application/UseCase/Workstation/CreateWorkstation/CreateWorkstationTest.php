<?php

declare(strict_types=1);

namespace App\Tests\Unit\Workstation\Application\UseCase\Workstation\CreateWorkstation;


use App\Workstation\Application\UseCase\Workstation\CreateWorkstation\CreateWorkstation;
use App\Workstation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationInputValueObject;
use App\Workstation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationOutputValueObject;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Workstation\Domain\Model\Workstation;

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
        $valueObject = CreateWorkstationInputValueObject::create(
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

        self::assertInstanceOf(CreateWorkstationOutputValueObject::class, $responseValueObject);
    }
}