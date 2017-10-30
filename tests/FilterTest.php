<?php

use Ntzm\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * @covers Collection::filter
 */
class FilterTest extends TestCase
{
    public function testFilterBasic()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);

        $filtered = $collection->filter(function (int $number) {
            return $number % 2 === 0;
        });

        $this->assertEquals(new Collection([1 => 2, 3 => 4, 5 => 6, 7 => 8, 9 => 10]), $filtered);
    }

    public function testFilterNoCallback()
    {
        $collection = new Collection([1, 0, 'hello', null, '', 5.5]);

        $filtered = $collection->filter();

        $this->assertEquals(new Collection([0 => 1, 2 => 'hello', 5 => 5.5]), $filtered);
    }

    public function testFilterWithKeys()
    {
        $collection = new Collection([
            'a' => 'never',
            '1' => 'gonna',
            '2' => 'give',
            '3' => 'you',
            '4' => 'up',
            'b' => 'never',
            '5' => 'gonna',
            '6' => 'let',
            '7' => 'you',
            '8' => 'down',
        ]);

        $filtered = $collection->filter(function (string $value, string $key) {
            return is_numeric($key) && $value !== 'you';
        });

        $this->assertEquals(new Collection([
            '1' => 'gonna',
            '2' => 'give',
            '4' => 'up',
            '5' => 'gonna',
            '6' => 'let',
            '8' => 'down',
        ]), $filtered);
    }
}
