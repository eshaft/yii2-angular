<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 13:11
 */

namespace common\components\DesignPatterns\Creational\FactoryMethod;


class ItalianFactory extends FactoryMethod
{
    protected function createVehicle(string $type): VehicleInterface
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
            case parent::FAST:
                return new CarFerrary();
            default: throw new InvalidArgumentException("$type is not a valid vehicle");
        }
    }
}