<section class="content">

    <!-- lightbox msg sucesso agenda -->
    <div class="lbox-msgenviada" id="lbox-msgok">	
        <div class="texts-lbox-ag">	
            <div class="div-title-form-msgok">
                <span class="form-lb-title">Seu pedido foi enviado com sucesso!</span>
            </div>
        </div>	
        <input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
    </div>


    <div class="line-gray-ag">
        <div class="container" >	
            <div class="div-title-ag-1">	
                <h1 class="title-ag-1">Agenda</h1>
            </div>
            <div class="div-title-ag-2">	
                <span class="title-ag-2"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
            </div>	
            <div class="div-botao-cadastre-ev">
                <a id="botao-cadastre-ag" class="botao-cadastre-ev">Cadastre seu evento</a>
            </div>
        </div>	
    </div>	
    <div class="lbox-ag" id="lbox-ag">	
        <div class="texts-lbox-ag">	
            <span class="ev-title">Cadastre seu evento gratuitamente</br></span>
            <span class="ev-title2">na agenda do Bombarco</span>
        </div>
        <div>	
            <span class="ev-sub-title" id="erro-contato">* O cadastrao não é automatico. Nossa equipe</br>receberá suas informações e adcionará o evento.</span>

        </div>	
        <form>

            <div class="form-nome-ag">
                <input placeholder="Seu nome"id="nome" class="terms-ag-1" type="text"/>
            </div>
            <div class="form-nome-ag-2">
                <input placeholder="Seu email" id="email_" class="terms-ag-2" type="text"/>
            </div>
            <div class="form-nome-ag-3">
                <input placeholder="Empresa" id="empresa" class="terms-ag-3" type="text"/>
            </div>
            <div class="form-nome-ag-4">
                <input placeholder="Descrição do evento" id="mensagem" class="terms-ag-4" type="text"/>
            </div>
            <input type="submit" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-cadastro-agenda" value="CADASTRAR EVENTO">
            <input type="button" id="close" class="fechar-form close" value="X">
        </form>
    </div>
    <div class="line-white-ag">	<!--Start Links Categorias Guia-->
        <div class="container">	
            <!--Div que segura todo conteudo da line-white-pb-->	
            <div class="fundo-cinza-branco"></div>

            <div class="bloco_noticias">

                <?php foreach ($agendas as $key => $agenda): ?>

                    <a href="<?php echo Agendas::mountUrl($agenda); ?>" data-id-evento="<?php echo $agenda->id; ?>">

                        <div class="bloco_mes">
                            <h2 class="title_mes"><?php echo Agendas::formatDateTimeToView($agenda->data_inicio); ?></h2>
                        </div>

                        <div class="bloco_post">
                            <div class="conteudo_textos">
                                <h4>
                                    <div class="title_post"><?php echo $agenda->titulo; ?></div>
                                </h4>
                                <span class="data_post"><?php echo Agendas::formatDateTimeToView($agenda->data_inicio); ?></span>
                                <span class="local_post"><?php echo $agenda->local; ?></span>
                            </div>
                        </div>

                    </a>

                <?php endforeach ?>

            </div>	


            <div class="box-cinza-lateral-bb">

                <?php $embarcacoes_destaque = Embarcacoes::anunciosRelacionados(); ?>

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
                                    <?php echo Embarcacoes::getThumb($value, array('class' => 'bg-img-tabela-lat'), true); ?>						
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


                <?php $empresas_relacionadas = Empresas::anunciosRelacionados(Macros::$macro_by_slug['empresa']); ?>

                <div class="bloco-tabela-2">
                    <div class="title-lat-tabela-div2">
                        <span class="title-lat-tabela2"> Guia de Empresas </span>
                    </div>	
                    <div class="box-tabela-lat-tab2">

                        <?php foreach ($empresas_relacionadas as $key => $value): ?>

                            <ul class="categories-tabela-lat2">
                                <li class="category-tabela–lat2">
                                    <?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class' => 'bg-img-tabela-lat2')); ?>						
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
            </div>	

            <?php if (count($agendas) == Agendas::LIMIT_SEARCH): ?>
                <div class="div-botao-carregar-ag">
                    <a class="botao-carregar-ag" id="carregar-ag">CARREGAR MAIS EVENTOS</a>	
                </div>
            <?php endif ?>	
            <div class="advertise-home_banner">

                <?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width' => 728, 'height' => 90), true); ?>

            </div>		
            <br class="clear">
        </div>		

        <div class="fundo-cinza-lateral2"></div>

    </div>	
    <div class="line-footer-white">
        <div class="container">
            <div class="line-menu-comunidade">
                <div class="div-botoes-comunidade-a">
                    <a href="<?php echo Yii::app()->createUrl('comunidade/teste-bombarco'); ?>" class="botao-teste-bombarco-com" id="bt-teste-bombarco-comu">Raio X</a>
                    <a href="<?php echo Yii::app()->createUrl('comunidade/tabela-bombarco'); ?>" class="botao-tabela-com" id="bt-tabela-comu">Tabela Bombarco</a>
                    <a href="<?php echo Yii::app()->createUrl('comunidade/agenda'); ?>" class="botao-agenda-com" id="cbt-agenda-comu">Agenda</a>
                    <a href="<?php echo Yii::app()->createUrl('comunidade/primeiro-barco'); ?>" class="botao-primeiro-barco-com" id="bt-primeiro-barco-comu">Primeiro Barco</a>
                    <a href="<?php echo Yii::app()->createUrl('comunidade/noticias'); ?>" class="botao-noticias-com" id="bt-noticias-comu">Notícias</a>
                </div> 
            </div>	 
        </div>
    </div>
</section>
<div class="div-voltar-ao-topo-list">	
    <a class="botao-voltar-ao-topo-list" id="btn-subir-bb">VOLTAR AO TOPO</a>	
</div>