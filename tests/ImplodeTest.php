<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::implode
 */
class ImplodeTest extends TestCase
{
    public function testImplode()
    {
        $collection = new Collection(['foo', 'bar', 'baz']);

        $this->assertSame('foobarbaz', $collection->implode());
        $this->assertSame('foo|bar|baz', $collection->implode('|'));
        $this->assertSame('foo .. bar .. baz', $collection->implode(' .. '));
    }
}
