<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 15:54
 */

namespace common\components\DesignPatterns\Behavioral\NullObject;


interface LoggerInterface
{
    public function log(string $str);
}