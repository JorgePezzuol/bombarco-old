<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'contatos-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model, 'nome', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'nome'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'mensagem'); ?>
		<?php echo $form->textField($model, 'mensagem', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'mensagem'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textField($model, 'data'); ?>
		<?php echo $form->error($model,'data'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'usuarios_id', GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'usuarios_id'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->