<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::values
 */
class ValuesTest extends TestCase
{
    public function testValues()
    {
        $collection = new Collection([
            'foo' => 'bar',
            1 => 'baz',
        ]);

        $this->assertEquals(new Collection(['bar', 'baz']), $collection->values());
    }
}
