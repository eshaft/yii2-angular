<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 13:02
 */

namespace common\components\DesignPatterns\Creational\FactoryMethod;


class CarMercedes implements VehicleInterface
{
    private $color;

    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }

    public function addAMGTuning()
    {

    }
}