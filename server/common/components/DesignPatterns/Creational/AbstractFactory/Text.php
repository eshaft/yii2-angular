<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 12:14
 */

namespace common\components\DesignPatterns\Creational\AbstractFactory;


abstract class Text
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}