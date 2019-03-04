<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'embarcacao-metricas-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'titulo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model, 'valor', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'valor'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ultimo'); ?>
		<?php echo $form->textField($model, 'ultimo'); ?>
		<?php echo $form->error($model,'ultimo'); ?>
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