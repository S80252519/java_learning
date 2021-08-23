<?php

namespace backend\modules\site\controllers;

use common\base\BaseController;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

class FileController extends BaseController
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
                    'download' => ['get'],
                    'upload' => ['post'],
                ],
            ],
        ];
    }

    public function actionDownload()
    {
    }


    /**
     * 文件上传
     *
     * @throws \common\exceptions\RequestParamException
     */
    public function actionUpload()
    {
        $params = $this->validate(['file' => UploadedFile::getInstanceByName('file')], [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,jpeg'],
        ]);

        $url = 'https://xxx/xx.jpg';

        $this->data = compact('url');
    }
}
