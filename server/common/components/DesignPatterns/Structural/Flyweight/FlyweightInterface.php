<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 21:41
 */

namespace common\components\DesignPatterns\Structural\Flyweight;


interface FlyweightInterface
{
    public function render(string $extrinsicState): string;
}