
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
				<span class="title-pricad-4">
					Dados de Acesso
					<?php if(Yii::app()->user->hasFlash('sucesso')):?>
						<?php echo '<br>'. Yii::app()->user->getFlash('sucesso');?>
					<?php endif; ?>
				</span>
				<?php $form = $this->beginWidget('GxActiveForm', array(
					'id' => 'usuarios-form'
				));
				?>
				<div class="quadro-pricad-1">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">E-mail *</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php if(Yii::app()->controller->action->id == 'create'): ?>
							<?php echo $form->textField($model, 'email', array("class" => "text-form-pricad", 'maxlength' => 100)); ?>
						<?php else: ?>
							<?php echo $form->textField($model, 'email', array('disabled'=>true, "class" => "text-form-pricad", 'maxlength' => 100)); ?>
						<?php endif;?>
					</div>
						<?php echo $form->error($model,'email'); ?>
						<div class="errorMessage" id="error-email"></div>
				</div>
				
				<?php
					if(Yii::app()->controller->action->id == 'create') {
						echo '<div class="quadro-pricad-1">
							<div class="div-text-top-form-cadpri">
								<span class="text-top-form-cadpri">Senha *</span>
							</div>';
							echo '<div class="caixa-form-pricad" id="#">';
								echo $form->passwordField($model, 'senha', array("class" => "text-form-pricad", 'maxlength' => 100, 'value'=>''));
							echo '</div>';
								echo $form->error($model,'senha');
								echo '<div class="errorMessage" id="error-senha"></div>';
						echo '</div>';
					}
				?>
				
			</div>
		</div>
	</div>
	<div class="line-pricad-3">
		<div class="container">
			<div class="box-pricad-3">
				<span class="title-pricad-4">Dados Pessoais</span>
				<div class="quadro-pricad-1">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Nome *</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'nome', array("class"=> "text-form-pricad", 'maxlength' => 100)); ?>
					</div>
						<?php echo $form->error($model,'nome'); ?>
						<div class="errorMessage" id="error-nome"></div>
				</div>
				<div class="quadro-pricad-1">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Sobrenome</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'sobrenome', array("class"=> "text-form-pricad", 'maxlength' => 100)); ?>
					</div>
						<?php echo $form->error($model,'sobrenome'); ?>
						<div class="errorMessage" id="error-sobrenome"></div>
				</div>
				<div class="quadro-pricad-1">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">CPF *</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'cpf', array("class"=>"text-form-pricad",'maxlength' => 45)); ?>
					</div>
						<?php echo $form->error($model,'cpf'); ?>
						<div class="errorMessage" id="error-cpf"></div>
				</div>

				<?php if(Yii::app()->controller->action->id == 'create'):?>
				<div class="quadro-pricad-3">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Data de Nascimento</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'data_nascimento', array("class"=> "text-form-pricad")); ?>
					</div>
						<?php echo $form->error($model,'celular'); ?>
						<div class="errorMessage" id="error-celular"></div>
				</div>
				<?php endif;?>
				


				<div class="quadro-pricad-3">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Telefone Fixo</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'telefone', array("class"=> "text-form-pricad", 'maxlength' => 45)); ?>
					</div>
						<?php echo $form->error($model,'telefone'); ?>
						<div class="errorMessage" id="error-telefone"></div>
				</div>

			
	
				<div class="quadro-pricad-3">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Telefone Móvel *</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'celular', array("class"=> "text-form-pricad",'mask' => '(99) 99999.9999', 'maxlength' => 45)); ?>
					</div>
						<?php echo $form->error($model,'celular'); ?>
						<div class="errorMessage" id="error-celular"></div>
				</div>

				<?php if(Yii::app()->controller->action->id == 'update'):?>
				<div class="quadro-pricad-3" style="display:none;">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Data de Nascimento</span>
					</div>
					<div class="text-form-pricad" id="#">
						<?php echo Usuarios::formatDateTimeToView($model->data_nascimento); ?>
					</div>
						</div>
				<?php endif;?>

			

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
						
						if(Yii::app()->controller->action->id == 'update') {
							echo GxHtml::submitButton(Yii::t('app', 'ATUALIZAR'), array('class' => 'botao-pricad', 'id' => 'btn-form-usuario'));
						}
						else {
							echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class' => 'botao-pricad', 'id' => 'btn-form-usuario', 'onclick' => '_gaq.push(["_trackEvent", "Login", "click", "Cadastrar"]);'));	
						}
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