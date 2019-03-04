<div class="form">
<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'redirects-form',
	'enableAjaxValidation' => false,
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

	<div class="line-admin-cad-mod">
		<div class="container">
			<div class="box-admin-form2">
				<div class="linha-admin-form">
					<div class="box-admin-form">
						<span class="text-admin-form">De*</span>
						<?php echo $form->textField($model, 'de', array('maxlenght'=>250, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'de'); ?>
					</div>

					<div class="box-admin-form">
						<span class="text-admin-form">Para*</span>
						<?php echo $form->textField($model, 'para', array('maxlenght'=>250, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'para'); ?>
					</div>

					<!--<div class="box-admin-form">
						<span class="text-admin-form">Status</span>
						<div class="status_admin_drop">
							<?php echo $form->dropDownList($model, 'status', array('0'=>'Desativado', '1'=>'Ativado'), array('class'=>'input-status')); ?>	
						</div>	
						<?php echo $form->error($model,'status'); ?>
					</div>-->
				</div>
				<div class="linha-admin-form">
					<div class="container">
						<?php
							echo GxHtml::submitButton(Yii::t('app', 'Cadastrar'), array('class'=>'botao-cad-admin'));
							$this->endWidget();
							?>
					</div>
				</div>
			</div>	
		</div>		
	</div>			



</div><!-- form -->