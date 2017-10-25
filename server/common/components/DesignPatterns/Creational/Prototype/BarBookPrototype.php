<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 15:21
 */

namespace common\components\DesignPatterns\Creational\Prototype;


class BarBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected $category = 'Bar';

    public function __clone()
    {
    }
}