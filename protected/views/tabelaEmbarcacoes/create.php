<?php
		if (!Yii::app()->user->isGuest) {
			Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_tabela_embarcacoes.js?e='.microtime(), CClientScript::POS_END);
		}
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.price_format.2.0.min.js', CClientScript::POS_END);
//Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/tabela_embarcacoes_crud.js', CClientScript::POS_END);
$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Create'),
);
?>

<div class="container">

	<br/><br/><br/>
    <h1 class="title-admin-form">Cadastrar Embarcacão na Tabela</h1>



<?php
$this->renderPartial('_form2', array(
		'model' => $model,
		'macro_selected' => '',
		'fabricantes' => array(),
		'fabricante_selected' => '',
		'modelos' => array(),
		'buttons' => 'create'
	));
?>

</div>