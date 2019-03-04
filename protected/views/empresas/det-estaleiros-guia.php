<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/det_estaleiros_guia_detalhe.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
?>

<?php if (Yii::app()->user->id == $model->usuarios_id): ?>
    <section id="menu-acesso">
        <?php
        $this->renderPartial('/minhaConta/menu');
        ?>
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
                if (Empresas::checkTurboNaoPago($model, 'fotos')
                        || Empresas::checkTurboNaoPago($model, 'video') ||
                        Empresas::checkTurboNaoPago($model, 'telefone') ||
                        Empresas::checkTurboNaoPago($model, 'descricao') ||
                        Empresas::checkTurboNaoPago($model, 'cpm')):
                    ?>
                    <img src="<?php echo Yii::app()->createUrl('img/anuncio-turbinado.png'); ?>" alt="Anúncio Turbinado!" class="anuncio-turb">
                <?php endif; ?>
            </div>
        </div>

        <div class="estatisticas-box">
            <div class="container">
                <div class="estatisticas-cell">
                    <span class="cell-title">Contatos</span>
                    <span class="cell-result"><?php echo number_format(Empresas::totalizarMensagens($model->id),0,",","."); ?></span>
                </div>
                <?php if (Empresas::checkTurboNaoPago($model, 'telefone')): ?>
                    <div class="estatisticas-cell">
                        <span class="cell-title">Cliques para <br/>ver Telefone:</span>
                        <span class="cell-result"><?php echo number_format($model->vertelefone,0,",","."); ?></span>
                    </div>
                <?php endif; ?>

                <div class="estatisticas-cell">
                    <span class="cell-title">Cliques:</span>
                    <span class="cell-result"><?php echo number_format($model->cliques,0,",","."); ?></span>
                </div>
                   <?php if (Empresas::checkTurboNaoPago($model, 'cpm')): ?>
                    <div class="estatisticas-cell">
                        <?php
                        $impressoes = Empresas::totalizarImpressoes($model->id);
                        ?>
                        <span class="cell-title">Impressões</span>
                        <span class="cell-result"><?php echo number_format($impressoes['impressoes'],0,",",".") . '/ <span>' . number_format($impressoes['limite'],0,",","."); ?></span></span>
                    </div>
                <?php endif; ?>
                <div class="estatisticas-cell">
                    <span class="cell-result">
                        <a data-link="empresa" href="<?php echo Yii::app()->createUrl('empresas/update', array('id' => $model->id)); ?>" class="botao-minha-conta bt-action">Editar</a>
                    </span>
                </div>
                <br class="clear">
            </div>
        </div>

    </section>
<?php endif; ?>

