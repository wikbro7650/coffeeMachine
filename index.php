<?php

use CoffeeMachine\Coffee\Coffee;
use CoffeeMachine\CoffeeMachine\CoffeeMachine;
use CoffeeMachine\IngredientContainer\Ingredient;
use CoffeeMachine\IngredientContainer\IngredientContainer;

require_once 'vendor/autoload.php';

$ingredientContainer = new IngredientContainer();

$ingredientContainer->addIngredient('woda', new Ingredient('woda', 2000, 'ml'));
$ingredientContainer->addIngredient('mleko', new Ingredient('mleko', 1000, 'ml'));
$ingredientContainer->addIngredient('ziarna', new Ingredient('ziarna', 500, 'g'));

$coffeeMachine = new CoffeeMachine($ingredientContainer);

try {
    echo "=== Stan początkowy ===\n";
    $coffeeMachine->ingredientStatus();
    echo "\n";

    echo "=== Przygotowanie kawy z mlekiem ===\n";
    $coffeeMachine->makeCoffee(new Coffee(250, "milk"));
    echo "\n";

    echo "=== Stan po przygotowaniu kawy ===\n";
    $coffeeMachine->ingredientStatus();
    echo "\n";

    echo "=== Przygotowanie kawy czarnej ===\n";
    $coffeeMachine->makeCoffee(new Coffee(3050, "black"));
    echo "\n";

    echo "=== Stan końcowy ===\n";
    $coffeeMachine->ingredientStatus();

} catch (\Exception $e) {
    echo "BŁĄD: " . $e->getMessage() . "\n";
}