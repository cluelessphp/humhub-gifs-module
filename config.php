<?php

namespace humhub\modules\gifs;

use humhub\modules\gifs\Events;
use humhub\modules\gifs\Module;
use humhub\modules\content\widgets\WallEntryLinks;

return [
    'id' => 'gifs',
    'class' => Module::class,
    'namespace' => 'humhub\modules\gifs',
    'events' => [
	['class' => WallEntryLinks::class, 'event' => WallEntryLinks::EVENT_INIT, 'callback' => [Events::class, 'onWallEntryLinksInit']]
    ]
];
?>
