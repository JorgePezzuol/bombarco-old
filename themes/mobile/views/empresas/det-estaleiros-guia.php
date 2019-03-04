<?php
//slider images class
if (count($model->empresaImagens) == 1) {
    $class_slider = 'noslider';
} else {
    $class_slider = 'swiper-container';
}

//video frame
if ($model->video) {
    $url_video = $model->video;
    $step1 = explode('v=', $url_video);
    $step2 = explode('&', $step1[1]);
    $video_id = $step2[0];
}

//telefone
$character1 = '(';
$character2 = ')';
$tel_call = $model->telefone;
$string = str_replace($character1, "", $tel_call);
$string_final = str_replace($character2, "", $string);
?>

<?php if ($model->destaque == '1'): ?>
    <div class="header-estaleiros full-width">
        <div class="container">
            <a href="javascript:history.back();" class="btn-back inline-block sprite flt-left"></a>
    <?php if (!empty($model->logo)): ?>
                <div class="box-logo inline-block">
                    <img class="" src="<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $model->logo; ?>">
                </div>
    <?php endif; ?> 
        </div>
    </div>
<?php endif; ?>


<div class="box-title full-width">
    <div class="container">
        <article class="title"><?php echo $model->razao; ?></article>
    </div>
</div>

<div class="box-actions">
    <div class="container">
        <i class="item-action action-email inline-block"></i>
        <?php if ($model->destaque == '1'): ?>
            <?php if ($model->telefone != "" && Empresas::checkTurbo($model, 'telefone')  ): ?>
                <a href="tel:<?php echo $string_final; ?>" class="item-action action-tel inline-block"></a>
            <?php endif; ?>
            <a href="<?php echo 'http://maps.google.com.br/?q=' . $model->endereco . ' ' . $model->bairro . ', ' . $model->numero . ', ' . $model->cidades->nome . ', ' . $model->cep; ?>" class="item-action action-place inline-block last"></a>
        <?php endif; ?>
    </div>
</div>

<?php if ($model->destaque == '1'): ?>

    <div class="more-infos full-width">
        <div class="container">
            <div class="box-infos">
                <?php if ($model->descricao != "" && Empresas::checkTurbo($model, 'descricao')  ): ?>
                    <div class="single-box" data-tabdescription="1">
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
                            <article class="box-description" data-description="1">
                                <?php echo $model->descricao; ?>
                            </article>
                        </div>
                    </div>
                <?php endif ?>
                <?php if ($model->telefone != "" && Empresas::checkTurbo($model, 'telefone')  ): ?>
                    <div class="single-box" data-tabdescription="2">
                        <div class="content-box">
                            <p class="title">Telefone</p>
                            <p class="mini-description">
                                <?php
                                $string = $model->telefone;
                                $resume = substr($string, 0, 10);
                                echo '' . $resume . '...';
                                ?>
                            </p>
                            <i class="ico-arrow inline-block sprite"></i>
                            <article class="box-description" data-description="2">
                                <?php echo $model->telefone; ?>
                            </article>
                        </div>
                    </div>
                <?php endif ?>
                <?php if ($model->endereco): ?>
                    <div class="single-box" data-tabdescription="3">
                        <div class="content-box">
                            <p class="title">Endereço</p>
                            <p class="mini-description">
                                <?php
                                $string = $model->endereco;
                                $resume = substr($string, 0, 35);
                                echo '' . $resume . '...';
                                ?>
                            </p>
                            <i class="ico-arrow inline-block sprite"></i>
                            <article class="box-description" data-description="3">
                                 <?php echo $model->endereco . ' ' . $model->bairro . ', ' . $model->numero . '<br>' . $model->cidades->nome . ' - CEP:' . $model->cep; ?>
                            </article>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <?php if (count($model->empresaImagens) > 0 && Empresas::checkTurbo($model, 'fotos') == true) : ?>
        <div class="box-imagens">	
            <div class="single-info-title full-width">
                <span class="info-title">Imagens</span>
            </div>
            <div class="single-images full-width <?php echo $class_slider; ?>">
                <div class="slider-images swiper-wrapper">
        <?php for ($i = 0; $i < count($model->empresaImagens); $i++) { ?>
                        <div class="content-slider swiper-slide">
                        <!-- src correto <img class="imagem-turbinada img-deemb-slide" src="'.Yii::app()->request->baseUrl.'/public/empresas/'.$model->empresaImagens[$i]->imagem.' -->
                        <?php echo '<img class="content-image" src="' . Yii::app()->request->baseUrl . '/public/empresas/' . $model->empresaImagens[$i]->imagem . '"/>'; ?>
                        </div>
                        <?php } ?>	
                </div>
                <div class="swiper-pagination"></div>
                <!-- <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->
            </div>
        </div>
    <?php endif ?>

    <?php if ($model->video) : ?>

        <div class="single-info-title full-width">
            <span class="info-title">Vídeo</span>
        </div>

        <div class="single-info-content full-width">
            <div class="container">
                <div class="box-content full-width">
                    <article class="text-video inline-block">Conheça <?php echo $model->razao; ?> </article>
                    <a href="#" class="btn-video inline-block sprite" data-link="<?php echo $video_id; ?>"></a>
                    <br class="clear" />
                </div>
            </div>
        </div>

        <div class="box-video">
            <a href="#" class="btn-close-boxvideo inline-block sprite"></a>
            <br class="clear" />
        </div>

    <?php endif ?>
