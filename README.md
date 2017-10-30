# Collection

[![Build Status](https://travis-ci.org/ntzm/collection.svg?branch=master)](https://travis-ci.org/ntzm/collection)

A fast and simple PHP 7.1+ collection library.

## Installation

`composer require nztm/collection`

## Creating a collection

You can create a collection by passing a `iterable` value:

```php
// Arrays
new Collection([1, 2, 3]);

// Generators
new Collection(function () {
    yield 1;
    yield 2;
    yield 3;
});

// Traversables
new Collection(new class implements \IteratorAggregate {
    public function getIterator(): iterable
    {
        return new \ArrayIterator([1, 2, 3]);
    }
});
```

To create an empty collection, pass no arguments:

```php
$c = new Collection();
```

## Methods

- [`all`](#all)
- [`chunk`](#chunk)
- [`count`](#count)
- [`diff`](#diff)
- [`each`](#each)
- [`every`](#every)
- [`filter`](#filter)
- [`first`](#first)
- [`get`](#get)
- [`has`](#has)
- [`implode`](#implode)
- [`intersect`](#intersect)
- [`isEmpty`](#isEmpty)
- [`keys`](#keys)
- [`last`](#last)
- [`map`](#map)
- [`reduce`](#reduce)
- [`reverse`](#reverse)
- [`slice`](#slice)
- [`values`](#values)
- [`without`](#without)

### `all`

Get all items as an array.

```php
$c = new Collection([1, 2, 3]);

$c->all();
// [1, 2, 3]
```

### `chunk`

Break the items into chunks.

```php
$c = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

$c->chunk(3);
// Collection([
//     0 => Collection([0 => 1, 1 => 2, 2 => 3])
//     1 => Collection([3 => 4, 4 => 5, 5 => 6])
//     2 => Collection([6 => 7, 7 => 8])
// ])
```

### `count`

Count the number of items.

```php
$c = new Collection(['a', 'b', 'c', 'd']);

$c->count();
// 4
```

### `diff`

Get the difference between items.

```php
$a = new Collection([1, 2, 3, 4, 5]);
$b = new Collection([2, 3, 4]);

$a->diff($b);
// Collection([0 => 1, 4 => 5])
```

`diff` accepts a variable amount of arguments:

```php
$a = new Collection([1, 2, 3, 4, 5]);
$b = new Collection([2, 3, 4]);
$c = new Collection([1]);

$a->diff($b, $c);
// Collection([4 => 5])
```

### `each`

Run a function for each item.

```php
$c = new Collection([1, 2, 3]);

$c->each(function (int $number) {
    echo $number."\n";
});
// 1
// 2
// 3
```

You can stop a loop's execution (like `break` in a `foreach`) by returning `false`:

```php
$c = new Collection([1, 2, 3, 4, 5, 6]);

$c->each(function (int $number) {
    if ($number === 4) {
        return false;
    }

    echo $number."\n";
});
// 1
// 2
// 3
```

You can access the key of the current item with the second parameter:

```php
$c->each(function ($value, $key) {
    //
});
// a = 1
// b = 2
```

### `every`

Ensure every item passes a truth test.

```php
$c = new Collection([2, 4, 6, 8]);

$isEven = function (int $number) {
    return $number % 2 === 0;
});

$c->every($isEven);
// true
```

You can access the key of the current item with the second parameter:

```php
$c->every(function ($value, $key) {
    //
});
```

### `filter`

Filter items.

```php
$c = new Collection([1, 2, 3, 4, 5, 6, 7, 8]);

$isEven = function (int $number) {
    return $number % 2 === 0;
});

$c->filter($isEven);
// Collection([2, 4, 6, 8])
```

You can access the key of the current item with the second parameter:

```php
$c->filter(function ($value, $key) {
    //
});
```

You can also omit the callback completely to filter all falsey values:

```php
$c = new Collection([false, 1, 0, '', 'foo']);

$c->filter();
// Collection([1 => 1, 4 => 'foo'])
```

### `first`

Get the first item.

```php
$c = new Collection([1, 2, 3]);

$c->first();
// 1
```

If the collection is empty, `first` will return `null`:

```php
$c = new Collection([]);

$c->first();
// null
```

### `get`

Get the value at the given key.

```php
$c = new Collection([
    'foo' => 1,
    'bar' => 2,
]);

$c->get('foo');
// 1
```

If the key doesn't exist, `get` will return `null`:

```php
$c = new Collection([
    'foo' => 1,
]);

$c->get('bar');
// null
```

### `has`

Determine if a key exists.

```php
$c = new Collection([
    'foo' => 1,
]);

$c->has('foo');
// true

$c->has('bar');
// false
```

### `implode`

Implode items to a string.

```php
$c = new Collection(['foo', 'bar', 'baz']);

$c->implode('|');
// foo|bar|baz
```

If you don't pass an argument, it implodes using an empty string (`''`):

```php
$c = new Collection(['foo', 'bar', 'baz']);

$c->implode();
// foobarbaz
```

### `intersect`

Find intersecting items.

```php
$a = new Collection(['strawberry', 'apple', 'pear']);
$b = new Collection(['pineapple', 'pear', 'banana']);
$c = new Collection(['banana', 'raspberry', 'cherry']);

$a->intersect($b, $c);
// Collection(['pear', 'banana'])
```

### `isEmpty`

Determine if the collection is empty.

```php
$c = new Collection([1, 2, 3]);

$c->isEmpty();
// false

$c = new Collection([]);

$c->isEmpty();
// true
```

### `keys`

Get the keys of the items.

```php
$c = new Collection([
    'foo' => 1,
    'bar' => 2,
]);

$c->keys();
// Collection(['foo', 'bar'])
```

### `last`

Get the last item.

```php
$c = new Collection([1, 2, 3, 4, 5]);

$c->last();
// 5
```

### `map`

Map the items.

```php
$c = new Collection([1, 2, 3, 4]);

$c->map(function (int $number) {
    return $number * 2;
});
// Collection([2, 4, 6, 8])
```

```php
$c = new Collection(['foo', 'bar', 'baz']);

$c->map('strtoupper');
// Collection(['FOO', 'BAR', 'BAZ'])
```

You can access the key of the current item with the second parameter:

```php
$c->map(function ($value, $key) {
    //
});
```

### `reduce`

Reduce items to a single value. The second parameter sets the starting value, which is `null` if not supplied.

```php
$c = new Collection([5, 10, 20])

$c->reduce(function (int $carry, int $number) {
    return $carry + $number;
}, 0);
// 35
```

You can access the key of the current item with the third parameter:

```php
$c->map(function ($carry, $value, $key) {
    //
});
```

### `reverse`

Reverse the order of the items.

```php
$c = new Collection([1, 2, 3]);

$c->reverse();
// Collection([2 => 3, 1 => 2, 0 => 1])
```

### `slice`

Extract a slice of the items.

```php
$c = new Collection([1, 2, 3, 4, 5, 6]);

$c->slice(2);
// Collection([2 => 3, 3 => 4, 4 => 5, 5 => 6])
```

You can specify a length with the second parameter:

```php
$c = new Collection([1, 2, 3, 4, 5, 6]);

$c->slice(2, 2);
// Collection([2 => 3, 3 => 4])
```

### `values`

Get the values of the items.

```php
$c = new Collection([
    'foo' => 1,
    'bar' => 2,
    'baz' => 3,
]);

$c->values();
// Collection([1, 2, 3])
```

### `without`

Create a new collection without the given keys.

```php
$c = new Collection([
    'foo' => 1,
    'bar' => 2,
    'baz' => 3,
]);

$c->without(['foo', 'baz']);
// Collection(['bar' => 2])
```
