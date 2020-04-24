<?php

namespace humhub\modules\gifs\widgets;

use Yii;
use humhub\components\Widget;
use humhub\modules\content\components\ContentContainerController;

class GifDisplay extends Widget
{

    public $content;

    public function run()
    {
        return $this->render('gifdisplay', [
                    'object' => $this->content,
                    'id' => $this->content->content->id,
        ]);
    }

}
