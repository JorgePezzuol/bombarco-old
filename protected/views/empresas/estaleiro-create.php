


<?php


	 $form = $this->beginWidget('GxActiveForm', array(
		'id' => 'empresas-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'enableClientValidation'=>true,
	));

?>
	
<div class="container">
		<h1 class="title-admin-form">Cadastre o Estaleiro</h1>
</div>


<?php
	
	/*echo $form->errorSummary($empresa);
	echo $form->errorSummary($usuario);
	echo $form->errorSummary($plano);*/

	$this->renderPartial('_form_estaleiro', array(
		'empresa' => $empresa,
		'flgEstaleiro'=>true,
		'usuario'=>$usuario,
		'plano'=>$plano,
		'flgCadastroOK'=>$flgCadastroOK,
		'form'=>$form)
	);
?>
<div class="line-admin-cad-mod" style="height: 200px;">
	<div class="linha-admin-form">
		<div class="container">	
			<div class="box-admin-form5">

<?php
	echo GxHtml::submitButton(Yii::t('app', 'Finalizar'),array('class'=>'botao-cad-admin', 'id'=>'submit-estaleiro'));

	$this->endWidget();
	
?>
			</div>
		</div>
	</div>
</div>

