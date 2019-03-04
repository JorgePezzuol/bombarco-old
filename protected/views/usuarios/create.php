<?php
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/usuarios_create.js?e='.microtime(), CClientScript::POS_END);
?>
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
					<div class="caixa-form-pricad" id="div-email">
						<?php if(Yii::app()->controller->action->id == 'create'): ?>
							<input type="email" required class="required text-form-pricad" maxlength="100" id="Usuarios_email" name="Usuarios[email]"/>
						<?php else: ?>
							<input disabled type="email" class="text-form-pricad" maxlength="100" id="Usuarios_email" name="Usuarios[email]"/>
						<?php endif;?>
					</div>
					<?php echo $form->error($model,'email'); ?>
					<div class="errorMessage" id="error-email"></div>
				</div>
				
				<?php if(Yii::app()->controller->action->id == 'create'): ?>
					<div class="quadro-pricad-1">
						<div class="div-text-top-form-cadpri">
							<span class="text-top-form-cadpri">Senha *</span>
						</div>
						<div class="caixa-form-pricad" id="#">
							<input type="password" id="Usuarios_senha" name="Usuarios[senha]" class="required text-form-pricad" maxlength="100"/> 
						</div>
					</div>
				<?php endif; ?>

				
			</div>	
		</div>
	</div>
	<div class="line-pricad-3">
		<div class="container">
			<div class="box-pricad-3">
				<span class="title-pricad-4">Dados Pessoais</span>

				<br><br><br>
				<div class="radio-box-cadastra">
				<?php if(Yii::app()->controller->action->id == 'create'):?>

					<input type="radio" data-tipo="fisica" class="tipo-pessoa checkbox-radio" name="Usuarios[pessoa]" value="F"/>
        	<span class="info-label-radio"><i class="label-icon-radio"></i>Pessoa Física</span>

					<input type="radio" data-tipo="juridica" class="tipo-pessoa checkbox-radio" name="Usuarios[pessoa]" value="J"/>
        	<span class="info-label-radio"><i class="label-icon-radio"></i>Pessoa Jurídica</span>


					<div class="errorMessage" id="error-pessoa"></div>
				<?php endif;?>
				</div>


				<?php if(Yii::app()->controller->action->id == 'create'):?>
				<br class="clr">
				<div id="campos-pf">
					<?php
						$this->renderPartial('_campos_pf', array('form'=>$form, 'model'=>$model));
					?>
				</div>

				<div id="campos-pj" style="display:none;">
					<?php
						$this->renderPartial('_campos_pj', array('form'=>$form, 'model'=>$model));
					?>
				</div>
				<?php else:?>
					<?php
						if($model->pessoa == 'F') {
							$this->renderPartial('_campos_pf', array('form'=>$form, 'model'=>$model));
						}
						else {
							$this->renderPartial('_campos_pj', array('form'=>$form, 'model'=>$model));
						}
					?>
				<?php endif;?>


				<div class="quadro-pricad-3">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Telefone Móvel (1)*</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'celular', array("class"=> "required text-form-pricad",'mask' => '(99) 99999.9999', 'maxlength' => 45)); ?>
					</div>
						<?php echo $form->error($model,'celular'); ?>
						<div class="errorMessage" id="error-celular"></div>
				</div>

				<div class="quadro-pricad-3">
					<div class="div-text-top-form-cadpri" style="width: auto;">
						<span class="text-top-form-cadpri">Telefone Móvel (2)</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'celular2', array("class"=> "text-form-pricad",'mask' => '(99) 99999.9999', 'maxlength' => 45)); ?>
					</div>
						<?php echo $form->error($model,'celular2'); ?>
						<div class="errorMessage" id="error-celular"></div>
				</div>

				<div class="quadro-pricad-3">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Telefone Fixo (1)*</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'telefone', array("class"=> "required text-form-pricad", 'maxlength' => 45)); ?>
					</div>
						<?php echo $form->error($model,'telefone'); ?>
						<div class="errorMessage" id="error-telefone"></div>
				</div>

				<div class="quadro-pricad-3">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Telefone Fixo (2)</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'telefone2', array("class"=> "text-form-pricad", 'maxlength' => 45)); ?>
					</div>
						<?php echo $form->error($model,'telefone2'); ?>
						<div class="errorMessage" id="error-telefone"></div>
				</div>


				<div class="quadro-pricad-3">
					<div class="div-text-top-form-cadpri">
						<span class="text-top-form-cadpri">Nextel</span>
					</div>
					<div class="caixa-form-pricad" id="#">
						<?php echo $form->textField($model, 'nextel', array("class"=> "text-form-pricad", 'maxlength' => 45)); ?>
					</div>
						<?php echo $form->error($model,'nextel'); ?>
						<div class="errorMessage" id="error-nextel"></div>
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
						
						if(Yii::app()->controller->action->id == 'update') {
							echo GxHtml::submitButton(Yii::t('app', 'ATUALIZAR'), array('class' => 'botao-pricad', 'id' => 'btn-form-usuario'));
						}
						else {
							/*echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class' => 'botao-pricad', 'id' => 'btn-form-usuario', 'onclick' => '_gaq.push(["_trackEvent", "usuarios-create", "click", "Cadastrar"]);'));	*/
							echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class' => 'botao-pricad', 'id' => 'btn-form-usuario'));
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