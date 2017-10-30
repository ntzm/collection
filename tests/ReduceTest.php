<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::reduce
 */
class ReduceTest extends TestCase
{
    public function testReduce()
    {
        $collection = new Collection([5, 10, 20, 40, 80, 160]);

        $this->assertSame(210, $collection->reduce(function (int $carry, int $number, int $key) {
            if ($key % 2 === 0) {
                return $carry;
            }

            return $carry + $number;
        }, 0));
    }
}
