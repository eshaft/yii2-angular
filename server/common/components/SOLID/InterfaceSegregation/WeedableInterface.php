<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.11.17
 * Time: 10:39
 */

namespace common\components\SOLID\InterfaceSegregation;


interface WeedableInterface
{
    public function weed($pickOutPercentage);
}