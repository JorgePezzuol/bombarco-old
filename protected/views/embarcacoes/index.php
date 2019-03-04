<section class="content">

        <div class="line-gray-emb-top">
            <div class="container">
                <div>
                    <h1 class="title-embc-1 ">Embarcações</h1>
                    <span class="title-embc-2"><a style="color:#fff;" href="<?php echo Yii::app()->homeUrl;?>">Home</a> > Embarcações</span>
                </div>
            </div>
        </div>

        <div class="line-white-emb">
            <div class="container" style="background-color:transparent !important;">
                <div class="div-class-box-emb">
                    <div class="box-l2-emba-1">
                        <div class="div-title-l2-emba">
                            <h1 class="title-l2-emba"> Lanchas à venda </h1>
                            <div class="btn-emba-div">
                                <a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda'); ?>" class="botao-emba" id="btn-ver-todas-#">Ver todas</a>
                            </div>
                        </div>

                        <div id="div-emba">

                            <?php foreach ($lanchas as $key => $value): ?>

                                <!--Conteudo a Ser dinamico-->
                                <a href="<?php echo Embarcacoes::mountUrl($value); ?>">
                                    <div class="box-unit-emba">
                                        <ul class="categories-emba">
                                            <li class="category-emba">
                                                <?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-emba'), false); ?>
                                            </li>
                                        </ul>
                                        <div class="textos-emba2">
                                            <span class="text-emba-title"> <?php echo $value->embarcacaoModelos->titulo; ?> </span>
                                            <span class="text-emba-ano"> Ano: </span>
                                            <span class="text-emba-estado"> Estado: </span>
                                            <span class="text-emba-price3"> R$ <?php echo Embarcacoes::exibirValorView($value->valor); ?> </span>
                                            <span class="text-emba-ano-rnd"> <?php echo $value->ano; ?> </span>
                                            <span class="text-emba-estado-rnd2"> <?php echo $value->estados->uf; ?> </span>
                                        </div>
                                    </div>
                                </a>
                                <!--End-->

                            <?php endforeach ?>

                        </div>
                    </div>

                    <div class="box-l2-emba-2">
                        <div class="div-title-l2-emba">
                            <h1 class="title-l2-emba"> Veleiros à venda </h1>
                            <div class="btn-emba-div">
                                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda'); ?>" class="botao-emba" id="btn-ver-todas-#">Ver todas</a>
                                </div>
                        </div>
                        <div id="div-emba">

                            <?php foreach ($veleiros as $key => $value): ?>

                                <!--Conteudo a Ser dinamico-->
                                <a href="<?php echo Embarcacoes::mountUrl($value); ?>">
                                    <div class="box-unit-emba">
                                        <ul class="categories-emba">
                                            <li class="category-emba">
                                                <?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-emba'), false); ?>
                                            </li>
                                        </ul>
                                        <div class="textos-emba2">
                                            <span class="text-emba-title"> <?php echo $value->embarcacaoModelos->titulo; ?> </span>
                                            <span class="text-emba-ano"> Ano: </span>
                                            <span class="text-emba-estado"> Estado: </span>
                                            <span class="text-emba-price3"> R$ <?php echo Embarcacoes::exibirValorView($value->valor); ?> </span>
                                            <span class="text-emba-ano-rnd"> <?php echo $value->ano; ?> </span>
                                            <span class="text-emba-estado-rnd2"> <?php echo $value->estados->uf; ?> </span>
                                        </div>
                                    </div>
                                </a>
                                <!--End-->

                            <?php endforeach ?>
                        </div>
                    </div>

                    <div class="box-l2-emba-3">
                        <div class="div-title-l2-emba">
                            <h1 class="title-l2-emba"> JetSkis à venda </h1>
                            <div class="btn-emba-div">
                                <a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda'); ?>" class="botao-emba" id="btn-ver-todas-#">Ver todas</a>
                            </div>
                        </div>
                        <div id="div-emba">

                            <?php foreach ($jetskis as $key => $value): ?>

                                <!--Conteudo a Ser dinamico-->
                                <a href="<?php echo Embarcacoes::mountUrl($value); ?>">
                                    <div class="box-unit-emba">
                                        <ul class="categories-emba">
                                            <li class="category-emba">
                                                <?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-emba'), false); ?>
                                            </li>
                                        </ul>
                                        <div class="textos-emba2">
                                            <span class="text-emba-title"> <?php echo $value->embarcacaoModelos->titulo; ?> </span>
                                            <span class="text-emba-ano"> Ano: </span>
                                            <span class="text-emba-estado"> Estado: </span>
                                            <span class="text-emba-price3"> R$ <?php echo Embarcacoes::exibirValorView($value->valor); ?> </span>
                                            <span class="text-emba-ano-rnd"> <?php echo $value->ano; ?> </span>
                                            <span class="text-emba-estado-rnd2"> <?php echo $value->estados->uf; ?> </span>
                                        </div>
                                    </div>
                                </a>
                                <!--End-->

                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

                <?php $embarcacoes_destaque = Embarcacoes::anunciosRelacionados(); ?>

                <div class="box-cinza-lateral-bb">
                        <div class="div-title-lateral-anuncios">
                            <span class="title-lateral-anuncios">Anúncios Patrocinados</span>
                        </div>
                    <div class="bloco-tabela-1">
                        <div class="title-lat-tabela-div">
                            <span class="title-lat-tabela">
                                Classificados
                             </span>
                        </div>
                        <div class="box-tabela-lat-tab">
                            <?php foreach ($embarcacoes_destaque as $key => $value): ?>

                                <ul class="categories-tabela-lat">
                                    <li class="category-tabela–lat">
                                        <?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-listagem-lat'), true); ?>
                                    </li>
                                </ul>
                                <div class="textos-lat-tab">
                                    <span class="text-list-lat-title"> <?php echo $value->embarcacaoModelos->titulo; ?> </span>
                                    <span class="text-list-tab-ano"> Ano: </span>
                                    <span class="text-list-tab-ano-rnd"> <?php echo $value->ano; ?> </span>
                                    <span class="text-list-tab-price"> R$ <?php echo Embarcacoes::exibirValorView($value->valor); ?> </span>
                                </div>

                            <?php endforeach ?>
                        </div>
                    </div>


                    <?php $empresas_relacionadas = Empresas::anunciosRelacionados(Macros::$macro_by_slug['empresa']); ?>

                    <div class="bloco-tabela-2">
                        <div class="title-lat-tabela-div2">
                            <span class="title-lat-tabela2"> Guia de Empresas </span>
                        </div>
                        <div class="box-tabela-lat-tab2">

                            <?php foreach ($empresas_relacionadas as $key => $value): ?>

                                <ul class="categories-tabela-lat2">
                                    <li class="category-tabela–lat2">
                                        <?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class'=>'bg-img-listagem-lat')); ?>
                                    </li>
                                </ul>
                                <div class="textos-lat-tab2">
                                    <span class="text-list-lat-title"> <?php echo $value->razao; ?> </span>
                                    <!--<span class="text-list-tab-ano2"> Localizacão: </span>
                                    <span class="text-list-tab-ano-rnd2"> <?php echo $value->cidades->nome . ' / ' . $value->estados->nome; ?> </span>-->
                                </div>

                            <?php endforeach ?>

                        </div>
                    </div>
                </div>

                <br class="clear">

                <div style="padding:20px 0;background-color: #fff; width: 740px;">
                    <div class="advertise-home_banner">
                        <?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width'=>728, 'height'=>90), true); ?>
                    </div>
                </div>

            </div>



            <div class="fundo-cinza-lateral"></div>
        </div>
        
</section>