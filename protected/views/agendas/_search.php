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
		<?php echo $form->label($model, 'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'texto'); ?>
		<?php echo $form->textField($model, 'texto', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'local'); ?>
		<?php echo $form->textField($model, 'local', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'data_inicio'); ?>
		<?php echo $form->textField($model, 'data_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'data_fim'); ?>
		<?php echo $form->textField($model, 'data_fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'imagem'); ?>
		<?php echo $form->textField($model, 'imagem', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fanpage'); ?>
		<?php echo $form->textField($model, 'fanpage', array('maxlength' => 250)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
