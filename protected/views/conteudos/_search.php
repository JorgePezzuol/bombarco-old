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
		<?php echo $form->label($model, 'macro'); ?>
		<?php echo $form->textField($model, 'macro', array('maxlength' => 1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'texto'); ?>
		<?php echo $form->textArea($model, 'texto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'facebook'); ?>
		<?php echo $form->textField($model, 'facebook', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'video'); ?>
		<?php echo $form->textArea($model, 'video'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'conteudo_categorias_id'); ?>
		<?php echo $form->dropDownList($model, 'conteudo_categorias_id', GxHtml::listDataEx(ConteudoCategorias::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'usuarios_id', GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'embarcacoes_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacoes_id', GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
