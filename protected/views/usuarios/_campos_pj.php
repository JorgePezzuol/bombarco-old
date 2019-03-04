<div class="quadro-pricad-3">
						<div class="div-text-top-form-cadpri">
							<span class="text-top-form-cadpri">Razao Social *</span>
						</div>
						<div class="caixa-form-pricad" id="#">
							<?php echo $form->textField($model, 'razaosocial', array("class"=> "required-pj text-form-pricad", 'maxlength' => 150)); ?>
						</div>
							<?php echo $form->error($model,'razaosocial'); ?>
							<div class="errorMessage" id="error-razaosocial"></div>
					</div>

					<div class="quadro-pricad-3">
						<div class="div-text-top-form-cadpri">
							<span class="text-top-form-cadpri">Nome Fantasia *</span>
						</div>
						<div class="caixa-form-pricad" id="#">
							<?php echo $form->textField($model, 'nomefantasia', array("class"=>"required-pj text-form-pricad",'maxlength' => 150)); ?>
						</div>
							<?php echo $form->error($model,'nomefantasia'); ?>
							<div class="errorMessage" id="error-nomefantasia"></div>
					</div>
		
					<div class="quadro-pricad-3">
						<div class="div-text-top-form-cadpri" id="div-cnpj">
							<span class="text-top-form-cadpri">CNPJ *</span>
						</div>
						<div class="caixa-form-pricad" id="#">
							<?php echo $form->textField($model, 'cnpj', array("class"=> "required-pj text-form-pricad", 'maxlength' => 150)); ?>
						</div>
							<?php echo $form->error($model,'cnpj'); ?>
							<div class="errorMessage error-cpfcnpj" id="error-cnpj"></div>
					</div>