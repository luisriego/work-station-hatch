<?php

declare(strict_types=1);

namespace App\Tests\Unit\Workstation\Application\UseCase\Workstation\GetWorkstationById;

use App\Workstation\Application\UseCase\Workstation\GetWorkstationById\GetWorkstationById;
use App\Workstation\Application\UseCase\Workstation\GetWorkstationById\ValueObject\GetWorkstationByIdInputVO;
use App\Workstation\Application\UseCase\Workstation\GetWorkstationById\ValueObject\GetWorkstationByIdOutputVO;
use App\Workstation\Domain\Exception\ResourceNotFoundException;
use App\Workstation\Domain\Repository\WorkstationRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Workstation\Domain\Model\Workstation;

class GetWorkstationByIdTest extends TestCase
{
    private const WORKSTATION_DATA = [
        'id' => '9b5c0b1f-09bf-4fed-acc9-fcaafc933a19',
        'name' => 'WS2053',
        'floor' => '18',
        'office' => 'Belo Horizonte',
    ];

    private WorkstationRepositoryInterface|MockObject $workstationRepository;

    private GetWorkstationById $useCase;

    public function setUp(): void
    {
        $this->workstationRepository = $this->createMock(WorkstationRepositoryInterface::class);

        $this->useCase = new GetWorkstationById($this->workstationRepository);
    }

    public function testGetWorkstationById(): void
    {
        $inputDto = GetWorkstationByIdInputVO::create(self::WORKSTATION_DATA['id']);

        $workstation = Workstation::create(
            self::WORKSTATION_DATA['id'],
            self::WORKSTATION_DATA['name'],
            self::WORKSTATION_DATA['floor'],
            self::WORKSTATION_DATA['office'],
        );

        $this->workstationRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($inputDto->id)
            ->willReturn($workstation);

        $responseDTO = $this->useCase->handle($inputDto);

        self::assertInstanceOf(GetWorkstationByIdOutputVO::class, $responseDTO);

        self::assertEquals(self::WORKSTATION_DATA['id'], $responseDTO->id);
        self::assertEquals(self::WORKSTATION_DATA['name'], $responseDTO->name);
        self::assertEquals(self::WORKSTATION_DATA['floor'], $responseDTO->floor);
        self::assertEquals(self::WORKSTATION_DATA['office'], $responseDTO->office);
    }

    public function testGetWorkstationByIdException(): void
    {
        $inputDto = GetWorkstationByIdInputVO::create(self::WORKSTATION_DATA['id']);

        $this->workstationRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($inputDto->id)
            ->willThrowException(ResourceNotFoundException::createFromClassAndId(Workstation::class, $inputDto->id));

        self::expectException(ResourceNotFoundException::class);

        $this->useCase->handle($inputDto);
    }
}