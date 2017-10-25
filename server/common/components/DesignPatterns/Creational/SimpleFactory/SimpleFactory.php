<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 12:51
 */

namespace common\components\DesignPatterns\Creational\SimpleFactory;


class SimpleFactory
{
    public function createBicycle(): Bicycle
    {
        return new Bicycle();
    }
}