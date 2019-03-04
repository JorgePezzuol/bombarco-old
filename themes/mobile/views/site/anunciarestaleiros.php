<div class="header-search full-width header-result-categorie">
    <div class="container">
        <a href="javascript:history.back();" class="header-back sprite inline-block"></a>
        <article class="title-categorie inline-block">Estaleiros</article>
        <br class="clear" />
    </div>
</div>

<div class="list-anunciar">

    <div class="content-list full-width">
        <div class="container">
            <i class="ico-list ico-contato inline-block sprite"></i>
            <article class="text-list inline-block">Deixe seu contato</article>
        </div>
    </div>

    <div class="content-list full-width">
        <div class="container">
            <i class="ico-list ico-user inline-block sprite"></i>
            <article class="text-list inline-block">Aguarde o retorno de <br /> um de nossos atendentes</article>
        </div>
    </div>

</div>

<article class="box-title-inst">Deixe seu contato</article>

<div class="box-contato box-contato-institucional">

    <div class="content-contato full-width">
        <div class="container container-form">

            <div id="erro-contato-anunciar-estaleiro" class="errorMessage"></div>

            <label class="label-contato">Nome</label>

            <?php if (!Yii::app()->user->isGuest): ?>
                <?php
                $nome = "Nome";

                if (Usuarios::getUsuarioLogado()->nome != "") {
                    $nome = Usuarios::getUsuarioLogado()->nome;
                }
                ?>
                <input value="<?php echo $nome; ?>" name="nome-contato-anunciar-estaleiro" id="nome-contato-anunciar-estaleiro"  class="input-text" type="text" />
            <?php else: ?>
                <input value="" name="nome-contato-anunciar-estaleiro" id="nome-contato-anunciar-estaleiro"  class="input-text" type="text" />
            <?php endif; ?>

            <label class="label-contato">Email</label>
            <?php if (!Yii::app()->user->isGuest): ?>
                <input value="<?php echo Usuarios::getUsuarioLogado()->email; ?>" name="email-contato-anunciar-estaleiro" id="email-contato-anunciar-estaleiro" class="input-text" type="email" />
            <?php else: ?>
                <input value="" name="email-contato-anunciar-estaleiro" id="email-contato-anunciar-estaleiro" class="input-text" type="email" />
            <?php endif; ?>

            <label class="label-contato">Telefone</label>
            <input id="telefone-contato-anunciar-estaleiro" name="telefone-contato-anunciar-estaleiro" class="input-text input-tel" type="tel" />

            <label class="label-contato">Mensagem</label>
            <textarea name="mensagem-contato-anunciar-estaleiro" id="mensagem-contato-anunciar-estaleiro" class="input-textarea"></textarea>

            <input type="submit" id="btn-contato-anunciar-estaleiro" class="input-submit" value="Enviar Mensagem" />
            <i class="ico-submit sprite inline-block"></i>
        </div>
    </div>

</div>