<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
    <h1 class="title-admin-form">Gerenciar Empresas</h1>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'empresas-grid',
    'dataProvider' => $model->searchAdmin(),
    'itemsCssClass' => "table table-bordered table-hover",
    'filter' => $model,
    'columns' => array(
        'id',
        'email',
        'razao',
        'cnpj',
        'telefone',
        'cep',
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
        'endereco',
        'bairro',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{deactivate}{activate}{turbinadas}',
            'buttons' => array(
                'view' => array(
                    'label' => '',
                    'url' => 'Empresas::mountUrl($data, $data->macros_id)',
                    'options'=>array('class'=>'fa fa-search'),
                    'imageUrl' => ''
                ),
                'update'=> array(
                    'label' => '',
                    'options'=>array('class'=>'fa fa-pencil'),
                    'imageUrl' => ''
                ),
                'deactivate' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    'label' => '',
                    'visible' => '$data->status == Empresas::$_status["ATIVADO"]',
                    'url' => 'Yii::app()->createUrl("empresas/ChangeStatus", array("id"=>$data->id))',
                    'options'=>array('id'=>'btn_deactivate','class'=>'fa fa-remove btn-change-status', 'data-status'=>Empresas::$_status["DESATIVADO"])
                ),
                'activate' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    'label' => '',
                    'url' => 'Yii::app()->createUrl("empresas/ChangeStatus", array("id"=>$data->id))',
                    'options'=>array('id'=>'btn_activate','class'=>'ic-continue fa fa-check btn-change-status', 'data-status'=>Empresas::$_status["ATIVADO"])
                ),
                'turbinadas' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    'label' => 'Turbinar',
                    'visible' => '$data->status != Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"] && $data->status != Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"]',
                    'url' => 'Yii::app()->createUrl("empresas/darTurbinadas", array("id"=>$data->id))',
                    'options'=>array('class'=>'ic-turbo pure-button'),
                ),
            ),
        ),
    ),
));
?>
