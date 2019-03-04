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
		<?php echo $form->label($model, 'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'razao'); ?>
		<?php echo $form->textField($model, 'razao', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tipo'); ?>
		<?php echo $form->textField($model, 'tipo', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'logo'); ?>
		<?php echo $form->textField($model, 'logo', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'capa'); ?>
		<?php echo $form->textField($model, 'capa', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'maps'); ?>
		<?php echo $form->textField($model, 'maps', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'cnpj'); ?>
		<?php echo $form->textField($model, 'cnpj', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'telefone'); ?>
		<?php echo $form->textField($model, 'telefone', array('maxlength' => 20)); ?>
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
		<?php echo $form->label($model, 'cep'); ?>
		<?php echo $form->textField($model, 'cep', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'endereco'); ?>
		<?php echo $form->textField($model, 'endereco', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'numero'); ?>
		<?php echo $form->textField($model, 'numero'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'bairro'); ?>
		<?php echo $form->textField($model, 'bairro', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fanpage'); ?>
		<?php echo $form->textField($model, 'fanpage', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'empresa_categorias_id'); ?>
		<?php echo $form->dropDownList($model, 'empresa_categorias_id', GxHtml::listDataEx(EmpresaCategorias::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'usuarios_id', GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'macros_id'); ?>
		<?php echo $form->dropDownList($model, 'macros_id', GxHtml::listDataEx(Macros::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
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
