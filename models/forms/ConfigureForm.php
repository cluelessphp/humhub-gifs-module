<?php

namespace humhub\modules\gifs\models\forms;

use Yii;
use yii\base\Model;

/**
 * ConfigureForm defines the configurable fields.
 */
class ConfigureForm extends Model
{

    public $client;

    public function rules()
    {
        return [
            [['client'], 'safe'],
            [['client'], 'required'],
            [['client'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
     public function attributeLabels()
     {
         return [
             'client' => Yii::t('GifsModule.base', 'client')
         ];
     }

    public function loadSettings()
    {
        $this->client = Yii::$app->getModule('gifs')->settings->get('client');

        return true;
    }

    public function save()
    {
        Yii::$app->getModule('gifs')->settings->set('client', $this->client);
        return true;
    }

}
