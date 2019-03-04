


<div class="line-admin-top2">
	<div class="container">
		<div class="col-md-12">
			<div class="row" style="margin-bottom:15px;">
				<h1 class="title-admin-form">Gerenciar Meta Tags</h1>
				<?php echo CHtml::link('CADASTRAR META TAG', array('seo/create'), array('class'=>'botao-cad-admin botao-cad-admin btn btn-primary'));?>
				<?php echo CHtml::link('GERENCIAR MATÉRIAS', array('admin/comunidade'), array('class'=>'botao-cad-admin btn btn-primary'));?>
				<?php echo CHtml::link('VOLTAR AO SITE', array('site/index'), array('class'=>'botao-cad-admin btn btn-primary'));?>
			</div>
		</div>


		<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'seo-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'url',
		'title',
		'description',
		'keywords',
		array(
			'name' => 'follow',
			'value' => '($data->follow === 0) ? Yii::t(\'app\', \'Não\') : Yii::t(\'app\', \'Sim\')',
			'filter' => array('0' => Yii::t('app', 'Não'), '1' => Yii::t('app', 'Sim')),
			),
		
		array(
			'name' => 'index',
			'value' => '($data->index === 0) ? Yii::t(\'app\', \'Não\') : Yii::t(\'app\', \'Sim\')',
			'filter' => array('0' => Yii::t('app', 'Não'), '1' => Yii::t('app', 'Sim')),
			),
		
		 array(
			'class' => 'CButtonColumn',
			'header' => "Ações",
			'template' => '{update}{delete}',
			'buttons' => array(
        		'update' => array('options' => array('class' => 'fa fa-pencil')),
        		'delete' => array('options' => array('class' => 'fa fa-times', 'style'=>"margin-left:15px;")),
				/*'activate' => array(
					'class' => 'fa fa-pencil',
					'url' => 'Yii::app()->createUrl("embarcacaoFabricantes/changeStatus", array("id"=>$data->id))'
				)*/
			)
		),
	),
)); ?>
		
	</div>
</div>


