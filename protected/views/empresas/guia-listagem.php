
<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/empresas_busca.js', CClientScript::POS_END);
?>
<section class="content">


    <div class="line-white-gl">
        <div class="container" >
            <div class="div-title-2-guia">
                <span class="title-2-guia"><a class="link-bd" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd" href="<?php echo Yii::app()->createUrl('guia-de-empresas'); ?>">Guia de Empresas</a> > </span>
            </div>
            <div class="div-title-1-guia">
                <span class="title-1-guia">Guia de Empresas</span>
                <?php //if (isset($array_view['categoria'])) echo "Categoria: " . $array_view['categoria']->titulo . '<br>';  ?>
                <?php //if (isset($array_view['estado'])) echo "Estado: " . $array_view['estado']->nome . '<br>'; ?>
                <?php //if (isset($array_view['termo'])) echo "Resultados para: " . $array_view['termo']; ?>
            </div>

            <?php echo CHtml::form(array('site/urlguia'), 'get', array('id' => 'form-search')); ?>

            <div class="div-search-ok-4">
                <div class="search-ok-4">
                    <input name="termo" placeholder="Buscar em Guia de Empresas" class="terms-ok-3" type="text" value="<?php echo $array_params['termo']; ?>">
                    <input class="find-ok-4" type="submit">
                </div>
            </div>
            <div class="div-selects-guia">
                <div class="div-select-listagem-1">
                    <span class="select-listagem-1 close-dd">
                        <?php
                        $categoriaId = (isset($array_view['categoria'])) ? $array_view['categoria']->id : '';
                        echo EmpresaCategorias::dropDown_($categoriaId);
                        ?>
                    </span>
                </div>
                <div class="div-select-listagem-2">
                    <span class="select-listagem-2 close-dd">
                        <?php
                        $estadoId = (isset($array_view['estado'])) ? $array_view['estado']->id : '';
                        echo Estados::dropDown_($estadoId);
                        ?>
                    </span>
                </div>
                <div class="div-botao-buscar-gl" style="position:relative;left:20px;">
                    <input type="submit" class="botao-buscar-gl" name="Busca" id="submit-discover" value="BUSCAR" onclick="_gaq.push(['_trackEvent', 'guia-de-empresas', 'click', 'BUSCAR']);"/>
                </div>
            </div>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>

</div>
<!--End da section de busca-->
<!--Start Links Categorias Guia-->
<div class="line-gray-gl">
    <div class="container">
        <div class="col1-gl">
            <section class="boxes-home-guia-gl">


                <?php if (count($empresas) > 0): ?>

                    <ul class="categories-guia-gl">

                        <span class="title-listagem-empresas">Empresas em Destaque</span>
                        <br class="clr">

                        <?php foreach ($empresas as $key => $value): ?>

                            <a href="<?php echo Empresas::mountUrl($value, Macros::$macro_by_slug['empresa']); ?>">
                                <li class="category-guia-gl">

                                    <?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, false, array('class' => 'bg-img-guia-gl')); ?>

                                    <span class="table-guia-gl">
                                        <?php echo $value->nomefantasia; ?>
                                    </span>
                                </li>
                            </a>

                        <?php endforeach ?>

                    </ul>

                <?php endif ?>
                ﻿
                <?php /*if (count($empresas) == Empresas::LIMIT_SEARCH): ?>
                    <div class="div-botao-carregar-gl">
                        <a class="botao-carregar-guia-gl" id="carregar-gl" data-limit="<?php echo Empresas::LIMIT_SEARCH; ?>" data-categoria="<?php echo $array_params['categoria']; ?>" data-localizacao="<?php echo $array_params['localizacao']; ?>" data-termo="<?php echo $array_params['termo']; ?>">Carregar mais</a>
                    </div>
                <?php endif*/ ?>

                <?php if (count($gratuitas) > 0): ?>
                    <ul id="ul-carregar-mais" class="categories-guia-gl lista-empresas">

                        <span class="title-listagem-empresas">Todas</span>
                        <br class="clr">

                        <?php foreach ($gratuitas as $key => $value): ?>

                                <li class="category-guia-gl-free">

                                    <?php $href = Empresas::mountUrl($value, $value->macros_id); ?>
                                    <div class="table-guia-gl button">
                                        <?php echo '<a class="diva" style="text-decoration:none; color:#000" href="' . $href . '">' . $value->nomefantasia . '</a>'; ?>
                                    </div>
                                </li>

                        <?php endforeach ?>
                    </ul>

                    <?php if (count($gratuitas) == Empresas::LIMIT_SEARCH): ?>
                        <div class="div-botao-carregar-gl">
                            <a class="botao-carregar-guia-gl btn-carregar-mais" rel="lista-empresas" id="carregar-gl" data-limit="<?php echo Empresas::LIMIT_SEARCH; ?>" data-categoria="<?php echo $array_params['categoria']; ?>" data-localizacao="<?php echo $array_params['localizacao']; ?>" data-termo="<?php echo $array_params['termo']; ?>">Carregar mais</a>    
                        </div>
                    <?php endif ?>

                <?php endif; ?>

                ﻿
                <?php if(count($gratuitas) == 0 && count($empresas) == 0):?>
                    <span class="title-listagem-empresas">Nenhum resultado</span>
                <?php endif;?>


                <div class="advertise-home_banner" style="text-align: left;">
                    <span>Publicidade</span>
                    <?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width' => 728, 'height' => 90), true); ?>

                </div>
            </section>
        </div>
        <div class="col2-gl">
            <div style="text-align:left;" class="advertise-guia-gl">
                <span>Publicidade</span>
                <?php echo Banners::loadBanner(Banners::LATERAL, null, array('width' => 200, 'height' => 446), true); ?>
            </div>
        </div>
    </div>

</div>


</section>

<script>
    $(document).ready(function () {
        $(".select-anuncio-pad").on("change", function () {
            $("#buscar-guia").prop("disabled", false);
            $("#buscar-guia").css("opacity", "1");
        });
    });
</script>
