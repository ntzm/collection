<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::sum
 */
class SumTest extends TestCase
{
    public function testSum()
    {
        $collection = new Collection([1, 2, 3, 4, 5]);

        $this->assertSame(15, $collection->sum());
    }
}
