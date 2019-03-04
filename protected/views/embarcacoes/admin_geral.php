
<div class="container">
    <h1>Anúncios de embarcações</h1>
    <br/>

    <style>
        .items {
            margin-left: -150px !important;
        }
        .grid-view table.items th, .grid-view table.items td {
            font-size: 0.9em;
            border: 1px white solid;
            padding: 0.3em;

        }
        td .fa {
            padding: 7px;
        }
    </style>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'embarcacoes-grid',
    'dataProvider' => $model->searchAdmin(),
    //'itemsCssClass' => "table table-bordered table-hover",
    'filter' => $model,
    'template'=>"{summary}\n{pager}\n{items}\n{pager}", //THIS DOES WHAT YOU WANT
    'columns' => array(
        'id',
        /*array(
            'header'=>'Pedido',
            'value'=>'$data->getReference()',
            'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
            ),
        array(
            'name'=>'nome_usuario',
            'header'=>"Proprietário",
            'value'=>'Usuarios::buscarNomeDonoEmbarc($data->id)',
            'filter'=>false,
        ),
        array(
            'header'=>'Pagamento',
            'value'=>'$data->getPagamento()',
            ),*/
        array(
            'name'=>'gratuito',
            'header'=>"Gratuito?",
            'value' =>'PlanoUsuarios::checarSeEhGratuito($data)',
            'filter'=>array(1=>'Gratuitos', 0=>'Pagos'),
        ),
        array(
            'header' => 'Data',
            'name' => 'dataregistro',
            'value' => 'Utils::formatDateTimeToView($data->dataregistro)',
            'filter' => false
        ),
        array(
            'name'=>'email',
            'value'=>'$data->email'
        ),
        array(
            'name'=>'embarcacao_macros_id',
            'value'=>'$data->embarcacaoModelos->embarcacaoFabricantes->embarcacaoMacros->titulo',
            'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
            ),
        array(
            'name'=>'embarcacao_fabricantes_id',
            'header'=>'Fabricante',
            'value'=>'GxHtml::valueEx($data->embarcacaoFabricantes)'
            ),
        array(
            'name'=>'embarcacao_modelos_id',
            'value'=>'GxHtml::valueEx($data->embarcacaoModelos)',
            'filter'=>GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true)),
            ),


        array(
            'name'=>'estados_id',
            'value'=>'GxHtml::valueEx($data->estados)',
            'filter'=>GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)),
            ),
        array(
            'name'=>'cidades_id',
            'value'=>'GxHtml::valueEx($data->cidades)',
            'filter'=>GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true)),
            ),
        array(
            'name'=>'valor',
            'value' =>'($data->valor == "") ? "Não informado" : "R$ ".number_format($data -> valor, 2, ",", ".")',
        ),
        array(
            'name'=> 'estado',
            'header'=>'Estado',
            'value' =>'($data->estado == "U") ? "Usado" : "Novo"',
            'filter'=>array('U'=>'Usado', 'N'=>'Novo'),
        ),
        array(
            'name'=> 'status',
            'value' => 'Anuncio::$_status_anuncio_by_number[$data->status]',
            'filter'=> Anuncio::$_status_anuncio_by_number,
        ),
        array(
            'name'=> 'ano',
            'value' => '($data->ano == "") ? "Não informado" : $data->ano',
        ),
        /*array(
            'name' => 'qntmotores',
            'value' => '($data->qntmotores === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
            'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
            ),*/
        //'descricao',
        array(
            'name'=> 'views',
            'value' => '($data->views == 0) ? "Nenhuma visualização" : $data->views',
        ),
        array(
            'header'=>'Turbinada',
            'value'=>'count($data->turbinadas)',
            'value' =>'(count($data->turbinadas) == 0) ? "Não" : "Sim"',
            'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
        ),

        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}{activate}{turbinadas}',
            'buttons' => array(
                'view' => array(
                    'label' => '',
                    'url' => 'Embarcacoes::mountUrl($data)',
                    'options'=>array('class'=>'fa fa-search'),
                    'imageUrl' => ''
                ),
                'update'=> array(
                    'label' => '',
                    //'visible'=>'$data->status != Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"] && $data->status != Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"]',
                    'options'=>array('class'=>'fa fa-pencil'),
                    'imageUrl' => ''
                ),
                /*'deactivate' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    'label' => '',
                    'visible'=>'$data->status != Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"]',
                    'url' => 'Yii::app()->createUrl("Embarcacoes/statusAnuncio", array("id"=>$data->id))',
                    'options'=>array('id'=>'btn_desativar','class'=>'fa fa-remove btn-change-status', 'data-status'=>Anuncio::$_status_anuncio['ANUNCIO_EXPIRADO']),
                ),*/
                'delete' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    //'label' => "deletar",
                    'visible'=>'$data->status != Anuncio::$_status_anuncio["ANUNCIO_DELETADO"]',
                    'url' => 'Yii::app()->createUrl("Embarcacoes/expirarAnuncio", array("embarcacoes_id"=>$data->id))',
                    'options'=>array('class'=>'fa fa-remove'),
                    'click'=>"function(e) {
                        e.preventDefault();

                        if (!confirm('Tem certeza que deseja realizar esta operação?')) return false;

                        $.ajax({
                            type:'GET',
                            url:$(this).attr('href'),
                                success:function(resp) {
                                    if(resp != '-1') {
                                        console.log(resp);
                                        return false;
                                        //$.fn.yiiGridView.update('embarcacoes-grid');
                                        //alert('Operação Realizada com sucesso.');
                                        //location.reload();
                                    }
                                    else {
                                        alert('Falha ao realizar a operação. Tente mais tarde.');
                                    }
                                }
                            });
                        return false;
                    }",
                ),
                'activate' => array (
                    'label' => '',
                    'visible'=>'$data->status != Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]',
                    'url' => 'Yii::app()->createUrl("Embarcacoes/statusAnuncio", array("id"=>$data->id))',
                    'options'=>array('id'=>'btn_ativar','class'=>'fa fa-check', 'data-status'=>Anuncio::$_status_anuncio['ANUNCIO_ATIVADO']),
                    'click'=>"function(e) {
                        e.preventDefault();

                        if (!confirm('Tem certeza que deseja realizar esta operação?')) return false;
                        
                        $.ajax({
                            type:'post',
                                url:$(this).attr('href'),
                                data: {status: $(this).data('status')},
                                success:function(resp) {
                                    if(resp != '-1') {

                                        $.fn.yiiGridView.update('embarcacoes-grid');
                                        alert('Operação Realizada com sucesso.');

                                    }
                                    else {
                                        alert('Falha ao realizar a operação. Tente mais tarde.');
                                    }
                                }
                            });
                        return false;
                    }",
                ),
                'turbinadas' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    'label' => 'Turbinar',
                    'visible' => '$data->status != Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"] && $data->status != Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"]',
                    'url' => 'Yii::app()->createUrl("embarcacoes/darTurbinadas", array("id"=>$data->id))',
                    'options'=>array('class'=>'ic-turbo pure-button'),
                ),
                
            )
        ),
    ),

));
?>