<?php endif; ?>


<div class="box-contato box-contato-empresa">

    <div class="header-contato full-width">
        <div class="container">
            <i class="btn-close-boxcontato inline-block sprite"></i>
            <article class="header-text">Envie uma mensagem para essa empresa</article>
            <div id="erro-contato-empresa"></div>
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
                <input id="nome-contato-empresa" value="<?php echo $nome; ?>" class="input-text" type="text">
            <?php else: ?>
                <input id="nome-contato-empresa" class="input-text" value="" type="text" />
            <?php endif; ?>

            <label class="label-contato">Email</label>
            <?php if (!Yii::app()->user->isGuest): ?>
                <input value="<?php echo Usuarios::getUsuarioLogado()->email; ?>" id="email-contato-empresa" class="input-text" type="email">
            <?php else: ?>
                <input value="" id="email-contato-empresa" class="input-text" type="email">
            <?php endif; ?>

            <label class="label-contato">Telefone</label>
            <input id="telefone-contato-empresa" class="input-text input-tel" type="tel" />

            <label class="label-contato">Mensagem</label>
            <textarea id="mensagem-contato-empresa" class="input-textarea"></textarea>


            <input type="hidden" id="email_empresa" value="<?php echo $model->email; ?>"/>
            <input type="hidden" id="razao" value="<?php echo $model->razao; ?>"/>
            <input type="hidden" id="usuarios_id" value="<?php echo $model->usuarios_id; ?>"/>
<?php
echo CHtml::hiddenField('cidade', $model->cidades->nome, array('id' => 'cidade'));
echo CHtml::hiddenField('endereco', $model->endereco, array('id' => 'endereco'));
echo CHtml::hiddenField('numero', $model->numero, array('id' => 'numero'));
echo CHtml::hiddenField('cep', $model->cep, array('id' => 'cep'));
echo CHtml::hiddenField('flgEstaleiro', 0, array('id' => 'flgEstaleiro'));
echo CHtml::hiddenField('usuarios_id_empresa', $model->usuarios_id, array('id' => 'usuarios_id_empresa'));
?>

            <input type="button" name="botao-cadastrar-form" class="input-submit" id="btn-contato-empresa" value="Enviar Mensagem" />
            <i class="ico-submit sprite inline-block"></i>
        </div>
    </div>

</div>

