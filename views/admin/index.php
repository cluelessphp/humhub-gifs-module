<?php

use yii\helpers\Html;
use humhub\models\Setting;
use yii\bootstrap\ActiveForm;

?>

<div class="panel panel-default">
	<div class="panel-heading"><?= \Yii::t('GifsModule.base', '<strong>Tenor</strong>'); ?></div>
	<div class="panel-body">
		<?php $form = ActiveForm::begin(['id' => 'gifs-settings-form']); ?>

			<div class="form-group">
				<?= $form->field($model, 'client'); ?>
			</div>
			<p class="help-block"><?= \Yii::t('GifsModule.base', 'eg: "LKLSAW23FKQP"'); ?></p>
			<?= Html::submitButton(\Yii::t('GifsModule.base', 'save'), ['class' => 'btn btn-primary']); ?>
		<?php ActiveForm::end(); ?>
	</div>
</div>
