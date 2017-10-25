<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 22:04
 */

namespace common\components\DesignPatterns\Structural\Proxy;


use Throwable;
use yii\base\Exception;

class OutOfRangeException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}