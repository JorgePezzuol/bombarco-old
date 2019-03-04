<br/>

<div class="container-fluid">

    <h1>Aprovar Motores</h1>
    <br/>

<input type="hidden" id="embarcacoes_id"/>
<input type="hidden" id="hidden_vendas" value = "0"/>






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
                    <th class="text-center">Gratuito</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Data</th>
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
                        <td class="text-center" style="width:10% !important;">
                            
                            <?php $principal = MotorAnuncio::obterImgPrincipal($motor); ?>

                            <?php if ($principal != null): ?>

                                <?php $imagem = Yii::app()->request->baseUrl . '/public/motores/' . $principal; ?>

                                <img class="rounded mx-auto d-block img-thumbnail" src="<?php echo $imagem; ?>"/>

                            <?php else: ?>

                                <?php $imagem = Yii::app()->request->baseUrl . '/img/sem_foto_bb.jpg'; ?>

                                <img class="rounded mx-auto d-block img-thumbnail" src="<?php echo $imagem; ?>" />

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

                        <td class="text-center"><?php echo $motor->planoUsuarios->gratuito = (1) ? 'Sim' : 'Não'; ?></td>

                        <td style="font-weight:bolder;" class="text-center"><?php echo Anuncio::$_status_anuncio_by_number[$motor->status]; ?></td>

                        <td class="text-center"><?php echo Utils::formatDateTimeToView($motor->data_registro); ?></td>

                        <td class="text-center">
                            <a target="_blank" href="<?php echo MotorAnuncio::gerarLinkAbsoluto($motor); ?>"><i class="fa fa-search" style="font-size:24px"></i></a>
                        </td>

                        <td>
                            <a target="_blank" href="<?php echo Yii::app()->createUrl('motorAnuncio/update', array('id'=>$motor->id)); ?>"><i class="fa fa-pencil" style="font-size:24px"></i></a>
                        </td>

                        <td class="text-center">
                            <a class="btn-aprovar" data-id="<?php echo $motor->id; ?>" href="#"><i class="fa fa-check" style="font-size:24px"></i></a> 
                        </td>

                        <td class="text-center">
                            <?php if($motor->status == Anuncio::$_status_anuncio["ANUNCIO_BARRADO"]): ?>
                                <a style="opacity: 0.1;" href="#"><i class="fa fa-times" style="font-size:24px"></i></a>
                            <?php else: ?>
                                <a class="btn-barrar" data-id="<?php echo $motor->id; ?>" href="#"><i class="fa fa-times" style="font-size:24px"></i></a>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</div>

</section>

<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/datatable.css?e=1'); ?>

<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css?e1');?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable.min.js'); ?>



<script>
$(document).ready(function () {


    var tabela = $('#tabela').DataTable({
        pageLength: 10,
        language: {
            url: "https://www.bombarco.com.br/datatables.json"
        }
    });

    $(".btn-barrar").on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");

        $.ajax({

            url: Yii.app.createUrl("motorAnuncio/barrar", {id: id}),
            data: {},
            type: "POST",
            success: function(resp) {

                if(resp.trim() == 1) {
                    alert('Operação realizada com sucesso!');

                    setTimeout(function() { 
                        location.href = "https://www.bombarco.com.br/admin/aprovarMotores?e="+Math.random();
                    }, 350);    
                }

                else {

                    alert('Operação realizada com sucesso!');
                }
                

            },
            beforeSend: function(xhr, opts) {

                var s = confirm("Confirmar a ação?");

                if(!s) {
                    xhr.abort();
                }
            },
            error: function() {

                alert('Erro inesperado. Contate o admin do site');
            }
        });
    });

    $(".btn-aprovar").on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");

        $.ajax({

            url: Yii.app.createUrl("motorAnuncio/aprovar", {id: id}),
            data: {},
            type: "POST",
            success: function(resp) {

                if(resp.trim() == 1) {
                    alert('Operação realizada com sucesso!');

                    setTimeout(function() { 
                        location.href = "https://www.bombarco.com.br/admin/aprovarMotores?e="+Math.random();
                    }, 350);    
                }

                else {

                    alert('Operação realizada com sucesso!');
                }
                

            },
            beforeSend: function(xhr, opts) {

                var s = confirm("Confirmar a ação?");

                if(!s) {
                    xhr.abort();
                }
            },
            error: function() {

                alert('Erro inesperado. Contate o admin do site');
            }
        });
    });

});
</script>
