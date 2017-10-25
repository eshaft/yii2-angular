<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 13:41
 */

namespace common\components\DesignPatterns\Creational\Builder;


use common\components\DesignPatterns\Creational\Builder\Parts\Vehicle;

class Director
{
    public function build(BuilderInterface $builder): Vehicle
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheel();

        return $builder->getVehicle();
    }
}