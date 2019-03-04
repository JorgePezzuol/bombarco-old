<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'embarcacao_macros_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'embarcacao_fabricantes_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_fabricantes_id', GxHtml::listDataEx(EmbarcacaoFabricantes::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'embarcacao_tipos_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_tipos_id', GxHtml::listDataEx(EmbarcacaoTipos::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'embarcacao_modelos_id'); ?>
		<?php echo $form->dropDownList($model, 'embarcacao_modelos_id', GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'titulo'); ?>
		<?php echo $form->textField($model, 'titulo', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'slug'); ?>
		<?php echo $form->textField($model, 'slug', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tamanho'); ?>
		<?php echo $form->textField($model, 'tamanho', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'passageiros'); ?>
		<?php echo $form->textField($model, 'passageiros'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'acomodacoes'); ?>
		<?php echo $form->textField($model, 'acomodacoes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'comprimento'); ?>
		<?php echo $form->textField($model, 'comprimento', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'boca'); ?>
		<?php echo $form->textField($model, 'boca', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'calado'); ?>
		<?php echo $form->textField($model, 'calado', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'pedireito'); ?>
		<?php echo $form->textField($model, 'pedireito', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'pesocasco'); ?>
		<?php echo $form->textField($model, 'pesocasco', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tanquecombustivel'); ?>
		<?php echo $form->textField($model, 'tanquecombustivel', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tanqueagua'); ?>
		<?php echo $form->textField($model, 'tanqueagua', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'consumo'); ?>
		<?php echo $form->textField($model, 'consumo', array('maxlength' => 10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ncamarotes'); ?>
		<?php echo $form->textField($model, 'ncamarotes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'nbanheiros'); ?>
		<?php echo $form->textField($model, 'nbanheiros'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'motordefabrica'); ?>
		<?php echo $form->textField($model, 'motordefabrica', array('maxlength' => 45)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
