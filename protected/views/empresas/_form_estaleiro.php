<?php 
 // script

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/create_estaleiro.js?233', CClientScript::POS_END);
array(
'enableClientValidation' => true,
);
?>
<div class="line-admin-cad-mod">
	<div class="line-admin-top">
		<div class="container">
			<p class="text2-admin-form">
				<?php echo Yii::t('app', 'Campos com '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'são obrigatórios'); ?>.
			</p>
			<div class="div-botao-cad-admin2">

				<?php echo $form->errorSummary($usuario); ?>
				

				<?php
					if(Yii::app()->user->hasFlash('sucesso')) {
						echo Yii::app()->user->getFlash('sucesso');
						echo CHtml::link('CADASTRAR EMBARCAÇÕES', array('anuncios/anunciarEmbarcacao?tipo_anuncio=estaleiro'), array('class'=>'botao-cad-admin'));

					}

					if(Yii::app()->user->hasFlash('erro')) {
						echo Yii::app()->user->getFlash('erro');
						
					}
				?>

				
			</div>	
		</div>
	</div>
	<div class="container">
		<div class="linha-admin-form">
			<div class="container">
				<div class="box-admin-form">
					<span class="text-admin-form"><b>E-mail do usuário*</b></span>
					<?php echo $form->textField($usuario, 'email', array('maxlength' => 100, 'class'=>'campo-admin-form required')); ?>
					<?php echo $form->error($usuario,'email'); ?>
					<div class="errorMessage"></div>
				</div>
							
				<div class="box-admin-form">
					<span class="text-admin-form"><b>Senha*</b></span>
					<?php echo $form->passwordField($usuario, 'senha', array('maxlength' => 100, 'value'=>'','class'=>'campo-admin-form required')); ?>
					<?php echo $form->error($usuario,'senha'); ?>
					<div class="errorMessage"></div>
				</div>	
				<div class="box-admin-form">
				</div>	
			</div>
		</div>					
		<div class="linha-admin-form">		
				<div class="box-admin-form">
					<span class="text-admin-form"><b>Plano do Estaleiro*</b></span>
						<div class="embarcacao_tipos_id">
							<?php echo $form->dropDownList($plano,'planos_id',Planos::listarPlanos('estaleiro'),array('empty'=>'Selecione', 'class'=>'select-anuncio-pad required')); ?>
							<div class="errorMessage"></div>
						</div>	
						<?php echo $form->error($plano,'planos_id'); ?>
				</div>
				<div class="box-admin-form">
				</div>
				<div class="box-admin-form">
				</div>	
		</div>		
		<div class="linha-admin-form">
			<div class="container">
				<div class="box-admin-form">
					<span class="text-admin-form"><b>E-mail do estaleiro*</b></span>
					<?php echo $form->textField($empresa, 'email', array('maxlength' => 45, 'class'=>'campo-admin-form required')); ?>
					<?php echo $form->error($empresa,'email'); ?>
					<div class="errorMessage"></div>
				</div><!-- row -->
				<div class="box-admin-form">
					<span class="text-admin-form"><b/>Razão*<b></span>
					<?php echo $form->textField($empresa, 'razao', array('maxlength' => 45, 'class'=>'campo-admin-form required')); ?>
					<?php echo $form->error($empresa,'razao'); ?>
					<div class="errorMessage"></div>
				</div><!-- row -->
				<div class="box-admin-form">
					<span class="text-admin-form">Link no Google Maps</span>
					<?php echo $form->textField($empresa, 'maps', array('maxlength' => 100, 'class'=>'campo-admin-form')); ?>
					<?php echo $form->error($empresa,'maps'); ?>
				</div><!-- row -->
			</div>
		</div>		
		<div class="linha-admin-form">
			<div class="container">
				<div class="box-admin-form">
				<span class="text-admin-form"><b>Categoria do Estaleiro*<b/></span>
				<div class="embarcacao_macros_id">	
					<?php echo $form->dropDownList($empresa, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('empty'=>'Selecione', 'class'=>'select-anuncio-pad required')); ?>
					<div class="errorMessage"></div>
				</div>
				<?php echo $form->error($empresa,'embarcacao_macros_id'); ?>
				</div><!-- row -->
				<div class="box-admin-form">
				<span class="text-admin-form"><b>Destaque*</b></span>
				<div class="embarcacao_macros_id">	
					<?php echo $form->dropDownList($empresa,'destaque', array(0=>'Sem destaque', 1=>'Com destaque'), array('empty'=>'Selecione', 'class'=>'select-anuncio-pad required'))?>
				</div>	
				<?php echo $form->error($empresa,'destaque'); ?>
				<div class="errorMessage"></div>
				</div>
				<div class="box-admin-form">
					<span class="text-admin-form">CNPJ</span>
					<?php echo $form->textField($empresa, 'cnpj', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
					<?php echo $form->error($empresa,'cnpj'); ?>
				</div><!-- row -->
			</div>	
		</div>	
		<div class="linha-admin-form">
			<div class="container">
				<div class="box-admin-form">
				<span class="text-admin-form">Telefone 1</span>
				<?php echo $form->textField($empresa, 'telefone', array('maxlength' => 20, 'class'=>'campo-admin-form')); ?>
				<?php echo $form->error($empresa,'telefone'); ?>
				</div><!-- row -->
				<div class="box-admin-form">
					<span class="text-admin-form">CEP</span>
				<?php echo $form->textField($empresa, 'cep', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
				<?php echo $form->error($empresa,'cep'); ?>
				</div><!-- row -->
				<div class="box-admin-form">
				<span class="text-admin-form">Endereço</span>
				<?php echo $form->textField($empresa, 'endereco', array('maxlength' => 100, 'class'=>'campo-admin-form')); ?>
				<?php echo $form->error($empresa,'endereco'); ?>
				</div><!-- row -->
			</div>
		</div>
		<div class="linha-admin-form">
			<div class="container">		
				
				<div class="box-admin-form">
				<span class="text-admin-form">Número</span>
				<?php echo $form->textField($empresa, 'numero', array('maxlength' => 100, 'class'=>'campo-admin-form')); ?>
				<?php echo $form->error($empresa,'numero'); ?>
				</div><!-- row -->
				<div class="box-admin-form">
				<span class="text-admin-form">Bairro</span>
				<?php echo $form->textField($empresa, 'bairro', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
				<?php echo $form->error($empresa,'bairro'); ?>
				</div><!-- row -->	

				<div class="box-admin-form">
				<span class="text-admin-form">FanPage</span>
				<?php echo $form->textField($empresa, 'fanpage', array('maxlength' => 100, 'class'=>'campo-admin-form')); ?>
				<?php echo $form->error($empresa,'fanpage'); ?>
				</div><!-- row -->
			</div>
		</div>
		<div class="linha-admin-form">
			<div class="container">		
				<div class="box-admin-form">
				<span class="text-admin-form">UF</span>
					<div class="embarcacao_macros_id">
						<?php Estados::getModelDropDown($form, $empresa,'Empresas_cidades_id'); ?>
						<div class="errorMessage"></div>
					</div>
				<?php echo $form->error($empresa,'uf'); ?>
				
				</div>
				<div class="box-admin-form">
				<span class="text-admin-form ">Cidade</span>
					<div class="embarcacao_macros_id">
						<?php echo $form->dropDownList($empresa,'cidades_id', array(''=>'Selecione'),array('class'=>'select-anuncio-pad required')); ?>
						<div class="errorMessage"></div>
					</div>

				<?php echo $form->error($empresa,'cidade'); ?>
				
				</div>
				
			</div>
		</div>
		<div class="linha-admin-form">
			<div class="container">		
				<div class="box-admin-form" style="height: 160px;">
					<span class="text-admin-form">Capa</span>
					<div id="div-preview-capa">
						<?php
							if($empresa->capa != '') {
								$src = Yii::app()->baseUrl . '/public/empresas/'.$empresa->capa;
								//echo CHtml::image($src, 'Logo fabricante', array('class'=>'img-pvw-admin', 'id'=>'img-preview-logo'));
								echo '<img id="img-preview-capa" src="'.$src.'" class="img-pvw-admin" />';
							}
							else {
								echo '<img id="img-preview-capa" class="img-pvw-admin" />';
							}
							echo $form->fileField($empresa, 'capa', array('id'=>'capa'));
						?>
					</div>
				</div><!-- row -->
				<div class="box-admin-form" style = "height: 160px;">
					<span class="text-admin-form">Logo</span>
					<div id="div-preview-logo">
						<?php
							if($empresa->logo != '') {
								$src = Yii::app()->baseUrl . '/public/empresas/'.$empresa->logo;
								//echo CHtml::image($src, 'Logo fabricante', array('class'=>'img-pvw-admin', 'id'=>'img-preview-logo'));
								echo '<img id="img-preview-logo" src="'.$src.'" class="img-pvw-admin" />';
							}
							else {
								echo '<img id="img-preview-logo" class="img-pvw-admin" />';
							}
							echo $form->fileField($empresa, 'logo', array('id'=>'logo'));
						?>
					</div>
				</div><!-- row -->	
			</div>	
		</div>	
		<div class="linha-admin-form">
			<div class="container">		
				<div class="box-admin-form4">
					<span class="text-admin-form">Descrição</span>
					<?php echo $form->textArea($empresa,'descricao', array('class'=>'campo-admin-form2')); ?>
					<?php echo $form->error($empresa,'descricao'); ?>
				</div>
			</div>
		</div>	
	</div>
</div>			


