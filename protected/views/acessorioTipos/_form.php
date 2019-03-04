<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'acessorio-tipos-form',
	'enableAjaxValidation' => true,
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
						<span class="text-admin-form">Categoria da Embarcação*</span>
							<div class="embarcacao_macros_id">					
								<?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('empty'=>'Selecione', 'class'=>'select-anuncio-pad', 'id'=>'embmacro')); ?>				
							</div>
							<?php echo $form->error($model,'embarcacao_macros_id'); ?>
					</div>		

					<div class="box-admin-form">
						<span class="text-admin-form">Tipo do Acessorio*</span>
						<?php echo $form->textField($model, 'titulo', array('maxlength' => 45,'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'titulo'); ?>
					</div><!-- row -->
				</div>
			</div>
			<div class="linha-admin-form">
				<div class="box-admin-form">
					<?php
					echo GxHtml::submitButton(Yii::t('app', 'Cadastrar'), array('class'=>'botao-cad-admin'));
					$this->endWidget();
					?>
				</div>
			</div>	
		</div>
	</div>
</div>					

</div><!-- form -->