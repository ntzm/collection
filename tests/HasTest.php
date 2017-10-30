<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::has
 */
class HasTest extends TestCase
{
    public function testHas()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertTrue($collection->has(0));
        $this->assertFalse($collection->has(5));
    }
}
