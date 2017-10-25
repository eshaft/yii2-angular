<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 12:31
 */
namespace common\components\DesignPatterns\Creational\StaticFactory;


final class StaticFactory
{
    public static function factory(string $type): FormatterInterface
    {
        if($type == 'number') {
            return new FormatNumber();
        }

        if($type == 'string') {
            return new FormatString();
        }

        throw new InvalidArgumentException('Unknown format given');
    }
}