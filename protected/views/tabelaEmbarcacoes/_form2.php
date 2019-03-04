<?php
// incluir extensão que faz o edit inline no grid

Yii::app()->getComponent("booster");
Yii::app()->getComponent("editable");

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/js/scripts.js?"'.microtime(), CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_tabela_embarcacoes_v2.js?'.microtime(), CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);

echo '<div id="limita" class="form" style="margin-top:80px;">';

$this->widget('booster.widgets.TbEditableDetailView', array(
    'id' => 'cad_tabela_embarc',
    'data' => $model,
    'url' => $this->createUrl('user/update'),  //common submit url for all editables
    'attributes'=>array(
        array(  //select loaded from database
            'name' => 'embarcacao_macros_id',
            'editable' => array(
                'type' => 'select',
                'mode'=>'popup',
                'source' => Editable::source(EmbarcacaoMacros::model()->findAll(':status=:status',array(':status'=>1)), 'id', 'titulo'),
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }
                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {

                    $("#embarcacao_macros_id").val(params.newValue);
                
                }',
                'htmlOptions'=>array('id'=>'embarc_macros_id'),
             )
        ),
        array(  //select loaded from database
            'name' => 'embarcacao_fabricantes_id',
            'editable' => array(

                'type' => 'select',
                'mode'=>'popup',
                'source' => 'js: function() {

                    var json;
                    var select = [];

                    $.ajax({

                        url: Yii.app.createUrl("utils/loadFabricantesEmbarcacoes"),
                        data: { embarcacao_macros_id: $("#embarcacao_macros_id").val() },
                        type: "POST",
                        async: false,
                        success: function(resp) {
                                
                            json = JSON.parse(resp);

                        }
                    });
                    
                    for(var i = 0; i < json.length; i++) {
                        var obj_json = {};
                        obj_json.value = json[i].id;
                        obj_json.text = json[i].titulo;
                        select.push(obj_json);
                    }

                    return select;
                }',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        
                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {
                    e.preventDefault();
                    $("#embarcacao_fabricantes_id").val(params.newValue);
                    
                }',
                'htmlOptions'=>array('id'=>'embarc_fabricante'),
                
             )
        ),
        array(  //select loaded from database
            'name' => 'embarcacao_modelos_id',
            'editable' => array(
                'type' => 'select',
                //'emptytext' => 'Text for empty/null value',
                'mode'=>'popup',
                'source'=> 'js: function() {

                    var fabricante_id = $("#embarcacao_fabricantes_id").val();
                    var json;
                    var modelos = [];
                    
                    $.ajax({
                        url: Yii.app.createUrl("embarcacaoModelos/ajaxFromFabricante"),
                        async: false,
                        data: {
                            fabricante_id: fabricante_id
                        },
                        type: "POST",
                        success: function(resp) {
                            
                            json = JSON.parse(resp);

                        }
                    });

                    for(var i = 0; i < json.length; i++) {
                        var mod = {};
                        mod.value = json[i].id;
                        mod.text = json[i].titulo;
                        modelos.push(mod);
                    }

                    return modelos;
                }',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {

                    $("#embarcacao_modelos_id").val(params.newValue);
                    var pk = params.newValue;

                    // ajax atualizar pes
                    $.ajax({
                        url: Yii.app.createUrl("embarcacaoModelos/AJAXModelo"),
                        data: {
                            modelo_id: pk
                        },
                        type: "POST",
                        async: false,
                        success: function(resp) {
                            
                            var json = JSON.parse(resp);
                            $("#pes").val(json.tamanho);
                            $("#pes_editable").editable("setValue", json.tamanho);
                        }
                    });
                }'
             )
        ),
        array(  //select loaded from database
            'name' => 'pes',
            'editable' => array(
                'type' => 'text',
                'mode'=>'popup',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        
                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {
                    $("#pes").val(params.newValue);
                }',
                'htmlOptions'=>array('id'=>'pes_editable'),
             )
        ),

        array(  //select loaded from database
            'name' => 'ano',
            'editable' => array(
                'type' => 'text',
                'mode'=>'popup',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        
                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {
                    $("#ano").val(params.newValue);
                }',
                'htmlOptions'=>array('id'=>'ano_editable'),

             )
        ),
        array(  //select loaded from database
            'name' => 'valor',
            'editable' => array(
                'type' => 'text',
                'inputclass' => 'valor',
                'mode'=>'popup',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        
                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {
                    $("#valor").val(params.newValue);
                }',
                'onShown' => 'js: function() {
                    $(".valor").priceFormat({
                        prefix: "",
                        centsSeparator: ",",
                        thousandsSeparator: ".",
                        clearPrefix: true
                    });
                }'
             )
        ),



        array(  //select loaded from database
            'name' => 'qtdemotores',
            'editable' => array(
                'type' => 'text',
                'mode'=>'popup',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        
                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {
                    $("#qtdemotores").val(params.newValue);
                }'
             )
        ),


        array(  //select loaded from database
            'name' => 'motor_fabricantes_id',
            'editable' => array(
                'type' => 'select',
                'mode'=>'popup',
                'source' => Editable::source(MotorFabricantes::model()->findAll(':status=:status',array(':status'=>1)), 'id', 'titulo'),
                'onSave' => 'js: function(e, params) {
                    $("#motor_fabricantes_id").val(params.newValue);
                }',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        
                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }'
             )
        ),
        array(  //select loaded from database
            'name' => 'motor_modelos_id',
            'editable' => array(
                'type' => 'select',
                'mode'=>'popup',
                'source' => 'js: function() {

                    var motor_fabricantes_id = $("#motor_fabricantes_id").val();
                    var json;
                    var modelos = [];
                    
                    $.ajax({
                        url: Yii.app.createUrl("utils/loadMotorModelos"),
                        async: false,
                        data: {
                            motor_fabricantes_id: motor_fabricantes_id
                        },
                        type: "POST",
                        success: function(resp) {
                            
                            json = JSON.parse(resp);

                        }
                    });

                    for(var i = 0; i < json.length; i++) {
                        var mod = {};
                        mod.value = json[i].id;
                        mod.text = json[i].titulo;
                        modelos.push(mod);
                    }

                    return modelos;
                }',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {

                        
                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       //$(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {
                    $("#motor_modelos_id").val(params.newValue);

                    // buscar potencia
                    $.ajax({
                        url: Yii.app.createUrl("utils/loadPotenciaTipoMotor"),
                        data: {
                            id_modelo_motor: params.newValue
                        },
                        type: "POST",
                        async: false,
                        success: function(resp) {

                            var json = JSON.parse(resp);

                            if(json != null) {

                                $("#potenciamotor").val(json.potencia);
                                $("#editable_potenciamotor").editable("setValue", json.potencia);
                                
                                $("#motor_tipos_id").val(json.tipo_id);
                                $("#editable_tipo_motor").editable("setValue", json.tipo_id);
                            }
                        }
                    });
                }' 
             )
        ),
        array(  //select loaded from database
            'name' => 'motor_tipos_id',
            'editable' => array(
                'type' => 'select',
                'mode'=>'popup',
                'source'    => Editable::source(MotorTipos::model()->findAll(':status=:status',array(':status'=>1)), 'id', 'titulo'),
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {
                
                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {

                    $("#motor_tipos_id").val(params.newValue);
                
                }',
                'htmlOptions'=>array('id'=>'editable_tipo_motor')

             )
        ),
        array(  //select loaded from database
            'name' => 'potenciamotor',
            'editable' => array(
                'type' => 'text',
                'mode'=>'popup',
                'onHidden' => 'js: function(e, reason) {
                   if(reason === "save" || reason === "cancel") {
                        

                        if(reason === "cancel") {
                            $(this).editable("setValue", null);
                        }

                       //auto-open next editable
                       $(this).closest("tr").next().find(".editable").editable("show");
                   }
                }',
                'onSave' => 'js: function(e, params) {
                    $("#potenciamotor").val(params.newValue);
                }',
                'htmlOptions'=>array('id'=>'editable_potenciamotor')
             )
        ),
    )
));

echo '<br/></br>';
// salvar novo registro de tabela
echo '<a id="btn-salvar" class="botao-cad-admin btn btn-primary" href="#">SALVAR</a>';
echo '<br/><br/><br/>';
echo '<div id="sucesso" style="display:none;" class="aviso aviso-sucesso"></div>';
echo '<div id="erro" style="display:none;" class="aviso aviso-erro"></div>';

// usar esses hiddens pra armazenar o cadastro de novas embarcs na tabela
echo '<form id="form_ajax">';
echo '<input type="hidden" name="TabelaEmbarcacoes[embarcacao_macros_id]" id="embarcacao_macros_id"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[embarcacao_fabricantes_id]" id="embarcacao_fabricantes_id"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[embarcacao_modelos_id]" id="embarcacao_modelos_id"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[ano]" id="ano"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[valor]" id="valor"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[pes]" id="pes"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[qtdemotores]" id="qtdemotores"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[potenciamotor]" id="potenciamotor"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[motor_tipos_id]" id="motor_tipos_id"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[motor_fabricantes_id]" id="motor_fabricantes_id"/>';
echo '<input type="hidden" name="TabelaEmbarcacoes[motor_modelos_id]" id="motor_modelos_id"/>';
echo '</form>';


?>


