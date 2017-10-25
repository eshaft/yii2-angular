<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 18:34
 */

namespace common\components\DesignPatterns\Structural\Bridge;


interface FormatterInterface
{
    public function format(string $text);
}