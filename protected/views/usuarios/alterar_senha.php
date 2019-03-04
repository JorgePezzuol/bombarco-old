
<section class="content">
	<div class="line-pricad-1">
		<div class="container">
			<div class="box-pricad-1">
				<span class="title-pricad-2">Home > Anunciar > Cadastro</span>
				<span class="title-pricad-1">Cadastro</span>
				<span class="title-pricad-3">Preencha os campos abaixo para criar sua conta</span>
			</div>	
		</div>	
	</div>
	<div class="line-pricad-2">
		<div class="container">
			<div class="box-pricad-2">
				<span class="title-pricad-4">Dados de Acesso</span>
				<?php $form = $this->beginWidget('GxActiveForm', array(
					'id' => 'usuarios-form'
				));

				?>

				<div class="quadro-pricad-1">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">*Nova Senha</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->passwordField($model, 'senha', array("class" => "text-form-pricad", 'maxlength' => 100, 'value'=>'')); ?>
					</div>
						<?php echo $form->error($model,'senha'); ?>
				</div>
				<div class="quadro-pricad-1">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">*Confirmar Senha</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo CHtml::passwordField('Usuarios[confirmaSenha]', '', array('class'=>'text-form-pricad')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="line-pricad-4">
		<div class="container">
			<div class="box-pricad-4">
				<div class="quadro-pricad-2">
				</div>
				<div class="quadro-pricad-2">
					<?php
						
						echo GxHtml::submitButton(Yii::t('app', 'ATUALIZAR'), array('class' => 'botao-pricad'));

						$this->endWidget();
					?>
			
				</div>
				<div class="quadro-pricad-2">
				</div>
			</div>
		</div>
	</div>
	<div class="line-pricad-5">
		<div class="container">
			<div class="box-pricad-5">
			</div>
		</div>
	</div>	
</section>		