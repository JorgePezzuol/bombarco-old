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
		  <h1>Atualizar Banner</h1>

		
		  
		  <div class="col-10">
		  		<div class="errorMessage" id="error-macro"></div>
		  		<div class="errorMessage" id="error-fim"></div>
		  		<div class="errorMessage2" id="error-imagem"></div>
		  		<div class="errorMessage2" id="error-imagem-topo"></div>
		  </div>
	
		  <div class="col-10">
		    <label for="embarcacao_macros_id">Categoria do Banner*</label>
		    <?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('empty'=>'Selecione','class'=>'select-anuncio-pad form-control')); ?>
		  </div>
		</div>

		<div class="col-10">
		    <label>Posição*</label>
		    <?php echo $form->dropDownList($model, 'local', array(''=> 'Selecione',
						Banners::TOPO => 'topo',
						Banners::HORIZONTAL  => 'horizontal',
						Banners::LATERAL  => 'lateral',
						),array('class'=>'select-anuncio-pad')); ?>
		  </div>
		</div>

		<div class="form-group row">
			<label for="banners_fim">Data do fim* <small style="font-weight: normal;"> (Fim previsto: <?php echo $model->formatDateTimeToView($model->fim);?>)</small></label>
				<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					    'name'=>'Banners[fim]',
					    'id'=>'banners_fim',
					    'value'=>$model->formatDateTimeToView($model->fim),
					    'options'=>array(
					    	'dateFormat'=>'dd/mm/yy',
					    	'timeFormat'=>'hh:mm:ss'
					    ),
					    'language'=> 'pt-BR',
					    'htmlOptions'=>array(
					        'style'=>'',
					        'class'=>'form-control'
					    ),

					));
				?>
				
		</div>

		<br/>

		<div class="form-group row">
			<label>Imagem fechada <?php echo "<a href='".Yii::app()->baseUrl . '/' . Banners::PATH . '/' . $model->imagem."' target='_blank' style='font-size:12px;'>(Ver imagem atual)</a>";?></label>
			<?php
				echo $form->fileField($model, 'imagem', array('id' => 'file-imagem'),array('class'=>'btn-file'));			
			?>
		</div>

		<br/>

		<div class="form-group row">
			<?php if($model->local == 1): ?>

				<label>Imagem aberta <?php echo "<a href='".Yii::app()->baseUrl . '/' . Banners::PATH . '/' . $model->imagem_topo."' target='_blank' style='font-size:12px;'>(Ver imagem atual)</a>";?></label>
				<?php
					echo $form->fileField($model, 'imagem_topo', array('id' => 'file-imagem-topo'));			
				?>

			<?php endif; ?>
		</div>

		<div class="row text-center"> 
			<?php
				echo GxHtml::submitButton(Yii::t('app', 'ATUALIZAR'), array('class'=>'btn btn-primary', 'id'=>'btn-form-alterar-banner'));
			?>
		</div>

		<br/><br/><br/>

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