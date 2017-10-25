<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 13:55
 */

namespace common\components\DesignPatterns\Creational\Builder;


use common\components\DesignPatterns\Creational\Builder\Parts\Car;
use common\components\DesignPatterns\Creational\Builder\Parts\Vehicle;

class CarBuilder implements BuilderInterface
{
    /**
     * @var Car
     */
    private $car;

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function getVehicle(): Vehicle
    {
        return $this->car;
    }

    public function addDoors()
    {
        $this->car->setPart('rightDoor', new Parts\Door());
        $this->car->setPart('leftDoor', new Parts\Door());
        $this->car->setPart('trunkLid', new Parts\Door());
    }

    public function addEngine()
    {
        $this->car->setPart('engine', new Parts\Engine());
    }

    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Parts\Wheel());
        $this->car->setPart('wheelRF', new Parts\Wheel());
        $this->car->setPart('wheelLR', new Parts\Wheel());
        $this->car->setPart('wheelRR', new Parts\Wheel());
    }
}