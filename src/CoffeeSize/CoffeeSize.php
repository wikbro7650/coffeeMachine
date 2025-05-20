<?php

namespace CoffeeMachine\CoffeeSize;

class CoffeeSize
{
    public function __construct(public readonly int $capacity)
    {

    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function small(): self {
        return new self(200);
    }

    public function medium(): self {
        return new self(300);
    }

    public function large(): self {
        return new self(500);
    }

    public function espresso(): self {
        return new self(50);
    }
}