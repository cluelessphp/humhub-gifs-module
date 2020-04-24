<?php

namespace humhub\modules\gifs;

use yii\helpers\Url;
use humhub\modules\content\components\ContentContainerModule;

class Module extends ContentContainerModule
{

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/gifs/admin/index']);
    }
}
