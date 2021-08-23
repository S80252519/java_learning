<?php

return [
    'components' => [
        'db'      => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=gitlab.wanyol.com;dbname=mansys',
            'username' => 'gitlabtest',
            'password' => '1234@gitlab',
            'charset'  => 'utf8mb4',
        ],
        'db_main' => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=devops.oppo.local;dbname=it_main',
            'username' => 'devops_oppodev_it',
            'password' => 'devops_123456',
            'charset'  => 'utf8mb4',
        ],
    ],
];
