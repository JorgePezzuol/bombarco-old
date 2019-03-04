<?php

$this->breadcrumbs = array(
	EmpresaSeo::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . EmpresaSeo::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . EmpresaSeo::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(EmpresaSeo::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 