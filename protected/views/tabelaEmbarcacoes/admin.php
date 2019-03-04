<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_tabela_embarcacoes_v2.js?222', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.css');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/js/scripts.js?"'.microtime(), CClientScript::POS_END);

?>


  <div class="container-fluid">
    <h1 class="title-admin-form">Tabela de Embarcações</h1>
    <?php echo CHtml::link('CADASTRAR EMBARCAÇÃO', array('tabelaEmbarcacoes/create'), array('class'=>'botao-cad-admin btn btn-primary'));?>
    <!--<button id="btn-sumario" class="btn btn-success">IMPORTAR PLANILHA</button>-->
  


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'tabela-embarcacoes-grid',
    'dataProvider' => $model->search(),
  	'itemsCssClass' => "table table-bordered table-hover",
    'filter' => $model,
    'columns' => array(
        'id',
        'ano',
        array(
            'name' => 'valor',
            'value' =>'($data->valor == "0.00") ? "Não informado" : "R$ ".number_format($data -> valor, 2, ",", ".")',
            'filter' => array(-1 => 'Todos', 0 => 'Ordenar por maior preço', 1 => 'Ordenar por menor preço'), 
        ),
        array(
                'name'=>'embarcacao_fabricantes_id',
                'value'=>'GxHtml::valueEx($data->embarcacaoFabricantes)',
                'filter'=>GxHtml::listDataEx(EmbarcacaoFabricantes::listarFabricantesTabela()),
        ),
        array(
                'name'=>'embarcacao_modelos_id',
                'value'=>'GxHtml::valueEx($data->embarcacaoModelos)',
                'filter'=>GxHtml::listDataEx(EmbarcacaoModelos::listarModelosTabela()),
        ),

        /*array(
                'name'=>'embarcacao_macros_id',
                'value'=>'$data->embarcacaoMacros->titulo',
                'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
                ),*/
        'pes',
        'qtdemotores',
        'potenciamotor',
        array(
                'name'=>'motor_tipos_id',
                'value'=>'GxHtml::valueEx($data->motorTipos)',
                'filter'=>GxHtml::listDataEx(MotorTipos::model()->findAllAttributes(null, true)),
        ),

        array(
                'name'=>'motor_modelos_id',
                'value'=>'GxHtml::valueEx($data->motorModelos)',
                'filter'=>GxHtml::listDataEx(MotorModelos::model()->findAllAttributes(null, true)),
        ),
         array(
                'name'=>'motor_fabricantes_id',
                'value'=>'GxHtml::valueEx($data->motorFabricantes)',
                'filter'=>GxHtml::listDataEx(MotorFabricantes::model()->findAllAttributes(null, true)),
        ),


        array(
            'class' => 'CButtonColumn',
            'buttons' => array(
              'view' => array('options' => array('class' => 'fa fa-search')),
              'update' => array('options' => array('class' => 'fa fa-pencil')),
              'delete' => array('options' => array('class' => 'fa fa-trash'))
            )
        ),
    ),
)); ?>

<br/><br/>


<div id="div-import" class="container">
    <span id="sumario_modelos_nao_achados"></span>

</div>
<input style="display: none;" name="arquivo-planilha" id="arquivo-planilha" type="file">
<input type="hidden" id="nome_planilha" />

</div>

<script>
    

    $(document).ready(function() {


        $("#btn-sumario").on("click", function(e) {

            e.preventDefault();

            $("#arquivo-planilha").trigger("click");

        });


        $("body").on("click", ".btn-salva-registros", function() {

            $.confirm({
                title: 'Importação tabela BB!',
                content: 'Deseja continuar com a importação da planilha? OBS: Não há opção de volta caso opte por confirmar',
                confirm: function() {
                    
                    $.ajax({
                        url: Yii.app.createUrl("teste/importTabela"),
                        data: {
                            operacao: "gravar-registros",
                            nome_planilha: $("#nome_planilha").val()
                        },
                        type: "POST",
                        success: function(resp) {

                            console.log(JSON.parse(resp));

                            $.alert({
                                title: 'Sucesso!',
                                content: 'Sucesso ao importar os registros da tabela'
                            });
                            location.reload();
                        },
                        error: function(x, h, z) {

                            $.alert({
                                title: 'Erro',
                                content: 'Erro inesperado. Tente novamente mais tarde'
                            });
                        }
                    });
                },
                cancel: function() {

                }
            });
        });


        $('#arquivo-planilha').on("change", function () {

            var nome = $(this)[0].files[0].name;

            var fd = new FormData();
            fd.append("planilha", $(this)[0].files[0]);

            var flgok = false;
            console.log(flgok);
            $.ajax({
                url: Yii.app.createUrl('teste/salvarPlanilha'),
                type: 'POST',
                cache: false,
                data: fd,
                processData: false,
                contentType: false,
                async: false,
                success: function (resp) {

                    console.log(resp);
                    if(resp != "") {
                        $("#nome_planilha").val(resp.trim());
                        flgok = true;
                    }
                    /*if (resp.trim() == "-1") {
                       alert("Foto não permitida ou ultrapassou o limite! Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Prefira Imagens na horizontal.");
                    }

                    else {

                        flgok = true;
                        $("#logoimagem").attr("src", Yii.app.createUrl('public/usuarios/' + resp.trim()));

                    }*/


                },
                error: function (x, h, z) {
                    
                        $.alert({
                            title: 'Erro',
                            content: 'Erro inesperado. Tente novamente mais tarde'
                        });
                }
            });

            if(flgok) {

                $.ajax({
                    url: Yii.app.createUrl("teste/importTabela"),
                    data: {
                        operacao: "sumario",
                        nome_planilha: $("#nome_planilha").val()
                    },
                    type: "POST",
                    success: function(resp) {

                        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
                        $("#sumario_modelos_nao_achados").empty();
                        $("#sumario_modelos_nao_achados").append(resp);

                        var btn_importar = $("<button class='btn btn-salva-registros btn-success'>CONFIRMAR IMPORTAÇÃO</button>");

                        $("#div-import").append("<br/><br/><br/>");
                        $("#div-import").append(btn_importar);

                    },
                    error: function(x, h,z ) {

                        $.alert({
                            title: 'Erro',
                            content: 'Erro inesperado. Tente novamente mais tarde'
                        });
                    }
                });
            }
        });
    });
</script>