<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::keys
 */
class KeysTest extends TestCase
{
    public function testKeys()
    {
        $collection = new Collection([
            'foo' => 1,
            'bar' => 2,
            'baz' => 3,
        ]);

        $this->assertEquals(new Collection(['foo', 'bar', 'baz']), $collection->keys());
    }
}
