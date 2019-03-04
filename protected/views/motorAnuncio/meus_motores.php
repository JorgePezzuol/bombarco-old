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
            <span class="estatisticas-title">Motores</span>
        </div>
    </div>
</section>



    <section id="estatisticas">

        <?php
            /*$total_impressoes = number_format(Embarcacoes::totalizarImpressoesClassificados(Yii::app()->user->id)["impressoes"],0,",",".");
            $limite = number_format(Embarcacoes::totalizarImpressoesClassificados(Yii::app()->user->id)["limite"],0,",",".");
            $impressoes = $total_impressoes . "/" . $limite;*/
        ?>

        <div class="estatisticas-box">
            <div class="container">
                <div class="estatisticas-cell">
                    <span class="cell-title">Contatos</span>
                    <span class="cell-result"><?php echo MotorAnuncio::totalizarMensagens(Yii::app()->user->id);?></span>
                </div>
                <div class="estatisticas-cell">
                    <span class="cell-title">Cliques:</span>
                    <span class="cell-result"><?php echo MotorAnuncio::totalizarCliques(Yii::app()->user->id);?></span>
                </div>

                <div class="estatisticas-cell">
                    <span class="cell-title">Ver Telefone:</span>
                    <span class="cell-result"><?php echo MotorAnuncio::totalizarVerTelefone(Yii::app()->user->id);?></span>
                </div>

                <!--<div class="estatisticas-cell">
                    <span class="cell-title">Impressões:</span>
                    <span class="cell-result"><?php //echo $impressoes;?></span>
                </div>-->

                <br class="clear">
                
            </div>
        </div>
    </section>

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
                    <th>Id</th>
                    <th></th>
                    <th class="text-center">Marca</th>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Potência</th>
                    <th class="text-center">Ano</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Status</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($motores as $index => $motor): ?>
                    <tr>
                        <td class="text-center"><?php echo $motor->id; ?></td>
                        <td class="text-center">
                            
                            <?php $principal = MotorAnuncio::obterImgPrincipal($motor); ?>

                            <?php if ($principal != null): ?>

                                <?php $imagem = Yii::app()->request->baseUrl . '/public/motores/' . $principal; ?>

                                <img style="width: 50%;" class="rounded mx-auto d-block img-thumbnail" src="<?php echo $imagem; ?>"/>

                            <?php else: ?>

                                <?php $imagem = Yii::app()->request->baseUrl . '/img/sem_foto_bb.jpg'; ?>

                                <img style="width: 50%;" class="rounded mx-auto d-block img-thumbnail" src="<?php echo $imagem; ?>" />

                            <?php endif; ?>

                        </td>
                        <td class="text-center"><?php echo $motor->motorFabricantes->titulo; ?></td>
                        <td class="text-center"><?php echo $motor->motorTipos->titulo; ?></td>
                        <td class="text-center"><?php echo $motor->potencia; ?></td>
                        <td class="text-center"><?php echo $motor->ano; ?></td>
                        <td class="text-center">
                            <?php if (empty($motor->valor) || $motor->valor == '0.00'): ?>
                                R$ não informado
                            <?php else: ?>
                                <?php echo 'R$ ' . Utils::formataValorView((float) $motor->valor); ?>
                            <?php endif; ?>                                
                        </td>
                        <td class="text-center"><?php echo $motor->estado = ('U') ? 'Usado' : 'Novo'; ?></td>
                        <td style="font-weight:bolder;" class="text-center"><?php echo Anuncio::$_status_anuncio_by_number[$motor->status]; ?></td>

                        <td class="text-center">
                            <a target="_blank" href="<?php echo MotorAnuncio::gerarLinkAbsoluto($motor); ?>"><i class="fa fa-search" style="font-size:24px"></i></a>
                        </td>

                        <td>
                            <a target="_blank" href="<?php echo Yii::app()->createUrl('motorAnuncio/update', array('id'=>$motor->id)); ?>"><i class="fa fa-pencil" style="font-size:24px"></i></a>
                        </td>

                        <td class="text-center">
                            <?php if($motor->status == Anuncio::$_status_anuncio["ANUNCIO_DELETADO"]): ?>
                                <a style="opacity: 0.1;" href="#"><i class="fa fa-trash" style="font-size:24px"></i></a>
                            <?php else: ?>
                                <a class="btn-excluir" data-id="<?php echo $motor->id; ?>" href="#"><i class="fa fa-trash" style="font-size:24px"></i></a>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <?php if($motor->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]): ?>
                                <a class="btn-pausar" data-id="<?php echo $motor->id; ?>" href="#"><i class="fa fa-pause" style="font-size:24px"></i></a>
                            <?php elseif($motor->status == Anuncio::$_status_anuncio["ANUNCIO_PAUSADO"]): ?>
                                <a class="btn-despausar" data-id="<?php echo $motor->id; ?>" href="#"><i class="fa fa-play" style="font-size:24px"></i></a> 
                            <?php else: ?>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

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

