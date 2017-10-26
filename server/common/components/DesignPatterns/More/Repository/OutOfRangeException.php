<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 26.10.17
 * Time: 19:23
 */

namespace common\components\DesignPatterns\More\Repository;


use Throwable;
use yii\base\Exception;

class OutOfRangeException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}