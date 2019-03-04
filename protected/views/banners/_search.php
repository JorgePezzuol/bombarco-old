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
		<?php echo $form->label($model, 'usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'usuarios_id', GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'imagem'); ?>
		<?php echo $form->textField($model, 'imagem', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'imagem_topo'); ?>
		<?php echo $form->textField($model, 'imagem_topo', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fomato'); ?>
		<?php echo $form->textField($model, 'fomato', array('maxlength' => 4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'local'); ?>
		<?php echo $form->dropDownList($model, 'local', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'orientacao'); ?>
		<?php echo $form->dropDownList($model, 'orientacao', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'views'); ?>
		<?php echo $form->textField($model, 'views', array('maxlength' => 20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'cliques'); ?>
		<?php echo $form->textField($model, 'cliques', array('maxlength' => 20)); ?>
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
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