<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/datatable.css?e=1'); ?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap.min.css?e=1'); ?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css?e1');?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable.min.js'); ?>



<script>
$(document).ready(function () {


    var tabela = $('#tabela').DataTable({
        pageLength: 50,
        "language": {
            "url": "https://www.bombarco.com.br/datatables.json"
        }
    });

    $(".btn-excluir").on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");

        $.ajax({

            url: Yii.app.createUrl("motorAnuncio/excluir", {id: id}),
            data: {},
            type: "POST",
            success: function(resp) {

                if(resp.trim() == 1) {
                    alert('Operação realizada com sucesso!');

                    setTimeout(function() { 
                        location.href = "https://www.bombarco.com.br/motorAnuncio/meusMotores?e="+Math.random();
                    }, 350);    
                }

                else {

                    alert('Operação realizada com sucesso!');
                }
                

            },
            beforeSend: function(xhr, opts) {

                var s = confirm("Ao excluir o anúncio o mesmo deixará de ser exibido nas buscas do site. Deseja continuar?");

                if(!s) {
                    xhr.abort();
                }
            },
            error: function() {

                alert('Erro inesperado. Contate o admin do site');
            }
        });
    });

    $(".btn-pausar").on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");

        $.ajax({

            url: Yii.app.createUrl("motorAnuncio/pausar", {id: id}),
            data: {},
            type: "POST",
            success: function(resp) {

                if(resp.trim() == 1) {
                    alert('Operação realizada com sucesso!');

                    setTimeout(function() { 
                        location.href = "https://www.bombarco.com.br/motorAnuncio/meusMotores?e="+Math.random();
                    }, 350);    
                }

                else {

                    alert('Operação realizada com sucesso!');
                }
                

            },
            beforeSend: function(xhr, opts) {

                var s = confirm("Deseja continuar?");

                if(!s) {
                    xhr.abort();
                }
            },
            error: function() {

                alert('Erro inesperado. Contate o admin do site');
            }
        });
    });

    $(".btn-despausar").on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");

        $.ajax({

            url: Yii.app.createUrl("motorAnuncio/despausar", {id: id}),
            data: {},
            type: "POST",
            success: function(resp) {

                if(resp.trim() == 1) {
                    alert('Operação realizada com sucesso!');

                    setTimeout(function() { 
                        location.href = "https://www.bombarco.com.br/motorAnuncio/meusMotores?e="+Math.random();
                    }, 350);    
                }

                else {

                    alert('Operação realizada com sucesso!');
                }
                

            },
            beforeSend: function(xhr, opts) {

                var s = confirm("Deseja continuar?");

                if(!s) {
                    xhr.abort();
                }
            },
            error: function() {

                alert('Erro inesperado. Contate o admin do site');
            }
        });
    });


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
