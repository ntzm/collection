<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::diff
 */
class DiffTest extends TestCase
{
    public function testDiffBasic()
    {
        $a = new Collection([1, 2, 3, 4, 5, 6]);
        $b = new Collection([2, 3, 5]);

        $this->assertEquals(new Collection([0 => 1, 3 => 4, 5 => 6]), $a->diff($b));
    }

    public function testDiffAssoc()
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
            'a' => 1,
        ]), $a->diff($b));
    }
}
