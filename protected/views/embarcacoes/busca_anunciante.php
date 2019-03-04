<?php
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/embarcacoes_busca.js?'.microtime(), CClientScript::POS_END);

           
?>
<section class="content">
    <?php
       // $this->renderPartial('_form_busca', array('array_view'=>$array_view, 'array_params'=>$array_params, 'breadcrumbs'=>$breadcrumbs));
    ?>

    <div class="line-white-3-listagem">
        <div class="container">

            <?php if (count($array_view['embarcacoes']) > 0): ?>

            <div class="checkbox-lis-emb">


                



                <?php if ($array_view["usuarioDonoEmbarc"]->logo != null): ?>
                    <div class="quadro-l3-deemb2b" style="height: 0px !important;">
                        <a href="#">
                            <img class="bg-img-l3-deemb" src="<?php echo Yii::app()->request->baseUrl . '/public/usuarios/' . $array_view["usuarioDonoEmbarc"]->logo; ?>">
                        </a>
                    </div>
                <?php endif; ?>

            <div class="resultados-box">
                    <?php
                       /* echo '<span class="resultados-title">Você buscou por "' . $array_params['busca'];
                        if (count($array_view['embarcacoes']) > 1){
                            echo '", foram encontrados ' . count($array_view['embarcacoes']) . ' resultados</span>';
                        } else {
                            echo ', foi encontrado ' . count($array_view['embarcacoes']) . ' resultado</span>';
                        }*/
                        echo '<span style="line-height: 55px !important; margin-left:100px;" class="resultados-title">- '.count($array_view['embarcacoes']) . ' modelos';
                    ?>
                </div>
            </div>
            <?php endif ?>

            <?php $empresas_relacionadas = Empresas::anunciosRelacionados(Macros::$macro_by_slug['empresa']); ?>
            <?php $embarcacoes_relacionadas = Embarcacoes::anunciosRelacionados(2); ?>

            <?php if(count($embarcacoes_relacionadas) > 0 || count($empresas_relacionadas) > 0): ?>

                    <div class="box-cinza-lateral-bb">
                        <div class="div-title-lateral-anuncios">
                            <span class="title-lateral-anuncios">Anúncios Patrocinados</span>
                        </div>
                        <div class="div-coluna-blocos-list">


                            <?php if(count($embarcacoes_relacionadas) > 0): ?>

                                        <div class="bloco-an-re1">
                                            <div class="title-lw3-lat-listagem">

                                                <span class="title-lw3-lat-list"> Classificados </span>
                                            </div>

                                            <div class="box-listagem-lat">

                                            <?php $i = 0;?>
                                                <?php foreach ($embarcacoes_relacionadas as $key => $value): ?>

                                                    <?php if($i != 0) : echo "<br/>"; ?>
                                                    <?php endif; ?>

                                                    <?php $i++; ?>

                                                    <ul class="categories-listagem-lat">
                                                        <li class="category-listagem–lat">
                                                            <?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-listagem-lat'), true); ?>
                                                            <?php
                                                            // se tiver destaque poe a classe com o selo de destaque
                                                            if(Embarcacoes::checkTurbo($value, 'destaque_busca'))
                                                                echo '<i class="faixa-destaque-emba"></i>';
                                                            ?>
                                                        </li>

                                                    </ul>
                                                    <div class="textos-lat">

                                                    <?php

                                                        $titulo = "";
                                                        if(Embarcacoes::checkTurbo($value, "titulo") == true) {
                                                            $titulo = $value->titulo;
                                                        }                                                                                                                                                                 
                                                    ?>
                                                        <?php echo '<h2 class="text-list-lat-title">'.$value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $value->embarcacaoModelos->titulo. ' '. '<b>'.$titulo.'</b></h2>'; ?>
                                                        <span class="text-list-lat-ano"> Ano: </span>
                                                        <span class="text-list-lat-ano-rnd"> <?php echo Embarcacoes::exibirAnoView($value->ano); ?> </span><br>
                                                        <span class="text-list-lat-price"><?php echo ($value->valor > 0?"R$ " . number_format($value -> valor, 2, ',', '.'):" R$ não informado"); ?></span><br/>
                                                        <div  style="margin-top: 8px; cursor:pointer;" class="balao_contato" data-email="<?php echo $value->email;?>" data-embarcid="<?php echo $value->id; ?>" data-link="<?php echo Embarcacoes::mountUrl($value); ?>" data-valor="<?php echo $value->valor;?>" data-titulo="<?php echo Embarcacoes::getAlt($value);?>">
                                                            <img style="cursor:pointer; float:left;" class="balao" data-email="<?php echo $value->email; ?>" data-embarcid="<?php echo $value->id;?>" src="<?php echo Yii::app()->createUrl('img/icon_chat.png'); ?>"/>
                                                            <span style="float:left; margin-left:5px; font-size:13px;">Entre em contato</span>
                                                        </div>
                                                    </div>

                                                <?php endforeach ?>

                                            </div>
                                                
                                        </div>
                                <?php endif ?>

                            <?php if(count($empresas_relacionadas) > 0): ?>
                                    <div class="bloco-an-re2">

                                        <div class="title-lw3-lat2-listagem">
                                            <span class="title-lw3-lat2-list"> Guia de Empresas </span>
                                        </div>




                                        <div class="box-listagem-lat2">

                                            

                                            <?php foreach ($empresas_relacionadas as $key => $value): ?>

                                                <ul class="categories-listagem-lat">

                                                    <li class="category-listagem–lat">

                                                        <?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class'=>'bg-img-listagem-lat')); ?>

                                                    </li>

                                                </ul>

                                                <div class="textos-lat">
                                                    <span class="text-list-lat-title"> <?php echo $value->nomefantasia; ?> </span>
                                                    <!--<span class="text-list-lat-ano">Localizacão: </span>-->
                                                    <!--<span class="text-list-lat-ano-rnd"> <?php $value->estados->uf; ?> </span>-->
                                                </div>

                                            <?php endforeach ?>

                                        </div>
                                    </div>
                            <?php endif ?>
                        </div>
                    </div>

            <?php endif ?> 



            <div class= "box-tabela-bb">
                <ul class="categories-tabela">
                <?php

                    foreach($array_view['embarcacoes'] as $embarc) {

                        echo '<li class="category-tabela">';

                            echo Embarcacoes::getThumb($embarc, array('class'=>'bg-img-tabela'), true);                           

                            // se tiver destaque poe a classe com o selo de destaque
                            if(Embarcacoes::checkTurbo($embarc, 'destaque_busca') == true) {
                                echo '<i class="faixa-destaque-emba"></i>';
                            }

                            //HTML BUSCA
                            echo '<div class="textos-tabela-bb">';
                                
                                $titulo = "";
                                if(Embarcacoes::checkTurbo($embarc, "titulo") == true) {
                                    $titulo = $embarc->titulo;
                                }                                                                                                                                                                 
                                echo '<h2 class="text-tabela-bb-title">'.$embarc->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarc->embarcacaoModelos->titulo. ' '. '<b>'.$titulo.'</b></h2>';
                                

                                if ($embarc->status == Embarcacoes::ACTIVE) {

                                    echo '<h2 class="text-tabela-bb-ano">Ano: <b>'.$embarc->ano.'</b></h2>';
                                    echo '<h2 class="text-tabela-bb-estado">Estado: <b>' . Embarcacoes::$_estado[$embarc->estado] . '</b></h2>';
                                    echo '<h2 class="text-tabela-bb-price">';
                                    echo ($embarc->valor > 0?"R$ " . number_format($embarc -> valor, 2, ',', '.'):"R$ não informado");
                                    echo '</h2>';

                                    echo '<div  style="cursor:pointer;" class="balao_contato" data-email="'. $embarc->email . '" data-embarcid="'. $embarc->id . '" data-link="'.Embarcacoes::mountUrl($embarc).'" data-valor="'.$embarc->valor.'" data-titulo="'.Embarcacoes::getAlt($embarc).'">';
                                    echo '<img style="cursor:pointer; float:left;" class="balao" data-email="'. $embarc->email . '" data-embarcid="'. $embarc->id . '" src="'. Yii::app()->createUrl("img/icon_chat.png"). '"/>';
                                    echo '<span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>';  
                                    echo '</div>';
                                }

                                else {

                                    echo '<h2 class="text-tabela-bb-price">Anúncio vendido</h2>';

                                }
                                
                                // echo '<h2 class="text-tabela-bb-ano-rnd">'.$embarc->ano.'</h2>';
                                // echo '<h2 class="text-tabela-bb-estado-rnd">' . Embarcacoes::$_estado[$embarc->estado] . '</h2>';

                            echo '</div>';


                        echo '</li>';

                    }
                ?>
                </ul>


                <?php if (count($array_view['embarcacoes']) == 0): ?>
                <div class="resultados-box" style="text-align:center !important;">
                    <span class='resultados-title'>Nenhum resultado encontrado.</span>
                    <span class="resultados-tip">Faça uma nova busca ou navegue nas categorias abaixo.</span>
                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda');?>" class="resultados-categorias resultados-tip-lancha">Lanchas</a>
                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda');?>" class="resultados-categorias resultados-tip-veleiro">Veleiros</a>
                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda');?>" class="resultados-categorias resultados-tip-jet-skis">Jet Skis</a>
                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda');?>" class="resultados-categorias resultados-tip-pesca">Pesca</a>
                    <a style="background: url(https://www.bombarco.com.br/themes/bombarco/img/imagem-pagina-nao-encontrada-motores.png) no-repeat center center;" href="<?php echo Yii::app()->createUrl('motores');?>" class="resultados-categorias resultados-tip-motor"></a>

                </div>
                <?php endif ?>

            </div>

                <div class="advertise-home_banner">
                    <?php echo Banners::loadBanner(Banners::HORIZONTAL, 2, array('width'=>728, 'height'=>90), true); ?>
                </div>
                <br class="clear">

        </div>

        <div class="fundo-cinza-lateral"></div>
    </div>


    <?php /*$cpm = Embarcacoes::cpm($array_params['macro']); ?>

    <?php if (count($cpm) > 0): ?>

        <div class="line-white-5-listagem">
            <div class="container" >
                <div class="title-lw5-listagem">
                    <span class="title-lw5-list"> Mais embarcações desta categoria </span>
                </div>

                <div class="box-listagem">
                    <ul class="categories-listagem">

                        <?php foreach ($cpm as $key => $value): ?>

                            <li class="category-listagem">
                                <?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-listagem-lat','width'=>80, 'height'=>70), true); ?>
                                <span class="text-box-lis"> <?php echo $value->embarcacaoModelos->titulo; ?> <span>
                                <span class="price-box-lis"> R$ <?php echo Utils::formataValorView($value->valor); ?> <span>
                            </li>

                        <?php endforeach ?>

                    </ul>
                </div>

            </div>
        </div>

    <?php endif*/ ?>


    <?php

        // cookies
         $email = Yii::app()->request->cookies->contains('email') ? Yii::app()->request->cookies['email']->value : "";
         $celular = Yii::app()->request->cookies->contains('celular') ? Yii::app()->request->cookies['celular']->value : "";
         $nome = Yii::app()->request->cookies->contains('nome') ? Yii::app()->request->cookies['nome']->value : "";

    ?> 



    <div class="div-voltar-ao-topo-list">
        <a class="botao-voltar-ao-topo-list" id="btn-subir-bb">VOLTAR AO TOPO</a>
    </div>


        <!-- Contato -->
    <div class="lbox-ag" id="lbox-detemba">
        <div class="texts-lbox-ag">
            <input type="button" id="close-form-contato" class="fechar-form close" value="X">
            <div>
                <span class="ev-titleb">Envie uma mensagem para o vendedor desta embarcação</br></span>
                <span id="erro-contato" style="color:red;"></span>
            </div>
        </div>

        <div id="erro-contato-anunciante" class="div-sucess-lbox"></div>

        <div class="form-nome-ag nome-contato-anunciante">
                <input placeholder="Seu nome*"id="nome-contato-anunciante" value="<?php echo $nome; ?>" class="terms-ag-1" type="text" required="required">
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
            <!--<div style="padding-left: 30px; margin-bottom: 10px; font-weight: bold;">Financiamento <input type="checkbox" id="partner_finan" class="checkbox_partners_lgbox checkl1" data-form="form_finan" value="1"></div>-->
            <div style="padding-left: 30px; margin-bottom: 10px; font-weight: bold;">Transporte <input type="checkbox" id="partner_trans" data-form="form_trans" class="checkbox_partners_lgbox checkl1" value="1"></div>
        </div>

        <input type="text" name="j8BSVuvy" class="j8BSVuvy" value="" style="display:none !important;" />
        <input type="button" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-contato-anunciante" value="ENVIAR MENSAGEM" />
    </div>


    <!-- auxilia na hr de mandar a msg de contato -->
    <input type="hidden" id="idUsuarioDonoEmbarc"/>
    <input type="hidden" id="nome_destinatario"/>
    <input type="hidden" id="idEmbarcacao"/>
    <input type="hidden" id="emailEmbarcacao"/>

