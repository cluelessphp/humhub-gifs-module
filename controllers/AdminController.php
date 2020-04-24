<?php

namespace humhub\modules\gifs\controllers;

use Yii;
use humhub\components\behaviors\AccessControl;
use humhub\modules\admin\components\Controller;
use humhub\modules\gifs\models\forms\ConfigureForm;

class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'acl' => [
                'class' => AccessControl::class,
                'adminOnly' => true
            ]
        ];
    }

    public function actionIndex()
    {
        $model = new ConfigureForm();
        $model->loadSettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->view->saved();
        }

        return $this->render('index', ['model' => $model]);
    }

}
