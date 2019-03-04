<?php
$this->setPageTitle("Teste de lanchas | Bombarco");
Yii::app()->clientScript->registerMetaTag('Assista testes de Lanchas, Veleiros e Jet Ski no Raio-X Bombarco. Marcio Ishihara mostra as principais características dessas embarcações. Veja agora!  ', 'description', null, array(), 'bombarco_description');
?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/js/bootstrap-datepicker.js?11'); ?>
<section class="content">
    <div class="line-videos-1">
        <div class="container"> 
            <div>   
                <h1 class="title-vid-1">Teste de lanchas</h1>
                <span class="title-vid-2"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
            </div>  
        </div>      
    </div>  
                    
    <div class="line-videos-2">
        <div class="container">         


                <ul class="options-category-video">
                    <li style="display:none" class="tab todos-vid <?php if(empty($array_params['macro'])) echo 'active'; ?>"><a href="#">Todos</a></li>
                    <li style="display:none" class="tab speedboat-vid active <?php if($array_params['macro'] == 'lancha') echo 'active'; ?>"><a href="#">Lanchas</a></li>
                    <li style="display:none" class="tab sailboat-vid <?php if($array_params['macro'] == 'veleiro') echo 'active'; ?>"><a href="#">Veleiros</a></li>
                    <li style="display:none" class="tab jetski-vid <?php if($array_params['macro'] == 'jetski') echo 'active'; ?>"><a href="#">Jet Skis</a></li>
                    <li style="display:none" class="tab pesca-vid <?php if($array_params['macro'] == 'barcos-pesca') echo 'active'; ?>"><a href="#">Barcos de Pesca</a></li>
                    <li style="display:none" class="search-vid">
                        <?php echo CHtml::form(array('site/urlconteudos'), 'get', array('id'=>'form-search')); ?>
                            <input placeholder="ou digite aqui o que você procura" class="terms-vid" type="text" name="busca" value="<?php echo $array_params['busca']; ?>">
                            <input type="hidden" value="teste-bombarco" name="url">
                            <input type="hidden" value="<?php echo $array_params['macro']; ?>" name="macro">
                            <input class="find-vid" type="submit">
                        <?php echo CHtml::endForm(); ?>
                    </li>
                </ul>

                <span class="raiox-text-top">Confira nossos últimos videos:</span>


        </div>  
    </div>
     
    <div class="line-videos-3">
        <!--Start Banner Principal-->

        <section class="spotlight-banner">

                    <!--Start Controle Banner-->
                    <div class="container container-controls">
                        <span class="controls stop-video-too">
                            <a class="prev">
                                <i class="icon"></i>
                                <span class="title-next"></span>
                            </a>
                            <a class="next">
                                <i class="icon"></i>
                                <span class="title-next"></span>
                            </a>
                        </span> 
                    </div>
                    <!--End Controle Banner-->

                    <!--Start Slider-->
                    <ul class="slider">

                        <?php foreach ($ultimos_videos as $key => $value): ?>

                            <?php 
                                $imagem = ""; 
                                if(isset($value->conteudoImagens[0])) {
                                    $imagem = $value->conteudoImagens[0]->imagem;
                                }
                            ?>



                            <li class="slide" style="background-image: url(<?php echo '../public/conteudos/'.$imagem; ?>);">
                                <input class="video-url" type="hidden" value="//www.youtube-nocookie.com/embed/<?php echo Utils::getYoutubeID($value->video); ?>?autoplay=1&enablejsapi=1&version=3&hd=1&playerapiid=ytplayer&autohide=1&showinfo=0" />
                                <div class="video-theater">                             
                                    <!-- <iframe id="video-slide-home-1" width="1072" height="557" src="//www.youtube-nocookie.com/embed/<?php echo Utils::getYoutubeID($value->video); ?>?enablejsapi=1&version=3&hd=1&playerapiid=ytplayer&autohide=1&showinfo=0" frameborder="0" allowfullscreen="true" allowscriptaccess="always"></iframe> -->
                                    <a href="#" class="close-video">x</a>
                                </div>
                                      
                                <div class="container content-slide">
                                    <span class="type">Raio X</span>
                                    <span class="title"><?php echo $value->titulo; ?></span>
                                    <a class="icon-play" id="icon-video-home-1"><i class="icon"></i></a>
                                    <!--<span class="description">
                                        O Bombarco testou a nova Focker 270GT. <br>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing <br>
                                        elit. Sed luctus ex nibh. Nulla vel placerat nisl.<br>
                                        Maecenas id faucibus leo, a hendrerit libero.<br>
                                        Quisque convallis risus leo,nec.
                                    </span>-->  
                                    <a class="more-types" href="<?php echo Yii::app()->createUrl('comunidade/teste-bombarco'); ?>">Ver todos os testes</a>
                                </div>
                            </li>
                            
                        <?php endforeach ?>
                        

                    </ul>
                    <!--End Slider-->
        </section>      
        <!--End Banner Principal-->     
    
    </div>

    <div class="line-videos-4" id="raiox-todos-videos">
        <div class="container" >                                    
            <div class="box-videos-lw4">
                <ul class="categories-videos-lw4">
                        
                        <?php foreach ($teste_bombarco as $key => $value) :?>

                            <li class="category-videos–lw4">
                                <input class="video-url" type="hidden" value="//www.youtube-nocookie.com/embed/<?php echo Utils::getYoutubeID($value->video); ?>?autoplay=1&enablejsapi=1&version=3&hd=1&playerapiid=ytplayer&autohide=1&showinfo=0" />
                                <div style="background-color:transparent">
                                    <a href="#">
                                        <div class="js-lazyYT" id="btn-video1"  data-youtube-id="<?php echo Utils::getYoutubeID($value->video); ?>" data-width="300" data-height="200"></div>
                                    </a>
                                        <div class="textos-videos-lw4">
                                        <span class="text-videos-lw4-title"><?php echo $value->titulo; ?></span>
                                    </div>  
                                </div>                      
                            </li>

                        <?php endforeach; ?>
                            
                </ul>   

                <?php if (count($teste_bombarco) == Conteudos::LIMIT_SEARCH): ?>
                    <div class="div-btn-carregar-video">
                        <a class="botao-carregar-video" id="carregar-video" data-limit="<?php echo Conteudos::LIMIT_SEARCH; ?>" data-busca="<?php echo $array_params['busca'] ?>" data-macro="<?php echo $array_params['macro'] ?>">VER MAIS</a>
                    </div>
                <?php endif ?>
                
            </div>  

                
                
            <div class="box-cinza-lateral-bb">

                        <?php $embarcacoes_destaque = Embarcacoes::anunciosRelacionados(); ?>

                        <?php if(count($embarcacoes_destaque) > 0): ?>
                        <div class="bloco-tabela-1">
                            <div class="div-title-lateral-anuncios">
                                <span class="title-lateral-anuncios">Anúncios Patrocinados</span>
                            </div>  
                            <div class="title-lat-tabela-div">
                                <span class="title-lat-tabela"> 
                                    Classificados
                                 </span>
                            </div>  
                            <div class="box-tabela-lat-tab">

                                <?php foreach ($embarcacoes_destaque as $key => $value): ?>

                                    <ul class="categories-tabela-lat">
                                        <li class="category-tabela–lat">
                                            <?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-tabela-lat'), true); ?>                     
                                        </li>
                                    </ul>   
                                    <div class="textos-lat-tab">
                                        <span class="text-list-lat-title"> <?php echo $value->embarcacaoModelos->titulo; ?> </span>
                                        <span class="text-list-tab-ano"> Ano: </span>
                                        <span class="text-list-tab-ano-rnd"> <?php echo $value->ano; ?> </span><br>
                                        <span class="text-list-tab-price"> R$ <?php echo Utils::formataValorView($value->valor); ?> </span> 
                                    </div>
                                    
                                <?php endforeach ?> 

                            </div>  
                        </div>
                        <?php endif;?>


                        <?php $empresas_relacionadas = Empresas::anunciosRelacionados(Macros::$macro_by_slug['empresa']); ?>

                        <?php if(count($empresas_relacionadas) > 0): ?>
                        <div class="bloco-tabela-2">
                            <div class="title-lat-tabela-div2">
                                <span class="title-lat-tabela2"> Guia de Empresas </span>
                            </div>  
                            <div class="box-tabela-lat-tab2">
                                
                                <?php foreach ($empresas_relacionadas as $key => $value): ?>

                                    <ul class="categories-tabela-lat2">
                                        <li class="category-tabela–lat2">
                                            <?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class'=>'bg-img-tabela-lat2')); ?>                       
                                        </li>
                                    </ul>   
                                    <div class="textos-lat-tab2">
                                        <span class="text-list-lat-title"> <?php echo $value->razao; ?> </span>
                                        <span class="text-list-tab-ano2"> Localizacão: </span>
                                        <span class="text-list-tab-ano-rnd2"> <?php echo $value->cidades->nome . ' / ' . $value->estados->nome; ?> </span>
                                    </div>  
                                    
                                <?php endforeach ?> 

                            </div>  
                            <div class="div-voltar-ao-topo-list">   
                                <a class="botao-voltar-ao-topo-list" id="btn-subir-bb">VOLTAR AO TOPO</a>   
                            </div>

                        </div>
                        <?php endif;?>
                </div>  
            <div class="advertise-home_banner">

                <?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width'=>728, 'height'=>90), true); ?>

            </div>      
            <br class="clear">  
            
        </div>
        <div class="lightbox-videos">
            <div class="content-video">
                <a href="#" class="close-video">x</a>
            </div>
        </div>          
        <div class="fundo-cinza-lateral"></div>     
    </div>  
</section>
<div class="div-voltar-ao-topo-list">   
    <a class="botao-voltar-ao-topo-list" id="btn-subir-bb">VOLTAR AO TOPO</a>   
</div>
