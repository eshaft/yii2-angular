<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 12:13
 */

namespace common\components\DesignPatterns\Creational\AbstractFactory;


class HtmlFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new HtmlText($content);
    }
}