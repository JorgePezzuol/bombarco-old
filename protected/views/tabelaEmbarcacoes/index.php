<?php

/* scripts */
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/tabela_embarcacoes.js?e='.microtime(), CClientScript::POS_END);       
$this->setPageTitle("Tabela de Barcos | Bombarco");
Yii::app()->clientScript->registerMetaTag('Tabela Bombarco. Preços médios de Lanchas, Veleiros, Jet Ski e Barcos de Pesca no Mercado Nacional. Avalie Agora! ', 'description', null, array(), 'bombarco_description');
?>
<section class="content">
        <div class="line-tabela-1">
            <section class="main-filter-tabela">
                <div class="container">
                    <span class="title-tabela-top"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
                    <span class="title-tabela"><b>Tabela de Barcos</b></span>


                    <ul class="options-category-tabela" style="position: relative;left: 190px;">
                        <li style="margin-left:-400px;" class="tab speedboat-tab active" data-macro="2" ><a href="#">Lanchas</a></li>
                        <li class="tab jetski-tab" data-macro="1"><a href="#">Jet Skis</a></li>
                        <li class="tab pesca-tab" data-macro="4"><a href="#">Barcos de Pesca</a></li>
                    </ul>

                    <!--Start Filtro de Busca-->
                    <div class="form-filter-tabela">
                        <div class="col-tabela">
                            <div class="div-title-l1-tabela-col1">
                                <span class="title-l1-tabela-col1">
                                    Encontre o valor da embarcação na tabela exclusiva do Bombarco

                                </span>
                                <!-- precisa arrumar -->
                                <?php if(Yii::app()->user->isGuest):?>
                                <span style="
                                        float: right;
                                        position: relative;
                                        left: 260px;
                                        top: -20px;
                                        font-size: 13px;
                                        width: 180px;
                                        color: /*#0F2E44*/ red !important;">
                                    *É necessário efetuar o login para realizar a busca!
                                </span>
                                <?php endif;?>


                            </div>

                            <div class="selects-tabela-div">
                                <?php echo CHtml::form("#", 'get', array('id'=>'form-search', 'name'=>'form-search')); ?>
                                    <span class="select-tabela1 close-dd">
                                        <?php echo CHtml::dropDownList('marca', 0,
                                        EmbarcacaoFabricantes::fabricantesTabelaSlug(Anuncio::$_categoria_embarcacao['LANCHA']),
                                        array('empty' => 'Marca', 'id'=>'fabricante', 'style'=>'width:240px', 'class'=>'select-anuncio-pad'));?>
                                    </span>
                                    <span class="select-tabela2 close-dd">
                                        <select id="modelo-embarcacao" class="select-anuncio-pad" style="width: 240px;" name="modelo">
                                            <option selected value="">Modelo</option>
                                        </select>
                                    </span>
                                    </span>
                                    <span class="select-tabela3 close-dd">
                                        <select id="ano" class="select-anuncio-pad" style="width: 240px;" name="ano">
                                            <option value="" selected>Ano</option>
                                        </select>
                                    </span>
                                    <div class="div-botao-buscar-tab">

                                        <input type="submit" class="botao-buscar-tabela" name="Buscar-tab" id="btn-buscar-tab" value="BUSCAR!" onclick="_gaq.push(['_trackEvent', 'tabela-bombarco', 'click', 'Buscar'])" />
                                    </div>

                                <?php echo CHtml::endForm(); ?>
                            </div>
                            <div class="col-tabela2">
                                <div class="div-title-l1-tabela-col2">
                                <span class="title-l1-tabela-col2">Não encontrou a embarcação que procura?</span>
                                <span class="subtitle-l1-tabela-col2">Clique ao lado e deixe seu contato.</span>
                                </div>
                                <div class="div-botao-naoenc-tab" >
                                        <a id="btn-naoenc-tabela" class="botao-naoenc-tabela" onclick="_gaq.push(['_trackEvent', 'tabela-bombarco', 'click', 'Não-encontrei'])">Não encontrei a embarcação que procuro!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Filtro de Busca-->
                </div>
            </section>
        </div>
    <div class="line-tabela-2" id="line-tabela-busca">
            <div class="container">

                <div class="box-cinza-lateral-bb">

                        <?php $embarcacoes_destaque = Embarcacoes::anunciosRelacionados(); ?>
                        <?php if(count($embarcacoes_destaque) > 0): ?>

                            <div class="bloco-tabela-1">
                                <div class="div-title-lateral-anuncios">
                                    <span class="title-lateral-anuncios">Anúncios Patrocinados</span>
                                </div>
                                <div class="title-lat-tabela-div">
                                    <span class="title-lat-tabela">
                                        Classificados
                                     </span>
                                </div>
                                <div class="box-tabela-lat-tab">

                                    <?php foreach ($embarcacoes_destaque as $key => $value): ?>

                                        <ul class="categories-tabela-lat">
                                            <li class="category-tabela–lat">
                                                <?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-tabela-lat'), true); ?>
                                            </li>
                                        </ul>
                                        <div class="textos-lat-tab">
                                            <span class="text-list-lat-title"> <?php echo $value->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo; ?> </span>
                                            <span class="text-list-tab-ano"> Ano: </span>
                                            <span class="text-list-tab-ano-rnd"> <?php echo $value->ano; ?> </span><br>
                                            <span class="text-list-tab-price"> <?php echo ($value->valor > 0?"R$ " . number_format($value -> valor, 2, ',', '.'):" R$ não informado"); ?> </span>
                                        </div>

                                    <?php endforeach ?>

                                </div>
                            </div>
                        <?php endif;?>




                       
                        <?php $empresas_relacionadas = Empresas::anunciosRelacionados(Macros::$macro_by_slug['empresa']); ?>
                        <?php if (count($empresas_relacionadas) > 0): ?>
                        

                            <div class="bloco-tabela-2">
                                <div class="title-lat-tabela-div2">
                                    <span class="title-lat-tabela2"> Guia de Empresas </span>
                                </div>
                                <div class="box-tabela-lat-tab2">

                                    <?php foreach ($empresas_relacionadas as $key => $value): ?>

                                        <ul class="categories-tabela-lat2">
                                            <li class="category-tabela–lat2">
                                                <?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class'=>'bg-img-tabela-lat2')); ?>
                                            </li>
                                        </ul>
                                        <div class="textos-lat-tab2">
                                            <span class="text-list-lat-title"> <?php echo $value->razao; ?> </span>
                                            <span class="text-list-tab-ano2"> Localizacão: </span>
                                            <span class="text-list-tab-ano-rnd2"> <?php echo $value->cidades->nome . ' / ' . $value->estados->nome; ?> </span>
                                        </div>

                                    <?php endforeach ?>

                                </div>
                                <div class="div-voltar-ao-topo-list">
                                    <a class="botao-voltar-ao-topo-list" id="btn-subir-bb">VOLTAR AO TOPO</a>
                                </div>

                        </div>
                        <?php endif;?>

                </div>

                <div class="box-tabela-principal">
                    <div class="bloco-resultado-tabela">
                        <div class="div-title-l2r-tabela">
                            <span id="titulo-resultados" class="title-l2r-tabela"> Resultados da Tabela</span>
                        </div>
                        <div class="section-result-ajax">
                            <div class="box-tabela-bb-r">
                                <ul class="categories-tabela-r">
                                    <li class="category-tabela-r">
                                        <a href="#">
                                            <img class="bg-img-tabela-r" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/Penguins.jpg">
                                        </a>
                                        <div class="textos-tabela-bb-r">
                                            <span class="text-tabela-bb-title-r"> Lorem ipsum dolor sit consectetur adipiscing. </span>
                                            <span class="text-tabela-bb-ano-r"> Ano: </span>
                                            <span class="text-tabela-bb-estado-r"> Estado: </span>
                                            <span class="text-tabela-bb-price-r"> R$ 500.000,00 </span>
                                            <span class="text-tabela-bb-ano-rnd-r"> 2014 </span>
                                            <span class="text-tabela-bb-estado-rnd-r"> SP </span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="botoes-tabela-top">
                                    <div class="botao-tabela-top1">
                                         <a class="botao-opcoes-seguro-tab" id="btn-opcoes-seguro-tab">Opcões de seguro</a>
                                    </div>
                                    <div class="botao-tabela-top2">
                                         <a class="botao-financiamento-tab" id="btn-fincanciamento">Financiamento</a>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <!-- Inicio do conteudo abaixo do resultado-->
                    <div class="div-title-l2-tabela" id="titulo-resultados-anuncios">
                        <span class="title-l2-tabela"> <b>Embarcações do mesmo modelo nos classificados bombarco. </b></span>
                    </div>
                    <div class="section-result-ajax-anuncios">

                    </div>
                </div>



                <div class="botoes-tabela" id="ver-mais" style="display:none">
                    <!--<a class="botao-carregar-tabela" id="carregar-mais-tabela">VER MAIS</a>-->
                    <div class="div-btn-carregar-list">
                        <a class="botao-carregar-list" id="carregar-list"
                             data-limit="<?php echo Embarcacoes::LIMIT_SEARCH; ?>">VER MAIS</a>
                    </div>

                </div>





        <br class="clear">
        <div class="fundo-cinza-lateral">
        </div>

            </div>

    </div>

        <!-- lightboxes -->
        <div class="lbox-tab" id="lbox-tab">

            <?php
                /*$telefone = "";
                $nome = "";
                $email = "";
                if(!Yii::app()->user->isGuest) {
                    $user = Usuarios::model()->getUsuarioLogado();
                    $telefone = $user->telefone;
                    $email = $user->email;
                    $nome = $user->nome;
                }*/

                // cookies
                $email = Yii::app()->request->cookies->contains('email') ? Yii::app()->request->cookies['email']->value : "";
                $celular = Yii::app()->request->cookies->contains('celular') ? Yii::app()->request->cookies['celular']->value : "";
                $nome = Yii::app()->request->cookies->contains('nome') ? Yii::app()->request->cookies['nome']->value : "";


            ?>
                    <div>
                        <span class="tab-title">Deixe seu contato e os dados da embarcação que procura, assim que a tabela for atualizada, informaremos por e-mail.</span>
                    </div>
                    <div>
                        <span class="tab-sub-title">  * O seu pedido não é automatico. Nossa equipe </br>receberá suas informações e entrará em contato.</span>
                    </div>
            <form id="form_tabela" method="POST" action="#">
                <div class="form-nome-tab">
                    <input placeholder="Seu nome" id="nome" value="<?php echo $nome;?>" class="terms-ag-1" type="text" required>
                </div>
                <div class="form-nome-tab-2">
                    <input placeholder="Seu telefone" id="telefone" value="<?php echo $celular;?>" class="terms-tab-2" type="tel"  required>
                </div>
                <div class="form-nome-tab-3">
                    <input placeholder="Seu e-email" id="email-tab" value="<?php echo $email;?>" class="terms-tab-3" type="email"  required>
                </div>
                <div class="form-nome-tab-4">
                    <input placeholder="Descrição da embarcação (marca/modelo/ano)" id="descricao" class="terms-tab-4" type="text" required>
                </div>
                     <input type="submit" name="botao-cadastrar-form" class="botao-cadastrar-form" id="n-encontrou-barco-tabela" value="ENVIAR PEDIDO">
                     <input type="button" id="close" class="fechar-form close" value="X">
            </form>
        </div>

        <div class="lbox-msgenviada" id="lbox-lead">
            <div class="texts-lbox-ag">
                <div class="div-title-form-msgok">

                    <span class="form-lb-title" id="msg-lgbox2">
                        Entre com seu email
                    </span>

                    <div class="search-idt" style="margin-top:10px;">
                            <input id="email-lead" placeholder="Seu email" class="terms-idtf" type="text">
                    </div>

                </div>
            </div>
            <br/>
                <input type="button" class="botao-lb-form-msgok enviar" id="btn-lead" value="Ok">
        </div>

        <div class="lbox-msgenviada" id="lbox-msgok">
            <div class="texts-lbox-ag">
                <div class="div-title-form-msgok">
                    <span class="form-lb-title" id="msg-lgbox">Sua mensagem foi enviada com sucesso!</span>
                </div>
            </div>
                <input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
        </div>


        <!-- fim lightbox -->
</section>


<?php
    /* hidden indica se está logado ou não */
    echo CHtml::hiddenField('isGuest', Yii::app()->user->isGuest, array('id'=>'isGuest'));

    /* hidden indica macro da busca (jetski, lancha ou veleiro) */
    echo CHtml::hiddenField('macro', 2, array('id'=>'macro'));

    /* parametros */
    if($marca != null && $marca != "") {
        echo CHtml::hiddenField('marca-pre-selecionada', $marca, array('id'=>'marca-pre-selecionada'));
    }

    if($modelo != null && $modelo != "") {
        echo CHtml::hiddenField('modelo-pre-selecionado', $modelo, array('id'=>'modelo-pre-selecionado'));
    }

    if($ano != 0 && $ano != null) {
        echo CHtml::hiddenField('ano-pre-selecionado', $ano, array('id'=>'ano-pre-selecionado'));
    }

    if($macro != 0 && $macro != null) {
        echo CHtml::hiddenField('macro-pre-selecionada', $macro, array('id'=>'macro-pre-selecionada'));
    }
?>
