<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 20.10.17
 * Time: 15:18
 */

namespace common\components\export;


use yii\db\ActiveRecord;

interface IExport
{
    /**
     * @param ActiveRecord[] $models
     * @return string
     */
    static public function build($models): string;
}