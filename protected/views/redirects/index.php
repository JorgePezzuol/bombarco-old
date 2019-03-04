<?php

$this->breadcrumbs = array(
	Redirects::label(2),
	Yii::t('app', 'Index'),
);
?>

<h1><?php echo GxHtml::encode(Redirects::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 