<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::isEmpty
 */
class IsEmptyTest extends TestCase
{
    public function testIsEmpty()
    {
        $collection = new Collection();

        $this->assertTrue($collection->isEmpty());

        $collection = new Collection([1, 2, 3]);

        $this->assertFalse($collection->isEmpty());
    }
}
