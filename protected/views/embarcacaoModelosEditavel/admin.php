<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('embarcacao-modelos-editavel-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'embarcacao-modelos-editavel-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
				'name'=>'embarcacao_macros_id',
				'value'=>'GxHtml::valueEx($data->embarcacaoMacros)',
				'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'embarcacao_fabricantes_id',
				'value'=>'GxHtml::valueEx($data->embarcacaoFabricantes)',
				'filter'=>GxHtml::listDataEx(EmbarcacaoFabricantes::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'embarcacao_tipos_id',
				'value'=>'GxHtml::valueEx($data->embarcacaoTipos)',
				'filter'=>GxHtml::listDataEx(EmbarcacaoTipos::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'embarcacao_modelos_id',
				'value'=>'GxHtml::valueEx($data->embarcacaoModelos)',
				'filter'=>GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true)),
				),
		'titulo',
		/*
		'slug',
		'tamanho',
		'passageiros',
		'acomodacoes',
		'comprimento',
		'boca',
		'calado',
		'pedireito',
		'pesocasco',
		'tanquecombustivel',
		'tanqueagua',
		'consumo',
		'ncamarotes',
		'nbanheiros',
		array(
					'name' => 'status',
					'value' => '($data->status === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'motordefabrica',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>