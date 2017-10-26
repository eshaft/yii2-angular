<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 12:13
 */

namespace common\components\DesignPatterns\Behavioral\Strategy;


use Throwable;
use yii\base\Exception;

class LogicException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}