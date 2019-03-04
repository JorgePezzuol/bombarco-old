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
            <span class="estatisticas-title">Caixa de mensagens</span>
            <a style="display:none;" id="excluir-msg" href="#"><i class="fa fa-trash pull-right" style="font-size:24px"></i></a>
        </div>
    </div>
</section>


<!-- estatísticas / só aparecem se o usuário ser o dono da embarcação -->
    <!--<section id="estatisticas">

        <?php
            /*$total_impressoes = number_format(Embarcacoes::totalizarImpressoesClassificados(Yii::app()->user->id)["impressoes"],0,",",".");
            $limite = number_format(Embarcacoes::totalizarImpressoesClassificados(Yii::app()->user->id)["limite"],0,",",".");
            $impressoes = $total_impressoes . "/" . $limite;*/
        ?>

        <div class="estatisticas-box">
            <div class="container">
                <div class="estatisticas-cell">
                    <span class="cell-title">Contatos</span>
                    <span class="cell-result"><?php //echo number_format(Embarcacoes::totalizarMensagens(Yii::app()->user->id, null,'anuncio'),0,",",".");?></span>
                </div>
                <div class="estatisticas-cell">
                    <span class="cell-title">Cliques:</span>
                    <span class="cell-result"><?php //echo number_format(Embarcacoes::totalizarCliques(Yii::app()->user->id, null,'anuncio'),0,",",".");?></span>
                </div>

                <div class="estatisticas-cell">
                    <span class="cell-title">Ver Telefone:</span>
                    <span class="cell-result"><?php //echo number_format(Embarcacoes::totalizarVerTelefone(Yii::app()->user->id),0,",",".");?></span>
                </div>

                <div class="estatisticas-cell">
                    <span class="cell-title">Impressões:</span>
                    <span class="cell-result"><?php //echo $impressoes;?></span>
                </div>

                <br class="clear">
                
            </div>
        </div>
    </section>-->

<section id="minha-conta-tabela">


    <!--<section id="estatisticas">

        <div class="estatisticas-line">
            <div class="container">
                <span class="estatisticas-title">Meus anúncios</span>
            </div>
        </div>
    </section>-->

<div class="container">

        <table id="tabela" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($mensagens as $index => $msg): ?>
                    <?php if($msg->embarcacoes_id == null && $msg->motor_anuncio_id == null): continue; endif; ?>
                    <tr data-id="<?php echo $msg->id; ?>">
                        <td class="text-center">
                            
                            <?php if($msg->embarcacoes_id != null): ?>
                                <?php $principal = EmbarcacaoImagens::obterImgPrincipal($msg->embarcacoes_id); ?>
                                <?php $caminho = Yii::app()->request->baseUrl . '/public/embarcacoes/'; ?>
                            <?php else: ?>
                                <?php $principal = MotorAnuncio::obterImgPrincipal2($msg->motor_anuncio_id); ?>
                                <?php $caminho = Yii::app()->request->baseUrl . '/public/motores/'; ?>
                            <?php endif; ?>

                            <?php if ($principal != null): ?>

                                <?php $imagem = $caminho . $principal; ?>

                                <img class="rounded mx-auto d-block img-thumbnail" src="<?php echo $imagem; ?>"/>

                            <?php else: ?>

                                <?php $imagem = Yii::app()->request->baseUrl . '/img/sem_foto_bb.jpg'; ?>

                                <img class="rounded mx-auto d-block img-thumbnail" src="<?php echo $imagem; ?>" />

                            <?php endif; ?>

                        </td>
                        <td class="text-center td-email">
                            <?php echo $msg->email_rem; ?>
                        </td>

                        <td class="text-center">
                            <?php if($msg->embarcacoes_id != null): ?>
                                <?php echo Embarcacoes::getAlt2($msg->embarcacoes_id); ?>
                            <?php else: ?>
                                <?php echo MotorAnuncio::nomeAnuncio2($msg->motor_anuncio_id); ?>
                            <?php endif; ?>
                        </td>
                        <td class="text-center td-mensagem responder" style="white-space: nowrap;" data-id="<?php echo $msg->id;?>">
                            <span class="mensagem-full" style="display:none;"><?php echo $msg->mensagem; ?></span>
                            <?php 

                              if(strlen($msg->mensagem) <= 50)
                              {
                                echo $msg->mensagem;
                              }
                              else
                              {
                                $y = substr($msg->mensagem, 0, 50) . '...';
                                echo $y;
                              } 

                            ?>
                                
                        </td>
                        <td class="text-center td-data"><?php echo Utils::formatDateTimeToView($msg->data); ?></td>
                        <td>
                            <?php if($msg->status == 0): ?>
                                <a href="#" data-id="<?php echo $msg->id;?>" class="responder"><i class="fa fa-envelope" style="font-size:24px"></i></a>
                                <span style="display:none;">não lidas</span>
                                
                            <?php else: ?>
                                <i data-id="<?php echo $msg->id;?>" class="fa fa-envelope-open responder" style="font-size:24px"></i>
                                <span style="display:none;">lidas</span>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</div>

