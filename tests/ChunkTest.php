<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::chunk
 */
class ChunkTest extends TestCase
{
    public function testChunk()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

        $chunked = $collection->chunk(3);

        $this->assertCount(3, $chunked);
        $this->assertEquals(new Collection([1, 2, 3]), $chunked->get(0));
        $this->assertEquals(new Collection([3 => 4, 4 => 5, 5 => 6]), $chunked->get(1));
        $this->assertEquals(new Collection([6 => 7, 7 => 8]), $chunked->get(2));
    }

    public function testChunkEmpty()
    {
        $collection = new Collection();

        $chunked = $collection->chunk(1);

        $this->assertEmpty($chunked);
    }

    public function testChunkAssoc()
    {
        $collection = new Collection([
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
        ]);

        $chunked = $collection->chunk(2);

        $this->assertCount(2, $chunked);
        $this->assertEquals(new Collection(['a' => 1, 'b' => 2]), $chunked->get(0));
        $this->assertEquals(new Collection(['c' => 3, 'd' => 4]), $chunked->get(1));
    }
}
