<?php

return [
    'components' => [
        'db'      => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=mysql-test.maliujia;dbname=mansys',
            'username' => 'root',
            'password' => 'Rnu96YsSmh0gDUnu',
            'charset'  => 'utf8mb4',
        ],
        'db_main' => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=mysql-test.maliujia;dbname=it_main',
            'username' => 'root',
            'password' => 'Rnu96YsSmh0gDUnu',
            'charset'  => 'utf8mb4',
        ],
    ],
];

