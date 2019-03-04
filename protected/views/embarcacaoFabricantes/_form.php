<?php
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_embarcacoes_fabricantes.js', CClientScript::POS_END);
?>

<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'embarcacao-fabricantes-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
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

	<?php if(Yii::app()->user->hasFlash('successo')):?>
    <div class="info" style="margin-left:210px;">
        <?php echo Yii::app()->user->getFlash('successo'); ?>
    </div>
<?php endif; ?>

	<div class="line-admin-cad-mod">
		<div class="container">
			<div class="box-admin-form2">
				<div class="linha-admin-form">
					<div class="container">

						<div class="box-admin-form">
						<span class="text-admin-form">* Titulo</span>
						<?php echo $form->textField($model, 'titulo', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'titulo'); ?>
						<div class="errorMessage" id="titulo"></div>
						</div><!-- row -->

						<div class="box-admin-form">
							<span class="text-admin-form">* Categoria</span>
							<div class="embarcacao_macros_id">	
								<?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('id'=>'macro', 'class'=>'select-anuncio-pad')); ?>
							</div>	
							<?php echo $form->error($model,'macros_id'); ?>
						</div><!-- row -->
					</div>
				</div>		

					<div class="linha-admin-form2">
						<div class="container">

							<div class="box-admin-form3">
								<?php echo $form->fileField($model, 'logo', array('id' => 'file-logo')); ?>
								<?php echo $form->error($model,'error'); ?>
							</div>

							<div class="box-admin-form4" style="display:none;">
								<div id="div-preview-logo">
									<?php
										if($model->logo != '') {
											$src = Yii::app()->baseUrl . '/public/fabricantes/'.$model->logo;
											//echo CHtml::image($src, 'Logo fabricante', array('class'=>'img-pvw-admin', 'id'=>'img-preview-logo'));
											echo '<img id="img-preview-logo" src="'.$src.'" class="img-pvw-admin" />';
										}
										else {
											echo '<img id="img-preview-logo" class="img-pvw-admin" />';
										}
									?>
								</div>
							</div>	
						</div>
					</div>	
	
					<div class="linha-admin-form">
						<div class="container">	

						<?php

							if($buttons == 'create') {
								echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class'=>'botao-cad-admin'));
							}
							else {
								echo GxHtml::submitButton(Yii::t('app', 'ALTERAR'), array('class'=>'botao-cad-admin'));
							}

							
							$this->endWidget();
							?>

					</div>	
					<br/><br/>
				</div>
			</div>		
		</div>
	</div>	
			
		


</div><!-- form -->