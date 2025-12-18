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

    public function first()
    {
        return $this->items[0] ?? null;
    }

    public function each(callable $callback): self
    {
        foreach ($this->items as $item) {
            $callback($item);
        }

        return $this;
    }

    public function map(callable $callback): self
    {
        return new static(array_map($callback, $this->items));
    }

    public function filter(callable $callback): self
    {
        return new static(array_values(array_filter($this->items, $callback)));
    }

    public function pluck(string $key): self
    {
        return new static(
            array_map(fn($item) => $item->$key, $this->items)
        );
    }
}