<div class="line-admin-top2">
	<h1 class="title-admin-form">E-mails BomBarco</h1>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'maillings-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => "table table-bordered table-hover",
	'columns' => array(
		'id',
		'email',
		'data',
		array(
			'class' => 'CButtonColumn',
			'template' => '{delete}',
			'buttons' => array(
				'delete' => array(
					'options' => array('class' => 'fa fa-trash')
				)
			)
		),
	),
)); ?>
