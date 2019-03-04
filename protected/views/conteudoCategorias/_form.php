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
						<span class="text-admin-form">Título da Categoria*</span>
						<?php echo $form->textField($model, 'titulo', array('maxlength' => 45,'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'titulo'); ?>
					</div><!-- row -->
				</div>
			</div>

			<div class="box-admin-form">
				<span class="text-admin-form">Tipo da Notícia</span>
				<div class="embarcacao_macros_id">				
					<?php echo $form->dropDownList($model, 'macro', array(''=>'Selecione','B'=>'Blog', 'N'=>'Notícias', 'A'=>'Agenda', 'P'=>'Primeiro Barco', 'T'=>'Raio X'), array('id'=>'macro_conteudo')); ?>
				</div>
					<?php echo $form->error($model,'macro'); ?>
				<div class="errorMessage" id="error-macro"></div>
			</div><!-- row -->

			<div class="linha-admin-form">
				<div class="box-admin-form">
					<?php
					echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class'=>'botao-cad-admin'));
					$this->endWidget();
					?>
				</div>
			</div>	

		</div>
	</div>
</div>					

</div><!-- form -->