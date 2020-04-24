<?php

use humhub\compat\CHtml;
use humhub\models\Setting;
use humhub\compat\CActiveForm;
use humhub\modules\gifs\controllers\AdminController;
?>
<div class="panel panel-default">
	<div class="panel-heading"><?=Yii::t('GifsModule.base', '<strong>Tenor</strong>'); ?></div>
	<div class="panel-body">
		<?php $form = CActiveForm::begin(['id' => 'gifs-settings-form']); ?>
			<?=$form->errorSummary($model); ?>
			<p class="help-block"><?=Yii::t('GifsModule.base', 'eg: "LKLSAW23FKQP"'); ?></p>
			
			<div class="form-group">
				<?=$form->labelEx($model, 'client'); ?>
				<?=$form->textField($model, 'client', ['class' => 'form-control', 'readonly' => Setting::IsFixed('client', 'gifs')]); ?>
			</div>
			
			<?= CHtml::submitButton(Yii::t('GifsModule.base', 'save'), ['class' => 'btn btn-primary']); ?>
			<?=\humhub\widgets\DataSaved::widget(); ?>
		<?php CActiveForm::end(); ?>
	</div>
</div>
