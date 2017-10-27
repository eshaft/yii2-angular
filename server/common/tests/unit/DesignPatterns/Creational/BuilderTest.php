<?php
namespace common\tests\DesignPatterns\Creational;


use common\components\DesignPatterns\Creational\Builder\CarBuilder;
use common\components\DesignPatterns\Creational\Builder\Director;
use common\components\DesignPatterns\Creational\Builder\Parts\Car;
use common\components\DesignPatterns\Creational\Builder\Parts\Truck;
use common\components\DesignPatterns\Creational\Builder\TruckBuilder;

class BuilderTest extends \Codeception\Test\Unit
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

    public function testCanBuildTruck()
    {
        $truckBuilder = new TruckBuilder();
        $newVehicle = (new Director())->build($truckBuilder);

        $this->assertInstanceOf(Truck::class, $newVehicle);
    }

    public function testCanBuildCar()
    {
        $carBuilder = new CarBuilder();
        $newVehicle = (new Director())->build($carBuilder);

        $this->assertInstanceOf(Car::class, $newVehicle);
    }
}