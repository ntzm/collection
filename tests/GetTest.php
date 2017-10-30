<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::get
 */
class GetTest extends TestCase
{
    public function testGet()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertSame(1, $collection->get(0));
        $this->assertSame(2, $collection->get(1));
        $this->assertSame(3, $collection->get(2));
    }

    public function testGetNotExists()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertNull($collection->get(5));
        $this->assertNull($collection->get('foo'));
    }
}
