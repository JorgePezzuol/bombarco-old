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
		<?php echo $form->label($model, 'usuario_classificacoes_id'); ?>
		<?php echo $form->dropDownList($model, 'usuario_classificacoes_id', GxHtml::listDataEx(UsuarioClassificacoes::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'pessoa'); ?>
		<?php echo $form->textField($model, 'pessoa', array('maxlength' => 1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'nome'); ?>
		<?php echo $form->textField($model, 'nome', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'username'); ?>
		<?php echo $form->textField($model, 'username', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'senha'); ?>
		<?php echo $form->textField($model, 'senha', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'cpf'); ?>
		<?php echo $form->textField($model, 'cpf', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'telefone'); ?>
		<?php echo $form->textField($model, 'telefone', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'estados_id'); ?>
		<?php echo $form->dropDownList($model, 'estados_id', GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'cidades_id'); ?>
		<?php echo $form->dropDownList($model, 'cidades_id', GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'endereco'); ?>
		<?php echo $form->textArea($model, 'endereco'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'googleplus'); ?>
		<?php echo $form->textField($model, 'googleplus', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'facebook'); ?>
		<?php echo $form->textField($model, 'facebook', array('maxlength' => 45)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
