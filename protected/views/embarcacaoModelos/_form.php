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
		<!--<div class="container"><?php //echo $form->errorSummary($model); ?>-->		
	<div class="line-admin-cad-mod">
		<div class="container">
			<div class="box-admin-form2">
				<div class="linha-admin-form">
					<div class="container">
						<div class="box-admin-form">
							<span class="text-admin-form"><b>* Categoria da Embarcação</b></span>
							<div class="embarcacao_macros_id">				
								<?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAll('id != 0')), array('class'=>'select-anuncio-pad', 'empty'=>array('-1'=>'Selecione'))); ?>				
							</div>
							<?php echo $form->error($model,'embarcacao_macros_id'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
							<span class="text-admin-form"><b>* Fabricante</b></span>
							<div class="embarcacao_fabricantes_id">				
								<?php echo $form->dropDownList($model, 'embarcacao_fabricantes_id', $fabricantes, array('class'=>'select-anuncio-pad','empty'=>array(''=>'Selecione') ) ); ?>				
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

						<div class="box-admin-form" id="motor-jetski" style="display:none;">
						<span class="text-admin-form">Motor</span>
						<?php echo $form->textField($model, 'motor_de_fabrica', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?> 
						<?php echo $form->error($model,'motor_de_fabrica'); ?>
						</div><!-- row -->

					</div>	
				</div>
				<div class="linha-admin-form hide-jetski">
					<div class="container">
						<div class="box-admin-form">
						<span class="text-admin-form">Passageiros Noite</span>
						<?php echo $form->textField($model, 'acomodacoes', array('maxlength' => 7, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'acomodacoes'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
						<span class="text-admin-form">Comprimento</span>
						<?php echo $form->textField($model, 'comprimento', array('maxlength' => 7, 'class'=>'campo-admin-form')); ?> 
						<?php echo $form->error($model,'comprimento'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
						<span class="text-admin-form">Boca</span>
						<?php echo $form->textField($model, 'boca', array('maxlength' => 7, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'boca'); ?>
						</div><!-- row -->
					</div>	
				</div>
				<div class="linha-admin-form hide-jetski">
					<div class="container">
						<div class="box-admin-form">
						<span class="text-admin-form">Calado</span>
						<?php echo $form->textField($model, 'calado', array('maxlength' => 7, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'calado'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
						<span class="text-admin-form">Pé Direito</span>
						<?php echo $form->textField($model, 'pedireito', array('maxlength' => 7, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'pedireito'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
						<span class="text-admin-form">Peso do Casco</span>
						<?php echo $form->textField($model, 'pesocasco', array('maxlength' => 7, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'pesocasco'); ?>
						</div><!-- row -->
					</div>	
				</div>
				<div class="linha-admin-form hide-jetski">
					<div class="container">
						<div class="box-admin-form">
						<span class="text-admin-form">Tanque de Combustível / litros</span>
						<?php echo $form->textField($model, 'tanquecombustivel', array('maxlength' => 7, 'class'=>'campo-admin-form')); ?> 
						<?php echo $form->error($model,'tanquecombustivel'); ?>
						</div><!-- row -->

						<div class="box-admin-form hide-jetski">
						<span class="text-admin-form">Tanque de Água / litros</span>
						<?php echo $form->textField($model, 'tanqueagua', array('maxlength' => 7, 'class'=>'campo-admin-form')); ?> 
						</div><!-- row -->
						<div class="box-admin-form hide-jetski">
						<span class="text-admin-form">Número de Camarotes</span>
						<?php echo $form->textField($model, 'ncamarotes', array('maxlength' => 2, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'ncamarotes'); ?>
						</div><!-- row -->

					</div>	
				</div>
				<div class="linha-admin-form hide-jetski">
					<div class="container">
						

						<div class="box-admin-form">
						<span class="text-admin-form">Número de banheiros</span>
						<?php echo $form->textField($model, 'nbanheiros', array('maxlength' => 2, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'nbanheiros'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
						<span class="text-admin-form">Tamanho</span>
						<?php echo $form->textField($model, 'tamanho', array('maxlength' => 5, 'class'=>'campo-admin-form')); ?> 
						<?php echo $form->error($model,'tamanho'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
						<span class="text-admin-form">Passageiros Dia</span>
						<?php echo $form->textField($model, 'passageiros', array('maxlength' => 5, 'class'=>'campo-admin-form')); ?> 
						<?php echo $form->error($model,'passageiros'); ?>
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