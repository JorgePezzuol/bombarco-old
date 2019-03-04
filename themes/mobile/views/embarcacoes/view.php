<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

var_dump("asdasdasd");

/*

  $model 	// embarcação
  $flgJaFavoritou
  $usuarioDonoEmbarc->usuarios_id
  $acessoriosJetSki
  $acessoriosLancha
  $acessoriosVeleiro
  $telefone
  $nomeEmpresa
  $embarcacoes
  $embarcacoes_semelhantes
  $flgTitulo
  $breadcrumbs
  $flgVideo
  $pag_estaleiro


 */

//url for share
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

// usuario dono da embarc
$usuarioDonoEmbarc = Usuarios::model()->findByPk($idUsuarioDonoEmbarc);
$logo = $usuarioDonoEmbarc->logo;


//gambi para novo/usado
$novoOuUsado = $model->estado;
if ($novoOuUsado == "U") {
    $novoOuUsado = "Usado";
} else {
    $novoOuUsado = "Novo";
}

//slider images class
if (count($model->embarcacaoImagens) == 1) {
    $class_slider = 'noslider';
} else {
    $class_slider = 'swiper-container';
}


//video frame
$video_id = null;
if (!empty($model->video) && preg_match('/(v=|&)/', $model->video)) {
    $url_video = $model->video;
    $step1 = explode('v=', $url_video);
    $step2 = explode('&', $step1[1]);
    $video_id = $step2[0];
}

//telefone call
$usuarioDonoEmbarc = UsuariosEmbarcacoes::model()->find('embarcacoes_id = :embarcacoes_id', array(':embarcacoes_id' => $model->id));
$user = Usuarios::model()->findByPk($usuarioDonoEmbarc->usuarios_id);
$character1 = '(';
$character2 = ')';
if ($user->telefone == NULL) {
    $tel_call = $user->celular;
    $string = str_replace($character1, "", $tel_call);
    $string_final = str_replace($character2, "", $string);
} else {
    $tel_call = $user->telefone;
    $string = str_replace($character1, "", $tel_call);
    $string_final = str_replace($character2, "", $string);
}

// indica se há usuario logado ou não
// 0 => não está logado
// 1 => está logado
if (!Yii::app()->user->isGuest) {
    echo CHtml::hiddenField('isGuest', 1, array('id' => 'isGuest'));
} else {
    echo CHtml::hiddenField('isGuest', 0, array('id' => 'isGuest'));
}

//se ja favoritou ou nao
if ($flgJaFavoritou) {
    // ja favoritou, gerar campo hidden com value 1
    echo CHtml::hiddenField('flgFavoritou', '1', array('id' => 'flgFavoritou'));
} else {
    echo CHtml::hiddenField('flgFavoritou', '0', array('id' => 'flgFavoritou'));
}
?>

<div class="header-single full-width">
    <div class="container">
        <a href="javascript:history.back();" class="btn-back sprite inline-block"></a>
        <article class="single-title inline-block"><?php echo $model->embarcacaoFabricantes->titulo . ' ' . $model->embarcacaoModelos->titulo; ?></article>
    </div>
</div>
<!-- src correto:  src="'.Yii::app()->request->baseUrl.'/public/embarcacoes/'.$model->embarcacaoImagens[$i]->imagem.'" -->
<div class="single-images full-width <?php echo $class_slider; ?>">
    <div class="slider-images swiper-wrapper">
        <?php for ($i = 0; $i < count($model->embarcacaoImagens); $i++) { ?>
            <div class="content-slider swiper-slide">
            <?php echo CHtml::image(Embarcacoes::getSrcCrop($model->embarcacaoImagens[$i]->imagem), '', array('class'=>'content-image')); ?>
                <?php //echo '<img class="content-image" src="' . Embarcacoes::getSrcCrop(Yii::app()->request->baseUrl.'/public/embarcacoes/'.$model->embarcacaoImagens[$i]->imagem) . '"  />'; ?>
            </div>
        <?php } ?>	
    </div>
    <div class="swiper-pagination"></div>
    <!-- <div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div> -->
</div>

