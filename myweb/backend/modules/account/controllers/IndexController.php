<?php

namespace backend\modules\account\controllers;

use common\base\BaseController;
use common\helpers\RequestHelper;
use common\models\main\AccountModel;
use common\services\AccountService;
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
                'class'   => VerbFilter::className(),
                'actions' => [
                    'index'         => ['get'],
                    'query'         => ['get'],
                    'save'          => ['post'],
                    'save-password' => ['post'],
                    'delete'        => ['delete'],
                ],
            ],
        ];
    }

    /**
     * 账户列表
     *
     * @throws \common\exceptions\RequestParamException
     */
    public function actionIndex()
    {
        $platformLabels = array_column(AccountModel::$platformLabels, 'title', 'value');;
        $typeLabels     = array_column(AccountModel::$typeLabels, 'title', 'value');
        $statusLabels   = array_column(AccountModel::$statusLabels, 'title', 'value');
        $options        = compact('platformLabels', 'typeLabels', 'statusLabels');

        $params = $this->validate(Yii::$app->request->get(), [
            [['id', 'department_id', 'platform', 'status', 'uid'], 'default', 'value' => null],
            [['page'], 'default', 'value' => 1],
            [['page_size'], 'default', 'value' => 30],

            [['platform'], 'in', 'range' => array_keys($platformLabels)],
            [['status'], 'in', 'range' => array_keys($statusLabels)],
        ]);


        $accountService = new AccountService();
        $list = $accountService->getList($params);

        $this->data = compact('options', 'list');
    }

    /**
     * 筛选账户
     *
     * @throws \common\exceptions\RequestParamException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionQuery()
    {
        $statusLabels = AccountModel::$statusLabels;

        $params = $this->validate(RequestHelper::getQueryParams(), [
            [['status'], 'in', 'range' => array_keys($statusLabels)],

            [['status', 'keyword'], 'default', 'value' => null],
            [['page'], 'default', 'value' => 1],
            [['page_size'], 'default', 'value' => 1000],
        ]);

        $accountService = new AccountService();
        $list = $accountService->query($params);

        $this->data = compact('list');
    }

    /**
     * 保存账户
     *
     * @throws \Throwable
     * @throws \common\exceptions\RequestParamException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionSave()
    {
        $platformLabels = AccountModel::$platformLabels;
        $typeLabels     = AccountModel::$typeLabels;

        $params = $this->validate(RequestHelper::getBodyParams(), [
            [['platform', 'name', 'uid', 'department_id', 'type'], 'required'],
            [['id'], 'default', 'value' => null],
            [['default_pid'], 'default', 'value' => ''],

            [['platform'], 'in', 'range' => array_keys($platformLabels)],
            [['type'], 'in', 'range' => array_keys($typeLabels)],
        ]);

        $accountService = new AccountService();
        $id = $accountService->save($params);

        $this->data = compact('id');
    }

    /**
     * 保存密码
     *
     * @throws \Throwable
     * @throws \common\exceptions\RequestParamException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionSavePassword()
    {
        $params = $this->validate(RequestHelper::getBodyParams(), [
            [['id', 'password', 'confirm_password'], 'required'],
            [['old_password'], 'default', 'value' => ''],
            [
                ['confirm_password'],
                'compare',
                'compareAttribute' => 'password',
                'operator' => '===',
                'message' => '新密码与确认密码不一致.',
            ],
            [
                ['password'],
                'compare',
                'compareAttribute' => 'old_password',
                'operator' => '!==',
                'message' => '原密码与新密码不能一致.',
            ],
        ]);

        $accountService = new AccountService();
        $accountService->savePassword($params);
    }

    /**
     * 删除账户
     *
     * @throws Yii\db\Exception
     * @throws \common\exceptions\RequestParamException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function actionDelete()
    {
        $params = $this->validate(RequestHelper::getBodyParams(), [
            [['id'], 'required'],
        ]);

        $accountService = new AccountService();
        $accountService->delete($params['id']);
    }
}
