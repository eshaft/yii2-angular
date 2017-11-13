<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 13.11.17
 * Time: 11:04
 */

namespace console\controllers;


use yii\console\Controller;

class JobController extends Controller
{
    public function actionTest()
    {
        \Yii::$app->db->createCommand()->insert('{{%cron_test}}', [
            'created_at' => date('Y-m-d H:i:s')
        ])->execute();
    }
}