<?php

$params = array_merge(
    require(__DIR__ . DIRECTORY_SEPARATOR . YII_ENV . '/params.php'),
    require(__DIR__ . DIRECTORY_SEPARATOR . YII_ENV . '/params-local.php')
);

$config = [
    'id'               => 'demo', // 应用 ID
    'basePath'         => YII_ROOT,
    'language'         => 'zh-CN', // 默认语言
    'timeZone'         => 'Asia/Jakarta', // 默认时区
    'bootstrap'        => ['log'],
    'modules'          => [
        'site' => [
            'class' => 'backend\modules\site\Module',
        ],
        'account' => [
            'class' => 'backend\modules\account\Module',
        ],
    ],
    'components'       => [
        'user' => [
            'identityClass' => 'common\models\UserModel',
            'enableAutoLogin' => true,  //是否必须登陆
        ],
        'session'      => [
            'name'    => 'BACKEND_DEMO',
            'timeout' => 86400, // session 过期时间，单位为秒
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'log'          => [
            'traceLevel' => 1,
            'targets'    => [
                [
                    'class'       => 'yii\log\FileTarget',
                    'levels'      => ['error', 'warning'],
                    'logFile'     => '@runtime/' . date('Y-m-d') . '.log',
                    'logVars'     => [],
                    'maxFileSize' => 51200, //  单位 KB
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'class'       => 'common\components\ExceptionHandler',
            'ssoUrl'      => 'https://sso.oppo.com', // 单点登陆地址
        ],
        'request'      => [
            'csrfParam'              => '_csrf_backend',
            'class'                  => 'yii\web\Request',
            'enableCsrfValidation'   => false,
            'enableCookieValidation' => false,
            'enableCsrfCookie'       => false,
            'parsers'                => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey'    => '0eJhux0gSEyRG1Z_ifoZcqJl5BjbuNPP',
        ],
        'urlManager'   => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => false,
            'rules'               => [
                '/' => '/site/index/index',
                '<module>/<controller>' => '<module>/<controller>/index',
                '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'on beforeRequest' => function () {
        if (\Yii::$app->request->isOptions) {
            setCorsHeader();
            exit();
        }
    },
    'as access'        => [
        'class'             => common\components\AccessControl::className(),
        'switch'            => true,
        'allowActions'      => [
            'site/index/index',
            'site/index/info',
        ],
        'superAdminUserIds' => [],
    ],
    'params'           => $params,
];

return yii\helpers\ArrayHelper::merge(
    $config,
    require __DIR__ . DIRECTORY_SEPARATOR . YII_ENV . '/main-local.php'
);
