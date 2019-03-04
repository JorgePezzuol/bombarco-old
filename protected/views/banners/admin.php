<?php
    
    // tive q criar isso pra burlar o cbuttoncolumn do yii q n deixava
    // eu por no data o id e titulo do banner p aparecer no modal e gerar relatorio
    function retornaIdTitulo($id, $titulo) {
        return $id . "|" . $titulo;
    }
?>


<div class="line-admin-top2">
  <h1 class="title-admin-form">Gerenciar Banners</h1>
  <?php echo CHtml::link('CADASTRAR BANNER', array('admin/banners/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>




<!-- Modal relatorio -->
<button style="display:none;" id="botao_modal" data-toggle="modal" data-target="#relatorio_modal" class="btn btn-primary center-block">Click Me</button>
    
<!-- recebe o id e o titulo do banner ao clicar p gerar relatorio -->
<input type="hidden" id="banners_id"/>
<input type="hidden" id="hidden_titulo"/>

<div class="modal fade" id="relatorio_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="titulo_modal">Relatório de banner</h3>
        </div>

        <div class="modal-body">
            
            <!-- content goes here -->
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">De</label>
                <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'name'=>'Banners[inicio]',
                            'id'=>'de',
                            'options'=>array(
                                'dateFormat'=>'dd/mm/yy',
                                'timeFormat'=>'hh:mm:ss'
                            ),
                            'language'=> 'pt-BR',
                            'htmlOptions'=>array(
                                'style'=>'',
                                'class'=>'campo-admin-form form-control',
                            ),

                        ));
                    ?>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Até</label>
                <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'name'=>'Banners[fim]',
                            'id'=>'ate',

                            'options'=>array(
                                'dateFormat'=>'dd/mm/yy',
                                'timeFormat'=>'hh:mm:ss'
                            ),
                            'language'=> 'pt-BR',
                            'htmlOptions'=>array(
                                'style'=>'',
                                'class'=>'campo-admin-form form-control'
                            ),

                        ));
                    ?>
              </div>
            </form>

            <div style="display:none;" id="div_relatorio">
                <i class="fa fa-eye" aria-hidden="true"></i>
                <span>Total de visualizações: <b id="total_views"></b></span>
                <br/>
                <i style="margin-left:3px;" class="fa fa-hand-o-up" aria-hidden="true"></i>
                <span>Total de clicks: <b id="total_clicks"></b></span>
            </div>
            
        </div>
        <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Fechar</button>
                </div>
                <div class="btn-group btn-delete hidden" role="group">
                    <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal" role="button">Delete</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="btn-relatorio" class="btn btn-success btn-hover-green btn-relatorio" role="button">Gerar Relatório</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- fim modal relatorio -->