</section>

<!-- lightboxess -->

            <div class="modal fade" id="mensagem01" tabindex="-1" role="dialog" aria-labelledby="popupLogin" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="popupLogin"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <span class="titulo-modal">Mensagem</span>
                    <div class="limita-mensagens" style="height: 150px !important;" id="div-conversa">
                    </div>
                    <!--<div class="row"><hr/></div>-->
                    <span class="titulo-modal">Sua resposta</span>
                    <textarea id="msg">Digite aqui sua resposta.</textarea>
                  </div>
                  <div class="modal-footer">
                    <a href="#" id="btn-responder" class="btn btn-verde-claro w-65"><span class="pull-left">Enviar </span><i class="fa fa-check pull-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

<div class="lbox-ag" id="lbox-confirmacao" style="width: 580px !important;">
    <div class="texts-lbox-ag">
        <input type="button" id="close" class="fechar-form close" value="X">
        <div>
            <span id="texto_lightbox" class="ev-titleb" style="width: 530px !important;">Ao efetuar esta operação seu anúncio deixará de aparecer nas buscas do Bombarco. Confirmar?</br></span>
        </div>
    </div>

    <input type="button" style="margin-left:210px; margin-top:40px;" class="botao-lb-form-msgok" id="btn-confirmar" value="OK">

    <input type="hidden" id="deletar-ids"/>
    <input type="hidden" id="id-responder"/>

</div>

<!-- fim lightboxes -->

<style>
td, tr {
    cursor: pointer !important;
        white-space: nowrap;
    font-size: 13px;
    font-weight: bolder;
}
.modal-body {
    padding: 0 2em;
}
.modal-header {
    border: none;
}
.titulo-modal {
    border-top: 0;
    color: #00918e;
    padding-bottom: .5em;
    font-weight: 600;
    display: block;
}
.limita-mensagens {
    height: 250px;
    overflow-y: auto;
    padding: 15px;
}
.modal-body textarea {
    clear: both;
    display: block;
    margin: 1em 0;
    width: 100%;
    border: 1px solid #DDD;
    border-radius: 5px;
    padding: 1em;
    height: 130px;
    overflow-y: auto;
}
.modal-footer {
    padding: 1em 2em 2em;
}
.btn-verde-claro {
    background: #98cc47;
    color: #FFF;
    font-weight: bold;
    padding: 15px;
    font-size: 18px;
    border: 2px solid #98cc47;
    text-align: left;
    min-width: 200px;
    line-height: 24px;
}
.btn-verde:hover, .btn-verde:active, .btn-verde:focus, .btn-verde-claro:hover, .btn-verde-claro:focus {
    background: #102e46;
    border-color: #102e46;
    color: #FFF;
}
</style>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/datatable.css?e=1'); ?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap.min.css?e=1'); ?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css?e1');?>


