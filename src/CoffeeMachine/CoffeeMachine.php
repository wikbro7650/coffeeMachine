<?php

namespace CoffeeMachine\CoffeeMachine;

use CoffeeMachine\Coffee\Coffee;
use CoffeeMachine\CoffeeType\BlackCoffee;
use CoffeeMachine\CoffeeType\Espresso;
use CoffeeMachine\CoffeeType\MilkCoffee;
use CoffeeMachine\IngredientContainer\IngredientContainer;

class CoffeeMachine
{

    private IngredientContainer $ingredientContainer;

    public function __construct(IngredientContainer $ingredientContainer)
    {
        $this->ingredientContainer = $ingredientContainer;
    }

    /**
     * @throws \Exception
     */
    public function makeCoffee(Coffee $coffeeOrder): void {

        $size = $coffeeOrder ->capacity;

        $coffee = match (strtolower($coffeeOrder->type)) {
            'black' => new BlackCoffee($size),
            'milk' => new MilkCoffee($size),
            'espresso' => new Espresso(),
            default => throw new \InvalidArgumentException("Nieznany typ kawy"),
        };

        $water = $coffee ->getWaterAmount();
        $beans  = $coffee ->getBeanAmount();
        $milk  = $coffee ->getMilkAmount();

        $requirements = [];
        if ($water > 0) {
            $requirements['woda'] = $water;
        }
        if ($beans > 0) {
            $requirements['ziarna'] = $beans;
        }
        if ($milk > 0) {
            $requirements['mleko'] = $milk;
        }

        $this->ingredientContainer->checkIngredients($requirements);

        foreach ($requirements as $name => $amount) {
            $this->ingredientContainer->useIngredient($name, $amount);
        }

        echo "Przygotowano kawę typu " . strtoupper($coffeeOrder->type) .
            " o pojemności " . $size . " ml.\n";

    }

    public function refill(): void {
        $this->ingredientContainer->refillAll();
        echo "Wszystkie składniki zostały uzupełnione.\n";
        $this->ingredientStatus();
    }

    public function ingredientStatus():void {
        echo "Stan składników: " . $this->ingredientContainer->status() . "\n";
    }

}