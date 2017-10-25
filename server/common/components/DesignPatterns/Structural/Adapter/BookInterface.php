<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 20:02
 */

namespace common\components\DesignPatterns\Structural\Adapter;


interface BookInterface
{
    public function turnPage();

    public function open();

    public function getPage(): int;
}