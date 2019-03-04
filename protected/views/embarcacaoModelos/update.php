<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);
?>

<h1>Editando Modelo</h1>

<?php
if($model->embarcacao_macros_id == 1) {
	$this->renderPartial('_form_jetski', array(
		'model' => $model,
		'fabricantes' => $fabricantes,
		'tipos' => $tipos
	));
}
else {
	$this->renderPartial('_form', array(
		'model' => $model,
		'fabricantes' => $fabricantes,
		'tipos' => $tipos
	));
}

?>