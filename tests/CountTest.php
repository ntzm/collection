<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::count
 */
class CountTest extends TestCase
{
    public function testCount()
    {
        $items = [1, 2, 3];

        $collection = new Collection($items);

        $this->assertCount(3, $collection);
        $this->assertSame(3, $collection->count());
    }
}
