<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'log-buscas-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'busca'); ?>
		<?php echo $form->textField($model, 'busca', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'busca'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textField($model, 'data'); ?>
		<?php echo $form->error($model,'data'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'usuario'); ?>
		<?php echo $form->textField($model, 'usuario'); ?>
		<?php echo $form->error($model,'usuario'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model, 'ip', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'ip'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->