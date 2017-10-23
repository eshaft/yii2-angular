<?php
namespace frontend\controllers;

use common\components\formatters\CsvResponseFormatter;
use common\components\formatters\XlsResponseFormatter;
use common\components\formatters\YamlResponseFormatter;
use common\jobs\MailJob;
use common\models\Descr;
use common\models\User;
use common\models\UserAuth;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();

        /* @var $auth UserAuth */
        $auth = UserAuth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // авторизация
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // регистрация
                if (isset($attributes['email']) && User::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Пользователь с такой электронной почтой как в {client} уже существует, но с ним не связан. Для начала войдите на сайт использую электронную почту, для того, что бы связать её.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes['login'],
                        'email' => $attributes['email'],
                        'password' => $password,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new UserAuth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // Пользователь уже зарегистрирован
            if (!$auth) { // добавляем внешний сервис аутентификации
                $auth = new UserAuth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /*$models = User::find()->all();
        $data = array_map(function($model) {
            return $model->toArray();
        }, $models);

        $response = Yii::$app->response;
        $response->format = YamlResponseFormatter::FORMAT;
        $response->data = $data;

        Yii::$app->end();*/

        /*$response = Yii::$app->response;
        $response->format = CsvResponseFormatter::FORMAT;
        $response->data = User::find()->all();

        Yii::$app->end();*/

        /*$response = Yii::$app->response;
        $response->format = XlsResponseFormatter::FORMAT;
        $response->data = User::find()->all();

        Yii::$app->end();*/

        //return $response;

        //echo Yii::$app->user->can('manager'); exit;

        //$auth = Yii::$app->authManager;

        /*$admin = $auth->getRole('admin');

        $manager = $auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($admin, $manager);*/

        //$auth->revoke($admin, 1);
        //$auth->assign($manager, 1);

        /*Yii::$app->rabbitmq->push(new MailJob([
            'name' => 'Igor',
            'email' => 'eshaft@gmail.com',
            'title' => 'Hello! rabbitmq works!',
            'body' => 'Hello! rabbitmq works!'
        ]));*/

        $user = Yii::$app->user->identity;
        if($user->vk_token) {
            $this->redirect(['site/cabinetes']);
        }


        return $this->render('index');
    }

    public function actionQuit()
    {
        $user = Yii::$app->user->identity;
        if($user) {
            $user->vk_token = null;
            $user->save(false);
        }

        $this->redirect(['site/index']);
    }

    public function actionCabinetes()
    {
        $user = Yii::$app->user->identity;
        if($user->vk_token) {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/ads.getAccounts')
                ->setData([
                    'access_token' => $user->vk_token
                ])
                ->send();
            if ($response->isOk) {
                $cabinetes = $response->data['response'];
            }

            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/users.get')
                ->setData([
                    'access_token' => $user->vk_token,
                    'fields' => 'photo_id,photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig'
                ])
                ->send();
            if ($response->isOk) {
                $users = $response->data['response'][0];
            }

            return $this->render('cabinetes', [
                'cabinetes' => $cabinetes,
                'user' => $users
            ]);

        }

        $this->redirect(['site/index']);
    }

    public function actionCabinet($account_id)
    {
        $user = Yii::$app->user->identity;
        if($user->vk_token) {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/ads.getCampaigns')
                ->setData([
                    'access_token' => $user->vk_token,
                    'account_id' => $account_id,
                ])
                ->send();
            if ($response->isOk) {
                $campaigns = $response->data['response'];
            }

            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/ads.getAccounts')
                ->setData([
                    'access_token' => $user->vk_token
                ])
                ->send();
            if ($response->isOk) {
                $cabinetes = $response->data['response'];
                $cabinetes = array_filter($cabinetes, function($a) use ($account_id) {
                    return $a["account_id"] == $account_id;
                });
                if($cabinetes) {
                    foreach ($cabinetes as $cab) {
                        $cabinet = $cab;
                    }
                }
            }

            return $this->render('cabinet', [
                'campaigns' => $campaigns,
                'account_id' => $account_id,
                'cabinet' => $cabinet
            ]);
        }

        $this->redirect(['site/index']);
    }

    public function actionCampaign($account_id, $campaign_id)
    {
        $user = Yii::$app->user->identity;
        if($user->vk_token) {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/ads.getAds')
                ->setData([
                    'access_token' => $user->vk_token,
                    'account_id' => $account_id,
                    'campaign_ids' => Json::encode([$campaign_id]),
                    'include_deleted' => 0
                ])
                ->send();
            if ($response->isOk) {
                $ads = $response->data['response'];
            }

            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/ads.getAccounts')
                ->setData([
                    'access_token' => $user->vk_token
                ])
                ->send();
            if ($response->isOk) {
                $cabinetes = $response->data['response'];
                $cabinetes = array_filter($cabinetes, function($a) use ($account_id) {
                    return $a["account_id"] == $account_id;
                });
                if($cabinetes) {
                    foreach ($cabinetes as $cab) {
                        $cabinet = $cab;
                    }
                }
            }

            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/ads.getCampaigns')
                ->setData([
                    'access_token' => $user->vk_token,
                    'account_id' => $account_id,
                    'campaign_ids' => Json::encode([$campaign_id]),
                ])
                ->send();
            if ($response->isOk) {
                $campaign = $response->data['response'][0];
            }

            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/ads.getCategories')
                ->setData([
                    'access_token' => $user->vk_token,
                    'lang' => 'ru'
                ])
                ->send();
            if ($response->isOk) {
                $categories = $response->data['response'];
            }

            return $this->render('campaign', [
                'campaign' => $campaign,
                'account_id' => $account_id,
                'campaign_id' => $campaign_id,
                'cabinet' => $cabinet,
                'ads' => $ads,
                'statuses' => [
                    0 => 'объявление остановлено',
                    1 => 'объявление запущено',
                    2 => 'объявление удалено'
                ],
                'ad_platforms' => [
                    0 => 'ВКонтакте и сайты-партнёры',
                    1 => 'только ВКонтакте',
                    'all' => 'все площадки',
                    'desktop' => 'полная версия сайта',
                    'mobile' => 'мобильный сайт и приложения'
                ],
                'categories' => $categories,
            ]);
        }

        $this->redirect(['site/index']);
    }

    public function actionDel($account_id, $campaign_id, $ads_id)
    {
        $user = Yii::$app->user->identity;
        if($user->vk_token) {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://api.vk.com/method/ads.deleteAds')
                ->setData([
                    'access_token' => $user->vk_token,
                    'account_id' => $account_id,
                    'ids' => Json::encode([$ads_id])
                ])
                ->send();
        }

        $this->redirect(["site/campaign?account_id=$account_id&campaign_id=$campaign_id"]);
    }

    public function actionVk()
    {
        $code = Yii::$app->request->get('code');
        if($code) {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl('https://oauth.vk.com/access_token')
                ->setData([
                    'client_id' => 6196137,
                    'client_secret' => Yii::$app->params['vk_secret'],
                    'redirect_uri' => 'http://188.225.84.145/site/vk',
                    'code' => $code
                ])
                ->send();
            if ($response->isOk) {
                $token = $response->data['access_token'];
                $user = User::findOne(Yii::$app->user->id);
                $user->vk_token = $token;
                $user->save(false);
            }
        }

        return $this->goHome();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
