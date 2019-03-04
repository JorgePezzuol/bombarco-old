<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'acessorios-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'macro'); ?>
		<?php echo $form->textField($model, 'macro', array('maxlength' => 1)); ?>
		<?php echo $form->error($model,'macro'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'titulo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'acessorio_tipos_id'); ?>
		<?php echo $form->dropDownList($model, 'acessorio_tipos_id', GxHtml::listDataEx(AcessorioTipos::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'acessorio_tipos_id'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('embarcacaoAcessorioses')); ?></label>
		<?php echo $form->checkBoxList($model, 'embarcacaoAcessorioses', GxHtml::encodeEx(GxHtml::listDataEx(EmbarcacaoAcessorios::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->