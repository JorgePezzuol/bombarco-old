<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'maillings-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textField($model, 'data'); ?>
		<?php echo $form->error($model,'data'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'useragent'); ?>
		<?php echo $form->textArea($model, 'useragent'); ?>
		<?php echo $form->error($model,'useragent'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->