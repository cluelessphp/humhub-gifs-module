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
    public $gifSetting;

    public function rules()
    {
        return [
            [['client', 'gifSetting'], 'safe'],
            [['client'], 'required'],
            [['client'], 'string', 'max' => 255],
			[['gifSetting'], 'required'],
			[['gifSetting'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
     public function attributeLabels()
     {
         return [
             'client' => Yii::t('GifsModule.base', 'client'),
             'gifSetting' => Yii::t('GifsModule.base', 'gifSetting')
         ];
     }

    public function loadSettings()
    {
        $this->client = Yii::$app->getModule('gifs')->settings->get('client');
        $this->gifSetting = Yii::$app->getModule('gifs')->settings->get('gifSetting');

        return true;
    }

    public function save()
    {
        Yii::$app->getModule('gifs')->settings->set('client', $this->client);
		Yii::$app->getModule('gifs')->settings->set('gifSetting', $this->gifSetting);
        return true;
    }

	
}
