<style>
    .close-video {
        position: absolute;
        margin-top: -30px;
        /* text-decoration: none; */
        color: white;
        font-size: 30px;
        margin-left: 750px;
    }
    .slide-deemb li.category-deemb { 
    	display:flex!important;
    	align-items: center!important;
     }
</style>

<?php
// scripts
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/embarcacao_favoritos.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js?e='.microtime(), CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/elevatezoom.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/embarcacoes_detalhe.js?t='.microtime(), CClientScript::POS_END);

// gambiarra para exibir o estado do barco **NÃO TIRE ISSO DAQUI**
$novoOuUsado = $model->estado;
if ($novoOuUsado == "U") {
    $novoOuUsado = "Usado";
} else {
    $novoOuUsado = "Novo";
}


// usuario dono da embarc
$usuarioDonoEmbarc = Usuarios::model()->findByPk($idUsuarioDonoEmbarc);
$usuario_logado = Usuarios::getUsuarioLogado();

$modelo = $model->embarcacaoModelos;
$fabricante = $model->embarcacaoModelos->embarcacaoFabricantes;


?>
<!-- estatísticas / só aparecem se o usuário ser o dono da embarcação -->
<?php if (Yii::app()->user->id == $idUsuarioDonoEmbarc): ?>

    <section id="menu-acesso">
        <?php $this->renderPartial('/minhaConta/menu'); ?>
        <br class="clr">
    </section>

    <section id="estatisticas">

        <div class="estatisticas-line">
            <div class="container">
                <?php if ($model->data_ativacao != null) : ?>
                    <span class="estatisticas-title"><?php echo 'Data de ativação: <b class="bold-blue">' . Utils::formatDateTimeToView($model->data_ativacao) . '</b>'; ?></span>
                <?php endif; ?>
                <span class="estatisticas-title">Estatísticas: </span>
                <?php



                if (Embarcacoes::checkTurboNaoPago($model, 'cpm') ||
                    Embarcacoes::checkTurboNaoPago($model, 'fotos') ||
                    Embarcacoes::checkTurboNaoPago($model, 'video') ||
                    Embarcacoes::checkTurboNaoPago($model, 'titulo') ||
                    Embarcacoes::checkTurboNaoPago($model, 'destaque_busca')):
                    ?>
                    <img src="<?php echo Yii::app()->createUrl('img/anuncio-turbinado.png'); ?>" alt="Anúncio Turbinado!" class="anuncio-turb">
                <?php endif; ?>
            </div>
        </div>

        <div class="estatisticas-box">
            <div class="container">
                <div class="estatisticas-cell">
                    <span class="cell-title">Contatos</span>
                    <span class="cell-result"><?php echo number_format(Embarcacoes::totalizarMensagens(Yii::app()->user->id, $model->id, 'anuncio'),0,",","."); ?></span>
                </div>
                <div class="estatisticas-cell">
                    <span class="cell-title">Cliques para <br/>ver Telefone:</span>
                    <span class="cell-result"><?php echo number_format(Embarcacoes::totalizarVerTelefone(Yii::app()->user->id, $model->id),0,",","."); ?></span>
                </div>
                <div class="estatisticas-cell">
                    <span class="cell-title">Cliques:</span>
                    <span class="cell-result"><?php echo number_format(Embarcacoes::totalizarCliques(Yii::app()->user->id, $model->id, 'anuncio'),0,",","."); ?></span>
                </div>
                <?php if (Embarcacoes::checkTurboNaoPago($model, 'cpm')): ?>
                    <div class="estatisticas-cell">
                        <?php
                        $impressoes = Embarcacoes::totalizarImpressoesClassificados(Yii::app()->user->id, $model->id);
                        ?>
                        <span class="cell-title">Impressões</span>
                        <span class="cell-result"><?php echo number_format($impressoes['impressoes'],0,",",".") . '/ <span>' . number_format($impressoes['limite'],0,",","."); ?></span></span>
                    </div>
                <?php endif; ?>

                <div class="estatisticas-cell">
                    <a class="bt-action" href="<?php echo Yii::app()->createUrl('embarcacoes/update', array('id' => $model->id)); ?>">Editar</a>
                </div>

                <br class="clear">
            </div>
        </div>
    </section>
<?php endif; ?>


<?php
    // cookies
    $email = Yii::app()->request->cookies->contains('email') ? Yii::app()->request->cookies['email']->value : "";
    $celular = Yii::app()->request->cookies->contains('celular') ? Yii::app()->request->cookies['celular']->value : "";
    $nome = Yii::app()->request->cookies->contains('nome') ? Yii::app()->request->cookies['nome']->value : "";
?> 


