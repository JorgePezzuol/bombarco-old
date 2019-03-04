<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<input type="hidden" id="embarcacoes_id"/>
<input type="hidden" id="hidden_vendas" value = "0"/>


<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<section id="estatisticas">
    <div class="estatisticas-line">
        <div class="container">
            <span class="estatisticas-title">Classificados</span>
        </div>
    </div>
</section>


<!-- estatísticas / só aparecem se o usuário ser o dono da embarcação -->
    <section id="estatisticas">

        <?php
            $total_impressoes = number_format(Embarcacoes::totalizarImpressoesClassificados(Yii::app()->user->id)["impressoes"],0,",",".");
            $limite = number_format(Embarcacoes::totalizarImpressoesClassificados(Yii::app()->user->id)["limite"],0,",",".");
            $impressoes = $total_impressoes . "/" . $limite;
        ?>

        <div class="estatisticas-box">
            <div class="container">
                <div class="estatisticas-cell">
                    <span class="cell-title">Contatos</span>
                    <span class="cell-result"><?php echo number_format(Embarcacoes::totalizarMensagens(Yii::app()->user->id, null,'anuncio'),0,",",".");?></span>
                </div>
                <div class="estatisticas-cell">
                    <span class="cell-title">Cliques:</span>
                    <span class="cell-result"><?php echo number_format(Embarcacoes::totalizarCliques(Yii::app()->user->id, null,'anuncio'),0,",",".");?></span>
                </div>

                <div class="estatisticas-cell">
                    <span class="cell-title">Ver Telefone:</span>
                    <span class="cell-result"><?php echo number_format(Embarcacoes::totalizarVerTelefone(Yii::app()->user->id),0,",",".");?></span>
                </div>

                <div class="estatisticas-cell">
                    <span class="cell-title">Impressões:</span>
                    <span class="cell-result"><?php echo $impressoes;?></span>
                </div>

                <br class="clear">
                
            </div>
        </div>
    </section>

<section id="minha-conta-tabela">


    <section id="estatisticas">

        <div class="estatisticas-line">
            <div class="container">
                <span class="estatisticas-title">Minhas embarcações</span>
            </div>
        </div>
    </section>

<div class="container">

