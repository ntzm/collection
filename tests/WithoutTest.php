<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

class WithoutTest extends TestCase
{
    public function testWithout()
    {
        $collection = new Collection([
            'foo' => 1,
            'bar' => 2,
            'baz' => 3,
        ]);

        $this->assertEquals(
            new Collection(['bar' => 2]),
            $collection->without(['foo', 'baz'])
        );
    }
}
