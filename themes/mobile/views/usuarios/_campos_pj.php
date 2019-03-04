<label class="label-create">Razão Social</label>
<?php 
	echo $form->textField($model, 'razaosocial', array("class"=> "input-text", 'maxlength' => 150));
	echo $form->error($model,'razaosocial');
	echo '<div class="errorMessage" id="error-razaosocial"></div>';
?>

<label class="label-create">Nome Fantasia</label>
<?php 
	echo $form->textField($model, 'nomefantasia', array("class"=>"input-text",'maxlength' => 150));
	echo $form->error($model,'nomefantasia');
	echo '<div class="errorMessage" id="error-nomefantasia"></div>';
?>

<label class="label-create">CNPJ</label>
<?php 
	echo $form->textField($model, 'cnpj', array("class"=> "input-text", 'maxlength' => 150));
	echo $form->error($model,'cnpj');
	echo '<div class="errorMessage" id="error-cnpj"></div>';
?>