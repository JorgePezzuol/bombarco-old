<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/fineuploader/fine-uploader-new.css'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/fineuploader/jquery.fine-uploader.js?'.microtime(), 
        CClientScript::POS_END); ?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/turbinar.js?e='.microtime(), CClientScript::POS_END); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END); ?>


<?php

    // vai servir para indicar se ja possui todas as turbinadas
    $cont_turbos = 0;


    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'turbinar_embarcacao',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'enableClientValidation'=>true,
        'action'=>Yii::app()->createUrl("embarcacoes/turbinar", array('id'=>$embarcacao->id))
    ));

?>


<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<?php $this->renderPartial('/anuncios/templates'); ?>


       <div class="line-cadastro-11" style="border-top: none !important;">
                <div class="container">
                    <div class="box-cadastro-11" style="height: 170px !important;">
                        <div class="quadro-box-cadastro-11a">
                            <icon class="icone-foto-cadastro3"></i>
                            <div class="div-text-blue-cadastro-l10">

                                <span class="text-blue-cadastro-l10">Turbine seu anúncio!</span>
                            </div>
                        </div>
                        <div class="quadro-box-cadastro-11b">
                            <div class="div-cadastro-light2">
                            <span class="text-cadastro-light">

                                    Agora você pode turbinar o seu anúncio com as nossas opções de adicionais, tornando seu anúncio mais completo e aumentando suas chances de conversão!

                                <br/><br/>

                                 <div id="div_erro" style="font-weight: bold; color:red; font-size:18px; display:none;">
                                       Nenhuma turbinada foi selecionada!
                                </div>

                                <?php if(count(Anuncio::$_turbinados_embarcacao) == $cont_turbos): ?>
                                <div id="div_erro" style="font-weight: bold; color:red; font-size:18px; display:none;">
                                       Nenhuma turbinada foi selecionada!
                                </div>
                                <?php endif;?>


                                <?php if(Yii::app()->user->hasFlash('success')): ?>
 
                                    <div class="flash-success" style="font-weight: bold; color:green; font-size:18px;">
                                        <?php echo Yii::app()->user->getFlash('success'); ?>
                                    </div>
                                 
                                <?php endif; ?>


                                <?php if(Yii::app()->user->hasFlash('error')): ?>
                                 
                                    <div class="flash-error" style="font-weight: bold; color:red; font-size:18px;">
                                        <?php echo Yii::app()->user->getFlash('error'); ?>
                                    </div>
                                 
                                <?php endif; ?>
                                                                
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php for($i = 0; $i < count($recursosAdicionais); $i++): ?>

                <?php $nome_corrente = "Embarcacoes[recursos_adicionais][".$i."]"; ?>

                <!-- CHECA SE TEM CPM E JA ATINGIU O LIMITE, OU SE NAO TEM -->
                <?php if($recursosAdicionais[$i]->flag == 'cpm' && !Embarcacoes::checkCpm($embarcacao->id)) : ?>


                     <div class="line-cadastro-12">
                            <div class="container">
                                <div class="box-cadastro-12">
                                    <div class="quadro-box-cadastro-12a">
                                            <div class="checkbox-cadastro2">
                                                <input type="checkbox" data-valor="<?php echo $recursosAdicionais[$i]->valor; ?>" value="<?php echo $recursosAdicionais[$i]->id; ?>" data-attribute="<?php echo $recursosAdicionais[$i]->flag; ?>" id="check-cpm" name="<?php echo $nome_corrente; ?>" class="recursos-adicionais checkcad1">
                                            </div>
                                    </div>
                                    <div class="quadro-box-cadastro-12b">
                                    <!--<section class="section-duvida-form2">
                                        <a href="#" class="btn-duvida-form2" style="top:7px; right:261px"></a>
                                        <section class="none-duvidas2" style="right:249px;top:42px">
                                            <article class="article-duvida2" style="height: 173px; top: -241px;">

                                                Você escolhe quantas vezes (numero de impressões) e por quanto tempo (período) deseja ser visto, então seu anúncio aparecerá sempre nas áreas "Anúncios Patrocinados" do bombarco, aumentando bastante as suas chances de conversão.

                                            </article>
                                            <i class="ico-arrow-down2"></i>
                                        </section>
                                    </section>-->
                                        <div class ="div-cadastro-green-tb">
                                            <span id="span-cpm" class="text-cadastro-green-tb"><?php echo $recursosAdicionais[$i]->titulo; ?><b id="bold-valor-cpm"> (R$ <?php echo Utils::formataValorView($recursosAdicionais[$i]->valor); ?>)</b></span>
                                        </div>
                                    </div>
                                    <div class="quadro-box-cadastro-12d" style="display:none;" id="div-periodo-impressoes">
                                        <div class="div4-cadastro-green">
                                            <span class="text-cadastro-green5">Período:</span>
                                        </div>
                                        <div class="select-form-cadastrar8">

                                            <select style="margin-left:0px;" id="periodo-impressoes" name="EmbarcacaoImpressoes[limitdate]">
                                            </select>
                                        </div>

                                    </div>
                                    <div class="quadro-box-cadastro-12c" style="display:none;" id="div-limite-impressoes">

                                        <div class="div4-cadastro-green">
                                            <span class="text-cadastro-green5" style="margin-left:-55px !IMPORTANT;">Quantidade de Impressões:</span>
                                        </div>
                                        <div class="select-form-cadastrar8">
                                            <select id="qtde-impressoes" name="EmbarcacaoImpressoes[limitviews]">
                                                <option value="10" selected>10 mil impressões</option>
                                                <option value="20">20 mil impressões</option>
                                                <option value="30">30 mil impressões</option>
                                                <option value="40">40 mil impressões</option>
                                                <option value="50">50 mil impressões</option>
                                                <option value="60">60 mil impressões</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                <!-- titulo -->
                <?php if($recursosAdicionais[$i]->flag == 'titulo' && !Embarcacoes::checkTurboNaoPago($embarcacao, 'titulo')): ?>

                    <div class="line-cadastro-14">
                        <div class="container">
                            <div class="box-cadastro-14">
                                <div class="quadro-box-cadastro-14a">
                                        <div class="checkbox-cadastro2">
                                            <input type="checkbox" data-valor="<?php echo $recursosAdicionais[$i]->valor; ?>" value="<?php echo $recursosAdicionais[$i]->id; ?>" data-attribute="<?php echo $recursosAdicionais[$i]->flag; ?>" id="check-titulo-embarcacao" name="<?php echo $nome_corrente; ?>" class="recursos-adicionais checkcad1">
                                        </div>
                                </div>
                                <div class="quadro-box-cadastro-14b">
                                    <div class ="div-cadastro-green-tb">
                                        <span class="text-cadastro-green-tb"><?php echo $recursosAdicionais[$i]->titulo; ?><b> (R$ <?php echo Utils::formataValorView($recursosAdicionais[$i]->valor);?>)</b></span>
                                        <span style="font-size:13px; position:relative; top:-5px;">(40 caractéres máx)</span>
                                    </div>

                                </div>

                                <div class="quadro-box-cadastro-14d">
                                    <div class="campo-form-cadastro3" style="display:none;" id="div-titulo"/>
                                        <input id="embarcacoes-titulo" maxlength="40" type="text" class="font-form3" disabled name="Embarcacoes[titulo]"/>
                                    </div>
                                </div>
                            </div>
                <?php endif; ?>


                <?php if($recursosAdicionais[$i]->flag == 'destaque_busca' && !Embarcacoes::checkTurboNaoPago($embarcacao, 'destaque_busca')): ?>

                        <div class="line-cadastro-12">
                                <div class="container">
                                    <div class="box-cadastro-12">
                                        <div class="quadro-box-cadastro-12a">
                                                <div class="checkbox-cadastro2">
                                                    <input type="checkbox" data-valor="<?php echo $recursosAdicionais[$i]->valor; ?>" value="<?php echo $recursosAdicionais[$i]->id; ?>" data-attribute="<?php echo $recursosAdicionais[$i]->flag; ?>" id="cb-cadastro-" name="<?php echo $nome_corrente; ?>" class="recursos-adicionais checkcad1">
                                                </div>
                                        </div>
                                        <div class="quadro-box-cadastro-12b">
                                        <!--<section class="section-duvida-form2">
                                            <a href="#" class="btn-duvida-form2" style="top:7px; right:261px"></a>
                                            <section class="none-duvidas2" style="right:249px;top:42px">
                                                <article class="article-duvida2" style="height: 80px;top: -148px;">
                                                    Nas listagens sua embarcação irá aparecer com um selo de destaque, chamando mais atenção do usuário.

                                                </article>
                                                <i class="ico-arrow-down2"></i>
                                            </section>
                                        </section>-->
                                            <div class ="div-cadastro-green-tb">
                                                <span class="text-cadastro-green-tb"><?php echo $recursosAdicionais[$i]->titulo; ?><b> (R$ <?php echo $recursosAdicionais[$i]->valor; ?>)</b></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endif; ?>
                    

                    <!-- turbinado fotos  -->
                    <?php if($recursosAdicionais[$i]->flag == 'fotos' && !Embarcacoes::checkTurboNaoPago($embarcacao, 'fotos')): ?>

                        <div class="line-cadastro-13">
                                <div class="container">
                                    <div class="box-cadastro-13">
                                        <div class="quadro-box-cadastro-13a">
                                                <div class="checkbox-cadastro3">
                                                    <input type="checkbox" data-valor="<?php echo $recursosAdicionais[$i]->valor; ?>" value="<?php echo $recursosAdicionais[$i]->id; ?>" data-attribute="<?php echo $recursosAdicionais[$i]->flag; ?>" id="cb-cadastro-" name="<?php echo $nome_corrente; ?>" class="recursos-adicionais checkcad1">
                                                </div>
                                        </div>
                                        <div class="quadro-box-cadastro-13b">
                                            <div class ="div-cadastro-green-tb">
                                                <span class="text-cadastro-green-tb"><?php echo $recursosAdicionais[$i]->titulo; ?><b> (R$ <?php echo Utils::formataValorView($recursosAdicionais[$i]->valor); ?>)</b></span>
                                            </div>
                                        </div>

                                        <div class="quadro-box-cadastro-13c">
                                            <div class="line-box-cadastro-13">
                                                <div id="uploader-turbo"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endif ;?>

                    <!-- video -->
                    <?php if($recursosAdicionais[$i]->flag == 'video' && !Embarcacoes::checkTurboNaoPago($embarcacao, 'video')): ?>

                        <div class="line-cadastro-14">
                                <div class="container">
                                    <div class="box-cadastro-12">
                                        <div class="quadro-box-cadastro-14a">
                                                <div class="checkbox-cadastro2">
                                                    <input type="checkbox" data-valor="<?php echo $recursosAdicionais[$i]->valor; ?>" value="<?php echo $recursosAdicionais[$i]->id; ?>" data-attribute="<?php echo $recursosAdicionais[$i]->flag; ?>" id="cb-cadastro-" name="<?php echo $nome_corrente; ?>" class="recursos-adicionais checkcad1">
                                                </div>
                                        </div>
                                        <div class="quadro-box-cadastro-14b">
                                            <div class ="div-cadastro-green-tb">
                                                <span class="text-cadastro-green-tb"><?php echo $recursosAdicionais[$i]->titulo; ?> <b>(R$ <?php echo Utils::formataValorView($recursosAdicionais[$i]->valor); ?>)</b></span>
                                            </div>

                                        </div>
                                        <div class="quadro-box-cadastro-14d">
                                            <div class="campo-form-cadastro3" id="div-video" style="display:none;">
                                                <input id="Embarcacoes_video"  type="text" class="font-form3" disabled name="Embarcacoes[video]"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     <?php endif; ?>

        <?php endfor; ?>





