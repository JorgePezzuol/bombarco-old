<?php

$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model),
);
?>

<div class="container">

    <h1>Tabela - <?php echo GxHtml::encode(GxHtml::valueEx($model->embarcacaoModelos)); ?></h1>

    <?php echo CHtml::link('Cadastrar Embarcacão', array('admin/embarcacoes/tabela/criar'), array('class'=>'botao-cad-admin')); ?>
    <?php echo CHtml::link('Voltar a Lista', array('TabelaEmbarcacoes/admin'), array('class'=>'botao-cad-admin')); ?>
    <br><br>

    <?php $this->widget('zii.widgets.CDetailView', array(
                    'data' => $model,
                    'attributes' => array(
                        'id',
                        array(
                            'name' => 'embarcacaoModelos',
                            'type' => 'raw',
                            'value' => $model->embarcacaoModelos !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacaoModelos)), array('embarcacaoModelos/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacaoModelos, true))) : null,
                            ),
                        'ano',
                        array(
                            'name' => 'valor',
                            'value' => ($model->valor == "0.00") ? "Não informado" : "R$ ".number_format($model->valor, 2, ",", "."),
                            'filter' => array(-1 => 'Todos', 0 => 'Ordenar por maior preço', 1 => 'Ordenar por menor preço'),
                        ),
                        array(
                            'name' => 'status',
                            'type' => 'raw',
                            'value' => ($model->status == 1) ? "Ativado" : "Desativado"
                            ),
                    ),
                )
            );
    ?>

</div>



