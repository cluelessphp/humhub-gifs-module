<?php

namespace humhub\modules\gifs;

use Yii;
use yii\helpers\Url;
use yii\base\BaseObject;
use humhub\models\Setting;


class Events extends BaseObject
{

    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem([
            'label' => Yii::t('GifsModule.base', 'GIF Settings'),
            'url' => Url::toRoute('/gifs/admin/index'),
            'group' => 'settings',
            'icon' => '<i class="fa fa-cog"></i>',
            'isActive' => Yii::$app->controller->module && Yii::$app->controller->module->id == 'gifs' && Yii::$app->controller->id == 'admin',
            'sortOrder' => 650
        ]);
    }

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