<!-- campos hidden -->

                    <div id="div-campos-hidden">
                            <?php


                                // hidden que indica a qtde de mes do anuncio
                                echo CHtml::hiddenField('duracaomeses', $meses, array('id'=>'duracaomeses'));

                                echo CHtml::hiddenField('hidden-valor-cpm', 99.00, array('id'=>'hidden-valor-cpm'));
                               
                            ?>

                            <input type="hidden" id="hidden-valor-total-turbinada" value="0"/>
                        </div>



                                <div style="margin-left: 550px;">

                                    <div class="quadro-box-cadastro-lh-e">
                                        <div class="div6-cadastro-green">
                                                    <span class="text-cadastro-green6">TOTAL</span>
                                                </div>
                                                <div class="div-text-cadastro-lh3">
                                                    <span class="text-cadastro-lh3">R$</span>
                                                </div>
                                                <div class="div-text-cadastro-lh4">
                                                        <span class="text-cadastro-lh4" id="valor-total-turbinada">0,00</span>
                                                </div>
                                    </div>

                                    <?php echo GxHtml::submitButton(Yii::t('app', 'FINALIZAR'), array('class'=>'botao-cadastro-2', 'id'=>'btn-form')); ?>
                            </div>


                        <br/><br/><br/>
                        



<?php
    $this->endWidget();
?>
