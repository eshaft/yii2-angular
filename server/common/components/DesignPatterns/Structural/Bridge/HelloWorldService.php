<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 18:41
 */

namespace common\components\DesignPatterns\Structural\Bridge;


class HelloWorldService extends Service
{
    public function get()
    {
        return $this->implementation->format('Hello World!');
    }
}