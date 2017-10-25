<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 13:50
 */

namespace common\components\DesignPatterns\Creational\Builder;


use common\components\DesignPatterns\Creational\Builder\Parts\Truck;
use common\components\DesignPatterns\Creational\Builder\Parts\Vehicle;

class TruckBuilder implements BuilderInterface
{
    /**
     * @var Truck
     */
    private $truck;

    public function createVehicle()
    {
        $this->truck = new Truck();
    }

    public function getVehicle(): Vehicle
    {
        return $this->truck;
    }

    public function addWheel()
    {
        $this->truck->setPart('wheel1', new Parts\Wheel());
        $this->truck->setPart('wheel2', new Parts\Wheel());
        $this->truck->setPart('wheel3', new Parts\Wheel());
        $this->truck->setPart('wheel4', new Parts\Wheel());
        $this->truck->setPart('wheel5', new Parts\Wheel());
        $this->truck->setPart('wheel6', new Parts\Wheel());
    }

    public function addDoors()
    {
        $this->truck->setPart('rightDoor', new Parts\Door());
        $this->truck->setPart('leftDoor', new Parts\Door());
    }

    public function addEngine()
    {
        $this->truck->setPart('truckEngine', new Parts\Engine());
    }
}