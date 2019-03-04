<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'motores-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'motor_modelos_id'); ?>
		<?php echo $form->dropDownList($model, 'motor_modelos_id', GxHtml::listDataEx(MotorModelos::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'motor_modelos_id'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'titulo'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($model,'horas'); ?>
		<?php echo $form->textField($model, 'horas'); ?>
		<?php echo $form->error($model,'horas'); ?>
		</div><!-- row -->
		
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('0'=>'Desativado', '1'=>'Ativado')); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->		

		<?php /* ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('embarcacoes')); ?></label>
		<?php echo $form->checkBoxList($model, 'embarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>
		<?php */ ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->