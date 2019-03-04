<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'comparador-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'embarcacoes_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacoes_id', GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'embarcacoes_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'usuarios_id', GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'usuarios_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'dataregistro'); ?>
		<?php echo $form->textField($model, 'dataregistro'); ?>
		<?php echo $form->error($model,'dataregistro'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->