<div class="first-infos full-width">
    <div class="container">
        <?php if ($model->valor != '') : ?>
            <p class="single-price">
                <?php
                if ($model->valor == 0.00 || $model->valor == "") {
                    echo 'R$ N/Info.';
                } else {
                    echo 'R$ ' . Utils::formataValorView((float) $model->valor);
                }
                ?>
            </p>
        <?php endif; ?>

        <div class="list-infos full-width">
            <?php if ($model->embarcacaoModelos->embarcacaoTipos->titulo != "") : ?>
                <div class="col-info inline-block">
                    <span class="title-col">Tipo: <br /> 
                        <span class="content-col"> 
                            <?php 
                                if ($model->embarcacaoModelos->embarcacaoTipos->titulo == 'Não informado') {
                                    echo 'N/Info.';
                                } else {
                                    echo $model->embarcacaoModelos->embarcacaoTipos->titulo;
                                } 
                            ?>
                        </span>
                    </span>
                </div>
            <?php endif; ?>
            <?php if ($model->estado != "") : ?>
                <div class="col-info inline-block">
                    <span class="title-col">Estado: <br /> 
                        <span class="content-col"> <?php echo $novoOuUsado; ?> </span>
                    </span>
                </div>
            <?php endif; ?>
            <?php if ($model->ano != null) : ?>
                <div class="col-info inline-block">
                    <span class="title-col">Ano: <br /> 
                        <span class="content-col">
                            <?php
                            if ($model->ano == 0) {
                                echo 'N/Info.';
                            } else {
                                echo $model->ano;
                            }
                            ?>
                        </span>
                    </span>
                </div>
            <?php endif; ?>
            <?php if ($model->embarcacaoModelos->tamanho != null && $model->embarcacao_macros_id != 1) : ?>
                <div class="col-info inline-block col-info-last">
                    <i class="ico-pes sprite inline-block"></i>
                    <span class="content-col">
                        <?php
                        if ($model->embarcacaoModelos->tamanho == 0.00) {
                            echo 'N/Info.';
                        } else {
                            echo number_format($model->embarcacaoModelos->tamanho, 0, '.', '') . ' pés';
                        }
                        ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="infos-footer full-width">
        <div class="container">
            <div class="list-infos full-width">
                <?php if ($model->embarcacao_macros_id != 1 && $model->embarcacaoModelos->passageiros > 0 && $model->embarcacaoModelos->acomodacoes > 0) : ?>
                    <div class="col-info info-daynight inline-block">
                        <i class="ico-dianoite sprite inline-block"></i>
                        <article class="info-content inline-block">
                            <span class="info-text">Dia: <span class="bold"><?php echo $model->embarcacaoModelos->passageiros; ?></span></span> <br />
                            <span class="info-text">Noite: <span class="bold"><?php echo $model->embarcacaoModelos->acomodacoes; ?></span></span>
                        </article>

                    </div>
                <?php endif; ?>
                <?php if ($model->estados != null && $model->cidades != null) : ?>
                    <div class="col-info info-local inline-block">
                        <i class="ico-local sprite inline-block"></i>
                        <article class="info-content inline-block">
                            <span class="bold">
                                <?php
                                if ($model->cidades != null) {
                                    echo $model->cidades->nome;
                                }
                                ?>
                            </span>
                            <br />
                            <span class="bold">
                                <?php
                                if ($model->estados != null) {
                                    echo $model->estados->uf;
                                }
                                ?>
                            </span>
                        </article>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="more-infos full-width">
    <div class="container">
        <div class="box-infos">
            <?php
            if ($model->embarcacao_macros_id != Anuncio::$_categoria_embarcacao['JETSKI']) {

                if (count($model->motores) > 0) {
                    ?>
                    <div class="single-box" data-tabdescription="1">
                        <div class="content-box">
                            <p class="title">Motor</p>
                            <p class="mini-description">
                                <?php
                                if (count($model->motores) > 0) {
                                    echo 'Quantidade de motores: ' . count($model->motores) . '...';
                                }
                                ?>
                            </p>
                            <i class="ico-arrow inline-block sprite"></i>
                            <article class="box-description" data-description="1">
                                <?php
                                if (count($model->motores) > 0) {
                                    echo 'Quantidade de motores: ' . count($model->motores);
                                    echo '<br/>';
                                    $motor = $model->motores[0];
                                    echo 'Modelo: ' . $motor->motorModelos->titulo;
                                    echo ' / ';
                                    //echo 'Potência: '.number_format($motor->motorModelos->potencia, 0, '.', '') . ' HP';
                                    echo 'Potência: ' . $motor->motorModelos->potencia . ' HP';

                                    echo ' / ';
                                    echo 'Tipo: ' . $motor->motorModelos->motorTipos->titulo;
                                    echo ' / ';
                                    echo 'Fabricante: ' . $motor->motorModelos->motorFabricantes->titulo;
                                    echo ' / ';
                                    echo 'Horas de uso: ' . $motor->horas . 'h';
                                } else {
                                    echo 'Não possuí motor';
                                }
                                ?>
                            </article>
                        </div>
                    </div>
                    <?php
                }
            } else {
                if ($model->embarcacaoModelos->motor_de_fabrica != null) {
                    ?>
                    <div class="single-box" data-tabdescription="1">
                        <div class="content-box">
                            <p class="title">Motor</p>
                            <p class="mini-description">
                                <?php
                                echo $model->embarcacaoModelos->motor_de_fabrica;
                                ?>
                            </p>
                            <i class="ico-arrow inline-block sprite"></i>
                            <article class="box-description" data-description="1">
                                <?php
                                echo $model->embarcacaoModelos->motor_de_fabrica;
                                ?>
                            </article>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="single-box" data-tabdescription="1">
                        <div class="content-box">
                            <p class="title">Motor</p>
                            <p class="mini-description">
                                <?php
                                echo 'Nenhum motor informado'
                                ?>
                            </p>
                            <i class="ico-arrow inline-block sprite"></i>
                            <article class="box-description" data-description="1">
                                <?php
                                echo 'Nenhum motor informado';
                                ?>
                            </article>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <?php if ($model->descricao != "") { ?>

                <div class="single-box" data-tabdescription="2">
                    <div class="content-box">
                        <p class="title">Descrição</p>
                        <p class="mini-description">
                            <?php
                            $string = $model->descricao;
                            $resume = substr($string, 0, 35);
                            echo '' . $resume . '...';
                            ?>
                        </p>
                        <i class="ico-arrow inline-block sprite"></i>
                        <article class="box-description" data-description="2">
                            <?php echo $model->descricao; ?>
                        </article>
                    </div>
                </div>

            <?php } ?>

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
                    ?>

                    <div class="single-box" data-tabdescription="3">
                        <div class="content-box">
                            <p class="title">Acessórios</p>
                            <p class="mini-description">
                                <?php
                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
                                        $array_acessorios[] = $acessorio->acessorios->titulo;
                                    }
                                }
                                $string = implode(' / ', $array_acessorios);
                                $resume = substr($string, 0, 35);
                                echo '' . $resume . '...';
                                ?>
                            </p>
                            <i class="ico-arrow inline-block sprite"></i>
                            <article class="box-description" data-description="3">
                                <?php
                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
                                        $array_acessorios[] = $acessorio->acessorios->titulo;
                                    }
                                }

                                echo implode(' / ', $array_acessorios);
                                ?>
                            </article>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>

            <?php
            if (count($model->embarcacaoAcessorioses) > 0) {

                $flgAchouAcessorio = false;

                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
                        $flgAchouAcessorio = true;
                        break;
                    }
                }

                if ($flgAchouAcessorio) {
                    ?>

                    <div class="single-box" data-tabdescription="4">
                        <div class="content-box">
                            <p class="title">Comunicação e Navegação</p>
                            <p class="mini-description">
                                <?php
                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
                                        $array_acessorios_equipamentos[] = $acessorio->acessorios->titulo;
                                    }
                                }

                                $string = implode(' / ', $array_acessorios_equipamentos);
                                $resume = substr($string, 0, 35);
                                echo '' . $resume . '...';
                                ?>
                            </p>
                            <i class="ico-arrow inline-block sprite"></i>
                            <article class="box-description" data-description="4">
                                <?php
                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
                                        $array_acessorios_equipamentos[] = $acessorio->acessorios->titulo;
                                    }
                                }

                                echo implode(' / ', $array_acessorios_equipamentos);
                                ?>
                            </article>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>

            <?php
            if (count($model->embarcacaoAcessorioses) > 0) {

                $flgAchouAcessorio = false;

                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
                        $flgAchouAcessorio = true;
                        break;
                    }
                }

                if ($flgAchouAcessorio) {
                    ?>

                    <div class="single-box" data-tabdescription="5">
                        <div class="content-box">
                            <p class="title">Equipamentos Eletrônicos</p>
                            <p class="mini-description">
                                <?php
                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
                                        $array_acessorios_eletronicos[] = $acessorio->acessorios->titulo;
                                    }
                                }

                                $string = implode(' / ', $array_acessorios_eletronicos);
                                $resume = substr($string, 0, 35);
                                echo '' . $resume . '...';
                                ?>
                            </p>
                            <i class="ico-arrow inline-block sprite"></i>
                            <article class="box-description" data-description="5">
                                <?php
                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                    if ($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
                                        $array_acessorios_eletronicos[] = $acessorio->acessorios->titulo;
                                    }
                                }

                                echo implode(' / ', $array_acessorios_eletronicos);
                                ?>
                            </article>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>

        </div>
    </div>
