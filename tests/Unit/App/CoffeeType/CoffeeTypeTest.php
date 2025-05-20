<?php

namespace CoffeeMachine\Tests\Unit\App\CoffeeType;

use CoffeeMachine\CoffeeType\BlackCoffee;
use CoffeeMachine\CoffeeType\Espresso;
use CoffeeMachine\CoffeeType\MilkCoffee;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CoffeeTypeTest extends TestCase
{
    #[Test]
    public function testBlackCoffee(): void
    {
        $coffee = new BlackCoffee(200);

        $this->assertEquals(200, $coffee->getWaterAmount());
        $this->assertEquals(200*0.08, $coffee->getBeanAmount());
        $this->assertEquals(0, $coffee->getMilkAmount());
    }

    #[Test]
    public function testMilkCoffee(): void
    {
        $coffee = new MilkCoffee(200);

        $this->assertEquals(200*0.7, $coffee->getWaterAmount());
        $this->assertEquals(200*0.08, $coffee->getBeanAmount());
        $this->assertEquals(200*0.3, $coffee->getMilkAmount());
    }

    #[Test]
    public function testEspresso(): void
    {
        $coffee = new Espresso();

        $this->assertEquals(50, $coffee->getWaterAmount());
        $this->assertEquals(50*0.1, $coffee->getBeanAmount());
        $this->assertEquals(0, $coffee->getMilkAmount());
    }

}