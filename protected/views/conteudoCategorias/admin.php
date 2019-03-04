<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar Categorias de Notícias</h1>
	<?php echo CHtml::link('CADASTRAR CATEGORIA', array('admin/comunidade/categorias/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'conteudo-categorias-grid',
	'itemsCssClass' => "table table-bordered table-hover",
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'macro',
			'value'=>'Conteudos::$macros[$data->macro]',
			'filter' => array('B' => 'Blog', 'T' => 'Raio X', 'N'=>'Notícias', 'P'=>'Primeiro Barco', ' ' => 'Sem categoria'),
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{view} {update} {activate}',
			'buttons' => array(
				'view' => array('options' => array('class' => 'fa fa-search')),
				'update' => array('options' => array('class' => 'fa fa-pencil')),
				/*'activate' => array(
					'label' => "Status",
					'url' => 'Yii::app()->createUrl("motorTipos/changeStatus", array("id"=>$data->id))'
				)*/
			)
		),
	),
)); ?>
