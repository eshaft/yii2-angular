<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 12:43
 */

namespace common\components\DesignPatterns\Behavioral\Mediator;


interface MediatorInterface
{
    public function sendResponse(string $content);

    public function makeRequest();

    public function queryDb();
}