<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'banners-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'itemsCssClass' => "table table-bordered table-hover",
    'columns' => array(
        array(
                'header' => "Categoria",
                'name'=>'embarcacao_macros_id',
                'value'=>'GxHtml::valueEx($data->embarcacaoMacros)',
                'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
                ),
        array(
            'header' => 'Nome',
            'name' => 'titulo'

        ),
        /*array(
                'name'=>'usuarios_id',
                'value'=>'GxHtml::valueEx($data->usuarios)',
                //'filter'=>GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)),
                ),*/
        array(
            'header' => 'Banner fechado',
            'type'=>'html',
            'visible' => '$data->imagem != ""',
            'value' => function($data) { 

                if($data->imagem != "") {
                    return CHtml::link("Ver imagem", Yii::app()->baseUrl . '/' . Banners::PATH . '/' . $data->imagem, array('target'=>'_blank'));
                }

            },
            'filter' => false,
        ),
        array(
            'header' => 'Banner aberto',
            'type'=>'html',
            'value' => function($data) { 

                if($data->imagem_topo != "") {
                   return CHtml::link("Ver imagem", Yii::app()->baseUrl . '/' . Banners::PATH . '/' . $data->imagem_topo, array('target'=>'_blank')); 
                }
                
            },
            'filter' => false,
        ),
        array(
            'name'=>'cliques',
             'filter' => false,
             'value' => function($data) {

                $sql = "SELECT COUNT(*) FROM banners_clicks WHERE banners_id = ".$data->id;
                $num_clicks = Yii::app()->db->createCommand($sql)->queryScalar();

                return $num_clicks;
                //return count(BannersClicks::model()->findAll("banners_id=:banners_id", array(":banners_id"=>$data->id)));
                
             }
        ),
        array(
            'name' => 'views',
            'header' => 'Visualizações',
            'filter'=> false,
            'value' => function($data) {

                $sql = "SELECT COUNT(*) FROM banners_views WHERE banners_id = ".$data->id;
                $num_views = Yii::app()->db->createCommand($sql)->queryScalar();
                
                return $num_views;
                //return count(BannersViews::model()->findAll("banners_id=:banners_id", array(":banners_id"=>$data->id)));

             }
        ),
        array('name'=>'inicio', 'value'=>'Yii::app()->dateFormatter->format(\'dd/MM/yyyy\', $data->inicio)', 'filter'=>false),
        array('name'=>'fim', 'value'=>'Yii::app()->dateFormatter->format(\'dd/MM/yyyy\', $data->fim)', 'filter'=>false),
        array(
            'name' => 'status',
            'value' => '($data->status == 0) ? "Desativado" : "Ativado"',
            'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Ações',
            'template' => '{activate}{pause}{update}{del} {report}',
            'buttons' => array(
                'update' => array(
                    'options' => array('class' => "fa fa-pencil"),
                    'url' => 'Yii::app()->createUrl("admin/banners/editar/{$data->id}")'
                ),
                'activate' => array(
                    'label' => '<i class="fa fa-check"></i>',
                    'visible' => '$data->status == 0',
                    'url' => 'Yii::app()->createUrl("banners/changeStatus", array("id"=>$data->id))',
                    'click' => "function() {
                        if(!confirm('" . Yii::t('warnings', 'Confirme para alterar o status do banner') . "')) return false;
                            $.ajax({
                            type:'GET',
                            url:$(this).attr('href'),
                                success:function(resp) {

                                    if(resp.trim() == '1') {
                                        alert('Status do banner alterado com sucesso');
                                        //location.reload();
                                        $.fn.yiiGridView.update('banners-grid');
                                    }

                                    else {
                                        alert('Falha alterar o status do banner. Tente mais tarde.');
                                    }
                                },

                                error:function(x, h,z) {
                                    alert('Falha alterar o status do banner. Tente mais tarde.');
                                }
                            });
                            return false;
                        }",
                ),
                'pause' => array(
                    'label' => '<i class="fa fa-pause"></i>',
                    'visible' => '$data->status == 1',
                    'url' => 'Yii::app()->createUrl("banners/changeStatus", array("id"=>$data->id))',

                     'click' => "function() {
                        if(!confirm('" . Yii::t('warnings', 'Confirme para alterar o status do banner') . "')) return false;
                            $.ajax({
                            type:'GET',
                            url:$(this).attr('href'),
                                success:function(resp) {

                                    if(resp.trim() == '1') {
                                        alert('Status do banner alterado com sucesso');
                                        //location.reload();
                                        $.fn.yiiGridView.update('banners-grid');
                                    }

                                    else {
                                        alert('Falha alterar o status do banner. Tente mais tarde.');
                                    }
                                },

                                error:function(x, h,z) {
                                    alert('Falha alterar o status do banner. Tente mais tarde.');
                                }
                            });
                            return false;
                        }",
                ),
                'del' => array(
                    'label' => '<i class="fa fa-remove"></i>',
                    'url' => 'Yii::app()->createUrl("banners/delete", array("id"=>$data->id))',

                     'click' => "function() {
                        if(!confirm('" . Yii::t('warnings', 'Confirme para deletar o banner') . "')) return false;
                            $.ajax({
                            type:'GET',
                            url:$(this).attr('href'),
                                success:function(resp) {

                                    if(resp.trim() == '1') {
                                        alert('Banner deletado com sucesso');
                                        //location.reload();
                                        $.fn.yiiGridView.update('banners-grid');
                                    }

                                    else {
                                        alert('Falha ao deletar o banner. Tente mais tarde.');
                                    }
                                },

                                error:function(x, h,z) {
                                    alert('Falha ao deletar o banner. Tente mais tarde.');
                                }
                            });
                            return false;
                        }",
                ),
                'report' => array(
                    'label' => '<i class="fa fa-file-text-o"></i>',
                    // fazemos isso soh pra pegar o ID e titulo logo abaixo no href
                    'url' => 'retornaIdTitulo($data->id, $data->titulo)',

                    'click' => "function(e) {
                        
                        e.preventDefault();

                        var explode = $(this).attr('href').split('|');
                        $('#banners_id').val(explode[0]);

                        if(explode[1] != '') {
                            $('#titulo_modal').text('Relatório - '+explode[1]);
                        }   
                        else {
                            $('#titulo_modal').text('Relatório de banner');
                        }

                        $('#div_relatorio').hide();
                        $('#botao_modal').trigger('click');

                    }",
                ),
            )
        ),

    ),
)); ?>


<script>
    $(document).ready(function() {

        $("#btn-relatorio").on("click", function(e) {

            e.preventDefault();

            var banners_id = $("#banners_id").val();
            var de = $("#de").val();
            var ate = $("#ate").val();

            $.ajax({
                url: Yii.app.createUrl("relatorios/relatorioDeBanner"),
                data: {
                    banners_id: banners_id,
                    de: de,
                    ate: ate
                },
                type: "POST",
                success: function(resp) {
                    var json = JSON.parse(resp);
                    $("#total_views").text(json.views);
                    $("#total_clicks").text(json.clicks);
                    $("#div_relatorio").show();
                },
                error: function(x, h, z) {

                }
            });
        });
    });
</script>
