<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::reverse
 */
class ReverseTest extends TestCase
{
    public function testReverse()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertEquals(new Collection([2 => 3, 1 => 2, 0 => 1]), $collection->reverse());
    }
}
