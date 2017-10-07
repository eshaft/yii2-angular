<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 24.09.17
 * Time: 16:30
 */

namespace frontend\controllers;


use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class LoginController extends ActiveController
{
    public $modelClass = 'common\models\LoginForm';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className()
        ];
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'except' => ['login']
        ];
        return $behaviors;
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return User::findByUsername($model->username);
        } else {
            return $model;
        }
    }
}