<section class="content">
    <?php if ($model->capa != '' && PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
        <div class="line-detfab-1" style="background-image:url(<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . rawurlencode($model->capa); ?>);"></div>
    <?php endif; ?>

    <section id="empresa">
        <div class="top-part">
            <div class="container">
                <?php if (PlanoUsuarios::isFree($model->planoUsuarios) == false) :?>
                <div class="info">
                <?php else : ?>
                <div class="info" style="border:none;">
                <?php endif; ?>
                    <span class="link"><a href="<?php echo Yii::app()->homeUrl; ?>">Home</a> > <a href="<?php echo Yii::app()->createUrl('guia-de-empresas'); ?>">Empresas</a> > <a href="<?php echo Yii::app()->request->url; ?>"><?php echo $model->nomefantasia; ?></a></span><br>


                    <div class="info-box">
                        <?php if ($model->logo != "" && PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
                        <div class="img-box">  
                           <img alt="<?php echo $model->nomefantasia; ?>" title="<?php echo $model->nomefantasia; ?>" class="" src="<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $model->logo; ?>">
                        </div>
                        <?php endif; ?>
                        <h1 class="info-title"><?php echo $model->nomefantasia; ?></h1>
                    </div>

                    <h2 class="info-desc">
                    <?php if ($model->minidescricao != null && PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
                        <?php echo $model->minidescricao; ?>
                    <?php endif; ?>
                    </h2>

                    <div class="bt-social">

                        <?php if ($model->email != ""): ?>
                            <div class="bt-info-empresa">
                                <a class="botao-enviar-email-l2-deest" id="btn-contato-detemba" onclick="_gaq.push(['_trackEvent', 'guia-de-empresas', 'click', 'enviar-email']);">E-mail</a>
                            </div>
                        <?php endif ?>

                        <?php if (Empresas::checkTurbo($model, 'telefone') && PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
                            <div class="bt-info-empresa">
                                <a class="botao-ver-lefone-l2-deest vertelefone" id="btn-seguro-detemba" onclick="_gaq.push(['_trackEvent', 'guia-de-empresas', 'click', 'ver_Telefone']); adwords_conversor('Bt_TCJeKtFwQkLPC4wM')" >Telefone</a>
                            </div>
                        <?php endif ?>

                        <?php if ($model->fanpage != null && PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
                            <div class="bt-info-empresa">
                                <a class="botao-facebook-l2-deest" target="_blank" href="<?php echo $model->fanpage; ?>">Facebook</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <?php if(PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
                <div class="map" style="width: 50%;">
                    <iframe id="iframe-maps"  width="100%" height="190" frameborder="0"></iframe>
                    <div class="end-box">
                        <span class="end-title">Endereço</span><br>
                        <span class="end-desc">
                            <?php $num = (!empty($model->numero)) ? $model->numero : 's/ número'; ?>
                            <?php $complemento = (!empty($model->complemento)) ? '<br>' . $model->complemento : ''; ?>
                            <?php echo $model->endereco . ', nº '.$num . $complemento . ' - ' . $model->bairro . '<br>' . $model->cidades->nome . '/' . $model->estados->uf . '<br>CEP:' . $model->cep; ?>
                        </span>

                        <div class="bt-social">
                            <?php if ($model->cep != null && $model->cep != ""): ?>
                                <div class="bt-info-empresa">
                                    <a target="_blank" href="<?php echo 'http://maps.google.com.br/?q=' . $model->endereco . ' ' . $model->bairro . ', ' . $model->numero . ', ' . $model->cidades->nome . ', ' . $model->cep; ?>" class="botao-como-chegar-l3-deest" id="btn-como-chegar">Como chegar</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>

    </section>


    <div id="descricao">
        <div class="container">
            <?php if ($model->descricao != "" && Empresas::checkTurbo($model, 'descricao') && PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
                <div class="quadro-l3-a-detfab">
                    <div class="div-title4-l2-detfab">
                        <h4 class="title4-l2-detfab">Descrição</h4>
                    </div>
                    <div class="div-text4-l2-detfab">
                        <h4 class="text4-l2-detfab"><?php echo $model->descricao; ?></h4>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>

    <!--<?php
// indica se tem imagem ou não
    /*$flgTemImagem = false;

    if (count($model->empresaImagens) > 0) {

        // tem imagem
        $flgTemImagem = true;

        // não tem imagem
    } else {
        $flgTemImagem = false;
    }

    $flgTemDescricao = false;

    if ($model->descricao != "") {

        // tem imagem
        $flgTemDescricao = true;

        // não tem imagem
    } else {
        $flgTemDescricao = false;
    }*/
    ?>-->

    <section id="media-empresa" class="container">
        <?php if ($model->empresaImagens && Empresas::checkTurbo($model, 'fotos') && PlanoUsuarios::isFree($model->planoUsuarios) == false) :?>
        <div class="img-box">
            <ul id="img-box-slider">
                <?php
                for ($i = 0; $i < count($model->empresaImagens); $i++) {
                        echo '<li><a href="#"><img alt="'.$model->nomefantasia.'" title="'.$model->nomefantasia.'" src="' . Yii::app()->request->baseUrl . '/public/empresas/' . $model->empresaImagens[$i]->imagem . '"/></a></li>';
                    }
                ?>
            </ul>
        </div>
        <?php endif; ?>
        <?php if (Empresas::checkTurbo($model, 'video') && $model->video != "" && PlanoUsuarios::isFree($model->planoUsuarios) == false) {
            $url = $model->video;
            parse_str( parse_url( $url, PHP_URL_QUERY ), $idVid );
        ?>
        <div class="box-video">
            <iframe width="100%" height="340px" src="https://www.youtube.com/embed/<?php echo $idVid['v']; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
        <?php }; ?>
    </section>





            <?php $embarcacoes = Empresas::embarcacoes($model->id); ?>
            <?php if (count($embarcacoes) > 0): ?>
                <div class="line-detfab-4">
                    <div class="container">
                        <div class="quadro-l4-a-detfab">
                            <div class="div-title-l4-detfab">
                                <h5 class="title-l4-detfab">Embarcações no Classificado</h5>
                            </div>
                            <?php if (count($embarcacoes) > 4) { ?>
                                <ul id="slider_embarcacoes" class="galeria-l4-detfab">
                                <?php } else { ?>
                                    <ul class="galeria-l4-detfab">
                                    <?php } ?>

                                    <?php foreach ($embarcacoes as $key => $value): ?>

                                        <?php if (isset($value->embarcacoes) && !empty($value->embarcacoes)): ?>
                                            <li class="category-detfab-l4">
                                                <?php echo Embarcacoes::getThumb($value->embarcacoes, array('class' => 'bg-img-detfab-l4'), true); ?>
                                                <div class="textos-deemb">
                                                    <h6 class="text-emba-title"> <?php echo $value->embarcacoes->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $value->embarcacoes->embarcacaoModelos->titulo; ?> </h6>
                                                    <h6 class="text-emba-ano"> Ano: </h6>
                                                    <h6 class="text-emba-estado"> Estado: </h6>
                                                    <h6 class="text-deemb-price" style="font-size:15px;"><?php
                                      if ($value->embarcacoes->valor == '0.00' || $value->embarcacoes->valor == "") {
                                          echo 'Não informado';
                                      } else {
                                          echo 'R$ ' . number_format($value->embarcacoes->valor, 2, ',', '.');
                                      }
                                      ?> </h6>
                                                    <h6 class="text-emba-ano-rnd"> <?php echo $value->embarcacoes->ano; ?> </h6>
                                                    <h6 class="text-emba-estado-rnd"> <?php echo (isset($value->embarcacoes->estados)) ? $value->embarcacoes->estados->uf : null; ?> </h6>
                                                </div>
                                            </li>
                                        <?php endif ?>
                                        

                                    <?php endforeach ?>

                                </ul>

                        </div>
                        <!-- <div class="quadro-l4-b-detfab">

                        </div> -->
                    </div>
                </div>
            <?php endif ?>

            <section class="tidings-2">
                <div class="container">

                    <div class="timeline">
                        <span class="title">Últimas Notícias</span>

                        <a href="<?php echo Yii::app()->createUrl('comunidade/noticias'); ?>" class="more-news">Ver todas</a>

                        <ul class="news-list">

                            <?php foreach ($noticias as $key => $value): ?>

                                <li class="news-item">
                                    <a href="<?php echo Conteudos::mountUrl($value); ?>">
                                        <span class="img-post">
                                            <?php if (isset($value->conteudoImagens[0])): ?>
                                                <img class="img-post" src="<?php echo Conteudos::getPath($value->conteudoImagens[0]->imagem); ?>">
                                            <?php else: ?>
                                                <img class="img-post" src="<?php echo Conteudos::getPath(); ?>">
                                            <?php endif ?>
                                        </span>
                                        <span class="texts">
                                            <span class="date"><?php echo $value->data; ?></span>
                                            <span class="link-post"><?php echo $value->titulo; ?></span>
                                        </span>
                                    </a>
                                </li>

                            <?php endforeach ?>

                        </ul>
                    </div>

                    <aside class="advertise-sidebar">
                        <span>Publicidade</span>
                        <?php echo Banners::loadBanner(Banners::LATERAL, null, array('width' => 200, 'height' => 446), true); ?>
                    </aside>

                </div>

                <div class="lbox-ag" id="lbox-detemba">
                    <div class="texts-lbox-ag">
                        <input type="button" id="close-form" class="fechar-form close" value="X">
                        <span class="ev-titleb">Envie uma mensagem para essa empresa</br></span>
                        <div class="errorMessage" id="erro-contato"></div>
                    </div>
                    <div id="erro-contato-anunciante" class="div-sucess-lbox"></div>
                    <div class="form-nome-ag nome-contato-anunciante">
                        <?php
                        if (!Yii::app()->user->isGuest) {
                            $email = Usuarios::getUsuarioLogado()->email;
                            $nome = Usuarios::getUsuarioLogado()->nome;
                            $telefone = Usuarios::getUsuarioLogado()->celular;
                            if ($telefone == "") {
                                $telefone = "";
                            }
                        } else {
                            $email = "";
                            $nome = "";
                            $celular = "";
                            $telefone = "";
                        }
                        ?>
                        <input placeholder="Seu nome*" value="<?php echo $nome; ?>" id="nome-contato-anunciante" class="terms-ag-1" type="text" required="required">
                    </div>
                    <div class="form-nome-ag email-contato-anunciante">
                        <input placeholder="Seu e-mail*" value="<?php echo $email; ?>" id="email-contato-anunciante" class="terms-ag-1" type="text" required="required">
                    </div>
                    <div class="form-nome-ag telefone-contato-anunciante">
                        <input placeholder="Telefone*" value="<?php echo $telefone; ?>" id="telefone-contato-anunciante" class="terms-ag-1" type="tel">
                    </div>
                    <div class="form-nome-ag mensagem-contato-anunciante">
                        <textarea style="height:130px; width:365px;" id="mensagem-contato-anunciante" class="terms-ag-1" placeholder="Mensagem*" required="required"></textarea>
                    </div>
                    <span class="sub-detail">Campos obrigatórios*</span>
                    <input type="button" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-contato-empresa" value="ENVIAR MENSAGEM">
                    <!-- campo hidden contendo o email da empresa -->
                    <input type="text" name="j8BSVuvy" class="j8BSVuvy" value="" style="display:none !important;" />
                    <input type="hidden" id="email_empresa" value="<?php echo $model->email; ?>"/>
                    <input type="hidden" id="nomefantasia" value="<?php echo $model->nomefantasia; ?>"/>
                    <input type="hidden" id="usuarios_id" value="<?php echo $model->usuarios_id; ?>"/>
                </div>

                <?php if ($model->telefone != "" && Empresas::checkTurbo($model, 'telefone') && PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>

                    <div class="lbox-menor" id="lbox-detemba2">
                        <div class="texts-lbox-ag">
                            <div class="title-lbox-menor-div">
                                <span class="ev-titleb"><?php echo $model->telefone; ?></br></span>
                            </div>
                            <input type="button" id="close" class="fechar-form-d close" value="X">
                        </div>
                    </div>

                <?php endif ?>



            </section>
            </section>

            <!-- hidden -->
            <?php
            echo CHtml::hiddenField('cidade', $model->cidades->nome, array('id' => 'cidade'));
            echo CHtml::hiddenField('endereco', $model->endereco, array('id' => 'endereco'));
            echo CHtml::hiddenField('numero', $model->numero, array('id' => 'numero'));
            echo CHtml::hiddenField('cep', $model->cep, array('id' => 'cep'));
            echo CHtml::hiddenField('flgEstaleiro', 0, array('id' => 'flgEstaleiro'));
            echo CHtml::hiddenField('usuarios_id_empresa', $model->usuarios_id, array('id' => 'usuarios_id_empresa'));
            ?>

