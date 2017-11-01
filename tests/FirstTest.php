<?php

use Ntzm\Collection\Collection;
use Ntzm\Collection\EmptyCollectionException;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::first
 */
class FirstTest extends TestCase
{
    public function testFirst()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertSame(1, $collection->first());
    }

    public function testFirstEmpty()
    {
        $collection = new Collection();

        $this->expectException(EmptyCollectionException::class);

        $collection->first();
    }
}
