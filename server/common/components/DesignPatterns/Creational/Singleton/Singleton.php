<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 14:05
 */

namespace common\components\DesignPatterns\Creational\Singleton;


final class Singleton
{
    private static $instance;

    public static function getInstance(): Singleton
    {
        if(null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
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