<?php

namespace CoffeeMachine\Tests\Unit\App\CoffeeMachine;

use CoffeeMachine\Coffee\Coffee;
use CoffeeMachine\CoffeeMachine\CoffeeMachine;
use CoffeeMachine\IngredientContainer\Ingredient;
use CoffeeMachine\IngredientContainer\IngredientContainer;
use PHPUnit\Framework\TestCase;

class CoffeeMachineTest extends TestCase
{
    private CoffeeMachine $coffeeMachine;
    private IngredientContainer $container;

    protected function setUp(): void
    {
        $this->container = new IngredientContainer();
        $this->container->addIngredient('woda', new Ingredient('woda', 2000, 'ml'));
        $this->container->addIngredient('mleko', new Ingredient('mleko', 1000, 'ml'));
        $this->container->addIngredient('ziarna', new Ingredient('ziarna', 500, 'g'));

        $this->coffeeMachine = new CoffeeMachine($this->container);
    }

    public function testMakeBlackCoffee(): void
    {
        $this->coffeeMachine->makeCoffee(new Coffee(200, 'black'));

        $this->assertEquals(1800, $this->container->getIngredient('woda')->getAmount());
        $this->assertEquals(1000, $this->container->getIngredient('mleko')->getAmount());
        $this->assertEquals(484, $this->container->getIngredient('ziarna')->getAmount());
    }

    public function testMakeMilkCoffee(): void
    {
        $this->coffeeMachine->makeCoffee(new Coffee(200, 'milk'));

        $this->assertEquals(1860, $this->container->getIngredient('woda')->getAmount()); // Zużywa 140ml wody (70%)
        $this->assertEquals(940, $this->container->getIngredient('mleko')->getAmount()); // Zużywa 60ml mleka (30%)
        $this->assertEquals(484, $this->container->getIngredient('ziarna')->getAmount()); // Zużywa 16g ziaren (8%)
    }

    public function testMakeEspresso(): void
    {
        $this->coffeeMachine->makeCoffee(new Coffee(0, 'espresso'));

        $this->assertEquals(1950, $this->container->getIngredient('woda')->getAmount()); // Zużywa 30ml wody
        $this->assertEquals(1000, $this->container->getIngredient('mleko')->getAmount()); // Nie zużywa mleka
        $this->assertEquals(495, $this->container->getIngredient('ziarna')->getAmount()); // Zużywa 10g ziaren
    }

    public function testMakeCoffeeWithInvalidType(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Nieznany typ kawy');

        $this->coffeeMachine->makeCoffee(new Coffee(200, 'mocca'));
    }

    public function testMakeCoffeeWithInsufficientIngredients(): void
    {
        $this->expectException(\Exception::class);

        $this->coffeeMachine->makeCoffee(new Coffee(3000, 'black'));
    }

    public function testRefill(): void
    {
        $this->coffeeMachine->makeCoffee(new Coffee(500, 'milk'));

        $this->assertEquals(1650, $this->container->getIngredient('woda')->getAmount());
        $this->assertEquals(850, $this->container->getIngredient('mleko')->getAmount());
        $this->assertEquals(460, $this->container->getIngredient('ziarna')->getAmount());

        $this->coffeeMachine->refill();

        $this->assertEquals(2000, $this->container->getIngredient('woda')->getAmount());
        $this->assertEquals(1000, $this->container->getIngredient('mleko')->getAmount());
        $this->assertEquals(500, $this->container->getIngredient('ziarna')->getAmount());
    }

    public function testMultipleCoffees(): void
    {
        $this->coffeeMachine->makeCoffee(new Coffee(200, 'black'));
        $this->coffeeMachine->makeCoffee(new Coffee(200, 'milk'));
        $this->coffeeMachine->makeCoffee(new Coffee(0, 'espresso'));

        $this->assertEquals(1610, $this->container->getIngredient('woda')->getAmount());
        $this->assertEquals(940, $this->container->getIngredient('mleko')->getAmount());
        $this->assertEquals(463, $this->container->getIngredient('ziarna')->getAmount());
    }

}