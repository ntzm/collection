<?php

declare(strict_types=1);

namespace Ntzm\Collection;

class Collection implements \ArrayAccess, \Countable, \IteratorAggregate, \JsonSerializable
{
    /**
     * All items.
     *
     * @var array
     */
    protected $items;

    /**
     * Create a new collection from items.
     *
     * @param iterable $items
     */
    public function __construct(iterable $items = [])
    {
        $this->items = $this->iterableToArray($items);
    }

    /**
     * Get all items as an array.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Break items into chunks of a given size.
     *
     * @param int $size
     *
     * @return static
     */
    public function chunk(int $size): self
    {
        return new static(
            \array_map(function (array $chunk) {
                return new static($chunk);
            }, \array_chunk($this->items, $size, true))
        );
    }

    /**
     * Get the number of items.
     *
     * @return int
     */
    public function count(): int
    {
        return \count($this->items);
    }

    /**
     * Get the difference between the given items.
     *
     * @param iterable[] ...$items
     *
     * @return static
     */
    public function diff(iterable ...$items): self
    {
        $arrays = [$this->items];

        foreach ($items as $item) {
            $arrays[] = $this->iterableToArray($item);
        }

        return new static(\array_diff(...$arrays));
    }

    /**
     * Run a function for every item.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function each(callable $callback): self
    {
        foreach ($this->items as $key => $value) {
            if ($callback($value, $key) === false) {
                break;
            }
        }

        return $this;
    }

    /**
     * Determine if every item passes a truth test.
     *
     * @param callable $callback
     *
     * @return bool
     */
    public function every(callable $callback): bool
    {
        foreach ($this->items as $key => $value) {
            if (!$callback($value, $key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Filter items.
     *
     * @param callable $callback
     *
     * @return static
     */
    public function filter(callable $callback = null): self
    {
        if ($callback === null) {
            return new static(\array_filter($this->items));
        }

        return new static(
            \array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH)
        );
    }

    /**
     * Get the first item.
     *
     * @return mixed
     */
    public function first()
    {
        if (empty($this->items)) {
            return null;
        }

        return \reset($this->items);
    }

    /**
     * Get the item with a key.
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function get($key)
    {
        if ($this->has($key)) {
            return $this->items[$key];
        }

        return null;
    }

    /**
     * Get the items as an iterator.
     *
     * @return iterable
     */
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * Determine if a key exists.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function has($key): bool
    {
        return \array_key_exists($key, $this->items);
    }

    /**
     * Join the items together with a string.
     *
     * @param string $glue
     *
     * @return string
     */
    public function implode(string $glue = ''): string
    {
        return \implode($glue, $this->items);
    }

    /**
     * Get the intersections of the given items.
     *
     * @param iterable[] ...$items
     *
     * @return static
     */
    public function intersect(iterable ...$items): self
    {
        $arrays = [$this->items];

        foreach ($items as $item) {
            $arrays[] = $this->iterableToArray($item);
        }

        return new static(\array_intersect(...$arrays));
    }

    /**
     * Determine if there are no items.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Get the data that should be serialized when encoding to JSON.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->items;
    }

    /**
     * Get the keys of the items.
     *
     * @return static
     */
    public function keys(): self
    {
        return new static(\array_keys($this->items));
    }

    /**
     * Get the last item.
     *
     * @return mixed
     */
    public function last()
    {
        if (empty($this->items)) {
            return null;
        }

        return \end($this->items);
    }

    /**
     * Apply a function to every item.
     *
     * @param callable $callback
     *
     * @return static
     */
    public function map(callable $callback): self
    {
        return new static(
            \array_map($callback, $this->items, \array_keys($this->items))
        );
    }

    /**
     * Determine if a key exists.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return $this->has($key);
    }

    /**
     * Get a value for a key.
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    /**
     * Set a key to a value.
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value): void
    {
        if ($key === null) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    /**
     * Remove a key.
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * Reduce the items to a single value.
     *
     * @param callable $callback
     * @param mixed    $initial
     *
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null)
    {
        $result = $initial;

        foreach ($this->items as $key => $value) {
            $result = $callback($result, $value, $key);
        }

        return $result;
    }

    /**
     * Reverse the items.
     *
     * @return static
     */
    public function reverse(): self
    {
        return new static(\array_reverse($this->items, true));
    }

    /**
     * Extract a slice of items.
     *
     * @param int $offset
     * @param int $length
     *
     * @return static
     */
    public function slice(int $offset, int $length = null): self
    {
        return new static(\array_slice($this->items, $offset, $length, true));
    }

    /**
     * Determine if one or more items pass a truth test.
     *
     * @param callable $callback
     *
     * @return bool
     */
    public function some(callable $callback): bool
    {
        foreach ($this->items as $key => $value) {
            if ($callback($value, $key) === true) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the sum of the items.
     *
     * @return float|int
     */
    public function sum()
    {
        return \array_sum($this->items);
    }

    /**
     * Get the item values.
     *
     * @return static
     */
    public function values(): self
    {
        return new static(\array_values($this->items));
    }

    /**
     * Create a new collection without the given keys.
     *
     * @param iterable $keys
     *
     * @return static
     */
    public function without(iterable $keys): self
    {
        $items = $this->items;

        foreach ($keys as $key) {
            unset($items[$key]);
        }

        return new static($items);
    }

    /**
     * Transform an iterable value to an array.
     *
     * @param iterable $iterable
     *
     * @return array
     */
    protected function iterableToArray(iterable $iterable): array
    {
        if ($iterable instanceof \Traversable) {
            return \iterator_to_array($iterable);
        }

        return $iterable;
    }
}
