<?php

namespace backend\modules\site\controllers;

use common\base\BaseController;
use yii\filters\VerbFilter;
use Yii;

class IndexController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'info' => ['get'],
                ],
            ],
        ];
    }


    /**
     * @return array
     */
    public function actionInfo()
    {
    }
}
