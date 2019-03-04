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
                <span class="title-inst-top"><a class="link-bd2" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd2" href="<?php echo Yii::app()->createUrl('site/institucional'); ?>">Sobre</a></span>
            </div>
            <div class="div-title-inst-principal">
                <span class="title-inst-principal">Sobre o Bombarco</span>
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
                    <a class="botao-pq-anunciar btninst" href="por-que-anunciar" id="pq-anunciar-btn">Por que anunciar</a>
                    <a class="botao-institucional btninst active" href="institucional" id="institucional-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Institucional']);" >Institucional</a>
                </div>
        </div>
    </div>
    <div class="div-principal-inst" id="div-princ-institucional">
        <div class="line-inst-principal" id="institucional" >
            <div class="container">
                <div class="titulo-inst-div">
                    <span class="titulo-inst">O Bombarco</span>
                </div>
                <div class="texto-inst-div" style="height:390px">
                    <span class="texto-inst">

                        O Bombarco surgiu no mercado nacional com o objetivo de preencher uma lacuna da Internet no segmento náutico. Com uma proposta arrojada e inovadora, o site é uma porta de entrada para novos marinheiros e um porto seguro para quem busca informações de valor e negócios, tanto para anunciantes quanto para compradores.<br><br>
                        Hoje o Bombarco é considerado o maior Classificado Náutico do Brasil, pois reúne as melhores oportunidades de negócio para embarcações seminovas do mercado, o mais completo catálogo de estaleiros e embarcações novas, conteúdo selecionado, agenda e cobertura dos principais eventos náuticos, tornando o acesso à essas informações muito mais simplificado.<br><br>
                        “Com estudos realizados, ao longo desses anos, identificamos necessidades e comportamentos do internauta que busca informações do mercado náutico na rede. Assim desenvolvemos e melhoramos as ferramentas do site. Agora não é mais preciso pesquisar em diferentes fontes e mídias.”, <b>Marcio Ishihara, diretor-executivo do BOMBARCO.</b>

                    </span>

                </div>
            </div>
        </div>
        

    </div>
</section>
