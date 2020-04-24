<?php

namespace humhub\modules\gifs\models\forms;

use Yii;

class SettingsForm extends \yii\base\Model
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

    public function attributeLabels()
    {
        return [
            'client' => Yii::t('GifsModule.base', 'client')
        ];
    }
}
