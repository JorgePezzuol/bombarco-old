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
                <span class="title-inst-top"><a class="link-bd2" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd2" href="<?php echo Yii::app()->createUrl('/bom-marinheiro'); ?>">Bom Marinheiro</a></span>
            </div>
            <div class="div-title-inst-principal">
                <span class="title-inst-principal">Bom Marinheiro</span>
            </div>
        </div>
    </div>

    <div class="line-inst-2">
        <div class="container">
                <div class="menu-institucional">
                    <a class="botao-contato btninst" href="contato" id="contato-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-contato'])
;">Contato</a>
                    <a class="botao-bom-marinheiro btninst active" href="bom-marinheiro"id="bom-marinheiro-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-bom-marineiro']);">Bom Marinheiro</a>
                    <!--<a class="botao-planos btninst" href="planos" id="planos-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Planos']);">Planos</a>-->
                    <a class="botao-como-anunciar btninst" href="como-anunciar-site"id="como-anunciar-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-como-anunciar']);">Como anunciar</a>
                    <a class="botao-pq-anunciar btninst" href="por-que-anunciar" id="pq-anunciar-btn">Por que anunciar</a>
                    <a class="botao-institucional btninst" href="institucional" id="institucional-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Institucional']);" >Institucional</a>
                </div>
        </div>
    </div>
    <div class="div-principal-inst" id="div-princ-institucional">
        
        
        
        




        <div class="line-inst-principal" id="bom-marinheiro" >
            <div class="container">
                <div class="col-left-bm">
                    <div class="titulo-inst-div">
                        <span class="titulo-inst">O que é o Bom Marinheiro?</span>
                    </div>
                        <div class="texto-inst-div" style="height:120px; width: 583px;">
                            <span class="texto-inst">
                                O Bom Marinheiro é o primeiro selo de reconhecimento concedido aos marinheiros de esporte e recreio que se destacam e apresentam todos os requisitos para execução da sua função na categoria, cuja sua atuação sirva de referência para o aumento da competitividade e melhoria do segmento e busca paralelamente chamar a atenção dos órgãos responsáveis para a classe.
                            </span>
                        </div>
                    <div class="titulo-inst-div" style="margin-top:0px">
                        <span class="titulo-inst">Qual o objetivo?</span>
                    </div>
                        <div class="texto-inst-div" style="height:120px; width: 583px;">
                            <span class="texto-inst">
                                O objetivo do projeto é promover uma melhor qualificação por parte dos marinheiros nas áreas de mecânica, motor, elétrica, navegação, ética profissional, Responsabilidade Social, Limpeza e manutenção, tendências e novas tecnologias, GPS, comunicação VHF e uma sensibilização sobre preservação do meio ambiente, visando o crescimento sustentável do segmento.
                            </span>
                        </div>
                        <span class="texto-planos-final-6"><c>Conheça:</c></span>
                        <div class="div-btn-bm">
                            <a class="botao-plano-final" target="_blank"  href="http://www.bommarinheiro.com.br" id="#" onclick="_gaq.push(['_trackEvent', 'bom-marineiro', 'click', 'link-site']);">www.bommarinheiro.com.br</a>
                        </div>
                </div>
                <div class="col-right-bm">
                    <div id="bom-marinheiro bg" class="bmbg">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
