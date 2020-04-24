<?php

namespace humhub\modules\gifs;

use Yii;
use yii\helpers\Url;
use yii\base\BaseObject;
use humhub\models\Setting;


class Events extends BaseObject
{

    public static function gifFrame($event)
    {
        if (Yii::$app->user->isGuest) {
            return;
        }
        $event->sender->addWidget(gifdisplay::class, [], [
            'sortOrder' => Setting::Get('timeout', 'gifs')
            ]);
    }

    public static function onWallEntryLinksInit($event)
    {
        $stackWidget = $event->sender;
        $content = $event->sender->object;

        $stackWidget->addWidget(widgets\GifDisplay::class, ['content' => $content]);
    }


}
