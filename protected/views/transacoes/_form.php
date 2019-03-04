<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'transacoes-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'tid'); ?>
		<?php echo $form->textField($model, 'tid', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'tid'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'tid_externo'); ?>
		<?php echo $form->textField($model, 'tid_externo', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'tid_externo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model, 'valor', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'valor'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textField($model, 'descricao', array('maxlength' => 140)); ?>
		<?php echo $form->error($model,'descricao'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'data_criacao'); ?>
		<?php echo $form->textField($model, 'data_criacao'); ?>
		<?php echo $form->error($model,'data_criacao'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'data_confirmacao'); ?>
		<?php echo $form->textField($model, 'data_confirmacao'); ?>
		<?php echo $form->error($model,'data_confirmacao'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'formapagamento'); ?>
		<?php echo $form->textField($model, 'formapagamento', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'formapagamento'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'detalhes'); ?>
		<?php echo $form->textArea($model, 'detalhes'); ?>
		<?php echo $form->error($model,'detalhes'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'usuarios_id', GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'usuarios_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'plano_usuarios_id'); ?>
		<?php echo $form->dropDownList($model, 'plano_usuarios_id', GxHtml::listDataEx(PlanoUsuarios::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'plano_usuarios_id'); ?>
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