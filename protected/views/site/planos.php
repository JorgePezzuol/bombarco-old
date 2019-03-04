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
                <span class="title-inst-top"><a class="link-bd2" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd2" href="<?php echo Yii::app()->createUrl('planos'); ?>">Planos</a></span>
            </div>
            <div class="div-title-inst-principal">
                <span class="title-inst-principal">Planos</span>
            </div>
        </div>
    </div>

    <div class="line-inst-2">
        <div class="container">
                <div class="menu-institucional">
                    <a class="botao-contato btninst" href="contato" id="contato-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-contato'])
;">Contato</a>
                    <a class="botao-bom-marinheiro btninst" href="bom-marinheiro"id="bom-marinheiro-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-bom-marineiro']);">Bom Marinheiro</a>
                    <a class="botao-planos btninst active" href="planos" id="planos-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Planos']);">Planos</a>
                    <a class="botao-como-anunciar btninst" href="como-anunciar-site"id="como-anunciar-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-como-anunciar']);">Como anunciar</a>
                    <a class="botao-pq-anunciar btninst" href="por-que-anunciar" id="pq-anunciar-btn">Por que anunciar</a>
                    <a class="botao-institucional btninst" href="institucional" id="institucional-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Institucional']);" >Institucional</a>
            </div>
        </div>
    </div>
    <div class="div-principal-inst" id="div-princ-institucional">
        
        <div class="line-inst-principal" id="planos" >
            <!-- Conteudo de Planos - Landing Page -->
                <div class="line-planos-final-1" id="faixa-planos-fixed">
                    <div class="container">
                        <div class="bloco-planos-final-1a">
                            <div class="div-texto-planos-final-1">
                                <a class="texto-planos-final-1" id="btn-planos-a">Classificados</a>
                            </div>
                            <div class="div-texto-planos-final-1c">
                                <a class="texto-planos-final-1" id="btn-planos-b">Guia de Empresas</a>
                            </div>
                            <div class="div-texto-planos-final-1b">
                                <a class="texto-planos-final-1" id="btn-planos-c">Plano Premium para Estaleiros</a>
                            </div>
                            <div class="div-texto-planos-final-1">
                                <a class="texto-planos-final-1" id="btn-planos-d">Banners</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-planos-final-2">
                    <div class="container">
                        <div class="bloco-planos-final-2a">
                            <div class="bloco-planos-final-2b">
                                <div class="div-texto-planos-final-2">
                                    <span class="texto-planos-final-2 ">Planos para anunciar <b>Embarcações</b></span>
                                </div>
                            </div>
                            <div class="bloco-planos-final-2b">
                                <div class="div-texto-planos-final-3">
                                    <span class="texto-planos-final-3 ">Nos Classificados Bombarco você encontra anúncios maleáveis, de acordo com as suas necessidades. Aqui, você pode caprichar nas informações mais relevantes sobre as suas embarcações e até turbinar o seu anúncio com adicionais que fazem toda a diferença, como destaque nas buscas, mais fotos, vídeo, destaque na listagem e título. </span>
                                </div>
                            </div>
                            <div class="bloco-planos-final-2b">
                                <a class="botao-plano-final"  id="btn-planos-veja-a">Veja como seu anúncio vai ficar!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-planos-final-3">
                    <div class="container">
                        <div class="bloco-planos-final-3a">
                            <div class="bloco-planos-final-3b">
                                <div class="bloco-planos-final-3c">
                                    <div class="div-texto-planos-final-4">
                                        <span class="texto-planos-final-4"><b>Plano Individual</b></span>
                                    </div>
                                </div>
                                <div class="bloco-planos-final-3d">
                                    <div class="div-texto-planos-final-5">
                                        <span class="texto-planos-final-5">
                                            <c><b>Se você quer anunciar apenas uma <br>embarcação, </b>este é o plano ideal pra você.</b></c>
                                            <br><br>
                                            O valor do anúncio será calculado de acordo com <br> o valor do seu barco x a validade da publicação.
                                        </span>
                                    </div>
                                </div>
                                <div class="bloco-planos-final-3e">
                                    <a href="<?php echo Yii::app()->createUrl('anuncios/index');?>" class="botao2-plano-final desktop" href="" id="#" onclick="_gaq.push(['_trackEvent', 'Planos', 'click', 'simulação-PI']);">Faça uma simulação</a>
                                    <a href="javascript: return false;" class="botao2-plano-final mobile" href="" id="#">Faça uma simulação acessando o site pelo computador</a>
                                </div>
                            </div>
                            <div class="bloco-planos-final-3b">
                                <div class="bloco-planos-final-3c">
                                    <div class="div-texto-planos-final-4">
                                        <span class="texto-planos-final-4"><b>Plano <br>Plus</b></span>
                                    </div>
                                </div>
                                <div class="bloco-planos-final-3d">
                                    <div class="div-texto-planos-final-5">
                                        <span class="texto-planos-final-5">
                                            <c><b>Se você deseja anunciar um grande número<br> de embarcações, </b>este é o plano ideal pra você.</b></c>
                                            <br><br>
                                            Escolha quantos barcos serão anunciados <br>(6, 15, 30 ou 60) e a validade da publicação <br>para calcular o valor de seu pacote.
                                        </span>
                                    </div>
                                </div>
                                <div class="bloco-planos-final-3e">
                                    <a href="<?php echo Yii::app()->createUrl('anuncios/index');?>" class="botao2-plano-final desktop" href="" id="#" onclick="_gaq.push(['_trackEvent', 'Planos', 'click', 'simulação-plus']);">Faça uma simulação</a>
                                    <a href="javascript: return false;" class="botao2-plano-final mobile" href="" id="#">Faça uma simulação acessando o site pelo computador</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-planos-final-4">
                    <div class="container">
                        <div class="bloco-planos-final-4a">
                            <div class="bloco-planos-final-4b">
                                <div class="bloco-planos-final-4e">
                                    <div class="div-texto-planos-final-2">
                                        <span class="texto-planos-final-2 ">Anuncie sua empresa no<b> Guia de Empresas</b></span>
                                    </div>
                                </div>
                                <div class="bloco-planos-final-4e">
                                    <div class="div-texto-planos-final-3">
                                        <span class="texto-planos-final-3">Se você tem uma empresa e deseja aumentar a visibilidade dela é hora <br> de inseri-la em nosso Guia de Empresas. Para isso, basta escolher o tempo <br> de validade da exibição, 6 ou 12 meses, e o conteúdo da sua <br> página institucional.<c> A página da sua empresa irá conter: </c> </span>
                                    </div>
                                </div>
                                <div class="bloco-planos-final-4f">
                                    <div class="div-texto-planos-final-6">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Nome</span>
                                    </div>
                                    <div class="div-texto-planos-final-6">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Logo</span>
                                    </div>
                                    <div class="div-texto-planos-final-6">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Banner</span>
                                    </div>
                                    <div class="div-texto-planos-final-6">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Endereço</span>
                                    </div>
                                    <div class="div-texto-planos-final-6b">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Formulário para contato</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bloco-planos-final-4c">
                                <div class="bloco-planos-final-4g">
                                    <span class="texto-planos-final-6"><b>É possível ainda turbiná-la com os seguintes adicionais:</b></span>
                                </div>
                                <div class="bloco-planos-final-4f">
                                    <div class="div-texto-planos-final-6c">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Link para Facebook</span>
                                    </div>
                                    <div class="div-texto-planos-final-6d">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Descrição</span>
                                    </div>
                                    <div class="div-texto-planos-final-6d">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Imagem</span>
                                    </div>
                                    <div class="div-texto-planos-final-6d">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Video</span>
                                    </div>
                                    <div class="div-texto-planos-final-6d">
                                        <span class="texto-planos-final-6"><icon class="icon-planos-final"></icon>Destaque</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bloco-planos-final-4d">
                                <div class="bloco-planos-final-4h">
                                    <a class="botao-plano-final" style="margin-top: 27px;"  id="btn-planos-veja-b">Veja como seu anúncio vai ficar!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-planos-final-5">
                    <div class="container">
                        <div class="bloco-planos-final-5a">
                            <div class="bloco-planos-final-5b">
                                <span class="texto-planos-final-2 ">Plano premium para anúncio de<b> Estaleiros</b></span>
                            </div>
                            <div class="bloco-planos-final-5c">
                                <span class="texto-planos-final-3" style="margin-top: 8px;">Interessado em anunciar seu estaleiro?<br><c> Temos planos anuais especiais pra você! </c> </span>
                            </div>
                            <div class="bloco-planos-final-5d">
                                <a class="botao-plano-final" style="margin-top: 27px;" id="btn-planos-veja-c">Veja como seu anúncio vai ficar!</a>
                            </div>
                            <div class="bloco-planos-final-5e">
                                <span class="texto-planos-final-6"><c>Gostou?</c></span>
                                <a class="botao3-plano-final" id="btn-contato-planos" onclick="_gaq.push(['_trackEvent', 'Planos', 'click', 'contato.estaleiros']);">Entre em contato</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line-planos-final-6">
                    <div class="container">
                        <div class="bloco-planos-final-6a">
                            <div class="bloco-planos-final-6b">
                                <span class="texto-planos-final-2 ">Anuncie em nossos<b> Banners</b></span>
                            </div>
                            <div class="bloco-planos-final-6c">
                                <span class="texto-planos-final-3" style="margin-top: 15px;">Oferecemos três formatos de banners diferentes, com possibilidade de <br> segmentação por categoria e, consequentemente, público e conteúdo. </span>
                            </div>
                            <div class="bloco-planos-final-6d">
                                <div class="div-foto-banner-planos">
                                    <icon class="foto-banner-planos-c"></icon>
                                    <span class="texto-planos-final-6"><c>Anúncio Topo <br> Expansível</c></span>
                                </div>
                                <div class="div-foto-banner-planos">
                                    <icon class="foto-banner-planos-a"></icon>
                                    <span class="texto-planos-final-6"><c>Banner <br> Horizontal</c></span>
                                </div>
                                <div class="div-foto-banner-planos">
                                    <icon class="foto-banner-planos-b"></icon>
                                    <span class="texto-planos-final-6"><c>Banner <br> Vertical lateral</c></span>
                                </div>
                            </div>
                            <div class="bloco-planos-final-6e">
                                <span class="texto-planos-final-6" style="margin-top:27px"><c>Mais detalhes?</c></span>
                                <a class="botao3-plano-final" id="btn-contato-planos2" onclick="_gaq.push(['_trackEvent', 'Planos', 'click', 'contato.Banners']);">Entre em contato</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Divs Lightbox -->
                <div class="lbox-grande" id="lbox-grande-planos-a">
                  <input type="button" id="close" class="fechar-form-d close" value="X">
                        <div class="plbg1">
                        </div>
                </div>
                <div class="lbox-grande" id="lbox-grande-planos-b">
                  <input type="button" id="close" class="fechar-form-d close" value="X">
                        <div class="plbg2">
                        </div>
                </div>
                <div class="lbox-grande" id="lbox-grande-planos-c">
                  <input type="button" id="close" class="fechar-form-d close" value="X">
                        <div class="plbg3">
                        </div>
                </div>
                <div class="lbox-ag" id="lbox-contato-planos">
                    <div class="texts-lbox-ag">
                      <span class="ev-titleb">Envie uma mensagem para o Bombarco</br></span>
                      <input type="button" id="close" class="fechar-form close" value="X">
                    </div>
                    <div id="erro-contato" class="div-sucess-lbox"></div>

                    <div class="form-nome-ag">
                        <input placeholder="Seu nome"id="nome2" class="terms-ag-1" type="text" required />
                    </div>
                    <div class="form-nome-ag">
                        <input placeholder="Seu e-mail" id="email2" class="terms-ag-1" type="email" required />
                    </div>
                    <div class="form-nome-ag">
                        <input placeholder="Telefone" id="telefone2" class="terms-ag-1" type="tel">
                    </div>
                    <div class="form-nome-ag">
                        <input placeholder="Mensagem" id="mensagem2" class="terms-ag-1" type="text" required />
                    </div>
                    <input type="button" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-contato-institucional2" value="ENVIAR MENSAGEM">
                    <input type="text" name="mLmA8MdP" class="mLmA8MdP" value="" style="display:none !important;" />
                </div>
                <!-- // -->
        </div>

       
    </div>
</section>
