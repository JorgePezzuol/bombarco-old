<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'embarcacao-seo-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 65)); ?>
		<?php echo $form->error($model,'title'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model, 'description', array('maxlength' => 150)); ?>
		<?php echo $form->error($model,'description'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'keywords'); ?>
		<?php echo $form->textField($model, 'keywords', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'keywords'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'follow'); ?>
		<?php echo $form->checkBox($model, 'follow'); ?>
		<?php echo $form->error($model,'follow'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'index'); ?>
		<?php echo $form->checkBox($model, 'index'); ?>
		<?php echo $form->error($model,'index'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'embarcacoes_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacoes_id', GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'embarcacoes_id'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->