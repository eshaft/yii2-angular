<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['gii', 'debug', 'gearman', 'beanstalkd', 'rabbitmq'],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'response' => [
            'formatters' => [
                'yaml' => [
                    'class' => '\common\components\formatters\YamlResponseFormatter'
                ],
                'csv' => [
                    'class' => '\common\components\formatters\CsvResponseFormatter'
                ],
                'xls' => [
                    'class' => '\common\components\formatters\XlsResponseFormatter'
                ]
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'login',
                    'pluralize' => false,
                    'patterns' => [
                        'POST login-by-auth-key' => 'login-by-auth-key',
                        'OPTIONS login-by-auth-key' => 'options',
                        'POST login-by-form' => 'login-by-form',
                        'OPTIONS login-by-form' => 'options',
                        'POST reset-password' => 'reset-password',
                        'GET reset-password' => 'reset-password',
                        'OPTIONS reset-password' => 'options',
                    ]
                ],
            ],
        ],
        'gearman' => [
            'class' => \yii\queue\gearman\Queue::class,
            'host' => 'gearman',
            'port' => 4730,
            'channel' => 'my_queue',
            'as log' => \yii\queue\LogBehavior::class,
        ],
        'beanstalkd' => [
            'class' => \yii\queue\beanstalk\Queue::class,
            'host' => 'beanstalkd',
            'port' => 11300,
            'tube' => 'my_queue',
            'as log' => \yii\queue\LogBehavior::class,
        ],
        'rabbitmq' => [
            'class' => \yii\queue\amqp\Queue::class,
            'host' => 'rabbitmq',
            'port' => 5672,
            'queueName' => 'my_queue',
            'as log' => \yii\queue\LogBehavior::class,
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
        'debug' => [
            'class' => \yii\debug\Module::class,
            'panels' => [
                'queue' => \yii\queue\debug\Panel::class,
            ],
            'allowedIPs' => ['*']
        ],
    ]
];
