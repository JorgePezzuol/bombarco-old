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
		<?php echo $form->label($model, 'embarcacao_macros_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'embarcacao_modelos_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_modelos_id', GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'slug'); ?>
		<?php echo $form->textField($model, 'slug', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ano'); ?>
		<?php echo $form->textField($model, 'ano'); ?>
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
		<?php echo $form->label($model, 'valor'); ?>
		<?php echo $form->textField($model, 'valor', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'estado'); ?>
		<?php echo $form->textField($model, 'estado', array('maxlength' => 1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'qntmotores'); ?>
		<?php echo $form->dropDownList($model, 'qntmotores', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'descricao'); ?>
		<?php echo $form->textArea($model, 'descricao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'views'); ?>
		<?php echo $form->textField($model, 'views', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'video'); ?>
		<?php echo $form->textArea($model, 'video'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'destaque'); ?>
		<?php echo $form->dropDownList($model, 'destaque', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'plano_usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'plano_usuarios_id', GxHtml::listDataEx(PlanoUsuarios::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
