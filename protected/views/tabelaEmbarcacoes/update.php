<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/tabela_embarcacoes_crud.js', CClientScript::POS_END);
$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);
?>

<div class="container">
    <h1 class="title-admin-form">Editar Embarcacão da Tabela</h1>
</div>


<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'macro_selected' => $macro_selected,
		'fabricantes' => $fabricantes,
		'fabricante_selected' => $fabricante_selected,
		'modelos' => $modelos
	));
?>