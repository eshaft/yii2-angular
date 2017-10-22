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
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class LoginController extends ActiveController
{
    public $modelClass = 'common\models\LoginForm';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBearerAuth::className(),
            ],
            'except' => [
                'options', 'login-by-form', 'signup', 'request-password-reset',
                'reset-password'
            ],
        ];

        return $behaviors;
    }

    public function actionLoginByForm()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = User::findByUsername($model->username);
            return ['user' => $user, 'auth_key' => $user->auth_key];
        } else {
            return $model;
        }
    }

    public function actionLoginByAuthKey()
    {
        $auth_key = Yii::$app->request->post('auth_key', null);
        if ($auth_key && $user = User::findIdentityByAccessToken($auth_key)) {
            return ['user' => $user];
        } else {
            return $auth_key;
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return ['user' => $user, 'auth_key' => $user->auth_key];
                }
            }
        }

        return $model;
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                return ['success' => 'Check your email for further instructions.'];
            } else {
                return ['error' => 'Sorry, we are unable to reset password for the provided email address.'];
            }
        }

        return $model;
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            return ['error' => $e->getMessage()];
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            return ['success' => 'New password saved.'];
        }

        return $model;
    }
}