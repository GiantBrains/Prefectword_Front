<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Verified Professors',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'timezone'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',

            // the global settings for the facebook plugins widget
            'facebook' => [
                'appId' => '527091417732221',
                'secret' => 'be5954547e69102c03d81ba6f465f7e5',
            ],

            // the global settings for the google plugins widget
            'google' => [
                'clientId' => 'GOOGLE_API_CLIENT_ID',
                'pageId' => 'GOOGLE_PLUS_PAGE_ID',
                'profileId' => '109113922068966087471',
            ],

            // the global settings for the google analytic plugin widget
            'googleAnalytics' => [
                'id' => 'TRACKING_ID',
                'domain' => 'TRACKING_DOMAIN',
            ],

            // the global settings for the twitter plugins widget
            'twitter' => [
                'screenName' => 'doctorateessays'
            ],
        ],
        'notifications' => [
            'class' => 'machour\yii2\notifications\NotificationsModule',
            // Point this to your own Notification class
            // See the "Declaring your notifications" section below
            'notificationClass' => 'app\components\Notification',
            // Allow to have notification with same (user_id, key, key_id)
            // Default to FALSE
            'allowDuplicate' => false,
            // Allow custom date formatting in database
            'dbDateFormat' => 'Y-m-d H:i:s',
            // This callable should return your logged in user Id
            'userId' => function () {
                return \Yii::$app->user->id;
            }
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ],

    ],

    'components' => [
        'cm' => [ // bad abbreviation of "CashMoney"; not sustainable long-term
            'class' => 'app\components\CashMoney', // note: this has to correspond with the newly created folder, else you'd get a ReflectionError
            // Next up, we set the public parameters of the class
            'client_id' => 'AW4z_bz5wVOaWIz62BcmhfFSoZhtzZKqA9BZ5f3vi8hk0LItK-bYR8_L7W4r57Twt12acRTjn5HweHoL',
            'client_secret' => 'EBxC6yWLDE79TIcWZ_4GLmRt6EOaD1f_zu7OTsWP0GVjTaaPBIr1g_nJbDf7X3z_jige7o3K5W7D6Rp6',

        ],

        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV2' => '6LcXFfEUAAAAACyYLjoG52fn9q1EwdrXfdW7KQNc',
            'secretV2' => '6LcXFfEUAAAAAAJutrdOinyu-dvHxrdp3n25e6H1',
            'siteKeyV3' => '6LeiCPEUAAAAAGAvG74ythZmevXYMkFbAOvChqwS',
            'secretV3' => '6LeiCPEUAAAAANkk3qNzijJdWgiqONtRGe-6xPgh',
        ],
        // other default components here..
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::className(),
            'key' => 'doctorateessayswriting',
            'jwtValidationData' => [
                'class' => \sizeg\jwt\JwtValidationData::className(),
            ],

        ],
        'geoip' => ['class' => 'lysenkobv\GeoIP\GeoIP'],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'doctorateessays.com',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'authClientCollection' => [
            'class' => \yii\authclient\Collection::className(),
            'clients' => [
                'google' => [
                    'class' => 'dektrium\user\clients\Google',
                    'clientId' => '711908005593-p1k7t6ui5ret3fc1gvecie9vdc0keklu.apps.googleusercontent.com',
                    'clientSecret' => 'RRqo8l0UrWvUWgoWVmKegqsW',
                    'returnUrl' => 'https://verifiedprofessors.com/site/auth?authclient=google'
                ],
//                'twitter' => [
//                    'class' => 'dektrium\user\clients\Twitter',
//                    'attributeParams' => [
//                        'include_email' => 'true'
//                    ],
//                    'consumerKey' => 'CONSUMER_KEY',
//                    'consumerSecret' => 'CONSUMER_SECRET',
//                ],

                'facebook' => [
                    'class' => 'dektrium\user\clients\Facebook',
                    'clientId' => '717300522465738',
                    'clientSecret' => 'f6fca32825d053e3aa5fa23613d66ed9',
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'timezone' => [
            'class' => 'yii2mod\timezone\Timezone',
            'actionRoute' => '/site/timezone' //optional param - full path to page must be specified
        ],
        'booster' => [
            'class' => 'path.alias.to.booster.components.Booster',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.zoho.com',
                'username' => 'no-reply@verifiedprofessors.com',
                'password' => 'verifiedprofessors8994',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],

        'adminMailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.zoho.com',
                'username' => 'admin@verifiedprofessors.com',
                'password' => 'verifiedprofessors8994',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],

        'managerMailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.zoho.com',
                'username' => 'olivia@verifiedprofessors.com',
                'password' => 'verifiedprofessors8994',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],

        'supportMailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.zoho.com',
                'username' => 'support@verifiedprofessors.com',
                'password' => 'verifiedprofessors8994',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'about' => 'site/about',
                'contact' => 'site/contact',
                'how_it_works' => 'site/how_it_works',
                'services' => 'site/services',
                [
                    'pattern' => 'blog/<id:\d+>/<slug:[a-zA-Z0-9_-]+>',
                    'route' => 'blog/view',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => 'site/article/<slug:[a-zA-Z0-9_-]+>',
                    'route' => 'site/article',
                ],
                [
                    'pattern' => 'blog/update/<id:\d+>/<slug:[a-zA-Z0-9_-]+>',
                    'route' => 'blog/update',
                    'suffix' => '.html'
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'paper'],
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
