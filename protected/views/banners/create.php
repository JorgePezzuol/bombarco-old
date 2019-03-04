<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_banners.js', CClientScript::POS_END); ?>

<div class="container">

		<?php $form = $this->beginWidget('GxActiveForm', array(
			'id' => 'banners-form',
			'enableAjaxValidation' => true,
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
			'enableClientValidation'=>true,
			'clientOptions' => array('validateOnSubmit'=>true),
		));
		?>

		<div class="form-group row">
		  <?php echo CHtml::link('< Voltar a Lista', array('banners/admin'), array('class'=>'botao-cad-admin')); ?>
		  <h1>Cadastrar Banner</h1>

			
			<?php if($flg_cadastro): ?>
		    <div class="alert alert-success">
			  	<strong>Sucesso!</strong> O banner foi cadastrado.
			</div>
		  <?php endif; ?>
		  
		  <div class="col-10" style="color:red;">
		  		<div class="errorMessage" id="error-macro"></div>
		  		<div class="errorMessage" id="error-fim"></div>
		  		<div class="errorMessage" id="error-inicio"></div>
		  		<div class="errorMessage2" id="error-imagem"></div>
		  		<div class="errorMessage2" id="error-imagem-topo"></div>
		  		<div class="errorMessage2" id="error-titulo"></div>
		  		<div class="errorMessage2" id="error-link"></div>
		  </div>

		  <br/>
	
		  <div class="col-10">
		    <label for="embarcacao_macros_id">Categoria do Banner*</label>
		    <?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('empty'=>'Selecione','class'=>'select-anuncio-pad form-control')); ?>
		  </div>

		  <br/>

			  <div class="col-10">
			    <label>Posição*</label>
			    <?php echo $form->dropDownList($model, 'local', array(''=> 'Selecione',
							Banners::TOPO => 'topo',
							Banners::HORIZONTAL  => 'horizontal',
							Banners::LATERAL  => 'lateral',
							),array('class'=>'select-anuncio-pad form-control')); ?>
			  </div>

			  <br/>

			 <div class="col-10">
			    <label>Nome <small>(ex: banner da volvo)</small>*</label>
			    <?php echo $form->textField($model, 'titulo', array('class'=>'form-control', 'id'=>'titulo')); ?>
			  </div>

			 <br/>

			 <div class="col-10">
			    <label>Link*</label>
			    <?php echo $form->textField($model, 'link', array('class'=>'form-control', 'id'=>'link')); ?>
			  </div>
		</div>

		<div class="form-group row">
			<label for="banners_fim">Data do início*</label>
				<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						    'name'=>'Banners[inicio]',
						    'options'=>array(
						    	'dateFormat'=>'dd/mm/yy',
						    	'timeFormat'=>'hh:mm:ss'
						    ),
						    'language'=> 'pt-BR',
						    'htmlOptions'=>array(
						        'style'=>'',
						        'class'=>'campo-admin-form form-control',
						    ),

						));
					?>
				
		</div>


		<div class="form-group row">
			<label for="banners_fim">Data do fim*</label>
				<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						    'name'=>'Banners[fim]',

						    'options'=>array(
						    	'dateFormat'=>'dd/mm/yy',
						    	'timeFormat'=>'hh:mm:ss'
						    ),
						    'language'=> 'pt-BR',
						    'htmlOptions'=>array(
						        'style'=>'',
						        'class'=>'campo-admin-form form-control'
						    ),

						));
					?>
				
		</div>


		<br/>

		<div class="form-group row" id="div-imagem">

			<span class="text-admin-form"><b>Imagem Fechada*</b></span>
			<div id="div-preview-logo">

				<?php

					echo $form->fileField($model, 'imagem', array('id' => 'file-imagem'),array('class'=>'btn-file'));
					//echo'<a href="#" class="btn-file2">Adicionar</a>';
					if($model->imagem != '') {

						$src = Yii::app()->baseUrl . '/public/banners/'.$model->imagem;

						echo '<br/>';

						echo '<img id="img-preview-imagem" src="'.$src.'" class="img-pvw-admin img-banners img-banners" />';
					}
					else {

						echo '<br/>';
						echo '<img id="img-preview-imagem" class="img-pvw-admin img-banners" />';
					}

				?>
			</div>
			<div class="errorMessage2" id="error-imagem"></div>
		</div>

		<div class="form-group row" id="div-imagem-topo">
			<span class="text-admin-form"><b>Imagem Aberta*</b></span>
				<div id="div-preview-logo">

					<?php

						echo $form->fileField($model, 'imagem_topo', array('id' => 'file-imagem-topo'));
						//echo'<a href="#" class="btn-file2">Adicionar</a>';
						if($model->imagem_topo != '') {

							$src = Yii::app()->baseUrl . '/public/banners/'.$model->imagem_topo;

							echo '<br/>';

							echo '<img id="img-preview-imagem-topo" src="'.$src.'" class="img-pvw-admin img-banners" />';
						}
						else {

							echo '<br/>';

							echo '<img id="img-preview-imagem-topo" class="img-pvw-admin img-banners" />';
						}

					?>

				</div>
				<div class="errorMessage2" id="error-imagem-topo"></div>
		</div>

		<div class="row text-center"> 
			<?php
				echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class'=>'botao-cad-admin btn btn-primary', 'id'=>'btn-form-banner'));
			?>
		</div>

		<br/><br/>

		<div class="row" style="font-weight: bolder;">
			<div class="box-admin-form6">
				<div class="texts-info-banners">
					<span class="text-images2">*Os banners devem conter os seguintes tamanhos:</span>
					<span class="text-images2">Topo fechado: 1190 x 70;</span>
					<span class="text-images2">Topo aberto: 1190 x 460;</span>
					<span class="text-images2">Lateral: 200 x 446;</span>
					<span class="text-images2">Horizontal: 728 x 90.</span>
				</div>
			</div>
		</div>

		<?php
			$this->endWidget();
		?>
</div>