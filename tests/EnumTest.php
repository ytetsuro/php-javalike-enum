<?php

namespace JavaLikeEnum\Enum;

use BadMethodCallException;
use LogicException;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testShouldSameInstance()
    {
        $this->assertSame(ItemType::FOOD(), ItemType::FOOD());
    }

    public function testShouldNotClone()
    {
        $this->expectException(LogicException::class);

        clone ItemType::FOOD();
    }

    public function testShouldGetableValue()
    {
        $this->assertSame(1, ItemType::FOOD()->valueOf());
    }

    public function testShouldThrowExceptionWhenUndefineConst()
    {
        $this->expectException(BadMethodCallException::class);
        ItemType::UNDEFINED();
    }

    public function testShouldGetableEnums()
    {
        $expected = [
            ItemType::FOOD(),
            ItemType::SERVICE(),
            ItemType::DRINK(),
        ];

        $this->assertSame($expected, ItemType::values());
    }
}
