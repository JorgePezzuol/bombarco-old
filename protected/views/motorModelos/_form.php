
<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'motor-modelos-form',
	'enableAjaxValidation' => false,
	'enableClientValidation'=>true,
));
?>

	<div class="line-admin-top">
		<div class="container">
			<p class="text2-admin-form">
				<?php echo Yii::t('app', 'Campos com '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'são obrigatórios'); ?>.
			</p>
		</div>
	</div>

	<!--<?php echo $form->errorSummary($model); ?>-->
<div class="line-admin-cad-mod">
	<div class="container">
		<div class="box-admin-form2">
			<div class="linha-admin-form">
				<div class="container">
					<div class="box-admin-form">
						<span class="text-admin-form"><b>Categoria da Embarcação *</b></span>
						<div class="embarcacao_macros_id">	
							<?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true))); ?>
						</div>
						<?php echo $form->error($model,'embarcacao_macros_id'); ?>
					</div><!-- row -->
					<div class="box-admin-form">
						<span class="text-admin-form"><b>Modelo *</b></span>
						<?php echo $form->textField($model, 'titulo', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'titulo'); ?>
					</div><!-- row -->
					<div class="box-admin-form">
						<span class="text-admin-form"><b>Potência HP</b></span>
						<?php echo $form->textField($model, 'potencia', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'potencia'); ?>
					</div><!-- row -->
				</div>
			</div>		
			<div class="linha-admin-form">
				<div class="container">
					<div class="box-admin-form">
						<span class="text-admin-form"><b>Fabricante *</b></span>
						<div class="embarcacao_fabricantes_id">
							<?php echo $form->dropDownList($model, 'motor_fabricantes_id', GxHtml::listDataEx(MotorFabricantes::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status'=>1)))); ?>
						</div>	
						<?php echo $form->error($model,'motor_fabricantes_id'); ?>
					</div><!-- row -->
					<div class="box-admin-form">
						<span class="text-admin-form"><b>Tipo do Motor *</b></span>
						<div class="embarcacao_fabricantes_id">
							<?php echo $form->dropDownList($model, 'motor_tipos_id', GxHtml::listDataEx(MotorTipos::model()->findAllAttributes(null, true))); ?>
						</div>	
						<?php echo $form->error($model,'motor_tipos_id'); ?>
					</div><!-- row -->
				</div>
			</div>		
			<div class="linha-admin-form">
				<div class="container">
					<?php
					echo GxHtml::submitButton(Yii::t('app', 'Cadastrar'), array('class'=>'botao-cad-admin'));
					$this->endWidget();
					?>
				</div>
			</div>		
</div><!-- form -->