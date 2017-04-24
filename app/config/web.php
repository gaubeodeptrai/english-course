<?php
//use yii\easyii\controllers\AdminsController
$params = require(__DIR__ . '/params.php');

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

$config = [
    'id' => 'app',
    'on beforeAction' => ['\pjhl\multilanguage\Start', 'run'],
    'basePath' => $basePath,
    'bootstrap' => ['log'],
    'language'   => 'en',
    'sourceLanguage' => 'en',
    'runtimePath' => $webroot . '/runtime',
    'vendorPath' => $webroot . '/vendor',
    'modules' => [
        'user' => [
          'class' => 'dektrium\user\Module',
          
        'mailer' => [
        'sender'                => 'no-reply@myhost.com', // or ['no-reply@myhost.com' => 'Sender name']
        'welcomeSubject'        => 'Welcome subject',
        'confirmationSubject'   => 'Confirmation subject',
        'reconfirmationSubject' => 'Email change subject',
        'recoverySubject'       => 'Recovery subject',
        ],
         'enableUnconfirmedLogin' => true,
         'confirmWithin' => 21600,
         'cost' => 12,
         'admins' => ['root','administrator'],
         'controllerMap' => [
                'admin' => 'yii\easyii\controllers\AdminsController'
            ],   
        ],
        //'gii' => 'yii\gii\Module',
        'imagemanager' => [
        'class' => '\noam148\imagemanager\Module',
        //set accces rules ()
        'canUploadImage' => true,
        'canRemoveImage' => function(){
            return true;
        },
        // Set if blameable behavior is used, if it is, callable function can also be used
        'setBlameableBehavior' => false,
        //add css files (to use in media manage selector iframe)
        'cssFiles' => [
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
        ],
      ],
      'pdfjs' => [
           'class' => '\yii2assets\pdfjs\Module',
      ],          
    ],
    'components' => [
        'authClientCollection' => [
        'class' => yii\authclient\Collection::className(),
        'clients' => [
         'facebook' => [
            'class'        => 'dektrium\user\clients\Facebook',
            'clientId'     => '395761090809113',
            'clientSecret' => '5007f6b1cd028a422d340ab254640c57',
         ],
         'twitter' => [
            'class'          => 'dektrium\user\clients\Twitter',
            'consumerKey'    => 'CONSUMER_KEY',
            'consumerSecret' => 'CONSUMER_SECRET',
         ],
         'google' => [
            'class'        => 'dektrium\user\clients\Google',
            'clientId'     => '947360603129-mjqoaok596t0jviqrk73ch16nr0f0sli.apps.googleusercontent.com ',
            'clientSecret' => 'JbCF0Ul_BYJvNJY1Q0ezidAe ',
        ],
    ],
],
	'authManager' => [
        'class' => 'yii\rbac\DbManager',
      ],
        'imagemanager' => [
           'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
        //set media path (outside the web folder is possible)
           'mediaPath' => 'images/media/imagemanager',
        //path relative web folder to store the cache images
           'cachePath' => 'assets/images',
        //use filename (seo friendly) for resized images else use a hash
           'useFilename' => true,
        //show full url (for example in case of a API)
           'absoluteUrl' => false,
       ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HMjhChRHqJPRAyxyETeHPFg4Zs3NDkdO',
            'class' => 'pjhl\multilanguage\components\AdvancedRequest'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
       'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport'=>false,
            'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'info@deborah.vn',
            'password' => 'deborah123',
            'port' => '587', // Port 25 is a very common port too
            'encryption' => 'tls', // It is often used, check your provider or mail server 
            
           ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => 'pjhl\multilanguage\components\AdvancedUrlManager',
            'rules' => [
                '<controller:\w+>/view/<slug:[\w-]+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/cat/<slug:[\w-]+>' => '<controller>/cat',
            ],
        ],
        'assetManager' => [
            // uncomment the following line if you want to auto update your assets (unix hosting only)
            //'linkAssets' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [YII_DEBUG ? 'jquery.js' : 'jquery.min.js'],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [YII_DEBUG ? 'css/bootstrap.css' : 'css/bootstrap.min.css'],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [YII_DEBUG ? 'js/bootstrap.js' : 'js/bootstrap.min.js'],
                ],
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
        'db' => require(__DIR__ . '/db.php'),
	'jwplayer' => [
        'class' => 'wadeshuler\jwplayer\JWConfig',
        'key' => 'IdtfbA25',  // <-- Your Key Here!!
        'htmlOptions' => [
            'class' => 'myVideoPlayer',
        ],
      ]
    ],
    
     
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
    
    $config['components']['db']['enableSchemaCache'] = false;
}

return array_merge_recursive($config, require($webroot . '/vendor/noumo/easyii/config/easyii.php'));