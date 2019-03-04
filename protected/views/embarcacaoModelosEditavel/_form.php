<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'embarcacao-modelos-editavel-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'embarcacao_macros_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'embarcacao_macros_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'embarcacao_fabricantes_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_fabricantes_id', GxHtml::listDataEx(EmbarcacaoFabricantes::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'embarcacao_fabricantes_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'embarcacao_tipos_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_tipos_id', GxHtml::listDataEx(EmbarcacaoTipos::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'embarcacao_tipos_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'embarcacao_modelos_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_modelos_id', GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'embarcacao_modelos_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'titulo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model, 'slug', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'slug'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'tamanho'); ?>
		<?php echo $form->textField($model, 'tamanho', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'tamanho'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'passageiros'); ?>
		<?php echo $form->textField($model, 'passageiros'); ?>
		<?php echo $form->error($model,'passageiros'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'acomodacoes'); ?>
		<?php echo $form->textField($model, 'acomodacoes'); ?>
		<?php echo $form->error($model,'acomodacoes'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'comprimento'); ?>
		<?php echo $form->textField($model, 'comprimento', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'comprimento'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'boca'); ?>
		<?php echo $form->textField($model, 'boca', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'boca'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'calado'); ?>
		<?php echo $form->textField($model, 'calado', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'calado'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'pedireito'); ?>
		<?php echo $form->textField($model, 'pedireito', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'pedireito'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'pesocasco'); ?>
		<?php echo $form->textField($model, 'pesocasco', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'pesocasco'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'tanquecombustivel'); ?>
		<?php echo $form->textField($model, 'tanquecombustivel', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'tanquecombustivel'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'tanqueagua'); ?>
		<?php echo $form->textField($model, 'tanqueagua', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'tanqueagua'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'consumo'); ?>
		<?php echo $form->textField($model, 'consumo', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'consumo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ncamarotes'); ?>
		<?php echo $form->textField($model, 'ncamarotes'); ?>
		<?php echo $form->error($model,'ncamarotes'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'nbanheiros'); ?>
		<?php echo $form->textField($model, 'nbanheiros'); ?>
		<?php echo $form->error($model,'nbanheiros'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'motordefabrica'); ?>
		<?php echo $form->textField($model, 'motordefabrica', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'motordefabrica'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->