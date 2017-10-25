<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 16:40
 */

namespace common\components\DesignPatterns\Structural\DataMapper;


use Throwable;
use yii\base\Exception;

class InvalidArgumentException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}