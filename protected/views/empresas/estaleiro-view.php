<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/empresas.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/det_estaleiros_guia_detalhe.js?244523', CClientScript::POS_END);
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
                <span class="estatisticas-title">Estatísticas<span> (total):</span></span>
            </div>
        </div>
        <div class="estatisticas-box">
            <div class="container">
                <div class="estatisticas-cell">
                    <span class="cell-title">Contatos</span>
                    <span class="cell-result"><?php echo number_format(Empresas::totalizarMensagens($model->id), 0, ",", "."); ?></span>
                </div>
                <!--<div class="estatisticas-cell">
                    <span class="cell-title">Cliques para <br>ver Telefone:</span>
                    <span class="cell-result"><?php /* echo number_format(Empresas::totalizarMensagens($model->vertelefone), 0, ",", "."); */?></span>
                </div>-->
                <div class="estatisticas-cell">
                    <span class="cell-title">Cliques:</span>
                    <span class="cell-result"><?php echo number_format($model->cliques, 0, ",", "."); ?></span>
                </div>
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
        <div class="line-det-est-1" style="background-image:url(<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . rawurlencode($model->capa); ?>);"></div>
    <?php endif; ?>

    <div class="line-det-est-2">
        <div class="container">
            <?php if(PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
            <h1 class="bloco-esq-deest-l2">
                <?php
                $url = Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg';
                if (!empty($model->logo)) {
                    $url = Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $model->logo;
                }
                echo CHtml::image($url, $model->nomefantasia, array('width' => '100%', 'height' => 'auto', 'title'=>$model->nomefantasia));
                ?>
            </h1>
            <?php endif;?>
            <div class="bloco-dir-deest-l2">
                <div>
                    <h1 class="title-l2-deest "><?php echo $model->nomefantasia; ?></h1>
                    <span class="title2-l2-deest"><a class="link-bd" href="<?php echo Yii::app()->homeUrl; ?>">Home</a> > <a class="link-bd" href="<?php echo Yii::app()->createUrl('estaleiros'); ?>">Marcas</a> > <?php echo $model->nomefantasia; ?></span>
                </div>
                <div class="div-botoes-est-view">
                    <div class="div-botao-email-deest" style="z-index:2 !important;">
                        <a class="botao-enviar-email-l2-deest" id="btn-contato-detemba" onclick="_gaq.push(['_trackEvent', 'detalhe-estaleiros', 'click', 'enviar-email']);">Enviar e-mail</a>
                    </div>
                    <?php if ((!empty($model->telefone) && PlanoUsuarios::isFree($model->planoUsuarios) == false) || $model -> id == 1466): ?>
                        <div class="div-ver-telefone-deest" style="z-index:2 !important;">
                            <a class="botao-ver-lefone-l2-deest vertelefone" id="btn-seguro-detemba" onclick="_gaq.push(['_trackEvent', 'estaleiro', 'click', 'ver_Telefone']); adwords_conversor('Bt_TCJeKtFwQkLPC4wM')">Ver Telefone</a>
                        </div>
                    <?php endif; ?>


                    <?php if ($model->fanpage != "" && PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
                        <div class="div-botao-facebook-deest">
                            <a class="botao-facebook-l2-deest" target="_blank" href="<?php echo $model->fanpage; ?>" id="facebook-l2-deest">Facebook</a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- se for destaque aparece endereço e descrição -->
<?php if (PlanoUsuarios::isFree($model->planoUsuarios) == false): ?>
    <div class="line-det-est-3">
        <div class="container">
            <div class="bloco-esq-deest-l3">
                <h4 class="title-bloco-esq-l3-deest">Endereço</h4>
                <h4 class="text-bloco-esq-l3-deest"><?php echo $model->endereco . ', nº '.$model->numero . ' - ' . $model->bairro . ' - ' . $model->cidades->nome . '/' . $model->estados->uf . ' - ' . $model->cep; ?></h4>

                <?php if ($model->cep != null && $model->cep != ""): ?>
                    <a style="margin-right: 30px;" target="_blank" href="<?php echo 'http://maps.google.com.br/?q=' . $model->endereco . ' ' . $model->bairro . ', ' . $model->numero . ', ' . $model->cidades->nome . ', ' . $model->cep; ?>" class="botao-como-chegar-l3-deest" id="btn-como-chegar">Como chegar</a>
                <?php endif; ?>
            </div>
            <div class="bloco-dir-deest-l3">
                <div class="div-text-l2-deest">
                    <h4 class="title-bloco-dir-l3-deest">Descrição</h4>
                    <h4 style="min-height:200px;" class="text-bloco-dir-l3-deest">
                        <?php if ($model->descricao == ""): ?>
                            Não há descrição disponível.
                        <?php else: ?>
                            <?php echo $model->descricao; ?>
                        <?php endif; ?>
                    </h4>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>

<?php
// exibir embarcacoes deste fabricante, caso tenha
$embarcacoes = Embarcacoes::estaleiro($model->id);
?>

<?php if (count($embarcacoes) > 0): ?>
    <div class="line-det-est-4">
        <div class="container">
            <div class="div-title-l4-deest">
                <span class="title-l4-deest">Embarcações desta marca</span>
            </div>
            <div class="box-grid-det-est">

                <div class="line-gray-deest">

                  <?php foreach ($embarcacoes as $key => $value): ?>

                      <!--Conteudo a Ser dinamico-->
                      <div id="div-emba">
                          <div class="box-unit-emba">
                              <ul class="categories-emba">
                                  <li class="category-emba">
                                      <?php echo Embarcacoes::getThumb($value, array('class' => 'bg-img-emba'), true, array(), $model->slug); ?>
                                  </li>
                              </ul>
                              <div class="textos-emba2">
                                  <h2 class="text-emba-title"> <?php echo $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $value->embarcacaoModelos->titulo; ?> </h2>
                                  <h2 class="text-emba-ano"> Ano: <?php echo $value->ano == "" ? "Não informado" : $value->ano; ?></h2>
                                  <h2 class="text-emba-estado"> Estado: <?php echo (isset($value->estados)) ? $value->estados->uf : ''; ?> </h2>
                                  <h2 class="text-deemb-price" style="font-size:15px !important;">
                                      <?php
                                      if ($value->valor == '0.00' || $value->valor == "") {
                                          echo 'Não informado';
                                      } else {
                                          echo 'R$ ' . number_format($value->valor, 2, ',', '.');
                                      }
                                      ?>

                                  </h2>

                              </div>
                          </div>
                      </div>
                      <!--End-->

                  <?php endforeach ?>

                </div>


            </div>
            <div class="botoes-deest">

                <?php if (count($embarcacoes) == Embarcacoes::LIMIT_SEARCH): ?>
                    <a class="botao-carregar-deest" id="carregar-deest" data-id="<?php echo $model->id; ?>" data-limit="<?php echo Embarcacoes::LIMIT_SEARCH; ?>">CARREGAR MAIS OPÇÕES</a>
                <?php endif ?>
                <a class="botao-voltar-ao-topo-deest" id="btn-subir-bb">VOLTAR AO TOPO</a>

            </div>
        </div>
    </div>
<?php endif; ?>


<div class="line-det-est-5">
    <section class="tidings">
        <div class="container">


            <?php if (count($noticias) > 0): ?>


                <div class="timeline">
                    <span class="title">Notícias Relacionadas</span>

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

            <?php endif ?>

            <!--<aside class="advertise-sidebar-det-est">
            <?php //echo Banners::loadBanner(Banners::LATERAL, null, array('width' => 200, 'height' => 446), true); ?>
            </aside>-->

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


        <?php if($model -> id == 1466){ ?>
        <div class="lbox-menor" id="lbox-detemba2">
            <div class="texts-lbox-ag">
                <div class="title-lbox-menor-div">
                    <span class="ev-titleb">(98) 3241-1573</br></span>
                </div>
                <input type="button" id="close" class="fechar-form-d close" value="X">
            </div>
        </div>
        <?php }else{ ?>
        <div class="lbox-menor" id="lbox-detemba2">
            <div class="texts-lbox-ag">
                <div class="title-lbox-menor-div">
                    <span class="ev-titleb"><?php echo $model->telefone; ?></br></span>
                </div>
                <input type="button" id="close" class="fechar-form-d close" value="X">
            </div>
        </div>
        <?php } ?>


    </section>
    <!--End Noticias-->

</div>

</section>

<?php
echo CHtml::hiddenField('flgEstaleiro', 1, array('id' => 'flgEstaleiro'));
echo CHtml::hiddenField('usuarios_id_empresa', $model->usuarios_id, array('id' => 'usuarios_id_empresa'));
?>