<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-3.2.1.min.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap.min.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable.min.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable.select.js'); ?>






<script>
$(document).ready(function () {


    var $id = getUrlParameter("e");

    console.log($id);
    
    if($id != null) {

        setTimeout(function() {
            $('td[data-id='+$id+']').trigger("click");
        }, 350);
        
    }

    $(".responder").on("click", function(e) {

        e.preventDefault();

        $("#mensagem01").modal();

        if($(this).hasClass("td-mensagem")) {
            var msg = $(this).parent().find(".mensagem-full").text();
            var data = $(this).parent().find(".td-data").html();
            var email = $(this).parent().find(".td-email").html();
        }
        else {
            var msg = $(this).parent().parent().find(".mensagem-full").text();
            var data = $(this).parent().parent().find(".td-data").html();
            var email = $(this).parent().parent().find(".td-email").html();
        }
        

        $("#div-conversa").empty();

        $("#div-conversa").append('<p>'+msg+'</p><span class="autor-modal"><b style="font-weight:bolder;">'+email+'</b></span> <small style="font-size: 80%;">'+data+'</small><div class="row"></div></div>');

        $("#id-responder").val($(this).data("id"));
        
    });

    $("#btn-responder").on("click", function(e) {

        e.preventDefault();

        $.ajax({
            url: Yii.app.createUrl("contatos/responder"),
            type: "POST",
            data: {
                id: $("#id-responder").val(),
                msg: $("#msg").val()
            },
            success: function(resp) {

                if(resp.trim() == 1) {
                    setTimeout(function() { 
                        alert("Mensagem enviada com sucesso!");
                        location.href = "https://www.bombarco.com.br/contatos/mensagens?e="+Math.random();
                    }, 300);
                }
                else {
                    alert("Erro inesperado. Contate o admin do site");
                }
            },
            error: function(x, h, z) {
                alert("Erro inesperado. Contate o admin do site");
            },
            beforeSend(xhr, e) {
                if($("#msg").val() == "") {
                    xhr.abort();
                }
            }
        });
    });

    $("#excluir-msg").on("click", function(e) {
        e.preventDefault();

        var s = confirm("Confirmar?");

        if(s) {

            $.ajax({
                url: Yii.app.createUrl("contatos/excluirMsgs2"),
                data: {
                    ids: $("#deletar-ids").val()
                },
                type: "POST",
                success: function(resp) {

                    if(resp.trim() == 1) {
                        setTimeout(function() { 
                            location.href = "https://www.bombarco.com.br/contatos/mensagens?e="+Math.random();
                        }, 300);
                    }
                    else {
                        alert("Erro inesperado. Contate o admin do site");
                    }
                },
                error: function(x, h, z) {

                    alert("Erro inesperado. Contate o admin do site");
                }
            });
        }
    });

    $('#tabela tbody').on( 'click', 'tr', function () {      

        var id = $(this).data("id");

        if (!$(this).hasClass('selected')) {
            
            if($("#deletar-ids").val() == "") {
                $("#deletar-ids").val(id);
            }
            else {
                var ids = $("#deletar-ids").val();
                ids = ids + "|" +id;
                $("#deletar-ids").val(ids);
            }
        }
        else {
            $("#deletar-ids").val().split(id).pop();
        }

        setTimeout(function() {

            if($(".selected").length > 0) {
                $("#excluir-msg").show();    
                    
                }
            else {
                $("#excluir-msg").hide();
            }
        }, 200);

    }); 

    var tabela = $('#tabela').DataTable({
        pageLength: 10,
        select: true,
        select: {
            style: 'multi'
        },
        "language": {
            "url": "https://www.bombarco.com.br/datatables.json"
        },
        initComplete: function( settings, json ) {
            setTimeout(function() {
                $("#tabela_filter").append("<br/><small style='font-weight:bolder;'>(Você pode pesquisar por 'lidas' ou 'não lidas' no campo acima)</small>");
            }, 1000);
        }
    });





});
</script>
