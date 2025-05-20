<?php

namespace CoffeeMachine\IngredientContainer;

class IngredientContainer
{
    private array $ingredients = [];
    public function addIngredient(string $name, Ingredient $ingredient): void
    {
        $this->ingredients[$name] = $ingredient;
    }

    public function getIngredient(string $name): ?Ingredient
    {
        return $this->ingredients[$name] ?? null;
    }

    /**
     * @throws \Exception
     */
    public function useIngredient(string $name, float $amount): void
    {
        $ingredient = $this->getIngredient($name);
        if ($ingredient === null) {
            throw new \Exception("Składnik {$name} nie istnieje.");
        }
        $ingredient->useAmount($amount);
    }

    public function checkIngredients(array $requirements): void
    {
        foreach ($requirements as $name => $amount) {
            $ingredient = $this->getIngredient($name);
            if ($ingredient === null) {
                throw new \Exception("Składnik {$name} nie istnieje.");
            }
            if (!$ingredient->hasAmount($amount)) {
                throw new \Exception(
                    "Brakuje {$name}: potrzebne {$amount} {$ingredient->getUnit()}, " .
                    "dostępne {$ingredient->getAmount()} {$ingredient->getUnit()}."
                );
            }
        }
    }

    public function refillAll(): void
    {
        foreach ($this->ingredients as $ingredient) {
            $ingredient->refill();
        }
    }

    public function status(): string
    {
        $status = [];
        foreach ($this->ingredients as $name => $ingredient) {
            $status[] = "{$name}: {$ingredient->getAmount()} {$ingredient->getUnit()}";
        }
        return implode(", ", $status);
    }
}