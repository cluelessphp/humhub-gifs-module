<?php


namespace humhub\modules\gifs\widgets;

use Yii;
use humhub\modules\content\components\ContentContainerController;

class GifDisplay extends \yii\base\Widget
{

    
    public $content;


    public function run()
    {     
        return $this->render('gifdisplay', array(
                    'object' => $this->content,
                    'id' => $this->content->content->id,
        ));
    }

}
