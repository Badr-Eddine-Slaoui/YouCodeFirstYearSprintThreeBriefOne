<?php

namespace Foundations\DB\GoldDigger;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class Collection implements IteratorAggregate, Countable{
    protected array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function all(): array
    {
        return $this->items;
    }
}