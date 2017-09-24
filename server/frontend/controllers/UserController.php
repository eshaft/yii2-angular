<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 24.09.17
 * Time: 16:30
 */

namespace frontend\controllers;


use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className()
        ];
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }
}