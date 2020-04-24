<?php

namespace humhub\modules\gifs\controllers;

use Yii;
use yii\web\HttpException;
use humhub\modules\content\models\Content;
use humhub\modules\gifs\models\ShareForm;

class ShareController extends \humhub\components\Controller
{

    public function actionIndex()
    {
        $model = new ShareForm();
        $content = Content::findOne(['id' => Yii::$app->request->get('id')]);

        if (!$content->canView()) {
            throw new HttpException('400', 'Permission denied!');
        }

        return $this->renderAjax('index', ['content' => $content, 'model' => $model]);
    }

}
