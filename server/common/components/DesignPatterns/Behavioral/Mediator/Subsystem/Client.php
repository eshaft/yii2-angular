<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 12:46
 */

namespace common\components\DesignPatterns\Behavioral\Mediator\Subsystem;


use common\components\DesignPatterns\Behavioral\Mediator\Colleague;

class Client extends Colleague
{
    public function request()
    {
        $this->mediator->makeRequest();
    }

    public function output(string $content)
    {
        echo $content;
    }
}