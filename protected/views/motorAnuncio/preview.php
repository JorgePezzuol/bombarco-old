<style>
    .close-video {
        position: absolute;
        margin-top: -30px;
        /* text-decoration: none; */
        color: white;
        font-size: 30px;
        margin-left: 750px;
    }
    .icon4-deemb, .icon1-deemb, .icon2-deemb, .icon6-deemb, .icon5-deemb, .icon3-deemb {
        background: initial !important;
        left: -33px !important;
    }
</style>

<?php
    // scripts
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-ui.js?e=1111', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/motor_contato.js?e='.microtime(), CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/elevatezoom.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/motor_detalhe.js?t='.microtime(), CClientScript::POS_END);

    // meta tags
    $principal = MotorAnuncio::obterImgPrincipalPreview($motorPreview);
    if($principal != null) {
        Yii::app()->clientScript->registerMetaTag(Yii::app()->request->baseUrl . '/public/motores_preview/' . $principal, 'og:image:secure_url');    
    }
    Yii::app()->clientScript->registerMetaTag(MotorAnuncio::nomeAnuncio($motorPreview), 'og:title');
    Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true), 'og:site_name');
    Yii::app()->clientScript->registerMetaTag($motorPreview->descricao, 'og:description');
    $title = array("Motores | ", MotorAnuncio::nomeAnuncio($motorPreview));
    Yii::app()->clientScript->registerMetaTag(Utils::mountDescription($title), 'description', null, array(), 'bombarco_description');
?>


<?php
    // cookies
    $email = Yii::app()->request->cookies->contains('email') ? Yii::app()->request->cookies['email']->value : "";
    $celular = Yii::app()->request->cookies->contains('celular') ? Yii::app()->request->cookies['celular']->value : "";
    $nome = Yii::app()->request->cookies->contains('nome') ? Yii::app()->request->cookies['nome']->value : "";

    $anunciante = Usuarios::model()->findByPk($motorPreview->usuarios_id);
    $nomeEmpresa = ($anunciante->pessoa == 'J') ? $anunciante->nomefantasia : $anunciante->nome;

    $estado = Estados::model()->findByPk($anunciante->estados_id);
    if (!empty($estado))
        $estado = $estado->nome;

    $cidade = Cidades::model()->findByPk($anunciante->cidades_id);
    if (!empty($cidade))
        $cidade = $cidade->nome;
    if (!empty($anunciante->telefone)) {
        $telefone = $anunciante->telefone;
        if (!empty($anunciante->celular))
            $telefone .= ' / ' . $anunciante->celular;
    } else if (!empty($anunciante->celular)) {
        $telefone = $anunciante->celular;
    } else { }
?> 


