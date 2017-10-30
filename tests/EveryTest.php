<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::every
 */
class EveryTest extends TestCase
{
    public function testEvery()
    {
        $collection = new Collection([2, 4, 6, 8]);

        $isEven = function (int $number) {
            return $number % 2 === 0;
        };

        $this->assertTrue($collection->every($isEven));

        $isOdd = function (int $number) {
            return $number % 2 !== 0;
        };

        $this->assertFalse($collection->every($isOdd));

        $isEvenAndUnderSix = function (int $number) {
            return $number % 2 === 0 && $number < 6;
        };

        $this->assertFalse($collection->every($isEvenAndUnderSix));
    }
}