<section class="content" id="alterada-sm">

    <title><?php echo Utils::mountTitle($title); ?></title>

    <div class="line-deemb1">
        <div class="container pure-g">
            <div class="box-deemb1 pure-u-1">
                
                <div class="quadro-l1-deemb1 pure-u-1">
                    <span class="text-top-deemb pure-u-3-5 pure-u-sm-5-5 pure-u-md-5-5" style="margin-top:40px !important; text-align:left;"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
                    <div class="search-deemb pure-u-2-5 pure-u-sm-5-5"> 
                        <?php echo CHtml::form(array('site/url'), 'get', array('id' => 'form-search', 'name' => 'buscando')); ?>
                        <input name="buscando" placeholder="Buscar <?php echo EmbarcacaoMacros::$macro[$fabricante->embarcacao_macros_id] ?>" class="terms-deemb" type="text">
                        <input class="find-deemb" type="submit">
                        <input type="hidden" name="macro" value="<?php echo EmbarcacaoMacros::$macro_by_slug[$fabricante->embarcacaoMacros->alias]; ?>"/>
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
                                
                <div class="clearfix"></div>

                <div class="quadro-l1-deemb3 pure-u-1">
                
                    <div class="quadro-l1-deemb2">
                        <div class="quadro-deemb pure-u-1">  
                        <?php
                            
                            
                            $imagem = Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg';
                            if (!empty($fabricante->logo)) {
                                $href_marca = EmbarcacaoFabricantes::mountUrl($model);
                                $imagem = Yii::app()->baseUrl . '/public/fabricantes/' . $fabricante->logo;
                                echo '<a href="'.$href_marca.'" class="pure-u-3-12 pure-u-sm-12-12 pure-u-md-12-12"><img class="bg-img-deemb" id="img-anunciante" alt="'.$fabricante->titulo.'" title="'.$fabricante->titulo.'" src="'.$imagem.'"/></a>';

                                    if(Embarcacoes::checkTurbo($model, 'titulo')) {
                                        echo '<h1 class="title-emb-deemb pure-u-6-12 pure-u-sm-12-12 pure-u-md-12-12">'. $fabricante->titulo . ' ' . $modelo->titulo .' - '. $model->ano  .', '.$modelo->embarcacaoTipos->titulo .'<span style="color:black;"  class="subtitle-emb-deemb"><b>'.$model->titulo.'</b></span></h1>';
                                    }
                                    else {
                                        echo '<h1 class="title-emb-deemb pure-u-6-12 pure-u-sm-12-12 pure-u-md-12-12">'. $fabricante->titulo . ' ' . $modelo->titulo .' - '. $model->ano  .', '.$modelo->embarcacaoTipos->titulo .'</h1>';    
                                    }
                                
                            } else {
                                echo '<a href="'.EmbarcacaoFabricantes::mountUrl($model).'"><img class="bg-img-deemb" id="img-anunciante" src="'.$imagem.'"/></a>';
                                    if(Embarcacoes::checkTurbo($model, 'titulo')) {
                                        echo '<h1 class="title-emb-deemb pure-u-6-12 pure-u-sm-12-12 pure-u-md-12-12">'. $fabricante->titulo . ' ' . $modelo->titulo .' - '. $model->ano  .', '.$modelo->embarcacaoTipos->titulo .'<span style="color:black;" class="subtitle-emb-deemb"><b>'.$model->titulo.'</b></span></h1>';
                                    }
                                    else {
                                        echo '<h1 class="title-emb-deemb pure-u-6-12 pure-u-sm-12-12 pure-u-md-12-12">'. $fabricante->titulo . ' ' . $modelo->titulo .' - '. $model->ano .', '.$modelo->embarcacaoTipos->titulo .'</h1>';    
                                    }
                            
                            }
                        
                        ?>
                        
                        <?php
                            $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        ?>
                        <div class="redes pure-u-3-12 pure-u-sm-12-12 pure-u-md-12-12"> 
                            <a class="btn-rede" data-ax-trackname="detalhe btn comparar" href="<?php echo Yii::app()->createUrl('comparador/comparar', array('id_embarcacao' => $model->id)); ?>" id="botao-deemb1" title="Comparar"><i class="fa fa-exchange"></i></a>
                            <a class="btn-rede" id="compartilhar" target="_blank" title="Compartilhar no Facebook!"><i class="fa fa-facebook"></i></a>
                            <a href="https://wa.me/?text=<?php echo $actual_link; ?>" class="btn-rede"><i class="fa fa-whatsapp"></i></a>
                            <a class="btn-rede add-favoritos ax-track-event" data-ax-trackname="detalhe btn favoritar" id="add-favoritos" title="Favoritar Produto"><i class="fa fa-heart"></i></a>
                        </div><!-- REDES SOCIAIS -->
                        </div>
                    </div>
                    
                    
                </div>
                
                <div class="clearfix"></div>
                
                <div class="quadro-l1-deemb5 pure-u-3-5 pure-u-sm-1 pure-u-md-1">
                    <div class="box-video">

                    </div>
                    <a href="#" class="img-principal pure-u-1">

                        <?php
                        $imagem = Yii::app()->request->baseUrl . '/img/sem_foto_bb.jpg';
                        $principal = EmbarcacaoImagens::obterImgPrincipal($model->id);
                        if ($principal != null) {
                            $imagem = Yii::app()->request->baseUrl . '/public/embarcacoes/' . $principal;
                            echo '<img class="bg-img-slide-deemb" alt="'.Embarcacoes::getAlt($model).'" title="'.Embarcacoes::getAlt($model).'" data-zoom-image="' . $imagem . '" src="' . $imagem . '" id="img-zoom" />';

                        } else {
                            echo '<img class="bg-img-slide-deemb" data-zoom-image="' . $imagem . '"  src="' . $imagem . '" id="img-zoom" />';
                        }

                        ?>
                    </a>
                    <!--div class="quadro-l1-deemb7 pure-u-3-5 pure-u-sm-1 pure-u-md-1"-->
                    <div class="pure-u-4-5 slider-principal">
                        <div id="div-deemb1">
                            <?php if (count($model->embarcacaoImagens) > 5) { ?>
                                <ul class="slide-deemb pure-u-5-5">
                                    <?php
                                    for ($i = 0; $i < count($model->embarcacaoImagens); $i++) {

                                        if (Embarcacoes::checkTurbo($model, 'video') && $i == 0 && $model->video != "") {
                                        
                                            echo '<li class="category-deemb">';
                                            echo '<a href="#" class="ax-track-event" data-ax-trackname="detalhe galeria video">';
                                            echo '<div class="lazyYT-button" data-video="' . $model->video . '"></div>';
                                            echo '</a>';
                                            echo '</li>';
                                        }

                                        echo '<li class="category-deemb">';
                                        echo '<a href="#" class="img-thumbnail-emb ax-track-event" data-ax-trackname="detalhe galeria imagem">';
                                        echo '<img alt="'.Embarcacoes::getAlt($model).'" title="'.Embarcacoes::getAlt($model).'" class="img-deemb-slide" src="' . Yii::app()->request->baseUrl . '/public/embarcacoes/' . $model->embarcacaoImagens[$i]->imagem . '"/>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            <?php } else { ?>
                                <ul class="slide-deemb2 pure-u-5-5">
                                    <?php

                                        if(count($model->embarcacaoImagens) == 0) {

                                            if (Embarcacoes::checkTurbo($model, 'video') && $model->video != "") {
                                                  
                                                echo '<li class="category-deemb">';
                                                echo '<a href="#" class="ax-track-event" data-ax-trackname="detalhe galeria video">';
                                                echo '<div class="lazyYT-button" data-video="' . $model->video . '"></div>';
                                                echo '</a>';
                                                echo '</li>';

                                                /*echo '<li class="category-deemb pure-u-1-5">';
                                                echo '<a href="#" class="ax-track-event">';
                                                echo '<div class="lazyYT-button" data-video="' . $model->video . '"></div>';
                                                echo '</a>';
                                                echo '</li>';*/
                                            }
                                        }
                                        else {

                                            for ($i = 0; $i < count($model->embarcacaoImagens); $i++) {

                                                if (Embarcacoes::checkTurbo($model, 'video') && $i == 0 && $model->video != "") {
                                                      
                                                    echo '<li class="category-deemb">';
                                                    echo '<a href="#" class="ax-track-event" data-ax-trackname="detalhe galeria video">';
                                                    echo '<div class="lazyYT-button" data-video="' . $model->video . '"></div>';
                                                    echo '</a>';
                                                    echo '</li>';
                                                }

                                                echo '<li class="category-deemb pure-u-1-5">';
                                                echo '<a href="#" class="img-thumbnail-emb ax-track-event" data-ax-trackname="detalhe galeria imagem">';
                                                echo '<img alt="'.Embarcacoes::getAlt($model).'" title="'.Embarcacoes::getAlt($model).'" class="img-deemb-slide" src="' . Yii::app()->request->baseUrl . '/public/embarcacoes/' . $model->embarcacaoImagens[$i]->imagem . '"/>';
                                                echo '</a>';
                                                echo '</li>';
                                            }
                                        }
                                        
                                    ?>
                                </ul>
                            <?php } ?>
                        </div>

                    </div>
                </div>              
                
                
                <div id="limita-form" class="pure-u-2-5 pure-u-sm-5-5">
                
                
                    <div id="mini-info">
                        

                        <?php if ($model->status == Embarcacoes::ACTIVE): ?>


                            <div class="quadro-deemb">
                                <h2 class="title" id="valor_barco">
                                <?php
                                    if (empty($model->valor) || $model->valor == '0.00') {
                                        echo 'R$ não informado';
                                    } else {
                                        echo 'R$ ' . Utils::formataValorView((float) $model->valor);
                                    }
                                ?>
                                </h2>

                                <h2 style="color:red;" id="msg_principal"></h2>
                                <br/>

                                <div class="campo">
                                    <label>Nome: </label>
                                    <input id="nome_principal" value="<?php echo $nome; ?>" type="text" required="required">
                                </div>
                                <div class="campo">
                                    <label>E-mail: </label>
                                    <input id="email_principal" value="<?php echo $email; ?>" type="email" required="required">
                                </div>
                                <div class="campo">
                                    <label>Telefone: </label>
                                    <input id="celular_principal" value="<?php echo $celular; ?>" type="tel" autocomplete="off">
                                </div>
                                <div class="campo">
                                    <span class="ponta"></span>
                                    <textarea id="mensagem_principal" required="required">Olá, tenho interesse neste produto e gostaria de receber mais informações</textarea>
                                </div>


                                <div class="campo"> 
                                    <p>Quero saber mais sobre: </p>
                                    <!--<div class="check"><input type="checkbox" id="partner_marina_principal" value="1" data-form="form_marina" class="checkbox_partners"> Preço de marina</div>-->

                                    <div class="check"><input type="checkbox" id="partner_cons_principal" value="1" data-form="form_cons" class="checkbox_partners"> Consórcio</div>
                                    <div class="check"><input type="checkbox" value="1"> Arrais amador</div>
                                    <div class="check"><input type="checkbox" id="partner_trans_principal" value="1" data-form="form_trans" class="checkbox_partners"> Transporte</div>
                                    <div class="check total"><input type="checkbox" id="quero_receber" value="1" checked="checked"> Quero receber conteúdo exclusivo por e-mail <div class="tooltip"><i class="ajuda"></i> <span class="tooltiptext">Ao marcar esta opção você concorda em receber nossas novidades em seu endereço de e-mail.</span></div></div>
                                </div>
                                <div class="campo">
                                    <a href="#" name="botao-cadastrar-form" class="btn-envia-proposta" id="btn-contato-anunciante_principal"><i class="envelope-envia"></i> Enviar Proposta</a>
                                </div>   


                            </div>



                        <?php else: ?>

                            <?php $status_class = ($model->status == Embarcacoes::SOLD) ? 'sold' : 'expired'; ?>
                            <?php $status_txt = ($model->status == Embarcacoes::SOLD) ? 'Anúncio Vendido!' : 'Anúncio Indisponível'; ?>

                            <div class="quadro-l1-deemb8">
                                <div style="border-color:red; color:red;" class="anuncio-view-status <?php echo $status_class; ?>"><?php echo $status_txt; ?></div>
                                <icon class="anuncio-view-icon"></icon>
                            </div>

                        <?php endif ?>
                        
                    </div>

                    <div id="mais-infos">
                        <a href="#" class="scroll-div"><i class="ico-perfil"></i> Informações sobre o anunciante <i class="seta-baixo"></i></a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="line-deemb2">
        <div class="container">
            <div class="box-deemb2 pure-u-5-5">    
                
                <!-- TABS -->
                <div class="tabs">
                    <ul class="tab-links">
                        <li class="active"><a href="#descricao">Descrição</a></li>
                        <!--<li><a href="#financiamento">Financiamento</a></li>-->
                        <li><a href="#transporte">Transporte</a></li>
                        <li><a href="#consorcio">Consórcio</a></li>
                        <!--<li><a href="<?php //echo Yii::app()->createUrl('preco-de-marina'); ?>" target="_blank">Preço de Marina</a></li>-->
                        <li><a href="<?php echo Yii::app()->createUrl('arrais-mestre-capitao-amador'); ?>" target="_blank">Arrais amador</a></li>
                    </ul>
                 
                    <div class="limita-conteudo pure-u-1">
                        <div class="tab-content pure-u-1 pure-u-sm-5-5">
                            <div id="descricao" class="tab active">
                                <div class="quadro-l1-deemb2"><!-- ANUNCIANTE -->
                                    
                                    <?php if ($usuarioDonoEmbarc->logo != null): ?>
                                        <div class="quadro-l3-deemb2b">
                                            <a href="#">
                                                <img class="bg-img-l3-deemb" src="<?php echo Yii::app()->request->baseUrl . '/public/usuarios/' . $usuarioDonoEmbarc->logo; ?>">
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="quadro-l3-deemb2c anunciante">
                                        <div class="div-textos-l3-deemb">
                                            <div class="div-title-bloco2-l3-deemb">
                                                <?php 
                                                    $nomeEmpresa_ = str_replace(" ", "", $nomeEmpresa);
                                                    $link_anunciante = Yii::app()->createUrl("embarcacoes/anunciante/".$nomeEmpresa_."-".$usuarioDonoEmbarc->id); 
                                                    $href_ = "";
                                                    if (count($embarcacoes) > 0) {
                                                        $href_ = ' - <a target="_blank" style="color:#00918e; text-decoration: underline;" href="'.$link_anunciante.'">Ver mais modelos</a>';
                                                    }
                                                ?>
                                                <span class="title-l3-bloco2-deemb"><?php echo $nomeEmpresa; ?><?php echo $href_;?></span>
                                            </div>
                                            <div class="div-text-end-bloco2-l3-deemb">
                                                <span class="text-l3-bloco3-deemb tel-add">
                                                    <a href="#" class="link-view-tel" data-tel="<?php echo $telefone; ?>">(ver telefone)</a>
                                                </span>
                                            </div>
                                            <div class="div-text-end-bloco2-l3-deemb">
                                                <?php if($estado == "Sem Estado"): $estado = ""; endif;?>
                                                <span class="text-l3-bloco3-deemb"><?php echo $cidade.' - '.$estado; ?></span>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>
                                
                                <hr/>
                                
                                <p><?php echo $model->descricao;?></p>
                                <div class="quadro-l1-deemb6">
                                    <?php
                                        echo '<div class="quadro-l1-deemb6b" style="border-top: 0px;">
                                            <div class="div-info-quadros-view3">
                                                <icon class="icon1-deemb "></i>
                                                    <span class="text-fixo-deemb">Preço:</span>
                                                    </div>
                                                    <div class="div-info-quadros-view4">
                                                    <span class="text-dnmc-deemb1">';
                                        if (empty($model->valor) || $model->valor == '0.00') {
                                            echo 'R$ não informado';
                                        } else {
                                            echo 'R$ ' . Utils::formataValorView((float) $model->valor);
                                        }
                                        echo '</span>
                                            </div>
                                        </div>';
                                    ?>

                                    <?php
                                    if ($modelo->embarcacaoTipos->titulo != "") {
                                        echo '<div class="quadro-l1-deemb6b" >
                                            <div class="div-info-quadros-view3">
                                                <icon class="icon2-deemb "></i>
                                                <span class="text-fixo-deemb">Tipo:</span>
                                                </div>
                                                <div class="div-info-quadros-view3">
                                                <span class="text-dnmc-deemb1">';
                                        echo $modelo->embarcacaoTipos->titulo;
                                        echo '</span>
                                                </div>
                                        </div>';
                                    }
                                    ?>

                                    <?php
                                    if ($model->estado != "") {
                                        echo '<div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view3">
                                            <icon class="icon3-deemb "></i>
                                                <span class="text-fixo-deemb">Estado:</span>
                                                </div>
                                                <div class="div-info-quadros-view4">
                                                <span class="text-dnmc-deemb1">';
                                        //echo $model->estado = ('U') ? 'Usado' : 'Novo';
                                        echo $novoOuUsado;
                                        echo '</span>
                                                </div>
                                            </div>';
                                    }
                                    ?>

                                    <?php
                                    if ($model->ano != null) {
                                        echo '<div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width:190px">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb" style="width:200px">Ano de Fabricação:</span>
                                                    </div>
                                                    <div class="div-info-quadros-view3">
                                                    <span class="text-dnmc-deemb1">';
                                        if ($model->ano == 0) {
                                            echo 'Não informado';
                                        } else {
                                            echo $model->ano;
                                        }
                                        echo '</span>
                                                    </div>
                                            </div>';
                                    }
                                    ?>

                                    <?php
                                    // jetski n tem esse campo
                                    if ($modelo->tamanho != null && $fabricante->embarcacao_macros_id != 1) {
                                        echo '<div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view3">
                                                <icon class="icon5-deemb "  style="margin-top: 5px !important;"></i>
                                                    <span class="text-fixo-deemb" style="margin-top: -5px;">Tamanho:</span>
                                                    </div>
                                                    <div class="div-info-quadros-view4">
                                                    <span class="text-dnmc-deemb1">';
                                        if ($modelo->tamanho == 0.00) {
                                            echo 'Não informado';
                                        } else {
                                            echo number_format($modelo->tamanho, 0) . ' pés';
                                        }
                                        echo '</span>
                                                    </div>
                                            </div>';
                                    }
                                    ?>

                                    <?php
                                    if ($fabricante->embarcacao_macros_id != 1 && (strlen($modelo->passageiros) > 0 || strlen($modelo->acomodacoes) > 0)) {
                                        echo '<div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view3" style="margin-right:10px">
                                                <icon class="icon6-deemb "></i>
                                                <span class="text-fixo-deemb">Tripulação:</span>
                                                </div>
                                                <div class="div-info-quadros-view3">
                                                    <span class="text-dnmc-deemb1">';
                                        echo 'Pass Dia: ' . $modelo->passageiros . ' | Pass Noite: ' . $modelo->acomodacoes . '</span>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    ?>


                                    <?php
                                    if ($model->estados != null && $model->cidades != null) {
                                        echo '<div class="quadro-l1-deemb6b">
                                                <icon class="icon7-deemb "></i>
                                                    <span class="text-fixo-deemb">Local:</span>
                                                    <span class="text-dnmc-deemb7" style="width:210px !important;">';
                                        if ($model->cidades != null) {
                                            echo $model->cidades->nome;
                                        }

                                        if ($model->estados != null) {
                                            echo ' | ' . $model->estados->uf;
                                        }

                                        echo '</span>
                                            </div>';
                                    }
                                    ?>

                                    <?php
                                    if ($model->combustivel != NULL && $model->combustivel != "") {
                                                                   
                                        echo '<div class="quadro-l1-deemb6b" >
                                            <div class="div-info-quadros-view3" style="width:145px !important;">
                                                <icon class="icon2-deemb "></i>
                                                <span class="text-fixo-deemb">Combustível:</span>
                                                </div>
                                                <div class="div-info-quadros-view3">
                                                <span class="text-dnmc-deemb1">';
                                        echo $model->combustivel;
                                        echo '</span>
                                                </div>
                                        </div>';
                                   
                                    } ?>
                                  

                                </div>
                                
                                <?php if ($model->status == Embarcacoes::ACTIVE): ?>

                                    <div class="quadro-l1-deemb8">
                                        <a class="botao-deemb-contato btn-lbox ax-track-event" data-ax-trackname="detalhe entre em contato" data-lbox="#lbox-detemba" id="btn-contato-detemba" >Tire suas dúvidas com o anunciante</a>
                                        <icon class="icon8-deemb"></icon>
                                    </div>

                                <?php else: ?>

                                    <?php $status_class = ($model->status == Embarcacoes::SOLD) ? 'sold' : 'expired'; ?>
                                    <?php $status_txt = ($model->status == Embarcacoes::SOLD) ? 'Anúncio Vendido!' : 'Anúncio Indisponível'; ?>

                                    <div class="quadro-l1-deemb8">
                                        <div style="border-color:red; color:red;" class="anuncio-view-status <?php echo $status_class; ?>"><?php echo $status_txt; ?></div>
                                        <icon class="anuncio-view-icon"></icon>
                                    </div>

                                <?php endif ?>
                                
                                <?php
                                    /*if ($model->descricao != "") {

                                        echo '<div class="quadro-deemb">
                                                <icon class="icon5-deemb"><span class="text-fixo-deemb" style="margin-top: -5px;"></span></icon>
                                                <h2 class="title">Descrição da embarcação</h2>
                                                
                                                <span class="text">';
                                        echo $model->descricao;
                                        echo '  </span>
                                              </div>';
                                    }*/
                                ?>


                                <?php
                                    // motores
                                    if ($fabricante->embarcacao_macros_id != Anuncio::$_categoria_embarcacao['JETSKI']) {

                                        if (count($model->motores) > 0) {

                                            echo '<div class="quadro-deemb">
                                                    <icon class="icon2-deemb"><span class="text-fixo-deemb"></span></icon>
                                                    <h2 class="title">Motorização</h2>
                                                    <span class="text">';

                                            echo 'Quantidade de motores: ' . count($model->motores);
                                            echo '<br/>';
                                            $motor = $model->motores[0];
                                            echo 'Modelo: ' . $motor->motorModelos->titulo;
                                            echo ' | ';
                                            //echo 'Potência: '.number_format($motor->motorModelos->potencia, 0, '.', '') . ' HP';
                                            echo 'Potência: ' . $motor->motorModelos->potencia . ' HP';
                                            echo ' | ';
                                            echo 'Tipo: ' . $motor->motorModelos->motorTipos->titulo;
                                            echo ' | ';
                                            echo 'Fabricante: ' . $motor->motorModelos->motorFabricantes->titulo;
                                            echo ' | ';
                                            if($motor->horas != "") {
                                                echo 'Horas de uso: ' . $motor->horas . 'h';
                                            }


                                            echo '  </span>
                                                  </div>';
                                        } else {

                                             echo '<div class="quadro-deemb">
                                                    <icon class="icon2-deemb "><span class="text-fixo-deemb"></span></icon>
                                                    <h2 class="title">Motorização</h2>
                                                    <span class="text">';
                                            echo 'Não possui motor.';
                                            echo '  </span>
                                                  </div>';

                                        }
                                    }

                                    // jetski
                                    else {
                                        if ($modelo->motor_de_fabrica != null) {

                                            echo '<div class="quadro-deemb">
                                                    <icon class="icon2-deemb "><span class="text-fixo-deemb"></span></icon>
                                                    <h2 class="title">Motorização</h2>
                                                    <span class="text">';
                                            echo $modelo->motor_de_fabrica;
                                            echo '  </span>
                                                  </div>';
                                        } else {

                                            echo '<div class="quadro-deemb">
                                                    <icon class="icon2-deemb "><span class="text-fixo-deemb"></span></icon>
                                                    <h2 class="title">Motorização</h2>
                                                    <span class="text">';
                                            echo 'Não foi informado o motor do jetski';
                                            echo '  </span>
                                                  </div>';
                                        }
                                    }
                                ?>

                                <div id="acessorios-emb">

                                    <?php
                                        // acessórios e equipamentos
                                        if (count($model->embarcacaoAcessorioses) > 0) {

                                            $flgAchouAcessorio = false;

                                            foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
                                                    $flgAchouAcessorio = true;
                                                    break;
                                                }
                                            }

                                            if ($flgAchouAcessorio) {

                                                echo '<div class="quadro-deemb">
                                                        <icon class="icon3-deemb "><span class="text-fixo-deemb"></span></icon>
                                                        <h2 class="title">Acessórios e Equipamentos</h2>
                                                        <span class="text">';

                                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
                                                        $array_acessorios[] = $acessorio->acessorios->titulo;
                                                    }
                                                }
                                                echo implode(' | ', $array_acessorios);

                                                echo '  </span>
                                                      </div>';
                                            }
                                        }
                                    ?>


                                    <?php
                                        // acessórios e equipamentos
                                        if (count($model->embarcacaoAcessorioses) > 0) {

                                            $flgAchouAcessorio = false;

                                            foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
                                                    $flgAchouAcessorio = true;
                                                    break;
                                                }
                                            }

                                            if ($flgAchouAcessorio) {

                                                echo '<div class="quadro-deemb">
                                                        <icon class="icon6-deemb "><span class="text-fixo-deemb"></span></icon>
                                                        <h2 class="title">Comunicação e Navegação</h2>
                                                        <span class="text">';

                                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
                                                        $array_acessorios_equipamentos[] = $acessorio->acessorios->titulo;
                                                    }
                                                }
                                                echo implode(' | ', $array_acessorios_equipamentos);

                                                echo '  </span>
                                                      </div>';
                                            }
                                        }
                                    ?>


                                    <?php
                                        // acessórios e equipamentos
                                        if (count($model->embarcacaoAcessorioses) > 0) {

                                            $flgAchouAcessorio = false;

                                            foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
                                                    $flgAchouAcessorio = true;
                                                    break;
                                                }
                                            }

                                            if ($flgAchouAcessorio) {

                                                echo '<div class="quadro-deemb">
                                                        <icon class="icon4-deemb"><span class="text-fixo-deemb"></span></icon>
                                                        <h2 class="title">Equipamentos Eletrônicos</h2>
                                                        <span class="text">';

                                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
                                                        $array_acessorios_eletronicos[] = $acessorio->acessorios->titulo;
                                                    }
                                                }
                                                echo implode(' | ', $array_acessorios_eletronicos);

                                                echo '  </span>
                                                      </div>';
                                            }
                                        }
                                    ?>

                                    <?php
                                        // acessórios e equipamentos
                                        if (count($model->embarcacaoAcessorioses) > 0) {

                                            $flgAchouAcessorio = false;

                                            foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_MESTRA']) {
                                                    $flgAchouAcessorio = true;
                                                    break;
                                                }
                                            }

                                            if ($flgAchouAcessorio) {

                                                echo '<div class="quadro-deemb">
                                                        <icon class="icon7-deemb "><span class="text-fixo-deemb"></span></icon>
                                                        <h2 class="title">Vela Mestra</h2>
                                                        <span class="text">';

                                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_MESTRA']) {
                                                        $array_acessorios_vela_mestra[] = $acessorio->acessorios->titulo;
                                                    }
                                                }

                                                echo implode(' | ', $array_acessorios_vela_mestra);

                                                echo '  </span>
                                                      </div>';
                                            }
                                        }
                                    ?>

                                    <?php
                                        // acessórios e equipamentos
                                        if (count($model->embarcacaoAcessorioses) > 0) {

                                            $flgAchouAcessorio = false;

                                            foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_GENOA']) {
                                                    $flgAchouAcessorio = true;
                                                    break;
                                                }
                                            }

                                            if ($flgAchouAcessorio) {

                                                echo '<div class="quadro-deemb">
                                                        <icon class="icon7-deemb "><span class="text-fixo-deemb"></span></icon>
                                                        <h2 class="title">Vela Genoa</h2>
                                                        <span class="text">';

                                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_GENOA']) {
                                                        $array_acessorios_vela_genoa[] = $acessorio->acessorios->titulo;
                                                    }
                                                }
                                                echo implode(' | ', $array_acessorios_vela_genoa);

                                                echo '  </span>
                                                      </div>';
                                            }
                                        }
                                    ?>
                                </div>
                            </div> <!-- FIM DESCRICAO -->
                 
                            <div id="financiamento" class="tab">
                                <div class="quadro-l3-deemb3">
                                    
                                    <!--div class="quadro-l3-deemb3d">
                                        <a class="botao-deemb-4 btn-lbox ax-track-event" data-ax-trackname="detalhe cotacao financiar" data-lbox="#lbox-detemba3" id="btn-financ-detemba">Fazer cotação</a>
                                    </div-->
                                
                                    <!-- Lightbox Financeira -->
                                    <div class="financeira">
                                        <span class="sub-detail">Campos obrigatórios*</span>
                                        <div class="quadro-l3-deemb3b">
                                            <a href="http://www.financeiraalfa.com.br/home/" target="_blank"><img src="<?php echo Yii::app()->createUrl('img/logo-alfa.png'); ?>" alt="Alfa Financeira"></a>
                                        </div>
                                        <div class="quadro-l3-deemb3c">
                                            <div class="div-title-bloco3-l3-deemb">
                                                <span class="title-l3-bloco2-deemb">Precisando financiar?</span>
                                                <br><span class="sub-title">Financiar é uma das maneiras mais rápidas para obter a embarcação que você quer.</span>
                                            </div>
                                        </div>
                                        <div class="texts-lbox-ag">
                                            <!--input type="button" id="close" class="fechar-form close" value="X" />
                                            <img src="< ?php echo Yii::app()->createUrl('img/logo-alfa.png'); ?>" alt="Alfa Financeira"-->
                                            <p>São prazos com planos de até 60 meses e diversas linhas de crédito: <strong>Consulte um especialista da Alfa Financeira</strong></p>
                                        </div>
                                        <form id="form_finan" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
                                            <div class="form-nome-ag">
                                                <input name="finan_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1 contatos_parceiros" value="<?php echo $nome; ?>" type="text" required="required">
                                            </div>
                                            <div class="form-nome-ag">
                                                <input name="finan_email" placeholder="Seu e-mail*" class="terms-ag-1 contatos_parceiros" type="email" value="<?php echo $email; ?>" required="required">
                                            </div>
                                            <div class="form-nome-ag">
                                                <input name="finan_phone" placeholder="Seu telefone*" class="terms-ag-1 contatos_parceiros" type="tel" value="<?php echo $celular; ?>" required="required">
                                            </div>
                                            
                                            <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />
                                            <input type="submit" data-form="form_finan" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form envelope-envia" value="SOLICITAR CONTATO" />
                                            <input type="hidden" name="finan_id" value="<?php echo $model->id; ?>" />
                                            <input type="hidden" name="finan_titulo" value="<?php echo $fabricante->titulo . ' ' . $model->embarcacaoModelos->titulo; ?>" />
                                            <input type="hidden" name="finan_valor" value="<?php echo $model->valor; ?>" />
                                            <input type="hidden" name="finan_link" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
                                            <input type="hidden" name="finan_parceiro" value="Alfa Financeira" />
                                            <input type="hidden" name="partner_type" value="finan" />
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="transporte" class="tab">
                                <div class="quadro-l3-deemb3">
                                    
                                        <div class="consorcio" id="">
                                            <span class="sub-detail">Campos obrigatórios*</span>
                                            <div class="quadro-l3-deemb3b">
                                            <a href="http://www.bombarco.com.br/transporte-de-lancha-veleiro-jetski" target="_blank">
                                                <!--<img src="<?php //echo Yii::app()->createUrl('img/LOGO_CSC.jpg'); ?>" alt="Transporte">-->
                                            </a>
                                            </div>
                                        <div class="quadro-l3-deemb3c" style="width:100% !important;">
                                            <div class="div-title-bloco3-l3-deemb" style="margin-left:0px !important;">
                                                <span class="title-l3-bloco2-deemb">Leve a sua embarcação com segurança e eficiência</span>
                                                <br>
                                                <span class="sub-title">Comprar ou vender uma embarcação também demanda se preparar para o transporte dela e, consequentemente, os seus custos. Para isso, é necessário uma transportadora especialista no assunto.</span><br/>
                                            </div>
                                        </div>
                                        <div class="texts-lbox-ag">

                                            <p><strong>Todo o suporte necessário para transportar sua lancha</strong></p>
                                        </div>
                                        <form id="form_trans" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST">
                                            <div class="form-nome-ag">
                                                <input name="trans_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1" value="<?php echo $nome; ?>" type="text" required="required">
                                            </div>
                                            <div class="form-nome-ag">
                                                <input name="trans_email" placeholder="Seu e-mail*" class="terms-ag-1" type="email" value="<?php echo $email; ?>" required="required">
                                            </div>
                                            <div class="form-nome-ag">
                                                <input name="trans_phone" placeholder="Seu telefone*" class="terms-ag-1" type="tel" value="<?php echo $celular; ?>" required="required">
                                            </div>
                                            
                                            <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />
                                            <input type="submit" data-form="form_trans" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form" value="SOLICITAR CONTATO" />
                                            <input type="hidden" name="trans_id" value="<?php echo $model->id; ?>" />
                                            <input type="hidden" name="trans_titulo" value="<?php echo $fabricante->titulo . ' ' . $modelo->titulo; ?>" />
                                            <input type="hidden" name="trans_valor" value="<?php echo $model->valor; ?>" />
                                            <input type="hidden" name="trans_link" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
                                            <input type="hidden" name="trans_parceiro" value="Transporte " />
                                            <input type="hidden" name="partner_type" value="trans" />
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                 
                            <div id="consorcio" class="tab">
                                <div class="quadro-l3-deemb3">
                                    
                                    <!--div class="quadro-l3-deemb3d">
                                        <a class="botao-deemb-4 btn-lbox ax-track-event" data-ax-trackname="detalhe cotacao consorcio" data-lbox="#lbox-detemba2" id="btn-seguro-detemba">Fazer cotação</a>
                                    </div-->
                                    
                                    <!-- Lightbox Consórcio -->
                                    <div class="consorcio" id="">
                                        <span class="sub-detail">Campos obrigatórios*</span>
                                        <div class="quadro-l3-deemb3b">
                                            <a href="http://www.unifisa.com.br/" target="_blank"><img src="<?php echo Yii::app()->createUrl('img/logo-unifisa.png'); ?>" alt="Unifisa"></a>
                                        </div>
                                        <div class="quadro-l3-deemb3c">
                                            <div class="div-title-bloco3-l3-deemb">
                                                <span class="title-l3-bloco2-deemb">Pensando em consórcio?</span>
                                                <br>
                                                <span class="sub-title">É possível comprar barcos e lanchas em até 100 parcelas, sem juros.</span>
                                            </div>
                                        </div>
                                        <div class="texts-lbox-ag">
                                            <!--img src="< ?php echo Yii::app()->createUrl('img/logo-unifisa.png'); ?>" alt="Unifisa"-->
                                            <p><strong>Consulte os especialistas da Unifisa</strong> e encontre um plano perfeito pra você: </p>
                                        </div>
                                        <form id="form_cons" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
                                            <div class="form-nome-ag">
                                                <input name="cons_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1 contatos_parceiros" value="<?php echo $nome; ?>" type="text" required="required">
                                            </div>
                                            <div class="form-nome-ag">
                                                <input name="cons_email" placeholder="Seu e-mail*" class="terms-ag-1 contatos_parceiros" type="email" value="<?php echo $email; ?>" required="required">
                                            </div>
                                            <div class="form-nome-ag">
                                                <input name="cons_phone" placeholder="Seu telefone*" class="terms-ag-1 contatos_parceiros" type="tel" value="<?php echo $celular; ?>" required="required">
                                            </div>
                                            <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />

                                            <input type="submit" data-form="form_cons" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form" value="SOLICITAR CONTATO" />
                                            <input type="hidden" name="cons_id" value="<?php echo $model->id; ?>" />
                                            <input type="hidden" name="cons_titulo" value="<?php echo $fabricante->titulo . ' ' . $modelo->titulo; ?>" />
                                            <input type="hidden" name="cons_valor" value="<?php echo $model->valor; ?>" />
                                            <input type="hidden" name="cons_link" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
                                            <input type="hidden" name="cons_parceiro" value="Unifisa" />
                                            <input type="hidden" name="partner_type" value="cons" />
                                        </form>
                                    </div>
                                </div>
                                
                            </div>

                            <div id="marina" class="tab">
                                <div class="quadro-l3-deemb3">
                                    
                                    <!--div class="quadro-l3-deemb3d">
                                        <a class="botao-deemb-4 btn-lbox ax-track-event" data-ax-trackname="detalhe cotacao consorcio" data-lbox="#lbox-detemba2" id="btn-seguro-detemba">Fazer cotação</a>
                                    </div-->
                                    
                                    <!-- Lightbox Consórcio -->
                                    <div class="consorcio" id="">
                                        <span class="sub-detail">Campos obrigatórios*</span>
                                        <div class="quadro-l3-deemb3b">
                                            <a href="http://www.unifisa.com.br/" target="_blank"><img src="<?php echo Yii::app()->createUrl('img/logo-unifisa.png'); ?>" alt="Unifisa"></a>
                                        </div>
                                        <div class="quadro-l3-deemb3c">
                                            <div class="div-title-bloco3-l3-deemb">
                                                <span class="title-l3-bloco2-deemb">Pensando em consórcio?</span>
                                                <br>
                                                <span class="sub-title">É possível comprar barcos e lanchas em até 100 parcelas, sem juros.</span>
                                            </div>
                                        </div>
                                        <div class="texts-lbox-ag">
                                            <!--img src="< ?php echo Yii::app()->createUrl('img/logo-unifisa.png'); ?>" alt="Unifisa"-->
                                            <p><strong>Consulte os especialistas da Unifisa</strong> e encontre um plano perfeito pra você: </p>
                                        </div>
                                        <form id="form_marina" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
                                            <div class="form-nome-ag">
                                                <input name="marina_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1 contatos_parceiros" value="<?php echo $nome; ?>" type="text" required="required">
                                            </div>
                                            <div class="form-nome-ag">
                                                <input name="marina_email" placeholder="Seu e-mail*" class="terms-ag-1 contatos_parceiros" type="email" value="<?php echo $email; ?>" required="required">
                                            </div>
                                            <div class="form-nome-ag">
                                                <input name="marina_phone" placeholder="Seu telefone*" class="terms-ag-1 contatos_parceiros" type="tel" value="<?php echo $celular; ?>" required="required">
                                            </div>
                                            <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />

                                            <input type="submit" data-form="form_marina" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form" value="SOLICITAR CONTATO" />
                                            <input type="hidden" name="marina_id" value="<?php echo $model->id; ?>" />
                                            <input type="hidden" name="marina_titulo" value="<?php echo $fabricante->titulo . ' ' . $modelo->titulo; ?>" />
                                            <input type="hidden" name="marina_valor" value="<?php echo $model->valor; ?>" />
                                            <input type="hidden" name="marina_link" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
                                            <input type="hidden" name="marina_parceiro" value="Preço de Marina" />
                                            <input type="hidden" name="partner_type" value="marina" />
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                    
                    </div> <!-- FIM TABS -->
                    <div class="quadro-l3-deemb4 pure-u-1-5 pure-u-sm-5-5">
                        <section style="text-align:center;" class="advertise-deemb">
                            <?php
                            echo '<span class="publicidade">Publicidade</span>';
                            echo Banners::loadBanner(Banners::LATERAL, $fabricante->embarcacao_macros_id, array('width' => 200, 'height' => 446), true);
                            ?>
                        </section>
                    </div>
                </div>          
            </div>
        </div>
    </div>

    <div id="fake">
        <!-- mais deste anunciante -->
        <?php
        if(count($embarcacoes_semelhantes) > 0) {
            $this->renderPartial('_embarcacoes_semelhantes_novo', array('embarcacoes_semelhantes'=>$embarcacoes_semelhantes));
        }
        ?>
    </div>
    
    <div class="line-deemb3">
        <div class="container">
            <div class="box-deemb3 pure-u-1 pure-u-sm-5-5">

                <div class="quadro-l3-deemb2 pure-u-12-12">

                    <?php if ($usuarioDonoEmbarc->logo != null): ?>
                        <div class="quadro-l3-deemb2b pure-u-3-12">
                            <a href="#">
                                <img class="bg-img-l3-deemb" src="<?php echo Yii::app()->request->baseUrl . '/public/usuarios/' . $usuarioDonoEmbarc->logo; ?>">
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="quadro-l3-deemb2c pure-u-5-12">
                        <div class="div-textos-l3-deemb">
                            <div class="div-title-bloco2-l3-deemb">

                                <span class="title-l3-bloco2-deemb"><?php echo $nomeEmpresa . $href_; ?></span>
                            </div>
                            
              <?php if ($usuarioDonoEmbarc->nome != null && $usuarioDonoEmbarc->nome != ""): ?>
                                    <div class="div-text-bloco2-l2-deemb">
                                        <?php $sobrenome = $usuarioDonoEmbarc->sobrenome != "" ? $usuarioDonoEmbarc->sobrenome : ""; ?>
                                        <span class="text-l3-bloco3-deemb verde">
                                            <b><?php echo $usuarioDonoEmbarc->nome. ' ' .$sobrenome; ?></b>
                                        </span>

                                    </div>
              <?php endif; ?>
                            
                            <div class="div-text-end-bloco2-l3-deemb">
                                <span class="text-l3-bloco3-deemb tel-add">
                                    <a href="#" class="link-view-tel" data-tel="<?php echo $telefone; ?>">(ver telefone)</a>
                                </span>
                            </div>
                            <div class="div-text-end-bloco2-l3-deemb">
                                <span class="text-l3-bloco3-deemb"><?php echo $cidade.' - '.$estado; ?></span>
                            </div>
                            
                            <?php if ($model->status == Embarcacoes::ACTIVE): ?>

                                <div class="quadro-l1-deemb8">

                                    <a class="botao-deemb-contato btn-lbox ax-track-event" data-ax-trackname="detalhe entre em contato" id="btn_contato2">Tire suas dúvidas com o anunciante</a>
                                    <icon class="icon8-deemb"></icon>
                                </div>
                            <?php else: ?>

                                <?php $status_class = ($model->status == Embarcacoes::SOLD) ? 'sold' : 'expired'; ?>
                                <?php $status_txt = ($model->status == Embarcacoes::SOLD) ? 'Anúncio Vendido!' : 'Anúncio Indisponível'; ?>

                                <div class="quadro-l1-deemb8">
                                    <div style="border-color:red; color:red;"  class="anuncio-view-status <?php echo $status_class; ?>"><?php echo $status_txt; ?></div>
                                    <icon class="anuncio-view-icon"></icon>
                                </div>

                            <?php endif ?>

                        </div>
                        
                    </div>
                    <div class="quadro-l3-deemb2c f-right  pure-u-4-12" id="mais-anuncios">
                        <div class="div-textos-l3-deemb">
                            <?php
                                if (count($embarcacoes) > 0) {
                                    $this->renderPartial('_embarcacoes_anunciante_novo', array('embarcacoes' => $embarcacoes));
                                }
                            ?>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
        <br class="clear" />
    </div>

    <!-- Contato -->
    <div class="lbox-ag" id="lbox-detemba">
        <div class="texts-lbox-ag">
            <input type="button" id="close-form-contato" class="fechar-form close" value="X">
            <div>
                <span class="ev-titleb">'Envie uma 'mensagem para o vendedor desta embarcação</br></span>
                <span id="erro-contato" style="color:red;"></span>
            </div>
        </div>

        <div id="erro-contato-anunciante" class="div-sucess-lbox"></div>

        <div class="form-nome-ag nome-contato-anunciante">
                <input placeholder="Seu nome*" id="nome-contato-anunciante" value="<?php echo $nome; ?>" class="terms-ag-1" type="text" required="required">
        </div>
        <div class="form-nome-ag email-contato-anunciante">

                <input placeholder="Seu e-mail*" value="<?php echo $email; ?>" id="email-contato-anunciante" class="terms-ag-1" type="text" required="required">
        </div>
        <div class="form-nome-ag telefone-contato-anunciante">
                <input placeholder="Telefone*" value="<?php echo $celular; ?>" id="telefone-contato-anunciante" class="terms-ag-1" type="tel">
        </div>
        <div class="form-nome-ag mensagem-contato-anunciante">
            <textarea style="height:100px; width:430px;" id="mensagem-contato-anunciante" class="terms-ag-1" placeholder="Mensagem*" required="required"></textarea>
        </div>
        <span class="sub-detail">Campos obrigatórios*</span>

        <div class="div-pergunta-partners">
            <!--<div style="margin-bottom: 3px;">Tenho interesse em:</div>-->
            <div style="margin-bottom: 10px; padding-left: 30px; font-weight: bold;">Consórcio <input type="checkbox" id="partner_cons" data-form="form_cons" class="checkbox_partners_lgbox checkl1" value="1"></div>
            <div style="padding-left: 30px; margin-bottom: 10px; font-weight: bold;">Arrais amador <input class="checkl1" type="checkbox" value="1"></div>
            <!--<div style="padding-left: 30px; margin-bottom: 10px; font-weight: bold;">Preço de Marina <input type="checkbox" id="partner_marina" class="checkbox_partners_lgbox checkl1" data-form="form_marina" value="1"></div>-->
            <div style="padding-left: 30px; margin-bottom: 10px; font-weight: bold;">Transporte <input type="checkbox" id="partner_trans" class="checkbox_partners_lgbox checkl1" data-form="form_trans" value="1"></div>
        </div>

        <input type="text" name="j8BSVuvy" class="j8BSVuvy" value="" style="display:none !important;" />
        <input type="button" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-contato-anunciante" value="ENVIAR MENSAGEM"/>
    </div>

