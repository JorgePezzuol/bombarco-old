<div class="form">
	<?php $form = $this->beginWidget('GxActiveForm', array(
		'id' => 'embarcacao-modelos-form',
		//'enableAjaxValidation' => true,
		'enableClientValidation'=>true,
	
		));
	?>

	<div class="line-admin-top">
		<div class="container">
			<p class="text2-admin-form">
				<?php echo Yii::t('app', 'Campos com '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'são obrigatórios'); ?>.
			</p>
		</div>
	</div>
		<!--<div class="container"><?php echo $form->errorSummary($model); ?>-->		
	<div class="line-admin-cad-mod">
		<div class="container">
			<div class="box-admin-form2">
				<div class="linha-admin-form">
					<div class="container">

						<div class="box-admin-form">
							<span class="text-admin-form"><b>* Fabricante</b></span>
							<div class="embarcacao_fabricantes_id">				
								<?php echo $form->dropDownList($model, 'embarcacao_fabricantes_id', $fabricantes, array('class'=>'select-anuncio-pad', 'disabled'=>true,'empty'=>array(''=>'Selecione') ) ); ?>				
							</div>		
							<?php echo $form->error($model,'embarcacao_fabricantes_id'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
						<span class="text-admin-form"><b>* Tipo da Embarcação</b></span>
							<div class="embarcacao_tipos_id">				
								<?php echo $form->dropDownList($model, 'embarcacao_tipos_id', $tipos, array('class'=>'select-anuncio-pad', 'empty'=>array(''=>'Selecione'))); ?>				
							</div>
						<?php echo $form->error($model,'embarcacao_tipos_id'); ?>
						</div><!-- row -->
					</div>
				</div>
				<div class="linha-admin-form">
					<div class="container">
						<div class="box-admin-form">
						<span class="text-admin-form"><b>* Modelo</b></span>
						<?php echo $form->textField($model, 'titulo', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'titulo'); ?>
						<div class="errorMessage" id="titulo"></div>
						</div><!-- row -->

						<div class="box-admin-form" id="motor-jetski">
						<span class="text-admin-form">Motor</span>
						<?php echo $form->textField($model, 'motor_de_fabrica', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?> 
						<?php echo $form->error($model,'motor_de_fabrica'); ?>
						</div><!-- row -->

					</div>	
				</div>
				<div class="linha-admin-form">
					<div class="container">
						<?php /* ?>
							<label><?php echo GxHtml::encode($model->getRelationLabel('embarcacoes')); ?></label>
							<?php echo $form->checkBoxList($model, 'embarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>
							<label><?php echo GxHtml::encode($model->getRelationLabel('tabelaEmbarcacoes')); ?></label>
							<?php echo $form->checkBoxList($model, 'tabelaEmbarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(TabelaEmbarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>
							<?php */ 
							?>
						<?php
						echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class'=>'botao-cad-admin', 'id'=>'cadastrar-modelo'));
						$this->endWidget();
						?>
						<br/><br/>
					</div>	
				</div>	
			</div>	
		</div>	
	</div>	
</div><!-- form -->