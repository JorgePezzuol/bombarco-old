<?php

	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/usuarios_create.js', CClientScript::POS_END);

	$form = $this->beginWidget('GxActiveForm', array(
		'id' => 'usuarios-form'
	));
?>

<div class="header-search full-width header-result-categorie">
	<div class="container">
		<a href="javascript:history.back();" class="header-back sprite inline-block"></a>
		<article class="title-categorie inline-block">Cadastro</article>
		<br class="clear" />
	</div>
</div>

<div class="content-create">
	<div class="container">
		<?php if(Yii::app()->user->hasFlash('sucesso')):?>
			<?php echo '<br>'. Yii::app()->user->getFlash('sucesso');?>
		<?php endif; ?>
		<div class="box-dados-acesso">

			<p class="title-text">Dados de Acesso</p>
			
			<label class="label-create">E-mail</label>
			<?php 
				echo $form->emailField($model, 'email', array("class" => "input-text", 'maxlength' => 100));
				echo $form->error($model,'email');
				echo '<div class="errorMessage" id="error-email"></div>';
			?>

			<label class="label-create">Senha</label>
			<?php 
				echo $form->passwordField($model, 'senha', array("class" => "input-text", 'maxlength' => 100, 'value'=>''));
				echo $form->error($model,'senha'); 
				echo '<div class="errorMessage" id="error-senha"></div>'; 
			?>

		</div>

		<div class="box-dados-pessoais">

			<p class="title-text">Dados Pessoais</p>

			<input type="radio" data-tipo="fisica" class="tipo-pessoa checkbox-radio" name="Usuarios[pessoa]" value="F"/>
        			<span class="info-label-radio"><i class="label-icon-radio"></i>Pessoa Física</span>

					<input type="radio" data-tipo="juridica" class="tipo-pessoa checkbox-radio" name="Usuarios[pessoa]" value="J"/>
        	<span class="info-label-radio"><i class="label-icon-radio"></i>Pessoa Jurídica</span>


					<div class="errorMessage" id="error-pessoa"></div>

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
			
			<label class="label-create">Telefone Fixo</label>
			<?php 
				echo $form->textField($model, 'telefone', array("class"=> "input-text", 'maxlength' => 45));
				echo $form->error($model,'telefone');
				echo '<div class="errorMessage" id="error-telefone"></div>';
			?>

			<label class="label-create">Telefone Móvel</label>
			<?php 
				echo $form->textField($model, 'celular', array("class"=> "input-text",'mask' => '(99) 99999.9999', 'maxlength' => 45)); 
				echo $form->error($model,'celular');
				echo '<div class="errorMessage" id="error-celular"></div>';
			?>
		</div>
		<?php
						
			if(Yii::app()->controller->action->id == 'update') {
				echo GxHtml::submitButton(Yii::t('app', 'ATUALIZAR'), array('class' => 'botao-pricad', 'id' => 'btn-form-usuario'));
			}
			else {
				echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class' => 'input-submit', 'id' => 'btn-form-usuario', 'onclick' => '_gaq.push(["_trackEvent", "Login", "click", "Cadastrar"]);'));	
			}
			$this->endWidget();
		?>
	</div>
</div>
