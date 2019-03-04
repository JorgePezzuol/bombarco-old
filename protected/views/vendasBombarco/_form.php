<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'vendas-bombarco-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'embarcacoes_id'); ?>
		<?php echo $form->textField($model, 'embarcacoes_id'); ?>
		<?php echo $form->error($model,'embarcacoes_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'venda_pelo_bombarco'); ?>
		<?php echo $form->checkBox($model, 'venda_pelo_bombarco'); ?>
		<?php echo $form->error($model,'venda_pelo_bombarco'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textField($model, 'data'); ?>
		<?php echo $form->error($model,'data'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->