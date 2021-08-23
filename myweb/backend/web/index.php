<?php

require dirname(dirname(__DIR__)) . '/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require Yii::getAlias( '@backend/config/main.php'),
    require Yii::getAlias( '@common/config/main.php')
);
(new yii\web\Application($config))->run();
