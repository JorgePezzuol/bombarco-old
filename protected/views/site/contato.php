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
                <span class="title-inst-top"><a class="link-bd2" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd2" href="<?php echo Yii::app()->createUrl('contato'); ?>">Contato</a></span>
            </div>
            <div class="div-title-inst-principal">
                <span class="title-inst-principal">Contato</span>
            </div>
        </div>
    </div>

    <div class="line-inst-2">
        <div class="container">
               <div class="menu-institucional">
                    <a class="botao-contato btninst active" href="contato" id="contato-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-contato'])
;">Contato</a>
                    <a class="botao-bom-marinheiro btninst" href="bom-marinheiro"id="bom-marinheiro-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-bom-marineiro']);">Bom Marinheiro</a>
                    <!--<a class="botao-planos btninst" href="planos" id="planos-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Planos']);">Planos</a>-->
                    <a class="botao-como-anunciar btninst" href="como-anunciar-site"id="como-anunciar-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-como-anunciar']);">Como anunciar</a>
                    <a class="botao-pq-anunciar btninst" href="por-que-anunciar" id="pq-anunciar-btn">Por que anunciar</a>
                    <a class="botao-institucional btninst" href="institucional" id="institucional-btn" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Btn-Institucional']);" >Institucional</a>
                </div>
        </div>
    </div>
    <div class="div-principal-inst" id="div-princ-institucional">


        <?php

        // cookies
         $email = Yii::app()->request->cookies->contains('email') ? Yii::app()->request->cookies['email']->value : "";
         $celular = Yii::app()->request->cookies->contains('celular') ? Yii::app()->request->cookies['celular']->value : "";
         $nome = Yii::app()->request->cookies->contains('nome') ? Yii::app()->request->cookies['nome']->value : "";

?> 
        
        
    <!-- lightbox msg de sucesso form de contato -->
    <div class="lbox-msgenviada" id="lbox-msgok">
            <div class="texts-lbox-ag">
                <div class="div-title-form-msgok">
                    <span class="form-lb-title" id="msg-lgbox">Sua mensagem foi enviada com sucesso!</span>
                </div>
            </div>
                <input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
        </div>

        <div class="line-inst-principal" id="contato" >

                <div class="line-anunciar-3-estban line-3-an" style="height:370px">
                    <div class="container">
                        <div class="box-estban-l3">
                            <div class="box-col1-estban-l3">

                                <div class="quad-estban-l3">

                                        <span class="text-l3-estban">*Nome</span>
                                            <div class="campo-nome-anunciar">
                                                <input name="nome" value="<?php echo $nome;?>" id="nome" class="font-form-sobre" type="text">
                                            </div>
                                        </div>
                                        <div class="quad-estban-l3b">
                                                <span class="text-l3-estban">*Mensagem</span>
                                            <div class="campo-nome-anunciar2">
                                                <textarea name="mensagem" id="mensagem" class="font-form2"></textarea>
                                            </div>

                                        </div>
                                        <div class="quad-estban-l3">
                                                <span class="text-l3-estban">*Seu E-mail</span>
                                            <div class="campo-nome-anunciar">
                                                <input name="email" id="email" value="<?php echo $email;?>"  class="font-form-sobre" type="text">
                                            </div>
                                        </div>
                                        <div class="quad-estban-l3">
                                        </div>
                                        <div class="quad-estban-l3">
                                            <span class="text-l3-estban">*Telefone</span>
                                            <div class="campo-nome-anunciar">
                                                <input id="telefone" name="telefone" value="<?php echo $celular;?>" class="font-form-sobre" type="tel">
                                            </div>
                                        </div>

                                        <div class="quad-estban-l3">

                                            <input type="submit" id="btn-contato" class="botao-enviar-an" value="ENVIAR" style="margin-top:105px" onclick="_gaq.push(['_trackEvent', 'contato', 'click', 'enviar']);" >
                                            <input type="text" name="mLmA8MdP" class="mLmA8MdP" value="" style="display:none !important;" />

                                        </div>
                                            <div id="erro-contato" class="errorMessage" style="margin-left:16px;"></div>
                            </div>
                            <div class="box-col2-estban-l3">
                                <span class="text-l3-estban-col2">Precisa de ajuda?<span>
                                    <span class="text2-l3-estban-col2">Fale Conosco<span>
                                        <span class="text3-l3-estban-col2">(11)98969-8912 - Seg a Sex das 8h10 às 18h00<br> <br> atendimento@bombarco.com.br<span>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</section>
