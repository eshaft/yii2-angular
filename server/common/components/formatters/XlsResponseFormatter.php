<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 20.10.17
 * Time: 10:46
 */

namespace common\components\formatters;


use common\components\export\Xls;
use yii\web\ResponseFormatterInterface;

class XlsResponseFormatter implements ResponseFormatterInterface
{
    const FORMAT = 'xls';

    public function format($response)
    {
        $response->headers->set('Content-Type','application/vnd.ms-exce');
        $response->headers->set('Content-Disposition','attachment;filename="export.xls"');

        $response->content = Xls::build($response->data);
    }
}