</div>

<div class="single-info-title full-width">
    <span class="info-title">Sobre o anunciante</span>
</div>
<div class="single-info-content full-width">
    <div class="container">
        <div class="box-content full-width">
            <div class="content">
                <?php if ($logo != null) : ?>

                    <div class="img-content inline-block">
                        <img class="image" src="<?php echo Yii::app()->request->baseUrl . '/public/usuarios/' . $logo; ?>" />
                    </div>
                <?php endif; ?>
                <article class="text-content inline-block">
                    <?php echo $nomeEmpresa; ?> <br />
                    <?php if ($estado != 'Não informado' && $cidade != 'Não informado') : ?>
                        <span class="text-light"><?php echo '' . $cidade . ' - ' . $model->estados->uf . ''; ?></span>
                    <?php endif; ?>
                </article>
                <?php if ($user->telefone != '' || $user->celular != '' ) { ?>
                    <a href="tel:<?php echo $string_final; ?>" class="ico-tel sprite inline-block flt-right"></a>
                <?php } ?>
                <br class="clear" />
            </div>
        </div>
    </div>
</div>


<div class="single-info-content info-consorcio full-width">
    <div class="container">
        <div class="box-content full-width">
            <div class="content">
                <div class="logo-consorcio sprite inline-block">
                    
                </div>
                <article class="text-content inline-block">
                    Pensando em <br /> consórcio?
                </article>
                <a href="#" class="ico-tel ico-email ico-contato-consorcio sprite inline-block flt-right"></a>
                <br class="clear" />
            </div>
        </div>
    </div>