</div>

<script>
    $( document ).ajaxComplete(function() {
        $("td").each(function() {
            var td = $(this).text();

            if(validateEmail(td)) {

                var email = td; 
                var id_embarc = $(this).prev().prev().prev().prev().text();

                $(this).prev().prev().prev().css("word-wrap", "break-word");
                $(this).prev().prev().prev().css("max-width", "80px");

                $(this).empty();
                $(this).append("<a data-idembarc='"+id_embarc+"' class='email-minhaconta' href='#'>"+email+"</a>");

                
            }
        });

        $(".email-minhaconta").on("click", function(e) {
            e.preventDefault();
            var idembarc = $(this).data("idembarc");
            window.open(Yii.app.createUrl("usuarios/updateIndoPelaEmbarc", {id: idembarc}), '_blank'); 
        });
    });

    $(document).ready(function() {

        $("td").each(function() {
            var td = $(this).text();

            if(validateEmail(td)) {

                var email = td; 
                var id_embarc = $(this).prev().prev().prev().prev().text();

                $(this).prev().prev().prev().css("word-wrap", "break-word");
                $(this).prev().prev().prev().css("max-width", "80px");

                $(this).empty();
                $(this).append("<a data-idembarc='"+id_embarc+"' class='email-minhaconta' href='#'>"+email+"</a>");

                
            }
        });

        $(".email-minhaconta").on("click", function(e) {
            e.preventDefault();
            var idembarc = $(this).data("idembarc");
            window.open(Yii.app.createUrl("usuarios/updateIndoPelaEmbarc", {id: idembarc}), '_blank'); 
        }); 
    });

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>