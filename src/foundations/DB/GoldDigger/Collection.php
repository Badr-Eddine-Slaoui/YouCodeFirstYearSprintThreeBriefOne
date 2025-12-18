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
}