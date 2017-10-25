<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 13:07
 */

namespace common\components\DesignPatterns\Creational\FactoryMethod;


abstract class FactoryMethod
{
    const CHEAP = 'cheap';
    const FAST = 'fast';

    abstract protected function createVehicle(string $type): VehicleInterface;

    public function create(string $type): VehicleInterface
    {
        $obj = $this->createVehicle($type);
        $obj->setColor('black');

        return $obj;
    }
}