<?php
if(isset($_GET["v"]) && $_GET["v"] == 1) {
    $dataProvider = $model->searchVendidos();
}
else {
    $dataProvider = $model->search();
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid-minha-conta',
    'dataProvider' => $dataProvider,
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name' => 'embarcacao_macros_id',
            'value' => '$data->embarcacaoModelos->embarcacaoFabricantes->embarcacaoMacros->titulo',
            'filter' => GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true, 'id != 0')),
        ),
        array(
            'header' => 'Marca',
            'name' => 'embarcacao_fabricantes_id',
            'value' => 'GxHtml::valueEx($data->embarcacaoFabricantes)',
            'filter' => GxHtml::listDataEx(EmbarcacaoFabricantes::filtrarPelosMeusFabricantes(Yii::app()->user->id, 'anuncio')),
        ),
        array(
            'name' => 'embarcacao_modelos_id',
            'value' => 'GxHtml::valueEx($data->embarcacaoModelos)',
            //'filter'=>GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true)),
            'filter' => GxHtml::listDataEx(EmbarcacaoModelos::filtrarPelosMeusModelos(Yii::app()->user->id, 'anuncio')),
        ),
        array(
            'name' => 'valor',
            'value' => '($data->valor == "0.00") ? "Não informado" : "R$ ".number_format($data -> valor, 2, ",", ".")',
            'filter' => array(-1 => 'Todos', 0 => 'Ordenar por maior preço', 1 => 'Ordenar por menor preço'),
        ),
        array(
            'header' => 'Cliques',
            'name' => 'views',
            'value' => '($data->views == 0) ? "Nenhuma visualização" : $data->views',
            'filter' => array(-1 => 'Todos', 0 => 'Mais clicados', 1 => 'Menos clicados'),
        ),
        array(
            'name' => 'status',
            // 'htmlOptions' => '',
            // 'value' => 'Anuncio::$_status_anuncio_by_number[$data->status]',
            'value' => function($_status_anuncio_by_number) {
                switch ($_status_anuncio_by_number->status) {
                    case 0:
                        echo '<span style="color:#999">Aguardando Pagamento</span>';
                        break;
                    case 1:
                        echo '<span style="color:#000">Aguardando Ativação</span>';
                        break;
                    case 2:
                        echo '<span style="color:#00918e">Ativado</span>';
                        break;
                    case 4:
                        echo '<span style="color:red">Vendido</span>';
                        break;
                    case 5:
                        echo '<span style="color:#fc0">Pausado</span>';
                        break;

                    default:
                        echo '<span style="color:red">Expirado</span>';
                        break;
                }
            },
            'filter' => array(0 => 'Aguardando Pagamento', 1 => 'Aguardando Ativação', 2 => 'Ativado', 4 => 'Vendido', 5 => 'Pausado', 6 => 'Expirado'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{vendido}{pausar}{despausar}{turbinar}{deletar}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Embarcacoes::mountUrl($data)',
                    'options' => array('class' => 'fa fa-search', "title"=>"Visualizar")
                ),
                'vendido' => array(
                    'visible' => '$data->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]',
                    'label' => "",
                    'url' => 'Yii::app()->createUrl("Embarcacoes/desativarOuPausarAnuncio", array("id"=>$data->id))',
                    'options' => array('id' => 'btn-ativar', 'class' => 'fa fa-dollar espacamento-10', 'title'=>"Vendido"),
                    'click' => "function() {

                        $('#texto_lightbox').text('Ao efetuar esta operação seu anúncio deixará de aparecer nas buscas do Bombarco. Confirmar?');

                        var href_ajax = $(this).attr('href');

                        $('#embarcacoes_id').val($(this).attr('href').split('/').pop());

                        // poe 1 p indicar que precisa do lightbox de vendas
                        $('#hidden_vendas').val(1);

                        $('#lbox-confirmacao').lightbox_me({
                            centered: true,
                            onLoad: function() {
                                $('#btn-confirmar').data('href_ajax', href_ajax);
                                $('#lbox-confirmacao').addClass('show');
                            },
                            onClose: function() {
                                return false;
                            }
                        });

                        return false;
                    }",
                ),
                'pausar' => array(
                    'visible' => '$data->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]',
                    'label' => "",
                    'url' => 'Yii::app()->createUrl("Embarcacoes/desativarOuPausarAnuncio", array("id"=>$data->id))',
                    'options' => array('id' => 'btn-ativar', 'class' => 'fa fa-pause espacamento-10', 'title'=>"Pausar"),
                    'click' => "function() {

                        $('#texto_lightbox').text('Ao efetuar esta operação seu anúncio deixará de aparecer nas buscas do Bombarco. Confirmar?');

                        var href_ajax = $(this).attr('href');

                        $('#embarcacoes_id').val($(this).attr('href').split('/').pop());

                        $('#btn-confirmar').data('href_ajax', href_ajax);

                        $('#btn-confirmar').data('pausar', 1);

                        // poe 0 pra n vir o lightbox de vendas
                        $('#hidden_vendas').val(0);

                        $('#lbox-confirmacao').lightbox_me({
                            centered: true,
                            onLoad: function() {
                                
                                $('#lbox-confirmacao').addClass('show');
                            },
                            onClose: function() {
                                return false;
                            }
                        });

                        return false;
                    }",
                ),
                'despausar' => array(
                    'visible' => '$data->status == Anuncio::$_status_anuncio["ANUNCIO_PAUSADO"]',
                    'label' => " ",
                    'url' => 'Yii::app()->createUrl("Embarcacoes/desativarOuPausarAnuncio", array("id"=>$data->id))',
                    'options' => array('id' => 'btn-ativar', 'class' => 'fa fa-check espacamento-10', "title"=>"Ativar"),
                    'click' => "function() {

                        var href_ajax = $(this).attr('href');

                        $('#embarcacoes_id').val($(this).attr('href').split('/').pop());

                        $('#texto_lightbox').text('Ao realizar esta operação seu anúncio voltará para as buscas do Bombarco. Confirmar?');

                        $('#btn-confirmar').data('href_ajax', href_ajax);

                        $('#btn-confirmar').data('pausar', 2);

                        // poe 0 pra n vir o lightbox de vendas
                        $('#hidden_vendas').val(0);

                        $('#lbox-confirmacao').lightbox_me({
                            centered: true,
                            onLoad: function() {
                                
                                $('#lbox-confirmacao').addClass('show');
                            },
                            onClose: function() {
                                return false;
                            }
                        });

                        return false;
                    }",
                ),
                'update' => array(
                  'options' => array('class' => 'fa fa-pencil espacamento-10', "title"=>"Editar"),
                    'visible' => '$data->status != Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"] && $data->status != Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"]',
                ),
                'turbinar' => array(
                    'label' => 'Turbinar',
                    'url' => 'Yii::app()->createUrl("embarcacoes/turbinar", array("id"=>$data->id))',
                    // n aparece p turbinar se tiver vendido ou expirado
                    'visible' => 'Embarcacoes::retornarQtdeTurbinadas($data->id) <> count(Anuncio::$_turbinados_embarcacao) && $data->status != 4 && $data->status != 6',
                    'imageUrl' => Yii::app()->theme->baseUrl."/img/icone-turbinar.png",
                    'options' => array('class' => 'icone-turbinar espacamento-10'),
                ),
                'deletar' => array(
                    'label' => " ",
                    'url' => 'Yii::app()->createUrl("embarcacoes/deletarAnuncio", array("id"=>$data->id))',
                    'options' => array('id' => 'btn-ativar', 'class' => 'fa fa-trash espacamento-10', "title"=>"Deletar"),
                    'click' => "function() {

                        $('#texto_lightbox').text('Ao efetuar esta operação seu anúncio deixará de aparecer nas buscas do Bombarco. Confirmar?');

                        var href_ajax = $(this).attr('href');

                        $('#embarcacoes_id').val($(this).attr('href').split('/').pop());

                        // poe 0 pra n vir o lightbox de vendas
                        $('#hidden_vendas').val(0);

                        $('#lbox-confirmacao').lightbox_me({
                            centered: true,
                            onLoad: function() {
                                $('#btn-confirmar').data('href_ajax', href_ajax);
                                $('#lbox-confirmacao').addClass('show');
                            },
                            onClose: function() {
                                return false;
                            }
                        });

                        return false;

                    }",
                ),
            ),
        ),
    ),
));
?>