<div style="display:none;">
    <form id="form_finan" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
        <div class="form-nome-ag">
            <input name="finan_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1" value="<?php echo $nome; ?>" type="text" required="required">
        </div>
        <div class="form-nome-ag">
            <input name="finan_email" placeholder="Seu e-mail*" class="terms-ag-1" type="email" value="<?php echo $email; ?>" required="required">
        </div>
        <div class="form-nome-ag">
            <input name="finan_phone" placeholder="Seu telefone*" class="terms-ag-1" type="tel" value="<?php echo $celular; ?>" required="required">
        </div>
        
        <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />
        <input type="submit" data-form="form_finan" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form envelope-envia" value="SOLICITAR CONTATO" />
        <input type="hidden" class="hidden_partner_id" name="finan_id" value="" />
        <input type="hidden" class="hidden_partner_titulo" name="finan_titulo" value="" />
        <input type="hidden" class="hidden_partner_valor" name="finan_valor" value="" />
        <input type="hidden" class="hidden_partner_link" name="finan_link" value="" />
        <input type="hidden" name="finan_parceiro" value="Alfa Financeira" />
        <input type="hidden" name="partner_type" value="finan" />
    </form>

    <form id="form_cons" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
        <div class="form-nome-ag">
            <input name="cons_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1" value="<?php echo $nome; ?>" type="text" required="required">
        </div>
        <div class="form-nome-ag">
            <input name="cons_email" placeholder="Seu e-mail*" class="terms-ag-1" type="email" value="<?php echo $email; ?>" required="required">
        </div>
        <div class="form-nome-ag">
            <input name="cons_phone" placeholder="Seu telefone*" class="terms-ag-1" type="tel" value="<?php echo $celular; ?>" required="required">
        </div>
        <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />

        <input type="submit" data-form="form_cons" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form" value="SOLICITAR CONTATO" onclick="_gaq.push(['_trackEvent', 'detalhe-emb', 'click', 'enviar consorcio'])" sax-track="detalhe-emb" sax-properties="click:enviar consorcio;macro:Empresa/Vendedor" />
        <input type="hidden" class="hidden_partner_id"  name="cons_id" value="" />
        <input type="hidden" class="hidden_partner_titulo" name="cons_titulo" value="" />
        <input type="hidden" class="hidden_partner_valor" name="cons_valor" value="" />
        <input type="hidden" class="hidden_partner_link"  name="cons_link" value="" />
        <input type="hidden" name="cons_parceiro" value="Unifisa" />
        <input type="hidden" name="partner_type" value="cons" />
    </form>

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
        <input type="hidden" class="hidden_partner_id"  name="trans_id" value="" />
        <input type="hidden" class="hidden_partner_titulo" name="trans_titulo" value="" />
        <input type="hidden" class="hidden_partner_valor" name="trans_valor" value="" />
        <input type="hidden" class="hidden_partner_link"  name="trans_link" value="" />
        <input type="hidden" name="trans_parceiro" value="Transporte" />
        <input type="hidden" name="partner_type" value="trans" />
    </form>
</div>

</section>
