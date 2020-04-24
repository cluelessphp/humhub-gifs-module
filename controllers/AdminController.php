<?php

namespace humhub\modules\gifs\controllers;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
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
        $form = new ConfigureForm();
        if ($form->load(Yii::$app->request->post())) {
            if ($form->validate()) {
                Setting::Set('client', $form->client, 'gifs');

                Yii::$app->session->setFlash('data-saved', Yii::t('GifsModule.base', 'Saved'));
            }
        } else {
            $form->client = Setting::Get('client', 'gifs');
        }

        return $this->render('index', [
            'model' => $form
        ]);
    }

}
