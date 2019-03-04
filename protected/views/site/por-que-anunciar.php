<?php
    if(isset($parametro)) {
        echo '<input id="hidden-parametro" type="hidden" value="'.$parametro.'"/>';
    }

    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js', CClientScript::POS_END);

?>
<section class="content">
    <div class="line-inst-1">
        <div class="container">
            <div class="div-title-inst-top">
                <span class="title-inst-top"><a class="link-bd2" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd2" href="<?php echo Yii::app()->createUrl('por-que-anunciar'); ?>">Por que Anunciar</a></span>
            </div>
            <div class="div-title-inst-principal">
                <span class="title-inst-principal">Por que Anunciar</span>
            </div>
        </div>
    </div>

    <div class="line-inst-2">
        <div class="container">
               <div class="menu-institucional">
                    <a class="botao-contato btninst" href="contato" id="contato-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-contato'])
;">Contato</a>
                    <a class="botao-bom-marinheiro btninst" href="bom-marinheiro"id="bom-marinheiro-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-bom-marineiro']);">Bom Marinheiro</a>
                    <!--<a class="botao-planos btninst" href="planos" id="planos-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Planos']);">Planos</a>-->
                    <a class="botao-como-anunciar btninst" href="como-anunciar-site"id="como-anunciar-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-como-anunciar']);">Como anunciar</a>
                    <a class="botao-pq-anunciar btninst active" href="por-que-anunciar" id="pq-anunciar-btn">Por que anunciar</a>
                    <a class="botao-institucional btninst " href="institucional" id="institucional-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Institucional']);" >Institucional</a>
                </div>
        </div>
    </div>
    <div class="div-principal-inst" id="div-princ-institucional">
        <div class="line-inst-principal" id="pq-anunciar">
            <div class="container">     
                <div class="titulo-inst-div">
                    <span class="titulo-inst">Por que anunciar</span>
                </div>
                <div class="texto-inst-div" style="height:130px">
                    <span class="texto-inst" >
                        
                        Anunciar no Bombarco é garantir que o seu negócio ganhe visibilidade qualificada. Dotada de anúncios segmentados por categoria, maleáveis de acordo com as necessidades do anunciante e com páginas personalizadas para estaleiros e empresas. Nossa plataforma torna-se uma potente ferramenta para a otimização de qualquer negócio náutico.

                    </span> 
                </div>      

            
                    
                    <div class="box-text2-l5-an" style="border-top:solid 1px #00918e">
                        <span class="title2-l5-an" style="margin-top:33px">No Bombarco você encontra</span>
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
                         
                        
                    </div>
            
            </div>  
        </div>
        
    
        
    </div>
</section>
