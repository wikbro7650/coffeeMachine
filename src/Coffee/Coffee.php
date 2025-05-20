<?php

namespace CoffeeMachine\Coffee;

class Coffee
{
    public function __construct(
        public readonly int $capacity,
        public readonly string $type,
    )
    {

    }

}