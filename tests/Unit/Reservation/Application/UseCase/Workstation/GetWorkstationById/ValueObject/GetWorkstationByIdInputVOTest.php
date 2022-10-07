<?php

declare(strict_types=1);

namespace App\Tests\Unit\Reservation\Application\UseCase\Workstation\GetWorkstationById\ValueObject;

use App\Reservation\Application\UseCase\Workstation\GetWorkstationById\ValueObject\GetWorkstationByIdInputVO;
use App\Reservation\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GetWorkstationByIdInputVOTest extends TestCase
{
    private const WORKSTATION_ID = '9b5c0b1f-09bf-4fed-acc9-fcaafc933a19';

    public function testGetWorkstationByIdInputVO(): void
    {
        $vo = GetWorkstationByIdInputVO::create(self::WORKSTATION_ID);

        self::assertInstanceOf(GetWorkstationByIdInputVO::class, $vo);
        self::assertEquals(self::WORKSTATION_ID, $vo->id);
    }

    public function testGetWorkstationByIdInputVOWithNullValue(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid arguments [id]');

        GetWorkstationByIdInputVO::create(null);
    }
}