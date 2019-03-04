<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
  <h1 class="title-admin-form">Gerenciar Estaleiros</h1>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'empresas-grid',
    'dataProvider' => $model->searchEstaleiros(),
    'filter' => $model,
    'itemsCssClass' => "table table-bordered table-hover",
    'columns' => array(
        'id',
        'email',
        'razao',
        'cnpj',
        'telefone',
        array(
            'name' => 'estados_id',
            'value' => 'GxHtml::valueEx($data->estados)',
            'filter' => GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)),
        ),
        array(
            'name' => 'cidades_id',
            'value' => 'GxHtml::valueEx($data->cidades)',
            'filter' => GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true)),
        ),
        'cep',
        'endereco',
        'numero',
        'bairro',
        /* array(
          'name'=>'empresa_categorias_id',
          'value'=>'GxHtml::valueEx($data->empresaCategorias)',
          'filter'=>GxHtml::listDataEx(EmpresaCategorias::model()->findAllAttributes(null, true)),
          ), */

        array(
            'name' => 'status',
            'value' => 'Empresas::$_status_by_id[$data->status]',
            'filter' => Empresas::$_status_by_id,
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}{activate}{deactivate}',
            'buttons' => array(
                'view' => array(
                    'label' => '',
                    'url' => 'Empresas::mountUrl($data, $data->macros_id)',
                    'options'=>array('class'=>'ic-view fa fa-search'),
                    'imageUrl' => ''
                ),
                'update'=> array(
                    'label' => '',
                    'options'=>array('class'=>'ic-update fa fa-pencil'),
                    'imageUrl' => ''
                ),
                
                /*'delete'=> array(
                    'label' => '',
                    'url' => 'Yii::app()->createUrl("empresas/delete/$data->id")',
                    'options'=>array('class'=>'ic-update fa fa-trash'),
                    'imageUrl' => ''
                ),*/
                'deactivate' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    'label' => '',
                    'visible' => '$data->status == Empresas::$_status["ATIVADO"]',
                    'url' => 'Yii::app()->createUrl("empresas/ChangeStatus", array("id"=>$data->id, "status"=>3))',
                    'options'=>array('id'=>'btn_deactivate ','class'=>'ic-delete fa fa-times btn-change-status', 'data-status'=>Empresas::$_status["DESATIVADO"])
                ),
                'activate' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    'label' => '',
                    'visible' => '$data->status == Empresas::$_status["DESATIVADO"] || $data->status == Empresas::$_status["VENDIDO"]',
                    'url' => 'Yii::app()->createUrl("empresas/ChangeStatus", array("id"=>$data->id, "status"=>2))',
                    'options'=>array('id'=>'btn_activate ','class'=>'ic-continue fa fa-check btn-change-status', 'data-status'=>Empresas::$_status["ATIVADO"])
                ),
            ),
        ),
    ),
));
?>
