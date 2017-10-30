<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::intersect
 */
class IntersectTest extends TestCase
{
    public function testIntersectBasic()
    {
        $a = new Collection([1, 2, 3, 4, 5, 6]);
        $b = new Collection([2, 3, 5]);

        $this->assertEquals(new Collection([1 => 2, 2 => 3, 4 => 5]), $a->intersect($b));
    }

    public function testIntersectAssoc()
    {
        $a = new Collection([
            'a' => 1,
            'b' => 2,
            'c' => 3,
        ]);

        $b = new Collection([
            2,
            'a' => 3,
            4,
        ]);

        $this->assertEquals(new Collection([
            'b' => 2,
            'c' => 3,
        ]), $a->intersect($b));
    }
}
