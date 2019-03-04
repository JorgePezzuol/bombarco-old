<?php

$this->breadcrumbs = array(
	EmbarcacaoTipos::label(2),
	Yii::t('app', 'Index'),
);

?>

<h1><?php echo GxHtml::encode(EmbarcacaoTipos::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 