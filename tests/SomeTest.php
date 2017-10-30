<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::some
 */
class SomeTest extends TestCase
{
    public function testSome()
    {
        $collection = new Collection([1, 3, 4, 5, 7, 9]);

        $isEven = function (int $number) {
            return $number % 2 === 0;
        };

        $this->assertTrue($collection->some($isEven));

        $isOverTen = function (int $number) {
            return $number > 10;
        };

        $this->assertFalse($collection->some($isOverTen));
    }

    public function testSomeWithKeys()
    {
        $collection = new Collection([
            'foo' => 1,
            'bar' => 2,
            'baz' => 3,
        ]);

        $this->assertTrue($collection->some(function (int $value, string $key) {
            return $key === 'bar' && $value === 2;
        }));

        $this->assertFalse($collection->some(function (int $value, string $key) {
            return $key === 'bar' && $value === 1;
        }));
    }
}
