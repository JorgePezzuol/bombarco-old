<section class="content">
    <div class="line-white-guia">
        <div class="container" >	
            <div class="div-title-2-guia">
                <span class="title-2-guia"><a class="link-bd" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd" href="<?php echo Yii::app()->createUrl('guia-de-empresas'); ?>">Guia de Empresas</a></span>
            </div>
            <div class="div-title-1-guia">	
                <h1 class="title-1-guia">Guia de Empresas </h1>	
            </div>

            <?php echo CHtml::form(array('site/urlguia'), 'get', array('id' => 'form-search')); ?>
            <div class="div-search-ok-4">
                <div class="search-ok-4">
                    <input name="termo" placeholder="Buscar Empresas" class="terms-ok-3" type="text">
                    <input class="find-ok-4" type="submit" onclick="_gaq.push(['_trackEvent', 'guia-de-empresas', 'click', 'BUSCAR']);">
                </div>
            </div>
            <div class="div-selects-guia">		
                <div class="div-select-listagem-1">	
                    <span class="select-listagem-1 close-dd">
                        <?php echo EmpresaCategorias::dropDown_(); ?>

                    </span>				
                </div>	
                <div class="div-select-listagem-2">		
                    <span class="select-listagem-2 close-dd">
                        <?php echo Estados::dropDown_(); ?>

                    </span>	
                </div>	
                <div class="div-botao-buscar-gl" style="position:relative;left:20px;">
                    <input disabled="disabled" style="opacity:0.2" type="submit" class="botao-buscar-gl" name="Busca" id="buscar-guia" value="BUSCAR" onclick="_gaq.push(['_trackEvent', 'guia-de-empresas', 'click', 'BUSCAR']);" />
                </div>	
            </div>	

            <?php echo CHtml::endForm(); ?>

        </div>

    </div>			

    <div class="line-white2-guia">	
        <div class="container">
            <section class="boxes-home-guia">
                <div class="div-title-guia-line2">
                    <span class="title-guia">Categorias mais buscadas</span>
                </div>	
                <div class="box-line-2guia">
                    <ul class="categories-guia">

                        <!--<li class="category-guia">
                                <a href="<?php //echo Yii::app()->createUrl('guia-de-empresas/aluguel-barcos'); ?>">
                                        <img class="bg-img-guia" src="<?php //echo Yii::app()->theme->baseUrl; ?>/img/AluguelDeBarcos.png">
                                        <span class="table-guia">
                                                <span class="texts-guia">
                                                        <h2 class="name-guia">Aluguel de barcos</h2>	
                                                </span>
                                        </span>
                                </a>
                        </li>-->

                        <li class="category-guia">
                            <a href="<?php echo Yii::app()->createUrl('guia-de-empresas/artigos-nauticos-em-geral'); ?>">
                                <img alt="artigos-nauticos" class="bg-img-guia" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/artigosNauticos.png"/>
                                <span class="table-guia">
                                    <span class="texts-guia">
                                        <h2 class="name-guia">Artigos Náuticos</h2>	
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li class="category-guia">
                            <a href="<?php echo Yii::app()->createUrl('guia-de-empresas/despachante'); ?>">
                                <img alt="despachante" class="bg-img-guia" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/despachante.png"/>
                                <span class="table-guia">
                                    <span class="texts-guia">
                                        <h2 class="name-guia">Despachante</h2>	
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li class="category-guia">
                            <a href="<?php echo Yii::app()->createUrl('guia-de-empresas/marina-e-iate-clube'); ?>">
                                <img alt="marinas" class="bg-img-guia" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/marinas.png"/>
                                <span class="table-guia">
                                    <span class="texts-guia">
                                        <h2 class="name-guia">Marina e Iate Clube</h2>	
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li class="category-guia">
                            <a href="<?php echo Yii::app()->createUrl('guia-de-empresas/motores'); ?>">
                                <img alt="motores" class="bg-img-guia" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/motores.png"/>
                                <span class="table-guia">
                                    <span class="texts-guia">
                                        <h2 class="name-guia">Motores</h2>	
                                    </span>
                                </span>
                            </a>
                        </li>

                        <li class="category-guia">
                            <a href="<?php echo Yii::app()->createUrl('guia-de-empresas/revendas-e-brokers'); ?>">
                                <img alt="revendas" class="bg-img-guia" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/revendas.png"/>
                                <span class="table-guia">
                                    <span class="texts-guia">
                                        <h2 class="name-guia">Revendas e Brokers</h2>	
                                    </span>
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>

                <!--
                TENTEI POR BANNER HORIZONTAL AQUI MAS N ROLOOU
                <div class="container" style="padding:20px;">
                        <div class="advertise-home_banner">
                <?php //echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width' => 728, 'height' => 90), true); ?>
                        </div>		
                </div>-->

            </section>
            <div class="box-line-3guia">
                <div style="text-align:center;" class="advertise-guia">
                    <?php echo Banners::loadBanner(Banners::LATERAL, null, array('width' => 200, 'height' => 446), true); ?>		
                </div>
            </div>

        </div>	


        <?php if (count($destaques) > 0): ?>
            <div class="line-gray-guia">			
                <div class="container">
                    <div class="div-title-slider-guia">		
                        <h4 class="title-slider-guia">Empresas em Destaque</h4>
                    </div>
                    <div class="bx-controls-direction2">
                        <span class="bx-prev"></span>
                        <i class="icon"></i>
                        <span class="bx-next"></span>
                        <i class="icon"></i>
                    </div>				
                    <div id="div-guia-slide" class="div-guia-slide">

                        <ul class="categories-guia-s">
                            <?php foreach ($destaques as $key => $value): ?>

                                <?php $url = Empresas::mountUrl($value, Macros::$macro_by_slug['empresa']); ?>

                                <li class="category-guia-s" >
                                    <a href="<?php echo $url; ?>">
                                        <?php if (count($value->logo != "")): ?>
                                            <img alt="<?php echo $value->razao; ?>" class="img-guia-s" src="<?php echo Yii::app()->baseUrl . '/public/empresas/' . $value->logo; ?>">
                                        <?php else: ?>
                                            <img alt="<?php echo $value->razao; ?>" class="img-guia-s" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/sem_foto_bb.jpg">
                                        <?php endif ?>		
                                    </a>
                                </li>


                            <?php endforeach ?>
                        </ul>

                    </div>
                </div>				
            </div>	
        <?php endif ?>

</section>

<script>
    $(document).ready(function () {
        $(".select-anuncio-pad").on("change", function () {
            $("#buscar-guia").prop("disabled", false);
            $("#buscar-guia").css("opacity", "1");
        });
    });
</script>

