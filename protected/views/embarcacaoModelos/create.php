<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Create'),
);
?>
<div class="container">
		<h1 class="title-admin-form3">Cadastrar de Modelo de Embarcação</h1>
</div>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'fabricantes' => array(),
		'tipos' => array(),
		'buttons' => 'create'
		));
?>