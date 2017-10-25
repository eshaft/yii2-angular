<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 12:36
 */

namespace common\components\DesignPatterns\Creational\StaticFactory;


use Throwable;
use yii\base\Exception;

class InvalidArgumentException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}