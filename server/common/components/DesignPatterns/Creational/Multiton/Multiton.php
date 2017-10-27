<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 14:05
 */

namespace common\components\DesignPatterns\Creational\Multiton;


final class Multiton
{
    const INSTANCE_1 = 1;
    const INSTANCE_2 = 2;

    private static $instances = [];

    public static function getInstance(string $instanceName): Multiton
    {
        if(!isset(self::$instances[$instanceName])) {
            self::$instances[$instanceName] = new self();
        }

        return self::$instances[$instanceName];
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}