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
		<?php echo $form->label($model, 'tid'); ?>
		<?php echo $form->textField($model, 'tid', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tid_externo'); ?>
		<?php echo $form->textField($model, 'tid_externo', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'valor'); ?>
		<?php echo $form->textField($model, 'valor', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'descricao'); ?>
		<?php echo $form->textField($model, 'descricao', array('maxlength' => 140)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'data_criacao'); ?>
		<?php echo $form->textField($model, 'data_criacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'data_confirmacao'); ?>
		<?php echo $form->textField($model, 'data_confirmacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'formapagamento'); ?>
		<?php echo $form->textField($model, 'formapagamento', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'detalhes'); ?>
		<?php echo $form->textArea($model, 'detalhes'); ?>
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
