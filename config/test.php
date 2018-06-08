<?php
$params = require __DIR__ . '/params-test.php';
$db = require __DIR__ . '/db-test.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),  
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],  
    'language' => 'en-US',
    'components' => [
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'view' => 'app\components\View',
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
      				'' => 'site/index',
      				'<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
      				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                [
                    'pattern' => 'js/<action>/<hash>',
                    'route' => 'js/<action>',
                    'suffix' => '.js',
                ],
			],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],

            ],
        ],
        // 'user' => [
        //     'identityClass' => 'app\models\User',
        // ],        
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],        
    ],
    'params' => $params,
];