</div>

</section>

<!-- lightboxess -->
<div class="lbox-msgenviada" id="lbox-vendas" style="width: 550px; height: 250px;">  
    <div class="texts-lbox-ag"> 
        <div class="div-title-form-msgok" style="top:0;">

            <span class="form-lb-title" id="msg-lgbox2">
                Que bom que a sua embarcação foi vendida! A venda foi realizado pelo Bombarco? 
            </span>
            <br/><br/><br/>
            <div class="compactRadioGroup" style="margin-left:20px;">
                <input style="display:none;" id="venda_0" type="radio" name="venda" value="1"/>
                <label style="margin-right:30px;" for="venda_0">Sim</label>
                <input style="display:none;" id="venda_1" type="radio" name="venda" value="0"/>
                <label style="margin-right:30px;" for="venda_0">Nao</label>
                <br/><br/><br/><br/>
                <input type="button" style="margin-right:40px;" class="botao-lb-form-msgok enviar" id="btn-vendas" value="OK">
            </div>

        </div>
    </div>  
    <br/>
    
</div>

<div class="lbox-ag" id="lbox-confirmacao" style="width: 580px !important;">
    <div class="texts-lbox-ag">
        <input type="button" id="close" class="fechar-form close" value="X">
        <div>
            <span id="texto_lightbox" class="ev-titleb" style="width: 530px !important;">Ao efetuar esta operação seu anúncio deixará de aparecer nas buscas do Bombarco. Confirmar?</br></span>
        </div>
    </div>

    <input type="button" style="margin-left:210px; margin-top:40px;" class="botao-lb-form-msgok" id="btn-confirmar" value="OK">
