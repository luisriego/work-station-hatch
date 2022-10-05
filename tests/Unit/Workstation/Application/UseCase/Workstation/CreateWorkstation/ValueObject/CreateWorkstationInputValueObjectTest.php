<?php

declare(strict_types=1);

namespace App\Tests\Unit\Workstation\Application\UseCase\Workstation\CreateWorkstation\ValueObject;

use App\Workstation\Application\UseCase\Workstation\CreateWorkstation\ValueObject\CreateWorkstationInputVO;
use PHPUnit\Framework\TestCase;

class CreateWorkstationInputValueObjectTest extends TestCase
{
    private const VALUES = [
        'name' => '1234',
        'floor' => '19',
        'office' => 'Belo Horizonte',
    ];

    public function testCreate(): void
    {
        $valueObject = CreateWorkstationInputVO::create(
            self::VALUES['name'],
            self::VALUES['floor'],
            self::VALUES['office'],
        );

        self::assertInstanceOf(CreateWorkstationInputVO::class, $valueObject);

        self::assertEquals(self::VALUES['name'], $valueObject->name);
        self::assertEquals(self::VALUES['floor'], $valueObject->floor);
        self::assertEquals(self::VALUES['office'], $valueObject->office);
    }
}