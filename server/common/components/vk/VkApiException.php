<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 25.10.17
 * Time: 10:32
 */

namespace common\components\vk;


use yii\web\HttpException;

class VkApiException extends HttpException
{
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(500, $message, $code, $previous);
    }
}