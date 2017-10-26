<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 15:43
 */

namespace common\components\DesignPatterns\Behavioral\Memento;


use Throwable;
use yii\base\Exception;

class InvalidArgumentException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}