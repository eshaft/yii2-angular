<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 20.10.17
 * Time: 10:46
 */

namespace common\components\formatters;


use common\components\export\Csv;
use yii\web\ResponseFormatterInterface;

class CsvResponseFormatter implements ResponseFormatterInterface
{
    const FORMAT = 'csv';

    public function format($response)
    {
        $response->headers->set('Content-Type','text/csv');
        $response->headers->set('Content-Disposition','attachment;filename="export.csv"');

        $response->content = Csv::build($response->data);
    }
}