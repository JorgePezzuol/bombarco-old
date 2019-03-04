<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
  <h1 class="title-admin-form">Compradores E-book</h1>
  <br/>
  <?php /*echo CHtml::link('Novo produto', array('admin/bombarcoshop/create'), array('class'=>'botao-cad-admin btn btn-primary btn-sm')); */?>

    <?php /*echo CHtml::link('Gerar código de desconto', array('admin/bombarcoshop/create'), array('class'=>'botao-cad-admin btn btn-success btn-sm')); */?>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    //'filter' => $model,
    'itemsCssClass' => "table table-bordered table-hover",
    'columns' => array(
    	'id',
      'nome',
      'email',
      array(
      'name'=>'dataregistro',
      'header'=>'Data',
      'value'=>'Utils::formatDateTimeToView($data->dataregistro)',
      'filter'=>GxHtml::listDataEx(UsuarioClassificacoes::model()->findAllAttributes(null, true)),
    ),
    	//'descricao',
       	//'valor',
       	//'status',
		/*array(
			'class' => 'CButtonColumn',
			'header'=>'Ações',
			'template' => '{delete}{update}{view}',
			'buttons' => array(
				'update' => array('options'=>array('class' => 'fa fa-pencil')),
				'delete' => array('options'=>array('class' => 'fa fa-close')),
				'view' => array('options'=>array('class' => 'fa fa-search')),
			)
		),*/

    ),
)); ?>
