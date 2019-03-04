
<div class="quadro-pricad-3">
	<div class="div-text-top-form-cadpri">
		<span class="text-top-form-cadpri">Nome *</span>
	</div>
	<div class="caixa-form-pricad" id="#">
		<input type="text" id="Usuarios_nome" name="Usuarios[nome]" class="required-pf text-form-pricad" maxlength="100"/>
	</div>
</div>


<div class="quadro-pricad-3">
	<div class="div-text-top-form-cadpri">
		<span class="text-top-form-cadpri">Sobrenome *</span>
	</div>
	<div class="caixa-form-pricad" id="#">
		<input type="text" id="Usuarios_nome" name="Usuarios[sobrenome]" class="required-pf text-form-pricad" maxlength="100"/>
	</div>
</div>

<div class="quadro-pricad-3">
	<div class="div-text-top-form-cadpri">
		<span class="text-top-form-cadpri">CPF *</span>
	</div>
	<div class="caixa-form-pricad" id="div-cpf">
		<input type="text" id="Usuarios_cpf" name="Usuarios[cpf]" class="required-pf text-form-pricad" maxlength="45"/>
		<div class="errorMessage error-cpfcnpj" id="error-cpf"></div>
	</div>
</div>

<?php if(Yii::app()->controller->action->id == 'create'):?>
<div class="quadro-pricad-3">
	<div class="div-text-top-form-cadpri">
		<span class="text-top-form-cadpri">Data de Nascimento *</span>
	</div>
	<div class="caixa-form-pricad" id="#">
		<input type="text" id="Usuarios_data_nascimento" name="Usuarios[data_nascimento]" class="required-pf text-form-pricad" maxlength="100"/>
	</div>
</div>
<?php else: ?>
<div class="quadro-pricad-3" style="display:none;">
	<div class="div-text-top-form-cadpri">
		<span class="text-top-form-cadpri">Data de Nascimento</span>
	</div>
	<div class="text-form-pricad" id="#">
		<?php echo Usuarios::formatDateTimeToView($model->data_nascimento); ?>
	</div>
</div>
<?php endif;?>