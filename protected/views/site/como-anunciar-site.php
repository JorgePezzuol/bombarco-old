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
                <span class="title-inst-top"><a class="link-bd2" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd2" href="<?php echo Yii::app()->createUrl('como-anunciar-site'); ?>">Como Anunciar</a></span>
            </div>
            <div class="div-title-inst-principal">
                <span class="title-inst-principal">Como Anunciar</span>
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
                    <a class="botao-como-anunciar btninst active" href="como-anunciar-site"id="como-anunciar-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-como-anunciar']);">Como anunciar</a>
                    <a class="botao-pq-anunciar btninst" href="por-que-anunciar" id="pq-anunciar-btn">Por que anunciar</a>
                    <a class="botao-institucional btninst" href="institucional" id="institucional-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Institucional']);" >Institucional</a>
                </div>
        </div>
    </div>
    <div class="div-principal-inst" id="div-princ-institucional">
        
        
        <div class="line-inst-principal" id="como-anunciar">
            <div class="container">
                <div class="titulo-inst-div2">
                    <span class="titulo-inst"><b>Para anuncinar</b> Embarcações <b>ou no</b> Guia de Empresas</span>
                </div>
                    <div class="line-anunciar-4-pl line-4-an">
                        <div class="container">
                            <div class="box-line-4-a">
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

                <div class="titulo-inst-div2">
                    <span class="titulo-inst"><b>Para anunciar</b> Estaleiros <b>ou</b> Banners Promocionais</span>
                </div>

                    <div class="line-anunciar-4-estban line-4-an">
                        <div class="container">
                            <div class="box-line-4-a">
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

            </div>
        </div>
        

        
    </div>
</section>
