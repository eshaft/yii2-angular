<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 20.10.17
 * Time: 15:11
 */
namespace common\components\export;

class Csv implements IExport
{
    static public function build($models): string
    {
        $content = '';
        $keys = [];
        foreach ($models[0]->toArray() as $key => $value) {
            $keys[] = $models[0]->getAttributeLabel($key);
        }
        $content .= implode(';', $keys);
        $content .= "\r\n";
        foreach ($models as $model) {
            $content .= implode(';', $model->toArray());
            $content .= "\r\n";
        }

        return $content;
    }
}