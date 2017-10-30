<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::last
 */
class LastTest extends TestCase
{
    public function testLast()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertSame(3, $collection->last());
    }

    public function testLastEmpty()
    {
        $collection = new Collection();

        $this->assertNull($collection->last());
    }
}
