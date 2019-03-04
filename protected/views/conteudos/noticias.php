<?php
$this->setPageTitle("Lançamento de Lanchas | Bombarco");
Yii::app()->clientScript->registerMetaTag('Leia no Bombarco. Ultimas Notícias de Lançamentos e Destaques de Lanchas, Veleiros, Jet Skis e Barcos de Pesca.', 'description', null, array(), 'bombarco_description');
?>

<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/js/bootstrap-datepicker.js?11'); ?>

<section class="content">
    <div class="line-gray-nt-top">
        <div class="container">
            <div>
                <h1 class="title-nt-1" >Lançamento de Lanchas</h1>
                <span class="title-nt-2"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
            </div>
            <?php echo CHtml::form(array('site/urlconteudos'), 'get', array('id'=>'form-search')); ?>
            <div class="search-nt">
                <input name="busca" placeholder="Buscar por Notícias" class="terms-nt" type="text" value="<?php echo $array_params['busca']; ?>">
                <input type="hidden" value="noticias" name="url">
                <input class="find-nt" type="submit">
            </div>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>                      
            <!--Start Links Categorias Guia-->
    <div class="line-white-nt"> 
        <div class="container" style="min-height: auto !important;" >
                <?php $embarcacoes_destaque = Embarcacoes::anunciosRelacionados(); ?>

                <div class="box-cinza-lateral-bb">  

                    <?php if(count($embarcacoes_destaque) > 0): ?>
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
                                    <span class="text-list-lat-title"> <?php echo $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $value->embarcacaoModelos->titulo; ?> </span>
                                    <span class="text-list-tab-ano"> Ano: </span>
                                    <span class="text-list-tab-ano-rnd"> <?php echo $value->ano; ?> </span><br>
                                    <span class="text-list-tab-price">
                                            <?php  
                                                if($value->valor > 0){
                                                    echo "R$ ". number_format($value -> valor, 2, ",", ".");
                                                }else{
                                                    echo "Não informado";
                                                }
                                            ?> </span>  
                                </div>
                                
                            <?php endforeach ?>
                        </div>  
                    </div>
                    <?php endif; ?>


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
                                    <span class="text-list-lat-title"> <?php echo $value->nomefantasia; ?> </span>
                                    <span class="text-list-tab-ano2"> Localizacão: </span>
                                    <span class="text-list-tab-ano-rnd2"> <?php echo $value->cidades->nome . ' / ' . $value->estados->nome; ?> </span>
                                </div>
                                
                            <?php endforeach ?>

                        </div>  
                    </div>
                    <?php endif; ?>
                </div>  
                
                <div class="boxes-home-nt">

                    <?php if(count($noticias) == 0): ?>
                        <div class="resultados-box">
                            <span class='resultados-title'>Nenhum resultado encontrado.</span>
                            <span class="resultados-tip">Faça uma nova busca ou navegue nas categorias abaixo.</span>
                            <a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda');?>" class="resultados-categorias resultados-tip-lancha">Lanchas</a>
                            <a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda');?>" class="resultados-categorias resultados-tip-veleiro">Veleiros</a>
                            <a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda');?>" class="resultados-categorias resultados-tip-jet-skis">Jet Skis</a>
                            <a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda');?>" class="resultados-categorias resultados-tip-pesca">Pesca</a>
                        </div>
                    <?php endif; ?>

                    <ul class="categories-nt">
                        
                        <?php $count = 0; ?>
                        <?php foreach ($noticias as $key => $value): ?>
                            
                            <?php if ($count == 0): $count++;?>

                                <li class="category-nt" style="width: 470px;">                                  
                                    <a href="<?php echo Conteudos::mountUrl($value); ?>">                                       
                                        <?php echo Conteudos::getThumb($value, array('class'=>'bg-img-nt', 'width'=>470, 'height'=>225), false); ?>
                                        <span class="blend"></span>
                                        <span class="table-nt2" >
                                            <span class="texts-nt2" style="position: relative;left: 89px;">
                                                <span class="text-data-nt2"><?php echo $value->data; ?></span>  
                                                <span class="text-tipo-nt2"><?php echo (isset($value->embarcacaoMacros) && $value->embarcacaoMacros->id != 0) ? $value->embarcacaoMacros->titulo : ''; ?></span>
                                                <h2 class="text-barco-nt2"><?php echo $value->titulo; ?></h2>   
                                            </span>     
                                        </span>                                     
                                    </a>
                                </li>

                            <?php else: ?>

                                <li class="category-nt" >                                   
                                    <a href="<?php echo Conteudos::mountUrl($value); ?>">                                       
                                        <?php echo Conteudos::getThumb($value, array('class'=>'bg-img-nt'), false); ?>
                                        <span class="blend"></span>
                                        <span class="table-nt">
                                            <span class="texts-nt">
                                                <span class="text-data-nt"><?php echo $value->data; ?></span>   
                                                <span class="text-tipo-nt"><?php echo (isset($value->embarcacaoMacros) && $value->embarcacaoMacros->id != 0) ? $value->embarcacaoMacros->titulo : ''; ?></span>
                                                <h2 class="text-barco-nt"><?php echo $value->titulo; ?></h2>    
                                            </span>     
                                        </span>                                     
                                    </a>
                                </li>   
                                
                            <?php endif ?>                          
                            
                        <?php endforeach ?> 
                        
                    </ul>
                </div>  
            
                <?php if (count($noticias) == Conteudos::LIMIT_SEARCH - 1): ?>

                    <div class="div-btn-carregar-guia-nt">
                        <a class="botao-carregar-guia-nt" id="carregar_nt" data-limit="<?php echo Conteudos::LIMIT_SEARCH; ?>" data-busca="<?php echo $array_params['busca'] ?>" data-categoria="<?php echo $array_params['categoria'] ?>">CARREGAR MAIS NOTÍCIAS</a>   
                    </div>
                
                <?php endif ?>
                
                <div class="advertise-home_banner">
                    <span>Publicidade</span>
                        <?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width'=>728, 'height'=>90), true); ?>
                </div>      
                
            <br class="clear">
        </div>      
        <div class="fundo-cinza-lateral">           
        </div>  
            


    </div>

                            <?php $this->renderPartial('_footer_menu'); ?>
</section>
<div class="div-voltar-ao-topo-list">   
    <a class="botao-voltar-ao-topo-list" id="btn-subir-bb">VOLTAR AO TOPO</a>   
</div>