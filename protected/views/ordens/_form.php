<?php
/* @var $this OrdensController */
/* @var $model Ordens */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ordens-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'transacoes_id'); ?>
		<?php echo $form->textField($model,'transacoes_id'); ?>
		<?php echo $form->error($model,'transacoes_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuarios_id'); ?>
		<?php echo $form->textField($model,'usuarios_id'); ?>
		<?php echo $form->error($model,'usuarios_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ordem_tipos_id'); ?>
		<?php echo $form->textField($model,'ordem_tipos_id'); ?>
		<?php echo $form->error($model,'ordem_tipos_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_item'); ?>
		<?php echo $form->textField($model,'id_item'); ?>
		<?php echo $form->error($model,'id_item'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_criacao'); ?>
		<?php echo $form->textField($model,'data_criacao'); ?>
		<?php echo $form->error($model,'data_criacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_ativacao'); ?>
		<?php echo $form->textField($model,'data_ativacao'); ?>
		<?php echo $form->error($model,'data_ativacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textField($model,'descricao',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->