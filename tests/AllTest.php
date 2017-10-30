<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::all
 */
class AllTest extends TestCase
{
    public function testAll()
    {
        $items = [1, 2, 3];

        $collection = new Collection($items);

        $this->assertSame($items, $collection->all());
    }
}