</section>

<div id="div-lightbox-video"></div>


<!-- campos hidden -->

<!-- contem o id da embarcação -->
<input type="hidden" id="id_embarcacao" value="<?php echo $model->id; ?>"/>

<!-- contem a flag que indica se o usuario ja favoritou a embarcação -->
<?php
if ($flgJaFavoritou) {
    // ja favoritou, gerar campo hidden com value 1
    echo CHtml::hiddenField('flgFavoritou', '1', array('id' => 'flgFavoritou'));
} else {
    echo CHtml::hiddenField('flgFavoritou', '0', array('id' => 'flgFavoritou'));
}

// id do usuario dono da embarcação
echo CHtml::hiddenField('idUsuarioDonoEmbarc', $idUsuarioDonoEmbarc, array('id' => 'idUsuarioDonoEmbarc'));

// id da embarcação
echo CHtml::hiddenField('idEmbarcacao', $model->id, array('id' => 'idEmbarcacao'));

// email da embarcação
echo CHtml::hiddenField('emailEmbarcacao', $model->email, array('id' => 'emailEmbarcacao'));

// nome destinatário
echo CHtml::hiddenField('nome_destinatario', $usuarioDonoEmbarc->nome, array('id' => 'nome-contato'));

// indica se há usuario logado ou não
// 0 => não está logado
// 1 => está logado
if (!Yii::app()->user->isGuest) {
    echo CHtml::hiddenField('isGuest', 1, array('id' => 'isGuest'));
} else {
    echo CHtml::hiddenField('isGuest', 0, array('id' => 'isGuest'));
}

// form de contato (campo que indica se é uma resposta ao anunciante ou nao (aqui no caso nao é, valor zero então))
echo CHtml::hiddenField('resposta', 0, array('id' => 'resposta'));
?>
