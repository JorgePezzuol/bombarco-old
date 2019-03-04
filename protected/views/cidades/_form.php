<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'cidades-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model, 'nome', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'nome'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'estados_id'); ?>
		<?php echo $form->dropDownList($model, 'estados_id', GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'estados_id'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('bairroses')); ?></label>
		<?php echo $form->checkBoxList($model, 'bairroses', GxHtml::encodeEx(GxHtml::listDataEx(Bairros::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->