</div>

<?php if ($model->video) : ?>

    <div class="single-info-title full-width">
        <span class="info-title">Vídeo</span>
    </div>

    <div class="single-info-content full-width">
        <div class="container">
            <div class="box-content full-width">
                <article class="text-video inline-block">Conheça a <?php echo $model->embarcacaoFabricantes->titulo . ' ' . $model->embarcacaoModelos->titulo; ?> </article>
                <i class="btn-video inline-block sprite" data-link="<?php echo $video_id; ?>"></i>
                <br class="clear" />
            </div>
        </div>
    </div>

    <div class="box-video">
        <i class="btn-close-boxvideo inline-block sprite"></i>
        <br class="clear" />
    </div>

<?php endif ?>

<?php
$embs_mais_anunciante = Embarcacoes::maisDesseAnunciante_mobile($idUsuarioDonoEmbarc, $model->id, null);
?>

<?php if (count($embs_mais_anunciante) > 0) : ?>
    <div class="single-info-title full-width">
        <span class="info-title">Mais deste anunciante</span>
    </div>
    <div class="results-search full-width">

        <div class="container" >
            <?php foreach ($embs_mais_anunciante as $key => $value): ?>
                <div class="result-content pure-g">
                    <a href="<?php echo Embarcacoes::mountUrl($value); ?>" class="link-result">
                        <div class="result-image pure-u-1-4">
                            <?php echo Embarcacoes::getThumb($value, array('class' => 'bg-img-resbus'), true); ?>
                        </div>
                        <div class="result-infos pure-u-3-4">
                            <?php
                            $result_title = $value->embarcacaoFabricantes->titulo . ' ' . $value->embarcacaoModelos->titulo;
                            $result_pes = substr($value->embarcacaoModelos->tamanho, 0, strpos($value->embarcacaoModelos->tamanho, '.'));
                            $result_price = $value->valor != '0.00' ? Utils::formataValorView($value->valor) : "N/Info.";
                            ?>
                            <div class="infos-content">
                                <article class="result-title"><?php echo $result_title; ?></article>


                                <?php if ($value->embarcacao_macros_id == 1): ?>

                                    <article class="info-content inline-block">
                                        <span class="info-text info-text-passageiros"><?php echo $value->embarcacaoModelos->embarcacaoTipos->titulo; ?></span>
                                    </article>
                                <?php else: ?>
                                    <i class="ico-pes inline-block sprite"></i>
                                    <span class="result-pes inline-block">
                                        <?php
                                        if ($result_pes == '0.00') {
                                            echo 'N/Info.';
                                        } else {
                                            echo '' . $result_pes . ' Pés';
                                        }
                                        ?>
                                    </span>
                                <?php endif; ?>


                                <span class="result-price inline-block">
                                    R$ <?php echo $result_price; ?> 
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endforeach; ?>

            <div  id="div-maisdesse-anunciante">
            </div>
            <?php if (count($embs_mais_anunciante) == 3) : ?>
                <div class="div-btn-carregar-list inline-block">
                    <div data-limit="3" id="btn-carregarmais-anunciante" class="btn-seemore">Carregar Mais</div>
                </div>
            <?php endif; ?>
            <i class="btn-slide-top inline-block sprite"></i>

        </div>
    </div>
