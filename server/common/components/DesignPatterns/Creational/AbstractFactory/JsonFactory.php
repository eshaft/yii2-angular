<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 12:11
 */

namespace common\components\DesignPatterns\Creational\AbstractFactory;


class JsonFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new JsonText($content);
    }
}