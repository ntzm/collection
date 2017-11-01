<?php

use Ntzm\Collection\Collection;
use Ntzm\Collection\EmptyCollectionException;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::average
 */
class AverageTest extends TestCase
{
    public function testAverage()
    {
        $collection = new Collection([1, 5, 7, 10]);

        $this->assertSame(5.75, $collection->average());
    }

    public function testAverageEmpty()
    {
        $collection = new Collection();

        $this->expectException(EmptyCollectionException::class);

        $collection->average();
    }
}