<?php endif; ?>

<div style="height: 50px;">
</div>

<div class="single-footer full-width">
    <div class="container">
        <div class="btn-contato inline-block">Contato</div>
        <div class="btns-footer">
            <i id="add-favoritos" class="btn-favorito inline-block sprite"></i>
            <i class="btn-share inline-block sprite"></i>
        </div>
        <div class="box-favoritado">
            <article class="text-box">Adicionado <br /> aos favoritos!</article>
            <i class="ico-arrow-fav inline-block sprite"></i>
        </div>
        <div class="box-share">
            <a href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>" class="link-newtab link-share inline-block sprite link-facebook"></a>
            <a href="https://twitter.com/share?url=<?php echo $url; ?>&via=Bombarco" class="link-newtab link-share inline-block sprite link-twitter"></a>
            <a href="http://www.linkedin.com/shareArticle?url=<?php echo $url; ?>&title=<?php echo $model->embarcacaoFabricantes->titulo . ' ' . $model->embarcacaoModelos->titulo; ?>" class="link-newtab link-share inline-block sprite link-linkedin last"></a>
            <i class="ico-arrow inline-block sprite"></i>
        </div>
        <br class="clear" />
    </div>
</div>

<div class="box-contato box-contato-embarcacoes">

    <div class="header-contato full-width">
        <div class="container">
            <i class="btn-close-boxcontato inline-block sprite"></i>
            <article class="header-text">Envie uma mensagem para o vendedor desta embarcação</article>
            <div id="erro-contato-anunciante" class="teste"></div>
        </div>
    </div>

    <div class="content-contato full-width">
        <div class="container container-form">
            <label class="label-contato">Nome</label>


            <?php if (!Yii::app()->user->isGuest): ?>
                <?php
                $nome = "Nome";

                if (Usuarios::getUsuarioLogado()->nome != "") {
                    $nome = Usuarios::getUsuarioLogado()->nome;
                }
                ?>
                <input id="nome-contato-anunciante" value="<?php echo $nome; ?>" class="input-text" type="text">
            <?php else: ?>
                <input id="nome-contato-anunciante" class="input-text" value="" type="text">
            <?php endif; ?>


            <label class="label-contato">Email</label>

            <?php if (!Yii::app()->user->isGuest): ?>
                <input placeholder="Seu e-mail" value="<?php echo Usuarios::getUsuarioLogado()->email; ?>" id="email-contato-anunciante" class="input-text" type="text">
            <?php else: ?>
                <input placeholder="Seu e-mail" id="email-contato-anunciante" class="input-text" type="text">
            <?php endif; ?>

            <label class="label-contato">Telefone</label>
            <input placeholder="Seu telefone" id="telefone-contato-anunciante" class="input-text input-tel" type="tel">

            <label class="label-contato">Mensagem</label>
            <textarea id="mensagem-contato-anunciante" class="input-textarea"></textarea>

            <?php
            // id do usuario dono da embarcação
            echo CHtml::hiddenField('idUsuarioDonoEmbarc', $idUsuarioDonoEmbarc, array('id' => 'idUsuarioDonoEmbarc'));

            // id da embarcação
            echo CHtml::hiddenField('idEmbarcacao', $model->id, array('id' => 'idEmbarcacao'));

            // email da embarcação
            echo CHtml::hiddenField('emailEmbarcacao', $model->email, array('id' => 'emailEmbarcacao'));

            // form de contato (campo que indica se é uma resposta ao anunciante ou nao (aqui no caso nao é, valor zero então))
            echo CHtml::hiddenField('resposta', 0, array('id' => 'resposta'));
            ?>


            <input type="button" name="botao-cadastrar-form" class="input-submit" id="btn-contato-anunciante" value="Enviar Mensagem" />
            <i class="ico-submit sprite inline-block"></i>
        </div>
    </div>

