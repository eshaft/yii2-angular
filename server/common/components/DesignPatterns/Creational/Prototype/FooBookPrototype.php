<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 15:22
 */

namespace common\components\DesignPatterns\Creational\Prototype;


class FooBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected $category = 'Foo';

    public function __clone()
    {
    }
}