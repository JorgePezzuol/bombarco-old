					
<?php
	$form=$this->beginWidget('CActiveForm', array(
	        'id'=>'form-atualizar-dados',
	        //'enableAjaxValidation'=>true,
	        'action'=>$this->createUrl('usuarios/atualizarDadosPessoais', array('id'=>$model->id)),
	       // 'enableClientValidation'=>true,
	     
	));
?>

<div class="info-dados">					
	
	<div class="input-box-2-3">
		<span class="info-label">Nome Fantasia</span>
		<div class="info-input" >
			<?php echo $form->textField($model, 'nomefantasia', array("class"=> "input-text", 'maxlength' => 100)); ?>
		</div>
	</div>

	<div class="input-box-2-3">
		<span class="info-label">Razão Social</span>
		<div class="info-input" >
			<?php echo $form->textField($model, 'razaosocial', array("class"=> "input-text", 'maxlength' => 100)); ?>
		</div>
	</div>

	<div class="input-box-1-3">
		<span class="info-label">CNPJ</span>
		<div class="info-input" >
			<?php echo $form->textField($model, 'cnpj', array("class"=> "input-text", 'maxlength' => 100)); ?>
		</div>
	</div>

	<div class="input-box-1-3">
		<span class="info-label">CEP</span>
		<div class="info-input" >
			<?php echo $form->textField($model, 'cep', array("class"=> "input-text", 'maxlength' => 100)); ?>
		</div>
	</div>

	<div class="input-box-2-3">
		<span class="info-label">Endereço</span>
		<div class="info-input" >
			<?php echo $form->textField($model, 'endereco', array("class"=> "input-text", 'maxlength' => 100)); ?>
		</div>
	</div>

	<div class="input-box-1-3">
		<span class="info-label">Número</span>
		<div class="info-input" >
			<?php echo $form->textField($model, 'numero', array("class"=> "input-text", 'maxlength' => 100)); ?>
		</div>
	</div>

	<div class="input-box-2-3">
		<span class="info-label">Bairro</span>
		<div class="info-input" >
			<?php echo $form->textField($model, 'bairro', array("class"=> "input-text", 'maxlength' => 100)); ?>
		</div>
	</div>

	<div class="input-box-1-3">
		<span class="info-label">Complemento</span>
		<div class="info-input" >
			<?php echo $form->textField($model, 'complemento', array("class"=> "input-text", 'maxlength' => 100)); ?>
		</div>
	</div>

	<div class="input-box-1-3">
		<span class="info-label">Estado</span>
		<div class="input-text" >
			<?php 	echo $form->dropDownList($model,'estados_id', Estados::model()->findAll(), array('class'=>'info-input')); ?>
		</div>
	</div>

	<div class="input-box-1-3">
		<span class="info-label">Cidade</span>
		<div class="input-text" >
			<?php 

				if($model->cidades != null) {
					echo $form->dropDownList($model,'cidades_id', 

						GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true, 'estados_id=:estado', array(':estado'=>$model->estados->id))));
						
				}
				else {
					echo $form->dropDownList($model,'cidades_id',
						Cidades::model()->findAllAttributes(null, true), array('class'=>'info-input'));
				}
				
			?>
		</div>
	</div>

	<div class="input-box-1-3" >
		<span class="info-label">Telefone</span>
		<?php echo $form->textField($model, 'telefone', array("class"=> "info-input", 'mask' => '(99) 99999.9999' , 'maxlength' => 45)); ?>
	</div>
	
	<div class="input-box-1-3" >
		<span class="info-label">Celular</span>
		<?php echo $form->textField($model, 'celular', array("class"=> "info-input", 'maxlength' => 45, 'id'=>'celular')); ?>
	</div>
	
	<div class="input-box-1-3" >
		<span class="info-label">Nextel</span>
		<?php echo $form->textField($model, 'nextel', array("class"=> "info-input", 'maxlength' => 45)); ?>
	</div>
	<br class="clr">
	
	<div class="input-box-3-3" >
		<span class="info-label">Logotipo:</span><br/>
		<span class="info-label">Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Tamanho ideal 200px x 200px</span><br/>
					<?php 
						if($model->logo != "" && $model->logo != null) {
							$imagem = $model->logo;
						}
						else {
							$imagem = 'addfoto.png';
						}
						echo '<div class="upload-img-box">';
						echo '<div class="img-crop" id="logo-img">' . CHtml::image(Yii::app()->request->baseUrl.'/public/usuarios/'.$imagem,
		             "logo", array('id'=>'logoimagem', 'class'=>'img-upload img-turbinada img-preview')) . '</div>';
						echo CHtml::activeFileField($model, 'logo', array('style'=>'display: none;', 'name'=>'logo', 'id'=>'logo-file'));
						if ($imagem != "addfoto.png"){
							echo '<span id="remover-logo" class="remover bt-remover-img">Excluir</span>';
						}
						echo '</div>';
					?>
	</div>

</div>

<br class="clr">
	<a id="atualizar-dados-pessoais" class="bt-action" href="#">Salvar</a>
<br class="clr">

<?php $this->endWidget();?>

