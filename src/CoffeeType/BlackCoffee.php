<?php

namespace CoffeeMachine\CoffeeType;

use CoffeeMachine\CoffeeSize\CoffeeSize;

class BlackCoffee extends BaseCoffee
{
    public function __construct(int $size)
    {
        parent::__construct($size);
    }
    public function needsMilk(): bool {
        return false;
    }

}