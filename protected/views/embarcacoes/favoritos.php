<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<section id="estatisticas">
    <div class="estatisticas-line">
        <div class="container">
            <span class="estatisticas-title">Favoritos</span>
        </div>
    </div>	
</section>

<section id="minha-conta-tabela">


    <section id="estatisticas">

        <div class="estatisticas-line">
            <div class="container">
                <span class="estatisticas-title">Embarcações Favoritadas</span>
            </div>
        </div>
    </section>

    <div class="container">

        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'grid-minha-conta',
            'dataProvider' => $model->favoritos(),
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => 'embarcacao_macros_id',
                    'value' => '$data->embarcacaoModelos->embarcacaoFabricantes->embarcacaoMacros->titulo',
                    'filter' => GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true, 'id != 0')),
                ),
                array(
                    'header' => 'Marca',
                    'name' => 'embarcacao_fabricantes_id',
                    'value' => 'GxHtml::valueEx($data->embarcacaoFabricantes)',
                    'filter' => EmbarcacaoFabricantes::filtrarPelosMeusFabricantesFavoritos(),
                ),
                array(
                    'header' => 'Modelo',
                    'name' => 'embarcacao_modelos_id',
                    'value' => 'GxHtml::valueEx($data->embarcacaoModelos)',
                    'filter' => EmbarcacaoModelos::filtrarPelosMeusModelosFavoritos(),
                ),
                array(
                    'header' => 'Localização',
                    'name' => 'estados_id',
                    'value' => 'GxHtml::valueEx($data->estados)',
                    'filter' => Embarcacoes::localizacoesMeusFavoritos(),
                //'filter'=>CHtml::dropDownList('Embarcacoes[estados_id]', '', Embarcacoes::localizacoesMeusFavoritos(), array('empty'=>'Selecione')),
                ),
                array(
                    'name' => 'valor',
                    'value' => '($data->valor == "0.00") ? "Não informado" : "R$ ".Utils::formataValorView($data->valor)',
                    'filter' => array('prompt' => 'Todos', 0 => 'Ordenar por maior preço', 1 => 'Ordenar por menor preço'),
                ),
                array(
                    'header' => 'Novo/Usado',
                    'name' => 'estado',
                    'value' => '($data->estado == "U" ? "Usado" : "Novo")',
                    'filter' => array('U' => 'Usado', 'N' => 'Novo'),
                ),
                array(
                    'name' => 'ano',
                    'value' => '$data->ano',
                    'filter' => Embarcacoes::listarAnosFavoritos(),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{view}{delete}',
                    'deleteButtonOptions' => array('class' => 'delete'),
                    'buttons' => array(
                        'view' => array(
                            'url' => 'Embarcacoes::mountUrl($data)',
                        ),
                        'delete' => array(
                            // só aparecer o botao de cancelar se tiver editado (editado = 1)
                            'url' => 'Yii::app()->createUrl("embarcacoes/desfavoritarEmbarcacao", array("id_embarcacao"=>$data->id))',
                        ),
                    ),
                ),
            ),
        ));
        ?>

    </div>

    <?php /* echo CHtml::resetButton('Resetar', array('id'=>'form-reset-button')); */ ?>
</section>	

<script>
    $(document).ready(function () {
        $('#form-reset-button').click(function ()
        {
            var id = 'grid-minha-conta';
            var inputSelector = '#' + id + ' .filters input, ' + '#' + id + ' .filters select';
            $(inputSelector).each(function (i, o) {
                $(o).val('');
            });
            var data = $.param($(inputSelector));
            $.fn.yiiGridView.update(id, {data: data});
            return false;
        });
    });
</script>