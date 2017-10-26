<?php
namespace frontend\controllers;

use common\components\DesignPatterns\Behavioral\ChainOfResponsibilities\FastStorage;
use common\components\DesignPatterns\Behavioral\ChainOfResponsibilities\SlowStorage;
use common\components\DesignPatterns\Behavioral\Command\HelloCommand;
use common\components\DesignPatterns\Behavioral\Command\Invoker;
use common\components\DesignPatterns\Behavioral\Command\Receiver;
use common\components\DesignPatterns\Behavioral\Iterator\Book;
use common\components\DesignPatterns\Behavioral\Iterator\BookList;
use common\components\DesignPatterns\Behavioral\Mediator\Mediator;
use common\components\DesignPatterns\Behavioral\Mediator\Subsystem\Database;
use common\components\DesignPatterns\Behavioral\Mediator\Subsystem\Server;
use common\components\DesignPatterns\Behavioral\Memento\Ticket;
use common\components\DesignPatterns\Behavioral\NullObject\NullLogger;
use common\components\DesignPatterns\Behavioral\NullObject\Service;
use common\components\DesignPatterns\Behavioral\Observer\UserObserver;
use common\components\DesignPatterns\Behavioral\Specifications\AndSpecification;
use common\components\DesignPatterns\Behavioral\Specifications\Item;
use common\components\DesignPatterns\Behavioral\Specifications\OrSpecification;
use common\components\DesignPatterns\Behavioral\Specifications\PriceSpecification;
use common\components\DesignPatterns\Behavioral\State\ContextOrder;
use common\components\DesignPatterns\Behavioral\State\CreateOrder;
use common\components\DesignPatterns\Behavioral\Strategy\IdComparator;
use common\components\DesignPatterns\Behavioral\Strategy\ObjectCollection;
use common\components\DesignPatterns\Behavioral\TemplateMethod\BeachJourney;
use common\components\DesignPatterns\Creational\AbstractFactory\JsonFactory;
use common\components\DesignPatterns\Creational\Builder\CarBuilder;
use common\components\DesignPatterns\Creational\Builder\Director;
use common\components\DesignPatterns\Creational\FactoryMethod\FactoryMethod;
use common\components\DesignPatterns\Creational\FactoryMethod\GermanyFactory;
use common\components\DesignPatterns\Creational\Multiton\Multiton;
use common\components\DesignPatterns\Creational\Pool\WorkerPool;
use common\components\DesignPatterns\Creational\Prototype\FooBookPrototype;
use common\components\DesignPatterns\Creational\SimpleFactory\SimpleFactory;
use common\components\DesignPatterns\Creational\Singleton\Singleton;
use common\components\DesignPatterns\Creational\StaticFactory\StaticFactory;
use common\components\DesignPatterns\Structural\Adapter\EBookAdapter;
use common\components\DesignPatterns\Structural\Adapter\Kindle;
use common\components\DesignPatterns\Structural\Bridge\HelloWorldService;
use common\components\DesignPatterns\Structural\Bridge\HtmlFormatter;
use common\components\DesignPatterns\Structural\Composite\Form;
use common\components\DesignPatterns\Structural\Composite\InputElement;
use common\components\DesignPatterns\Structural\Composite\TextElement;
use common\components\DesignPatterns\Structural\DataMapper\StorageAdapter;
use common\components\DesignPatterns\Structural\DataMapper\UserMapper;
use common\components\DesignPatterns\Structural\Decorator\JsonRenderer;
use common\components\DesignPatterns\Structural\Decorator\WebService;
use common\components\DesignPatterns\Structural\DependencyInjection\DatabaseConfiguration;
use common\components\DesignPatterns\Structural\DependencyInjection\DatabaseConnection;
use common\components\DesignPatterns\Structural\Facade\Facade;
use common\components\DesignPatterns\Structural\FluentInterface\Sql;
use common\components\DesignPatterns\Structural\Flyweight\FlyweightFactory;
use common\components\formatters\CsvResponseFormatter;
use common\components\formatters\XlsResponseFormatter;
use common\components\formatters\YamlResponseFormatter;
use common\components\vk\API;
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
        /*$factory = new JsonFactory();
        $text = $factory->createText('foobar');
        var_dump($text); exit;*/

        //StaticFactory::factory('number');

        /*$factory = new SimpleFactory();
        $bicycle = $factory->createBicycle();
        $bicycle->driveTo('Paris');
        var_dump($bicycle); exit;*/

        /*$factory = new GermanyFactory();
        $result = $factory->create(FactoryMethod::FAST);
        var_dump($result); exit;*/

        /*$newVehicle = (new Director())->build(new CarBuilder());
        var_dump($newVehicle); exit;*/

        //var_dump(Singleton::getInstance());exit;

        //var_dump(Multiton::getInstance('db')); exit;

        /*$worker = (new WorkerPool())->get();
        var_dump($worker); exit;*/

        /*$fooPrototype = new FooBookPrototype();
        $book1 = clone $fooPrototype;
        $book1->setTitle('Foo Book No ' . 1);
        $book2 = clone $fooPrototype;
        var_dump($book1, $book2);exit;*/

        /*$storage = new StorageAdapter([1 => ['username' => 'domnikl', 'email' => 'liebler.dominik@gmail.com']]);
        $mapper = new UserMapper($storage);
        $user = $mapper->findById(1);
        var_dump($user); exit;*/

        /*$form = new Form();
        $form->addElement(new InputElement());
        $form->addElement(new TextElement('777'));
        echo $form->render(); exit;*/

        //echo (new JsonRenderer(new WebService('text')))->renderData();exit;

        //echo (new HelloWorldService(new HtmlFormatter()))->get(); exit;

        //echo (new EBookAdapter(new Kindle()))->getPage(); exit;

        /*$config = new DatabaseConfiguration('localhost', 3306, 'domnikl', '1234');
        $connection = new DatabaseConnection($config);
        echo $connection->getDsn(); exit;*/

        /*$query = (new Sql())
            ->select(['foo', 'bar'])
            ->from('foobar', 'f')
            ->where('f.bar = ?');
        echo $query; exit;*/

        /*$characters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $fonts = ['Arial', 'Times New Roman', 'Verdana', 'Helvetica'];
        $factory = new FlyweightFactory();
        foreach ($characters as $char) {
            foreach ($fonts as $font) {
                $flyweight = $factory->get($char);
                $rendered = $flyweight->render($font);

                echo $rendered . "\n";
            }
        }
        exit;*/

        //$chain = new FastStorage(['/foo/bar?index=1' => 'Hello In Memory!'], new SlowStorage());

        /*$journey = new BeachJourney();
        $journey->takeATrip();
        var_dump($journey->getThingsToDo()); exit;*/

        /*$obj = new ObjectCollection([
            [
                [['id' => 2], ['id' => 1], ['id' => 3]],
                ['id' => 1],
            ],
            [
                [['id' => 3], ['id' => 2], ['id' => 1]],
                ['id' => 1],
            ],
        ]);
        $obj->setComparator(new IdComparator());
        var_dump($obj->sort());exit;*/

        /*$client = new \common\components\DesignPatterns\Behavioral\Mediator\Subsystem\Client();
        new Mediator(new Database(), $client, new Server());
        $client->request();exit;*/

        /*$invoker = new Invoker();
        $receiver = new Receiver();
        $receiver->enableDate();
        $invoker->setCommand(new HelloCommand($receiver));
        $invoker->run();
        echo $receiver->getOutput(); exit;*/

        /*$bookList = new BookList();
        $bookList->addBook(new Book('Learning PHP Design Patterns', 'William Sanders'));
        $bookList->addBook(new Book('Professional Php Design Patterns', 'Aaron Saray'));
        $bookList->addBook(new Book('Clean Code', 'Robert C. Martin'));
        $books = [];
        foreach ($bookList as $book) {
            $books[] = $book->getAuthorAndTitle();
        }
        var_dump($books); exit;*/

        /*$ticket = new Ticket();
        $ticket->open();
        $openedState = $ticket->getState();
        $memento = $ticket->saveToMemento();
        echo $memento->getState(); exit;*/

        /*$logger = new Service(new NullLogger());
        $logger->doSomething(); exit;*/

        /*$observer = new UserObserver();
        $user = new \common\components\DesignPatterns\Behavioral\Observer\User();
        $user->attach($observer);
        $user->changeEmail('foo@bar.com');
        var_dump($observer->getChangedUsers()); exit;*/

        /*$spec1 = new PriceSpecification(50, 99);
        $spec2 = new PriceSpecification(101, 200);
        $orSpec = new OrSpecification($spec1, $spec2);
        echo $orSpec->isSatisfiedBy(new Item(150)); exit;*/

        $order = new CreateOrder();
        $contextOrder = new ContextOrder();
        $contextOrder->setState($order);
        $contextOrder->done();
        echo $contextOrder->getStatus(); exit;



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

        /*$user = Yii::$app->user->identity;
        if($user->vk_token) {
            $this->redirect(['site/cabinetes']);
        }*/


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

            $vkresp = (new API($user->vk_token))
                ->getAccounts()
                ->getCurrentUser()
                ->execute()
                ->response();

            return $this->render('cabinetes', [
                'cabinetes' => $vkresp->getCabinetes(),
                'user' => $vkresp->getCurrentUser()
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
                ->setUrl('https://api.vk.com/method/execute')
                ->setData([
                    'access_token' => $user->vk_token,
                    'code' => '
                        return {
                            "campaigns": API.ads.getCampaigns({"account_id": '.$account_id.'}),
                            "cabinetes": API.ads.getAccounts()
                        };
                    '
                ])
                ->send();
            if ($response->isOk) {
                $campaigns = $response->data['response']['campaigns'];
                $cabinetes = $response->data['response']['cabinetes'];
                if(is_array($cabinetes)) {
                    $cabinet = ArrayHelper::index($cabinetes, 'account_id')[$account_id];
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
                ->setUrl('https://api.vk.com/method/execute')
                ->setData([
                    'access_token' => $user->vk_token,
                    'code' => '
                        return {
                            "categories": API.ads.getCategories({"lang": "ru"}),
                            "ads": API.ads.getAds({
                                "account_id": '.$account_id.',
                                "campaign_ids": "['.$campaign_id.']",
                                "include_deleted": 0
                            }),
                            "campaign": API.ads.getCampaigns({
                                "account_id": '.$account_id.',
                                "campaign_ids": "['.$campaign_id.']"
                            })[0],
                            "cabinetes": API.ads.getAccounts()                                                        
                        };
                    '
                ])
                ->send();
            if ($response->isOk) {
                $ads = $response->data['response']['ads'];
                $campaign = $response->data['response']['campaign'];
                $cabinetes = $response->data['response']['cabinetes'];
                if(is_array($cabinetes)) {
                    $cabinet = ArrayHelper::index($cabinetes, 'account_id')[$account_id];
                }
                $categories = $response->data['response']['categories'];
                if(is_array($categories)) {
                    $categories = ArrayHelper::index($categories, 'id');
                }
            }

            //var_dump($flood); exit;


            return $this->render('campaign', [
                'campaign' => $campaign,
                'account_id' => $account_id,
                'campaign_id' => $campaign_id,
                'cabinet' => $cabinet,
                'ads' => $ads,
                'categories' => $categories,
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
                    'client_id' => Yii::$app->params['vk_id'],
                    'client_secret' => Yii::$app->params['vk_secret'],
                    'redirect_uri' => Yii::$app->params['vk_redirect_uri'],
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
