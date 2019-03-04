
										
<?php
	$form=$this->beginWidget('CActiveForm', array(
	        'id'=>'form-atualizar-dados',
	        //'enableAjaxValidation'=>true,
	        'action'=>$this->createUrl('usuarios/atualizarDadosPessoais', array('id'=>$model->id)),
	       // 'enableClientValidation'=>true,
	     
	));
?>		

<div class="info-dados">

	<div class="input-box-1-3" >
		<span class="info-label">Nome</span>
		<?php echo $form->textField($model, 'nome', array("class"=> "info-input", 'maxlength' => 100)); ?>
	</div>

	<div class="input-box-2-3" >
		<span class="info-label">Sobrenome</span>
		<?php echo $form->textField($model, 'sobrenome', array("class"=> "info-input", 'maxlength' => 100)); ?>
	</div>
	
	<div class="input-box-1-3" >
		<span class="info-label">CPF</span>
		<?php echo $form->textField($model, 'cpf', array("class"=> "info-input", 'maxlength' => 45)); ?>
	</div>
	
	<div class="input-box-1-3" >
		<span class="info-label">Data de Nascimento</span>
		<?php echo $form->textField($model, 'data_nascimento', array("class"=> "info-input", 'value'=>Usuarios::formatDateTimeToView($model->data_nascimento))); ?>
	</div>
	
	<div class="input-box-1-3" >
		<span class="info-label">CEP</span>
		<?php echo $form->textField($model, 'cep', array("class"=> "info-input", 'maxlength' => 45)); ?>
	</div>
	
	<div class="input-box-2-3" >
		<span class="info-label">Endereço</span>
		<?php echo $form->textField($model, 'endereco', array("class"=> "info-input", 'maxlength' => 150)); ?>
	</div>
	
	<div class="input-box-1-3" >
		<span class="info-label">Número</span>
		<?php echo $form->textField($model, 'numero', array("class"=> "info-input", 'maxlength' => 20)); ?>
	</div>
	
	<div class="input-box-2-3" >
		<span class="info-label">Bairro</span>
		<?php echo $form->textField($model, 'bairro', array("class"=> "info-input", 'maxlength' => 150)); ?>
	</div>
	
	<div class="input-box-1-3" >
		<span class="info-label">Complemento</span>
		<?php echo $form->textField($model, 'complemento', array("class"=> "info-input", 'maxlength' => 45)); ?>
	</div>
	
	<div class="input-box-1-3">
		<span class="info-label">Estado</span>

		<div class="input-text" >
			<select class="info-input" id="Usuarios_estados_id" name="Usuarios[estados_id]">
				<?php $estados = Estados::model()->findAll(); ?>
				<?php foreach($estados as $e): ?>
					<option value="<?php echo $e->id;?>"><?php echo $e->nome;?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="input-box-1-3">
		<span class="info-label">Cidade</span>

		<div class="input-text" >
			<?php 

				if($model->cidades != null) {
					echo $form->dropDownList($model,'cidades_id', 

						GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true, 'estados_id=:estado', array(':estado'=>$model->estados->id), array('class'=>'info-input'))));
						
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
						if ($imagem != "sem_foto_bb.jpg"){
							echo '<span id="remover-logo" class="remover bt-remover-img">Excluir</span>';
						}
						echo '</div>';
					?>
	</div>

</div>

<br class="clr">

	<a id="atualizar-dados-pessoais" class="bt-action" href="#">Salvar</a>

<br class="cr">



<?php $this->endWidget();?>

