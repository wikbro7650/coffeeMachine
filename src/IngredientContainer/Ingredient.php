<?php

namespace CoffeeMachine\IngredientContainer;

class Ingredient
{
    private float|int $amount;
    private int $defaultAmount;
    private string $name;
    private string $unit;

    public function __construct(string $name, float $amount, string $unit)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->defaultAmount = $amount;
        $this->unit = $unit;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getAmount(): float|int
    {
        return $this->amount;
    }

    public function hasAmount(float $amount): bool
    {
        return $this->amount >= $amount;
    }

    /**
     * @throws \Exception
     */
    public function useAmount(float $amount): void
    {
        if (!$this->hasAmount($amount)) {
            throw new \Exception("Brakuje {$this->name}: potrzebne {$amount} {$this->unit}, dostępne {$this->amount} {$this->unit}.");
        }
        $this->amount -= $amount;
    }

    public function refill(?int $amount = null): void
    {
        $this->amount = $amount ?? $this->defaultAmount;
    }
}