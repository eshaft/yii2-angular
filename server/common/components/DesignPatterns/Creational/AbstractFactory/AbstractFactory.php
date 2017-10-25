<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 12:08
 */

namespace common\components\DesignPatterns\Creational\AbstractFactory;


abstract class AbstractFactory
{
    abstract public function createText(string $content): Text;
}