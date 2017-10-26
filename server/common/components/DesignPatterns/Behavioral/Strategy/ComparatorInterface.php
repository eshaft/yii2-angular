<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 12:10
 */

namespace common\components\DesignPatterns\Behavioral\Strategy;


interface ComparatorInterface
{
    public function compare($a, $b): int;
}