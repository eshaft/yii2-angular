<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 20:35
 */

namespace common\components\DesignPatterns\Structural\Facade;


interface OsInterface
{
    public function halt();

    public function getName(): string;
}