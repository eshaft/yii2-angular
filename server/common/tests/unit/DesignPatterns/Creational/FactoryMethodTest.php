<?php
namespace common\tests\DesignPatterns\Creational;


use common\components\DesignPatterns\Creational\FactoryMethod\Bicycle;
use common\components\DesignPatterns\Creational\FactoryMethod\CarFerrary;
use common\components\DesignPatterns\Creational\FactoryMethod\CarMercedes;
use common\components\DesignPatterns\Creational\FactoryMethod\FactoryMethod;
use common\components\DesignPatterns\Creational\FactoryMethod\GermanyFactory;
use common\components\DesignPatterns\Creational\FactoryMethod\InvalidArgumentException;
use common\components\DesignPatterns\Creational\FactoryMethod\ItalianFactory;

class FactoryMethodTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCanCreateCheapVehicleInGermany()
    {
        $factory = new GermanyFactory();
        $result = $factory->create(FactoryMethod::CHEAP);

        $this->assertInstanceOf(Bicycle::class, $result);
    }

    public function testCanCreateFastVehicleInGermany()
    {
        $factory = new GermanyFactory();
        $result = $factory->create(FactoryMethod::FAST);

        $this->assertInstanceOf(CarMercedes::class, $result);
    }

    public function testCanCreateCheapVehicleInItaly()
    {
        $factory = new ItalianFactory();
        $result = $factory->create(FactoryMethod::CHEAP);

        $this->assertInstanceOf(Bicycle::class, $result);
    }

    public function testCanCreateFastVehicleInItaly()
    {
        $factory = new ItalianFactory();
        $result = $factory->create(FactoryMethod::FAST);

        $this->assertInstanceOf(CarFerrary::class, $result);
    }

    public function testUnknownType()
    {
        $this->expectException(InvalidArgumentException::class);
        (new ItalianFactory())->create('spaceship');
    }
}