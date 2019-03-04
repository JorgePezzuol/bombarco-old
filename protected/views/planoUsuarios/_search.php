<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'inicio'); ?>
		<?php echo $form->textField($model, 'inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fim'); ?>
		<?php echo $form->textField($model, 'fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'qntpermitida'); ?>
		<?php echo $form->textField($model, 'qntpermitida'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'valor'); ?>
		<?php echo $form->textField($model, 'valor', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'planos_id'); ?>
		<?php echo $form->dropDownList($model, 'planos_id', GxHtml::listDataEx(Planos::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'usuarios_id', GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