</div>

<!-- fim lightboxes -->




<script>
$(document).ready(function () {

    // tirar opção de filtrar por status (solicitação da milena)
    if(getUrlParameter("v") == 1) {
        $("#grid-minha-conta_c6").hide();
        $('select[name="Embarcacoes[status]"]').hide();
    }

    if(typeof getUrlParameter("e") == "undefined" && typeof getUrlParameter("v") == "undefined") {
        $("#minha-conta-classificados").addClass("active");
    }

    $("<span class='span-radio'><i class='ico-radio'></i></span>").insertAfter("input[type='radio']");
    $('.span-radio').on('click', function (e) {
        e.preventDefault();
        $('span').removeClass('section-change');
        $(this).parent().addClass('section-change');
        $('.section-change .span-radio').removeClass('active-radio');
        $(this).addClass('active-radio');
        $(this).prev().trigger('change');
        $(this).prev().trigger('click');
    });

    $('#form-reset-button').click(function () {
        var id = 'grid-minha-conta';
        var inputSelector = '#' + id + ' .filters input, ' + '#' + id + ' .filters select';
        $(inputSelector).each(function (i, o) {
            $(o).val('');
        });
        var data = $.param($(inputSelector));
        $.fn.yiiGridView.update(id, {data: data});
        return false;
    });

    /* evento botoes lightboxes */
    $("#btn-confirmar").on("click", function() {

        var href_ajax = $(this).data("href_ajax");
        var data = $(this).data("data");
        var pausar = $(this).data("pausar");
        
        $.ajax({
            type:'GET',
            data: {
                embarcacoes_id: $("#embarcacoes_id").val(),
                pausar: pausar
            },
            url: href_ajax,
            success:function(resp) {

                if(resp != '-1') {

                    // 1 pra abrir o lightboxvendas 0 p n abrir, setamos isso em cada operacao
                    if($("#hidden_vendas").val() == 1) {
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#lbox-vendas').lightbox_me({
                            centered: true,
                            onLoad: function() {
                                $(".close").click();
                            },
                            onClose: function() {}
                        });    
                    }
                    else {

                        $("#lbox-confirmacao").hide();
                        
                        lightBoxMsg('Operação realizada com sucesso!');
                        
                        /*$('#texto_lightbox').text('Operação realizada com sucesso!');

                        $('#lbox-confirmacao').lightbox_me({
                            centered: true,
                            onLoad: function() {
                                $('#btn-confirmar').data('href_ajax', href_ajax);
                                $('#lbox-confirmacao').addClass('show');
                            },
                            onClose: function() {
                                return false;
                            }
                        });*/

                        setTimeout(function() { 
                            location.href = Yii.app.createUrl('embarcacoes/lista?t='+Math.random()+"&e=anuncios");
                        }, 1000);
                        
                    }
                }
            }
        });
    }); 
    /* fim evento botoes lightboxes */

    $("#btn-vendas").on("click", function() {

        $.ajax({

            url: Yii.app.createUrl("vendasBombarco/createAjax"),
            data: {
                simNao: $('input[name="venda"]:checked').val(),
                embarcacoes_id: $("#embarcacoes_id").val()
            },
            type: "POST",
            success: function() {

                $("#lbox-vendas").hide();

                /*$('#texto_lightbox').text('Operação realizada com sucesso!');

                $('#lbox-confirmacao').lightbox_me({
                    centered: true,
                    onLoad: function() {
                        $('#btn-confirmar').data('href_ajax', href_ajax);
                        $('#lbox-confirmacao').addClass('show');
                    },
                    onClose: function() {
                        return false;
                    }
                });*/


                lightBoxMsg('Operação realizada com sucesso!');

                setTimeout(function() { 
                    location.href = Yii.app.createUrl('embarcacoes/lista?t='+Math.random()+"&e=anuncios");
                }, 1000);


            },
            error: function() {

            }
        });
    });


});
</script>
