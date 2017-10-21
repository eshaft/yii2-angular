<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 20.10.17
 * Time: 10:46
 */

namespace common\components\formatters;


use Symfony\Component\Yaml\Yaml;
use yii\web\ResponseFormatterInterface;

class YamlResponseFormatter implements ResponseFormatterInterface
{
    const FORMAT = 'yaml';

    public function format($response)
    {
        $response->headers->set('Content-Type','text/csv');
        $response->headers->set('Content-Disposition','attachment;filename="export.yaml"');

        $response->content = Yaml::dump($response->data);
    }
}