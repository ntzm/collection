<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::slice
 */
class SliceTest extends TestCase
{
    public function testSlicePositiveOffset()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);

        $this->assertEquals(
            new Collection([2 => 3, 3 => 4, 4 => 5, 5 => 6]),
            $collection->slice(2)
        );
    }

    public function testSliceNegativeOffset()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);

        $this->assertEquals(
            new Collection([4 => 5, 5 => 6]),
            $collection->slice(-2)
        );
    }

    public function testSliceWithLength()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6]);

        $this->assertEquals(
            new Collection([2 => 3, 3 => 4]),
            $collection->slice(2, 2)
        );
    }
}
