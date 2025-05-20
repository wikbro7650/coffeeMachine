<?php

namespace CoffeeMachine\CoffeeType;

class BaseCoffee
{
    public function __construct(public readonly int $size)
    {
    }

    public function getWaterAmount(): int {
        return $this->size;
    }

    public function getBeanAmount(): float {
        return ($this->size) * 0.08;
    }

    public function needsMilk(): bool {
        return true;
    }

    public function getMilkAmount(): float {
        return $this->needsMilk() ? $this->size * 0.3 : 0;
    }

}