<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 15:55
 */

namespace common\components\DesignPatterns\Behavioral\NullObject;


class NullLogger implements LoggerInterface
{
    public function log(string $str)
    {
        // do nothing
    }
}