<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'tags-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'titulo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model, 'slug', array('maxlength' => 150)); ?>
		<?php echo $form->error($model,'slug'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('agendases')); ?></label>
		<?php echo $form->checkBoxList($model, 'agendases', GxHtml::encodeEx(GxHtml::listDataEx(Agendas::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('conteudoses')); ?></label>
		<?php echo $form->checkBoxList($model, 'conteudoses', GxHtml::encodeEx(GxHtml::listDataEx(Conteudos::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('embarcacoes')); ?></label>
		<?php echo $form->checkBoxList($model, 'embarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->