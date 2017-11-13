<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 13.11.17
 * Time: 10:41
 */

namespace console\controllers;


use yii\base\Module;
use yii\console\Controller;
use yii2tech\crontab\CronJob;
use yii2tech\crontab\CronTab;

class CronController extends Controller
{
    private $cronTab;

    public function __construct($id, Module $module, CronTab $cronTab, array $config = [])
    {
        $this->cronTab = $cronTab;
        $this->cronTab->headLines = [
            '# this crontab created by my application',
            'SHELL=/bin/bash',
        ];
        parent::__construct($id, $module, $config);
    }

    public function actionTestJob()
    {
        $cronJob = new CronJob();
        $cronJob->min = '*/2';
        $cronJob->command = '/usr/local/bin/php /var/www/yii job/test';

        $this->cronTab->setJobs([
            $cronJob
        ]);

        try {
            $this->cronTab->apply();
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}