<section class="content" id="alterada-sm">

    <title><?php echo Utils::mountTitle($title); ?></title>

    <div class="line-deemb1">
        <div class="container pure-g">
            <div class="box-deemb1 pure-u-1">
                
                <div class="quadro-l1-deemb1 pure-u-1">
                    <span class="text-top-deemb pure-u-3-5 pure-u-sm-5-5 pure-u-md-5-5" style="margin-top:40px !important; text-align:left;">
                        <?php //echo Utils::breadCrumbs($breadcrumbs); ?>
                        <a href="/">Home</a> &gt; <a href="#">Motores</a> &gt; <a href="#"><?php echo $motorPreview->motorFabricantes->titulo; ?></a> &gt; <a href="#"><?php echo $motorPreview->motorTipos->titulo; ?></a> &gt; <a href="#"><?php echo $motorPreview->potencia; ?></a>
                    </span>
                    <div class="search-deemb pure-u-2-5 pure-u-sm-5-5"> 
                        <?php echo CHtml::form(array('motorAnuncio/busca'), 'get', array('id' => 'form-search', 'name' => 'buscando')); ?>
                        <input name="busca-texto" placeholder="Buscar" class="terms-deemb" type="text">
                        <input class="find-deemb" type="submit">
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
                                
                <div class="clearfix"></div>

                <div class="quadro-l1-deemb3 pure-u-1">
                
                    <div class="quadro-l1-deemb2">
                        <div class="quadro-deemb pure-u-1">  


                        <h1 class="title-emb-deemb pure-u-6-12 pure-u-sm-12-12 pure-u-md-12-12"><?php echo MotorAnuncio::nomeAnuncio($motorPreview); ?></h1>
                            
                        <div class="redes pure-u-3-12 pure-u-sm-12-12 pure-u-md-12-12"> 
                            <!--<a class="btn-rede" href="#" id="botao-deemb1" title="Comparar"><i class="fa fa-exchange"></i></a>-->
                            <a href="#" class="btn-rede" title="Compartilhar no Facebook!"><i class="fa fa-facebook"></i></a>
                            <!--<a class="btn-rede add-favoritos" id="add-favoritos" title="Favoritar Produto"><i class="fa fa-heart"></i></a>-->
                        </div><!-- REDES SOCIAIS -->
                        </div>
                    </div>
                    
                    
                </div>

                

                
                <div class="clearfix"></div>
                
                <div class="quadro-l1-deemb5 pure-u-3-5 pure-u-sm-1 pure-u-md-1">
                    <div class="box-video">

                    </div>
                    <a href="#" class="img-principal pure-u-1">

                        <?php $principal = MotorAnuncio::obterImgPrincipalPreview($motorPreview); ?>

                        <?php if ($principal != null): ?>

                            <?php $imagem = Yii::app()->request->baseUrl . '/public/motores_preview/' . $principal; ?>

                            <img class="bg-img-slide-deemb" data-zoom-image="<?php echo $imagem; ?>" src="<?php echo $imagem; ?>" id="img-zoom" />

                        <?php else: ?>

                            <?php $imagem = Yii::app()->request->baseUrl . '/img/sem_foto_bb.jpg'; ?>

                            <img class="bg-img-slide-deemb" data-zoom-image="<?php echo $imagem; ?>" src="<?php echo $imagem; ?>" id="img-zoom" />

                        <?php endif; ?>
                    </a>


                    <div class="pure-u-4-5 slider-principal">
                        <div id="div-deemb1">

                            <?php if(count($motorPreview->motorImagensPreviews) > 0): ?>
                                    <ul class="slide-deemb pure-u-5-5">

                                        <?php foreach($motorPreview->motorImagensPreviews as $motorPreviewImg): ?>

                                            <?php $imagem = Yii::app()->request->baseUrl . '/public/motores_preview/' . $motorPreviewImg->imagem; ?>

                                            <li class="category-deemb pure-u-1-5">
                                                <a href="#" class="img-thumbnail-emb">
                                                    <img class="img-deemb-slide" src="<?php echo $imagem; ?>"/>
                                                </a>
                                            </li>

                                        <?php endforeach; ?>
                                        
                                    </ul>
                            <?php endif; ?>                           
                        </div>

                    </div>
                </div>              
                
                
                <div id="limita-form" class="pure-u-2-5 pure-u-sm-5-5">
                
                    <div id="mini-info">
                        
                        <div class="quadro-deemb">
                            <h2 class="title" id="valor_barco">
                            <?php
                                if (empty($motorPreview->valor) || $motorPreview->valor == '0.00') {
                                    echo 'R$ não informado';
                                } else {
                                    echo 'R$ ' . Utils::formataValorView((float) $motorPreview->valor);
                                }
                            ?>
                            </h2>

                            <h2 style="color:red;" id="msg_principal"></h2>
                            <br/>

                            <form id="form-contato" method="POST">
                                <input type="hidden" name="j8BSVuvy" value=""/>
                                <input type="hidden" name="ContatosMotor[id_motor_anuncio]" value="<?php echo $motorPreview->id; ?>"/>
                                <input type="hidden" id="email_dest" name="ContatosMotor[email_dest]" value="<?php echo $motorPreview->usuarios->email; ?>"/>
                                <div class="campo">
                                    <label>Nome: </label>
                                    <input id="nome_principal" name="ContatosMotor[nome]" class="campo-msg-principal" value="<?php echo $nome; ?>" type="text" required="required">
                                </div>
                                <div class="campo">
                                    <label>E-mail: </label>
                                    <input id="email_principal" name="ContatosMotor[email_rem]" class="campo-msg-principal" value="<?php echo $email; ?>" type="email" required="required">
                                </div>
                                <div class="campo">
                                    <label>Telefone: </label>
                                    <input id="celular_principal" name="ContatosMotor[telefone]" class="campo-msg-principal" value="<?php echo $celular; ?>" type="tel" autocomplete="off">
                                </div>
                                <div class="campo" id="div-msg">
                                    <span class="ponta"></span>
                                    <textarea id="mensagem_principal" name="ContatosMotor[mensagem]" class="campo-msg-principal" required="required">Olá, tenho interesse neste produto e gostaria de receber mais informações</textarea>
                                </div>
                            </form>


                            <div class="campo"> 
                                <!--<p>Quero saber mais sobre: </p>
                                <div class="check"><input type="checkbox" id="partner_marina_principal" value="1" data-form="form_marina" class="checkbox_partners"> Preço de marina</div>
                                <div class="check"><input type="checkbox" id="partner_cons_principal" value="1" data-form="form_cons" class="checkbox_partners"> Consórcio</div>
                                <div class="check"><input type="checkbox" id="partner_trans_principal" value="1" data-form="form_trans" class="checkbox_partners"> Transporte</div>-->
                                <div class="check total"><input type="checkbox" id="quero_receber" value="1" checked="checked"> Quero receber conteúdo exclusivo por e-mail <div class="tooltip"><i class="ajuda"></i> <span class="tooltiptext">Ao marcar esta opção você concorda em receber nossas novidades em seu endereço de e-mail.</span></div></div>
                            </div>
                            <div class="campo">
                                <a href="#" name="botao-cadastrar-form" class="btn-envia-proposta"><i class="envelope-envia"></i> Enviar Proposta</a>
                            </div>   


                        </div>

                        
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
                        <!--<li><a href="#transporte">Transporte</a></li>-->
                        <!--<li><a href="#consorcio">Consórcio</a></li>-->
                        <!--<li><a href="<?php //echo Yii::app()->createUrl('preco-de-marina'); ?>" target="_blank">Preço de Marina</a></li>-->
                        
                    </ul>
                 
                    <div class="limita-conteudo pure-u-1">
                        <div class="tab-content pure-u-1 pure-u-sm-5-5">
                            <div id="descricao" class="tab active">
                                <div class="quadro-l1-deemb2">
                                    
                                    <?php if ($anunciante->logo != null): ?>
                                        <div class="quadro-l3-deemb2b">
                                            <a href="#">
                                                <img class="bg-img-l3-deemb" src="<?php echo Yii::app()->request->baseUrl . '/public/usuarios/' . $anunciante->logo; ?>">
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="quadro-l3-deemb2c anunciante">
                                        <div class="div-textos-l3-deemb">
                                            <div class="div-title-bloco2-l3-deemb">
                                                <span class="title-l3-bloco2-deemb"><?php echo $nomeEmpresa; ?></span>
                                            </div>
                                            <div class="div-text-end-bloco2-l3-deemb">
                                                <span class="text-l3-bloco3-deemb tel-add">
                                                    <a href="#" class="ver_tel2" data-tel="<?php echo $telefone; ?>">(ver telefone)</a>
                                                </span>
                                            </div>
                                            <div class="div-text-end-bloco2-l3-deemb">
                                                <span class="text-l3-bloco3-deemb"><?php echo $cidade.' - '.$estado; ?></span>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>
                                
                                <hr/>
                                
                                <?php if($motorPreview->descricao != ""): ?>
                                    <p><?php echo $motorPreview->descricao; ?></p>
                                <?php endif; ?>

                                <div class="quadro-l1-deemb6">
 
                                    <div class="quadro-l1-deemb6b" style="border-top: 0px;">
                                        <div class="div-info-quadros-view3" style="width: 140px;">
                                            <icon class="icon1-deemb "></i>
                                            <span class="text-fixo-deemb">Preço:</span>
                                        </div>
                                        <div class="div-info-quadros-view4" style="width: 160px;">
                                            <span class="text-dnmc-deemb1">
                                                <?php if (empty($motorPreview->valor) || $motorPreview->valor == '0.00'): ?>
                                                    R$ não informado
                                                <?php else: ?>
                                                    <?php echo 'R$ ' . Utils::formataValorView((float) $motorPreview->valor); ?>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>

                                    <?php if ($motorPreview->motorTipos->titulo != ""): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <icon class="icon2-deemb "></i>
                                                <span class="text-fixo-deemb">Tipo:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->motorTipos->titulo; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($motorPreview->estado != null): ?>
                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <icon class="icon3-deemb "></i>
                                                <span class="text-fixo-deemb">Estado:</span>
                                            </div>
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->estado = ('U') ? 'Usado' : 'Novo'; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($motorPreview->ano != null): ?>
                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width:190px">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb" style="width:200px">Ano de Fabricação:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->ano; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                     

                                    <?php if($motorPreview->horas != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <icon class="icon5-deemb"></i>
                                                    <span class="text-fixo-deemb">Horas:</span>
                                            </div>
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <span class="text-dnmc-deemb1">

                                                    <?php echo $motorPreview->horas; ?>
                                                </span>

                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if($motorPreview->potencia != null): ?>
                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <icon class="icon6-deemb "></i>
                                                <span class="text-fixo-deemb">Potência:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->potencia; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($motorPreview->cilindrada != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 140px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">Cilindradas:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->cilindrada; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>


                                    <?php if ($motorPreview->rpm != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 140px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">RPM:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->rpm; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if ($motorPreview->combustivel != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">Combustível:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->combustivel; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if ($motorPreview->ampere != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">Ampére:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->ampere; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if ($motorPreview->sistema_partida != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">Partida:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->sistema_partida; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if ($motorPreview->direcao != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">Direção:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->direcao; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if ($motorPreview->comprimento_eixo != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">Eixo:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->comprimento_eixo; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if ($motorPreview->relacao_engrenagens != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">Engrenagens:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->relacao_engrenagens; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if ($motorPreview->peso_seco != null): ?>

                                        <div class="quadro-l1-deemb6b">
                                            <div class="div-info-quadros-view4" style="width: 160px;">
                                                <icon class="icon4-deemb"></i>
                                                    <span class="text-fixo-deemb">Peso:</span>
                                            </div>
                                            <div class="div-info-quadros-view3" style="width: 140px;">
                                                <span class="text-dnmc-deemb1">
                                                    <?php echo $motorPreview->peso_seco; ?>
                                                </span>
                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    

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
                            echo Banners::loadBanner(Banners::LATERAL, 2, array('width' => 200, 'height' => 446), true);
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
        /*if(count($embarcacoes_semelhantes) > 0) {
            $this->renderPartial('_embarcacoes_semelhantes_novo', array('embarcacoes_semelhantes'=>$embarcacoes_semelhantes));
        }*/
        ?>
    </div>
    
    <div class="line-deemb3">
        <div class="container">
            <div class="box-deemb3 pure-u-1 pure-u-sm-5-5">

                <div class="quadro-l3-deemb2 pure-u-12-12">

                    <?php if ($anunciante->logo != null): ?>
                        <div class="quadro-l3-deemb2b pure-u-3-12">
                            <a href="#">
                                <img class="bg-img-l3-deemb" src="<?php echo Yii::app()->request->baseUrl . '/public/usuarios/' . $anunciante->logo; ?>">
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="quadro-l3-deemb2c pure-u-5-12">
                        <div class="div-textos-l3-deemb">
                            <div class="div-title-bloco2-l3-deemb">
                                <span class="title-l3-bloco2-deemb"><?php echo $nomeEmpresa; ?></span>
                            </div>
                            
              <?php if ($anunciante->nome != null && $anunciante->nome != ""): ?>
                                    <div class="div-text-bloco2-l2-deemb">
                                        <?php $sobrenome = $anunciante->sobrenome != "" ? $anunciante->sobrenome : ""; ?>
                                        <span class="text-l3-bloco3-deemb verde">
                                            <b><?php echo $anunciante->nome. ' ' .$sobrenome; ?></b>
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
                            

                            <div class="quadro-l1-deemb8">

                                <a class="botao-deemb-contato btn-lbox ax-track-event" id="btn_contato2">Tire suas dúvidas com o anunciante</a>
                                <icon class="icon8-deemb"></icon>
                            </div>


                        </div>
                        
                    </div>
                    <div class="quadro-l3-deemb2c f-right  pure-u-4-12" id="mais-anuncios">
                        <div class="div-textos-l3-deemb">
                            <?php
                                /*if (count($embarcacoes) > 0) {
                                    $this->renderPartial('_embarcacoes_anunciante_novo', array('embarcacoes' => $embarcacoes));
                                }*/
                            ?>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
        <br class="clear" />
    </div>

</section>

