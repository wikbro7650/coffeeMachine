<?php

namespace CoffeeMachine\CoffeeType;


use CoffeeMachine\CoffeeSize\CoffeeSize;

class Espresso extends BaseCoffee
{
    public function __construct()
    {
        parent::__construct(50);
    }

    public function getBeanAmount(): float {
        return ($this->size) * 0.1;
    }

    public function needsMilk(): bool {
        return false;
    }
}