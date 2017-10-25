<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 13:32
 */

namespace common\components\DesignPatterns\Creational\Builder\Parts;


abstract class Vehicle
{
    /**
     * @var object[]
     */
    private $data = [];

    /**
     * @param string $key
     * @param object $value
     */
    public function setPart($key, $value)
    {
        $this->data[$key] = $value;
    }
}