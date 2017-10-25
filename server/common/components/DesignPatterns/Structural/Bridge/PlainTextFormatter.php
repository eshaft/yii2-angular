<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 18:36
 */

namespace common\components\DesignPatterns\Structural\Bridge;


class PlainTextFormatter implements FormatterInterface
{
    public function format(string $text)
    {
        return $text;
    }
}