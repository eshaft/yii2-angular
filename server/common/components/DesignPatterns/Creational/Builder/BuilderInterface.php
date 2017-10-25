<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 13:39
 */

namespace common\components\DesignPatterns\Creational\Builder;


use common\components\DesignPatterns\Creational\Builder\Parts\Vehicle;

interface BuilderInterface
{
    public function createVehicle();

    public function addWheel();

    public function addDoors();

    public function addEngine();

    public function getVehicle(): Vehicle;
}