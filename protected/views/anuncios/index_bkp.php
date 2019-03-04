<section class="content">
    <div class="line-anunciar-1">
        <div class="container" id="anuncios">
            <div class="div-text-l1-an" >
                <span class="text-l1-an"><a class="link-bd" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > Anunciar</span> 
            </div>              
            <div id="armored_website" style="width: 115px; height: 32px;"></div>
            <div class="menu-botoes-an">    
                <div class="div-botao-an1">
                    <a class="btn-menu-anunciar active" href="embarcacoes" id="botao-emba-an" onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'Embaracacao']);" >Embarcações</a>
                </div>
                <!-- se não tem empresa, então exibe a tab de plano de empresa-->
                <?php if (Empresas::model()->find('usuarios_id=:usuarios_id and macros_id = 2', array(':usuarios_id'=>Yii::app()->user->id))): ?>
                    <div class="div-botao-an2" style="display:none;">
                        <a class="btn-menu-anunciar" href="empservicos" id="botao-empser-an">Empresas ou Serviços</a>
                    </div>
                <?php else: ?>
                    <div class='div-botao-an2'>
                        <a class='btn-menu-anunciar' href='empservicos' id='botao-empser-an' onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'Empresa']);">Empresas ou Serviços</a>
                    </div>
                <?php endif; ?>

                <div class="div-botao-an3">
                    <a class="btn-menu-anunciar" href="estaleiros" id="botao-estaleiros-an" onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'Estaleiros']);">Estaleiros</a>
                </div>
                <div class="div-botao-an4">
                    <a class="btn-menu-anunciar" href="banners" id="botao-banner-an" onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'Banners']);">Banners</a>
                </div>
            </div>  
        </div>  
    </div>

    <div class="line-anunciar-2" >
        <div class="container">
            <div class="div-textos-bloco" >
                <div class="div-text-l2-an1">
                    <span class="text-l2-an1">Anunciar Embarcações</span>   
                </div>
                <div class="div-text-l2-an2">
                    <span class="text-l2-an2">(Lanchas, Veleiros ou JetSkis)</span> 
                </div>  
                <div class="div-text-l2-an3">
                    <span class="text-l2-an3">Crie e publique seu anúncio facilmente e de acordo com as suas necessidades. Ainda oferecemos combos de 6, 15, 30 ou 60 anúncios com valores especiais caso você precise anunciar diversos produtos.</span>   
                </div>

            </div>
            <!-- Conteudo Guia de Empresas -->
            <div class="div-textos-bloco-b" style="display:none; width: auto;">
                <div class="div-text-l2-an1-b" style="width:auto;">
                    <span class="text-l2-an1-b">Anunciar no Guia de Empresas</span>  
                </div>
                <div class="div-text-l2-an2">
                    <span class="text-l2-an2">(Anúncio de duração de 1 ano)</span> 
                </div> 
                <div class="div-text-l2-an2-b">
                    <span class="text-l2-an2-b">Anuncie os seus serviços e conquiste cada vez mais clientes. Crie um perfil da sua empresa,
                        onde você escolhe as informações que deseja exibir de acordo com a necessidade do seu negócio. </span>   
                </div>

            </div>
            <!-- Conteudo Estaleiros -->
            <div class="div-textos-bloco-c" style="display:none">
                <div class="div-text-l2-an1-c">
                    <span class="text-l2-an1-c">Anunciar Estaleiro</span>   
                </div>
                <div class="div-text-l2-an2-c">
                    <span class="text-l2-an2-c">Todas as grandes marcas estão no Bombarco. O seu estaleiro também precisa estar.
                        Adicione uma página do seu estaleiro com as suas informações, embarcações e um contato direto.
                        Oferecemos planos diferenciados para estaleiros. Para conhecê-los, deixe aqui seu contato.</span>   
                </div>

            </div>
            <!-- Conteudo Banners -->   
            <div class="div-textos-bloco-d" style="display:none">
                <div class="div-text-l2-an1-d">
                    <span class="text-l2-an1-d">Anunciar Banners Publicitários</span>   
                </div>
                <div class="div-text-l2-an2-d">
                    <span class="text-l2-an2-d">Temos diferentes banners e ferramentas de publicidade disponíveis para o seu negócio. 
                        Deixe o seu contato para lhe apresentarmos as diversas opções disponíveis no portal.</span> 
                </div>
            </div>  
        </div>
    </div>

    <div class="line-anunciar-3-emb line-3-an" >
        <div class="container">
            <div class="box-line-3-a">
                <div class="box-line-3-plano-ind-a">
                    <div class="div-text1-l3-an-a">
                        <span class="text1-l3-an-a">Anúncio Individual
                        </span> 
                    </div>  
                    <div class="box-line-3-planos-ind">
                        <div class="quadro-line-3-planos-ind">
                            <div class="div-text2-l3-an-a">
                                <span class="text2-l3-an-a">Valor da Embarcação
                                </span> 
                            </div>  
                            <div class="div-select-an">                             
                                <span class="select-form-anunciar">
                                    <select id="valor-plano-individual" class="select-anuncio-pad">
                                        <option value="null">Selecione...</option>
                                        <option value="10000.00" selected="selected">Até R$ 10 mil</option>
                                        <option value="50000.00">Até R$ 50 mil</option>
                                        <option value="250000.00">Até R$ 250 mil</option>
                                        <option value="0.00">Mais que R$ 250 mil</option>
                                    </select>
                                </span> 
                            </div>
                        </div>  
                        <div class="quadro3-line-3-planos-ind">
                            <div class="div-text2-l3-an-a">
                                <span class="text2-l3-an-a">Validade do Anúncio
                                </span> 
                            </div>  
                            <div class="div-select-an">                             
                                <span class="select-form-anunciar">
                                    <select id="meses-plano-individual" class="select-anuncio-pad">
                                        <option value="null">Selecione...</option>
                                        <option value="3" selected="selected">3 Meses</option>
                                        <option value="6">6 Meses</option>
                                    </select>
                                </span> 
                            </div>
                        </div>
                        <div class="quadro2-line-3-planos-ind">
                            <div class="div-text3-l3-an-a">
                                <span id="valor-anuncio-individual" class="text3-l3-an-a">
                                    R$ 32,00
                                </span> 
                            </div>
                            <div class="div-botao-contratar-an">
                                <a class="botao-contratar-an" id="href-anunciar-embarcacao" href="<?php echo Yii::app()->createUrl('anuncios/anunciarEmbarcacao?pid=1&meses=3&valor=32.00&qnt=1&individual=1'); ?>" onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'CONTRATAR-Ind']);">CONTRATAR</a>
                            </div>      
                        </div>  
                    </div>
                </div>  


                <?php
                if ($flgPlanoAnuncio) {
                    $this->renderPartial('_planos_embarcacao_desabilitado', array('plano' => $plano,
                        'qtdeAnunciosCadastrados' => $qtdeAnunciosCadastrados));
                } else {
                    $this->renderPartial('_planos_embarcacao');
                }
                ?>

    <div class="line-anunciar-3-empser line-3-an" style="display:none">
        <div class ="container">
            <div class="box-line-3-an-empser">
                <div class="box2-line-3-planos-escolha-b" style="float:left !important; background: #00918e;">
                    <div class="box-quad-line-3-empser">
                        <div class="quadro-line-3-planos-escolha-b">
                                <div class="div-text4-l3-an-a4">
                                    <span class="text4-l3-an-a3" style="position:relative; left: 8px; ">
                                        Completo
                                        <!--<?php if(count($infoPlanosEmpresa) > 0) { 
                                            echo $infoPlanosEmpresa[1]->duracaomeses; } 
                                        ?>-->
                                    </span> 
                                </div>
                        </div>
                        <div class="quadro-line-3-planos-escolha-b">
                                <div class="div-text4-l3-an-a4" style="top:20px;">
                                    <span class="text4-l3-an-b" style="line-height:32px;">
                                        <?php if(count($infoPlanosEmpresa) > 0) { 
                                            echo 'R$ '. $infoPlanosEmpresa[1]->valor; } 
                                        ?>
                                    </span> 
                                </div>
                        </div>  
                        <div class="quadro2-line-3-planos-escolha-b">
                                <div class="div-botao-contratar-an2">
                                    <a class="botao-contratar-an" id="href-anuncios-empresa" href="<?php if(count($linkPlanosEmpresa) > 0) { echo $linkPlanosEmpresa[1]; } ?>" onclick="_gaq.push(['_trackEvent', 'Empresa', 'click', 'Anunciar-12']);">ANUNCIAR</a>
                                </div>
                        </div>  
                    </div>
                </div>  
                
                <div class="box-line-3-planos-escolha-b" style="float:none;">
                    <div class="box-quad-line-3-empser">
                        <div class="quadro-line-3-planos-escolha-b" >
                                <div class="div-text4-l3-an-a4">
                                    <span class="text4-l3-an-a3" >
                                        Simples
                                    </span> 
                                </div>
                        </div>
                        <div class="quadro-line-3-planos-escolha-b">
                            <div class="div-text4-l3-an-a4">
                                    <span class="text4-l3-an-b">
                                        Gratuito
                                    </span> 
                                </div>
                        </div>  
                        <div class="quadro2-line-3-planos-escolha-b">
                            <div class="div-botao-contratar-an2">
                                <a class="botao-contratar-an" id="href-anuncios-empresa" href="<?php echo Yii::app()->createUrl('anuncios/anunciarEmpresaGratuito');?>" onclick="_gaq.push(['_trackEvent', 'Empresa', 'click', 'Anunciar-6']);">ANUNCIAR</a>
                            </div>
                        </div>                                                      
                    </div>      
                </div>
            </div>  
        </div>
    </div>  



            </div>  
        </div>
    </div>

    <div class="line-anunciar-3-empser line-3-an" style="display:none">
        <div class ="container">
            <div class="box-line-3-an-empser">

                <div class="box2-line-3-planos-escolha-b" style="float:none !important; background: #00918e;">
                    <div class="box-quad-line-3-empser">
                        <div class="quadro-line-3-planos-escolha-b" >
                            <div class="div-text4-l3-an-a4">
                                <span class="text4-l3-an-a3" style="position:relative; left: 8px; ">
                                    Completo
                                    <!--<?php
                                    if (count($infoPlanosEmpresa) > 0) {
                                        echo $infoPlanosEmpresa[1]->duracaomeses;
                                    }
                                    ?>-->
                                </span> 
                            </div>
                        </div>
                        <div class="quadro-line-3-planos-escolha-b">
                            <div class="div-text4-l3-an-a4">
                                <span class="text4-l3-an-b">
                                    <?php
                                    if (count($infoPlanosEmpresa) > 0) {
                                        echo 'R$ ' . $infoPlanosEmpresa[1]->valor;
                                    }
                                    ?>
                                </span> 
                            </div>
                        </div>  
                        <div class="quadro2-line-3-planos-escolha-b">
                            <div class="div-botao-contratar-an2">
                                <a class="botao-contratar-an" id="href-anuncios-empresa" href="<?php
                                if (count($linkPlanosEmpresa) > 0) {
                                    echo $linkPlanosEmpresa[1];
                                }
                                ?>" onclick="_gaq.push(['_trackEvent', 'Empresa', 'click', 'Anunciar-12']);">ANUNCIAR</a>
                            </div>
                        </div>  
                    </div>
                </div>  
                <div class="box-line-3-planos-escolha-b" style="float:none;" >
                    <div class="box-quad-line-3-empser">
                        <div class="quadro-line-3-planos-escolha-b">
                            <div class="div-text4-l3-an-a4">
                                <span class="text4-l3-an-a3">
                                    Simples
                                </span> 
                            </div>
                        </div>
                        <div class="quadro-line-3-planos-escolha-b">
                            <div class="div-text4-l3-an-a4">
                                <span class="text4-l3-an-b">
                                    Gratuito
                                </span> 
                            </div>
                        </div>  
                        <div class="quadro2-line-3-planos-escolha-b">
                            <div class="div-botao-contratar-an2">
                                <a class="botao-contratar-an" id="href-anuncios-empresa" href="<?php echo Yii::app()->createUrl('anuncios/anunciarEmpresaGratuito'); ?>" onclick="_gaq.push(['_trackEvent', 'Empresa', 'click', 'Anunciar-6']);">ANUNCIAR</a>
                            </div>
                        </div>                                                      
                    </div>      
                </div>
            </div>  
        </div>
    </div>  

    <div class="line-anunciar-3-estban line-3-an" style="display:none">
        <div class="container">
            <div class="box-estban-l3">
                <div class="box-col1-estban-l3">

                    <div class="quad-estban-l3">

                        <span class="text-l3-estban">*Nome</span>
                        <div class="campo-nome-anunciar">
                            <input name="Contatos[nome]" id="nome" class="required font-form" type="text">
                            <div class="errorMessage"></div>
                        </div>
                    </div>
                    <div class="quad-estban-l3">
                        <span class="text-l3-estban">*Nome da Empresa</span>
                        <div class="campo-nome-anunciar">
                            <input class="required font-form" id="nome_empresa" type="text">
                            <div class="errorMessage"></div>
                        </div>
                    </div>
                    <div class="quad-estban-l3">
                        <span class="text-l3-estban">*E-mail</span>
                        <div class="campo-nome-anunciar">
                            <input name="Contatos[email]" id="email" class="required font-form" type="text">
                            <div class="errorMessage"></div>
                        </div>
                    </div>
                    <div class="quad-estban-l3">
                        <span class="text-l3-estban">*Telefone</span>
                        <div class="campo-nome-anunciar">
                            <input name="telefone" id="telefone" class="required font-form" type="text">
                            <div class="errorMessage" id="telefone"></div>
                        </div>
                    </div>
                    <div class="quad-estban-l3">

                    </div>
                    <div class="quad-estban-l3">
                        <input type="submit" id="botao-contato" class="botao-enviar-an" value="ENVIAR" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Enviar']);" >
                    </div>
                </div>
                <div class="box-col2-estban-l3">
                    <span class="text-l3-estban-col2">Precisa de ajuda?<span>
                            <span class="text2-l3-estban-col2">Fale Conosco<span>
                                    <span class="text3-l3-estban-col2">(11) 4796-4062 e (11) 2629-2170 <br> <br> atendimento@bombarco.com.br<span>
                                            </div>
                                            </div>
                                            </div>  
                                            </div>

                                            <!-- lightbox msg de sucesso form de contato -->
                                            <div class="lbox-msgenviada" id="lbox-msgok">   
                                                <div class="texts-lbox-ag"> 
                                                    <div class="div-title-form-msgok">
                                                        <span class="form-lb-title" id="msg-lgbox">Sua mensagem foi enviada com sucesso!</span>
                                                    </div>
                                                </div>  
                                                <input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
                                            </div>


                                            <div class="line-anunciar-3-forpag">
                                                <div class="container">
                                                    <div class="bloco-anunciar-3-forpag">

                                                        <span class="titulo-anun-cf2">Formas de  pagamento</span>

                                                        <div class="bloco2-anunciar-3-forpag">
                                                            <icon class="icone-cartao-anun-1"></icon>
                                                        </div>  
                                                        <div class="bloco2-anunciar-3-forpag">
                                                            <icon class="icone-cartao-anun-2"></icon>
                                                        </div>
                                                        <div class="bloco2-anunciar-3-forpag">
                                                            <icon class="icone-cartao-anun-3"></icon>
                                                        </div>
                                                    </div>  
                                                </div>  
                                            </div>  

                                            <div class="line-anunciar-4 line-4-an">
                                                <div class="container">
                                                    <div class="box-line-4-a">
                                                        <div class="titulo-anuncf-div">
                                                            <span class="titulo-anun-cf"><b>Como funciona?</b></span>
                                                        </div>
                                                        <div class="div-icontext1-l4">
                                                            <div class="div-text-l4-an-a">
                                                                <span class="text-l4-an-a">Escolha o tipo de anúncio ideal</span>
                                                                <icon class="icon1-l4-an-a"></i>    
                                                            </div>
                                                        </div>  
                                                        <div class="div-icontext2-l4">
                                                            <icon class="icon-seta-l4-an-a"></i>    
                                                        </div>  
                                                        <div class="div-icontext1-l4">
                                                            <div class="div-text-l4-an-a">
                                                                <span class="text-l4-an-a">Cadastre-se em nossa plataforma</span>
                                                                <icon class="icon2-l4-an-a"></i>    
                                                            </div>
                                                        </div>  
                                                        <div class="div-icontext2-l4">
                                                            <icon class="icon-seta-l4-an-a"></i>    
                                                        </div>  
                                                        <div class="div-icontext1-l4">
                                                            <div class="div-text-l4-an-a">
                                                                <span class="text-l4-an-a">Cadastre o seu anúncio</span>
                                                                <icon class="icon3-l4-an-a"></i>    
                                                            </div>
                                                        </div>  
                                                        <div class="div-icontext2-l4">
                                                            <icon class="icon-seta-l4-an-a"></i>    
                                                        </div>  
                                                        <div class="div-icontext1-l4">
                                                            <div class="div-text-l4-an-a">
                                                                <span class="text-l4-an-a">Efetue o pagamento</span>
                                                                <icon class="icon4-l4-an-a"></i>    
                                                            </div>
                                                        </div>  
                                                    </div>  
                                                </div>
                                            </div>

                                            <div class="line-anunciar-4-estban line-4-an" style="display:none">
                                                <div class="container">
                                                    <div class="box-line-4-a">
                                                        <div class="titulo-anuncf-div">
                                                            <span class="titulo-anun-cf"><b>Como funciona?</b></span>
                                                        </div>
                                                        <div class="div-icontext1-l4">
                                                            <div class="div-text-l4-an-a">
                                                            </div>
                                                        </div>  
                                                        <div class="div-icontext2-l4">
                                                        </div>  
                                                        <div class="div-icontext1-l4">
                                                            <div class="div-text-l4-an-a">
                                                                <span class="text-l4-an-a">Deixe seu contato</span>
                                                                <icon class="icon3-l4-an-a"></i>    
                                                            </div>
                                                        </div>  
                                                        <div class="div-icontext2-l4">
                                                            <icon class="icon-seta-l4-an-a"></i>    
                                                        </div>  
                                                        <div class="div-icontext1-l4">
                                                            <div class="div-text-l4-an-a">
                                                                <span class="text-l4-an-a">Aguarde o retorno de um de nossos atendentes</span>
                                                                <icon class="icon2-l4-an-a"></i>    
                                                            </div>
                                                        </div>  
                                                        <div class="div-icontext2-l4">
                                                        </div>  
                                                        <div class="div-icontext1-l4">
                                                            <div class="div-text-l4-an-a">

                                                            </div>
                                                        </div>  
                                                    </div>  
                                                </div>
                                            </div>  

                                            <div class="line-anunciar-5">
                                                <div class="container">
                                                    <div class="box-line-5-an">
                                                        <div class="box-text-l5-an">
                                                            <span class="title-l5-an"><b> Anunciar no Bombarco é garantir que o seu negócio ganhe visibilidade qualificada.</b> Dotada de anúncios segmentados por categoria, maleáveis de acordo com as necessidades do anunciante e com páginas personalizadas para estaleiros e empresas, nossa plataforma torna-se uma potente ferramenta para a otimização de qualquer negócio náutico.</span>
                                                        </div>
                                                        <div class="box-text2-l5-an">
                                                            <span class="title2-l5-an">No Bombarco você encontra</span>
                                                        </div>
                                                        <div class="box-icones-l5-an">
                                                            <div class="box-sup-icones-l5-an">
                                                                <div class="quad-box-sup-icones-l5-an">
                                                                    <span class="text-l5-an">Conteúdo segmentado por gênero e categoria</span>
                                                                    <icon class="icon4-l5-an-a"></i>
                                                                </div>  
                                                                <div class="quad-box-sup-icones-l5-an">
                                                                    <span class="text-l5-an">Conceitos de usabilidade aplicados à risca, tornando a navegação ainda mais simplificada</span>
                                                                    <icon class="icon6-l5-an-a"></i>    
                                                                </div>  
                                                                <div class="quad-box-sup-icones-l5-an">
                                                                    <span class="text-l5-an">Sistema de busca e filtros otimizados</span>
                                                                    <icon class="icon7-l5-an-a"></i>
                                                                </div>  
                                                                <div class="quad-box-inf-icones-l5-an">
                                                                    <span class="text2-l5-an">Velocidade e ótimo desempenho na navegação de todas as páginas internas</span>
                                                                    <icon class="icon8-l5-an-a"></i>
                                                                </div>
                                                            </div>  
                                                            <!--
                                                            <div class="box-inf-icones-l5-an">
                            
                                                                    
                                                                    <div class="quad-box-inf-icones-l5-an" style= "position: relative; right: 30px;">
                                                                            <span class="text2-l5-an">Versão mobile disponível para acesso através de diferentes dispositivos</span>
                                                                            <icon class="icon9-l5-an-a"></i>
                                                                    </div>  
                                                                    
                                                            </div>  
                                                            -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                            </section>

                                            <script type="text/javascript">
                                                //gambiarra problema news
                                                /*getUrlParameterCiorreria();
                                                 function getUrlParameterCiorreria()
                                                 {
                                                 var sPageURL = window.location.search.substring(1);
                                                 var sURLVariables = sPageURL.split('&');
                                                 var flgAchouParam = false;
                                                 var parametro = '';
                                                 for (var i = 0; i < sURLVariables.length; i++) 
                                                 {
                                                 var sParameterName = sURLVariables[i].split('=');
                                                 if(sParameterName[0] == 'utm_content') {
                                                 if(sParameterName[1] == 'pacotes') {
                                                 location.href = 'https://docs.google.com/forms/d/1ROXnZlLtua2KI_M5p3OLuI77I2ed_P7tYoui90S-wzY/viewform';
                                                 }
                                                 }
                                                 }
                                                 }*/
                                                //final gambiarra
                                            </script>

