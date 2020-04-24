<?php

namespace humhub\modules\gifs;

use yii\helpers\Url;
use humhub\components\Module as BaseModule;

class Module extends BaseModule
{

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/gifs/admin/index']);
    }
}
