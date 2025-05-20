<?php

namespace CoffeeMachine\Tests\Unit\App\IngredientContainer;

use CoffeeMachine\IngredientContainer\Ingredient;
use CoffeeMachine\IngredientContainer\IngredientContainer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IngredientContainerTest extends TestCase
{
    private IngredientContainer $container;

    protected function setUp(): void
    {
        $this->container = new IngredientContainer();
        $this->container->addIngredient('woda', new Ingredient('woda', 2000, 'ml'));
        $this->container->addIngredient('mleko', new Ingredient('mleko', 1000, 'ml'));
        $this->container->addIngredient('ziarna', new Ingredient('ziarna', 500, 'g'));
    }

    #[Test]
    public function testAddAndGetIngredient(): void
    {
        $this->container->addIngredient('czekolada', new Ingredient('czekolada', 300, 'g'));

        $czekolada = $this->container->getIngredient('czekolada');
        $this->assertNotNull($czekolada);
        $this->assertEquals('czekolada', $czekolada->getName());
        $this->assertEquals(300, $czekolada->getAmount());

        $this->assertNull($this->container->getIngredient('nieistniejący'));
    }

    #[Test]
    public function testUseIngredient(): void
    {
        $this->container->useIngredient('woda', 500);
        $this->assertEquals(1500, $this->container->getIngredient('woda')->getAmount());

        $this->container->useIngredient('mleko', 300);
        $this->assertEquals(700, $this->container->getIngredient('mleko')->getAmount());
    }

    #[Test]
    public function testUseIngredientThrowsExceptionWhenIngredientNotExists(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Składnik nieistniejący nie istnieje.');

        $this->container->useIngredient('nieistniejący', 100);
    }

    #[Test]
    public function testUseIngredientThrowsExceptionWhenNotEnough(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Brakuje woda: potrzebne 3000 ml, dostępne 2000 ml.');

        $this->container->useIngredient('woda', 3000);
    }

    #[Test]
    public function testCheckIngredients(): void
    {
        $requirements = [
            'woda' => 500,
            'mleko' => 200,
            'ziarna' => 50
        ];

        $this->container->checkIngredients($requirements);
        $this->assertTrue(true);
    }

    #[Test]
    public function testCheckIngredientsThrowsExceptionWhenIngredientNotExists(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Składnik czekolada nie istnieje.');

        $requirements = [
            'woda' => 500,
            'czekolada' => 100
        ];

        $this->container->checkIngredients($requirements);
    }

    #[Test]
    public function testCheckIngredientsThrowsExceptionWhenNotEnough(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Brakuje ziarna: potrzebne 600 g, dostępne 500 g.');

        $requirements = [
            'woda' => 500,
            'ziarna' => 600
        ];

        $this->container->checkIngredients($requirements);
    }

    #[Test]
    public function testRefillAll(): void
    {
        $this->container->useIngredient('woda', 500);
        $this->container->useIngredient('mleko', 300);
        $this->container->useIngredient('ziarna', 100);

        $this->assertEquals(1500, $this->container->getIngredient('woda')->getAmount());
        $this->assertEquals(700, $this->container->getIngredient('mleko')->getAmount());
        $this->assertEquals(400, $this->container->getIngredient('ziarna')->getAmount());

        $this->container->refillAll();

        $this->assertEquals(2000, $this->container->getIngredient('woda')->getAmount());
        $this->assertEquals(1000, $this->container->getIngredient('mleko')->getAmount());
        $this->assertEquals(500, $this->container->getIngredient('ziarna')->getAmount());
    }

    #[Test]
    public function testStatus(): void
    {
        $status = $this->container->status();
        $this->assertStringContainsString('woda: 2000 ml', $status);
        $this->assertStringContainsString('mleko: 1000 ml', $status);
        $this->assertStringContainsString('ziarna: 500 g', $status);
    }
}