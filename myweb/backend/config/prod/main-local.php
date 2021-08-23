<?php

return [
    'components' => [
        'db'      => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=sso.oppo.com;dbname=mansys',
            'username' => 'OPPODev',
            'password' => 'yii@123456',
            'charset'  => 'utf8mb4',
        ],
        'db_main' => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=gitlab.oppo.com;dbname=gitlab_main',
            'username' => 'ROOT',
            'password' => 'yii@112',
            'charset'  => 'utf8mb4',
        ],
    ],
];
