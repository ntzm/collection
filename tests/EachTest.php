<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::each
 */
class EachTest extends TestCase
{
    public function testEach()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7]);

        $result = [];

        $collection->each(function (int $value) use (&$result) {
            if ($value > 4) {
                $result[] = $value;
            }
        });

        $this->assertSame([5, 6, 7], $result);
    }

    public function testEachAssoc()
    {
        $collection = new Collection([
            'a' => 1,
            'b' => 2,
            'c' => 3,
        ]);

        $result = '';

        $collection->each(function (int $value, string $key) use (&$result) {
            $result .= $key.'='.$value.'|';
        });

        $this->assertSame('a=1|b=2|c=3|', $result);
    }

    public function testEachCancel()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

        $ran = [];

        $collection->each(function (int $value) use (&$ran) {
            if ($value === 5) {
                return false;
            }

            $ran[] = $value;
        });

        $this->assertSame([1, 2, 3, 4], $ran);
    }
}