</div>


<!-- contato consorcio -->
<div class="box-contato-consorcio">

    <div class="header-contato full-width">
        <div class="container">
            <i class="btn-close-boxcontato inline-block sprite"></i>
            <article class="header-text">Consulte os especialistas da Unifisa e encontre um plano perfeito pra você</article>
            <div id="erro-contato-consorcio" class="teste"></div>
        </div>
    </div>

    <div class="content-contato full-width">
        <div class="container container-form">
            <form id="form_lbox" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST">
                <label class="label-contato">Nome</label>

                <?php if (!Yii::app()->user->isGuest): ?>
                    <?php
                    $nome = "Nome";

                    if (Usuarios::getUsuarioLogado()->nome != "") {
                        $nome = Usuarios::getUsuarioLogado()->nome;
                    }
                ?>
                    <input id="form-1-ag-lb" value="<?php echo $nome; ?>" class="input-text" name="finan_nome" type="text">
                <?php else: ?>
                    <input id="form-1-ag-lb" class="input-text" value="" name="finan_nome" type="text">
                <?php endif; ?>


                <label class="label-contato">Email</label>

                <?php if (!Yii::app()->user->isGuest): ?>
                    <input placeholder="Seu e-mail" value="<?php echo Usuarios::getUsuarioLogado()->email; ?>" id="finan_email" class="input-text" name="finan_email" type="text">
                <?php else: ?>
                    <input placeholder="Seu e-mail" id="finan_email" class="input-text" name="finan_email" type="text">
                <?php endif; ?>

                <label class="label-contato">Telefone</label>
                <input placeholder="Seu telefone" id="finan_phone" class="input-text input-tel" name="finan_phone" type="tel">

                <input type="submit" name="botao-cadastrar-form" class="input-submit" id="btn-contato-consorcio" value="Enviar Contato" />
                <i class="ico-submit sprite inline-block"></i>

                <input type="text" name="C7RiUSGm" value="" style="display:none !important;" />
                <input type="hidden" name="finan_id" value="<?php echo $model->id; ?>" />
                <input type="hidden" name="finan_titulo" value="<?php echo $model->embarcacaoFabricantes->titulo . ' ' . $model->embarcacaoModelos->titulo; ?>" />
                <input type="hidden" name="finan_valor" value="<?php echo $model->valor; ?>" />
                <input type="hidden" name="finan_link" value="<?php echo Embarcacoes::mountUrl($model); ?>" />
                <input type="hidden" name="finan_parceiro" value="Unifisa" />            
                <input type="hidden" name="partner_type" value="cons" />
            </form>
        </div>
    </div>

</div>