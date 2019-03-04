<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'embarcacao-acessorios-form',
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
		<?php echo $form->labelEx($model,'acessorios_id'); ?>
		<?php echo $form->dropDownList($model, 'acessorios_id', GxHtml::listDataEx(AcessorioModelos::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'acessorios_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'chave'); ?>
		<?php echo $form->textField($model, 'chave', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'chave'); ?>
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


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->