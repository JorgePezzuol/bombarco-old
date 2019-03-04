
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'conteudo-seo-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
				'name'=>'conteudos_id',
				'value'=>'GxHtml::valueEx($data->conteudos)',
				'filter'=>GxHtml::listDataEx(Conteudos::model()->findAllAttributes(null, true)),
				),
		'title',
		'description',
		'keywords',
		array(
					'name' => 'follow',
					'value' => '($data->follow === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		/*
		array(
					'name' => 'index',
					'value' => '($data->index === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>