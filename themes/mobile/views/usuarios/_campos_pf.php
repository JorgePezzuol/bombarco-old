<label class="label-create">Nome</label>
<?php 
	echo $form->textField($model, 'nome', array("class"=> "input-text", 'maxlength' => 100));
	echo $form->error($model,'nome');
	echo '<div class="errorMessage" id="error-nome"></div>';
?>

<label class="label-create">CPF</label>
<?php 
	echo $form->textField($model, 'cpf', array("class"=>"input-text",'maxlength' => 45));
	echo $form->error($model,'cpf');
	echo '<div class="errorMessage" id="error-cpf"></div>';
?>

<?php if(Yii::app()->controller->action->id == 'create'):?>
	<label class="label-create">Data de nascimento</label>
	<?php 
		echo $form->textField($model, 'data_nascimento', array("class"=> "input-text"));
		echo $form->error($model,'celular');
		echo '<div class="errorMessage" id="error-celular"></div>';
	?>
<?php endif;?>
							