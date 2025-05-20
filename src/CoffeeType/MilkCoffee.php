<?php

namespace CoffeeMachine\CoffeeType;

class MilkCoffee extends BaseCoffee
{
    public function __construct(int $size)
    {
        parent::__construct($size);
    }

    public function getWaterAmount(): int {
        return $this->size * 0.7;
    }
    public function needsMilk(): bool {
        return true;
    }
}