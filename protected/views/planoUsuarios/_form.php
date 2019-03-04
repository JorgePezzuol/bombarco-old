<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'plano-usuarios-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'inicio'); ?>
		<?php echo $form->textField($model, 'inicio'); ?>
		<?php echo $form->error($model,'inicio'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'fim'); ?>
		<?php echo $form->textField($model, 'fim'); ?>
		<?php echo $form->error($model,'fim'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'qntpermitida'); ?>
		<?php echo $form->textField($model, 'qntpermitida'); ?>
		<?php echo $form->error($model,'qntpermitida'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model, 'valor', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'valor'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'planos_id'); ?>
		<?php echo $form->dropDownList($model, 'planos_id', GxHtml::listDataEx(Planos::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'planos_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'usuarios_id', GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'usuarios_id'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('embarcacoes')); ?></label>
		<?php echo $form->checkBoxList($model, 'embarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->