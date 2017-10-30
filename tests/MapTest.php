<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::map
 */
class MapTest extends TestCase
{
    public function testMap()
    {
        $collection = new Collection([
            'foo' => 1,
            'bar' => 2,
            'baz' => 3,
        ]);

        $this->assertEquals(new Collection([
            ['foo', 1],
            ['bar', 2],
            ['baz', 3],
        ]), $collection->map(function (int $value, string $key) {
            return [$key, $value];
        }));
    }
}
