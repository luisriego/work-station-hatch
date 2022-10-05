<?php

declare(strict_types=1);

namespace App\Tests\Unit\Workstation\Application\UseCase\Workstation\UpdateWorkstation\ValueObject;

use App\Workstation\Application\UseCase\Workstation\UpdateWorkstation\ValueObject\UpdateWorkstationInputVO;
use App\Workstation\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UpdateWorkstationInputValueObjectTest extends TestCase
{
    private const VALUES = [
        'id' => '37fb348b-891a-4b1c-a4e4-a4a68a3c6bae',
        'name' => '1234',
        'floor' => '19',
        'office' => 'Belo Horizonte',
        'keys' => [],
    ];

    public function testCreateVO(): void
    {
        $valueObject = UpdateWorkstationInputVO::create(
            self::VALUES['id'],
            self::VALUES['name'],
            self::VALUES['floor'],
            self::VALUES['office'],
            self::VALUES['keys']
        );

        self::assertInstanceOf(UpdateWorkstationInputVO::class, $valueObject);

        self::assertEquals(self::VALUES['name'], $valueObject->name);
        self::assertEquals(self::VALUES['floor'], $valueObject->floor);
        self::assertEquals(self::VALUES['office'], $valueObject->office);
    }

//    public function testCreateWithNullId(): void
//    {
//        self::expectException(InvalidArgumentException::class);
//
//        UpdateWorkstationInputVO::create(
//            null,
//            self::VALUES['name'],
//            self::VALUES['floor'],
//            self::VALUES['office'],
//        );
//    }
}