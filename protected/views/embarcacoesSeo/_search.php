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
		<?php echo $form->label($model, 'embarcacao_modelos_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_modelos_id', GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'embarcacao_fabricantes_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_fabricantes_id', GxHtml::listDataEx(EmbarcacaoFabricantes::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 65)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description'); ?>
		<?php echo $form->textField($model, 'description', array('maxlength' => 150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'keywords'); ?>
		<?php echo $form->textField($model, 'keywords', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'follow'); ?>
		<?php echo $form->dropDownList($model, 'follow', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'index'); ?>
		<?php echo $form->dropDownList($model, 'index', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
