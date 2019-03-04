<?php
   $query_url = $_SERVER['QUERY_STRING'];
   ?>
<header class="header full-width">
   <div class=container><i class="btn-menu inline-block sprite"></i> <a href="<?php echo Yii::app()->homeUrl; ?>" class="logo-header inline-block sprite"></a></div>
</header>
<nav class=main-menu>
   <i class="btn-close-menu sprite inline-block flt-right"></i><br class=clear>
   <ul class=menu>
      <li class="item-menu even"><a href="<?php echo Yii::app()->homeUrl; ?>" class=link-menu><i class="ico-menu ico-home sprite inline-block"></i> Home</a></li>
      <li class="item-menu odd">
         <div href=# class="link-menu link-sub" data-link=1><i class="ico-menu ico-embarcacoes sprite inline-block"></i> Embarcações <i class="ico-arrow sprite inline-block"></i></div>
      </li>
      <li class=sub-item data-menu=1>
         <ul class=menu-sub>
            <li class=item-menu><a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda'); ?>" class=link-menu><i class="ico-menu ico-lanchas sprite inline-block"></i> Lanchas</a></li>
            <li class=item-menu><a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda'); ?>" class=link-menu><i class="ico-menu ico-veleiros sprite inline-block"></i> Veleiros</a></li>
            <li class=item-menu><a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda'); ?>" class=link-menu><i class="ico-menu ico-jetskis sprite inline-block"></i> Jet skis</a></li>
            <li class=item-menu><a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda'); ?>" class=link-menu><i class="ico-menu ico-pesca sprite inline-block"></i> Barcos de Pesca</a></li>
         </ul>
      </li>
      <li class="item-menu even"><a href="<?php echo Yii::app()->createUrl('catalogo'); ?>" class=link-menu><i class="ico-menu ico-estaleiros sprite inline-block"></i> Catálogo</a></li>
      <li class="item-menu odd"><a href="<?php echo Yii::app()->createUrl('guia-de-empresas/todas'); ?>" class=link-menu><i class="ico-menu ico-empresas sprite inline-block"></i> Guia de empresas</a></li>
      <li class="item-menu even"><a href="<?php echo Yii::app()->createUrl('site/institucional'); ?>" class=link-menu><i class="ico-menu ico-institucional sprite inline-block"></i> Institucional</a></li>
      <li class="item-menu odd"><a href="<?php echo Yii::app()->createUrl('site/comoAnunciar'); ?>" class=link-menu><i class="ico-menu ico-anunciar sprite inline-block"></i> Como anunciar</a></li>
      <li class="item-menu even"><a href=# class="link-menu link-home-contato"><i class="ico-menu ico-contato sprite inline-block"></i> Contato</a></li>
      <li class="item-menu odd"><a href="<?php echo Yii::app()->createUrl('embarcacoes/favoritosMobile'); ?>" class=link-menu><i class="ico-menu ico-favoritos sprite inline-block"></i> Favoritos</a></li>
      <?php if (!Yii::app()->user->isGuest): ?>
      <li class="item-menu even"><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>" class=link-menu><i class="ico-menu ico-logout sprite inline-block"></i> Logout</a></li>
      <?php else: ?>
      <li class="item-menu even"><a href="<?php echo Yii::app()->createUrl('site/login'); ?>" class=link-menu><i class="ico-menu ico-logout sprite inline-block"></i> Login / Cadastro</a></li>
      <?php endif; ?>
   </ul>
</nav>
<div class=box-contato-home>
   <div class="header-contato full-width">
      <div class=container>
         <i class="btn-close-boxcontato inline-block sprite"></i>
         <article class=header-text>Envie uma mensagem para o Bombarco</article>
         <div id=erro-contato></div>
      </div>
   </div>
   <div class="content-contato full-width">
      <div class="container container-form"><label class=label-contato>Nome</label><?php if (!Yii::app()->user->isGuest): ?><?php
         $nome = "Nome";
         
         if (Usuarios::getUsuarioLogado()->nome != "") { $nome = Usuarios::getUsuarioLogado()->nome; } ?> <input placeholder="Seu nome" id=nome-contato value="<?php echo $nome; ?>" class=input-text type=text><?php else: ?><input placeholder="Seu nome" id=nome-contato class=input-text type=text><?php endif; ?><label class=label-contato>Email</label><?php if (!Yii::app()->user->isGuest): ?> <input placeholder="Seu e-mail" value="<?php echo Usuarios::getUsuarioLogado()->email; ?>" id=email-contato class=input-text type=text><?php else: ?><input placeholder="Seu e-mail" id=email-contato class=input-text type=text><?php endif; ?><label class=label-contato>Telefone</label> <input placeholder="Seu e-mail" id=telefone-contato class="input-text input-tel" type=tel> <label class=label-contato>Mensagem</label> <textarea id=mensagem-contato class=input-textarea></textarea> <input type=button name=botao-cadastrar-form class=input-submit id=btn-contato value="Enviar Mensagem"> <i class="ico-submit sprite inline-block"></i></div>
   </div>
</div>
<div class=box-contato-sucess>
   <div class=container>
      <article class=text-msg>Sua mensagem foi enviada<br>com sucesso!</article>
      <div class=btn-ok>Ok</div>
   </div>
</div>
<?php if ($query_url == 'logintrue') : ?>
<div class="box-contato-sucess box-login-sucess">
   <div class=container>
      <article class=text-msg>Login efetuado<br>com sucesso!</article>
      <div class=btn-ok>Ok</div>
   </div>
</div>
<?php endif; ?><?php if ($query_url == 'createtrue') : ?>
<div class="box-contato-sucess box-login-sucess">
   <div class=container>
      <article class=text-msg>Cadastro efetuado<br>com sucesso!</article>
      <div class=btn-ok>Ok</div>
   </div>
</div>
<?php endif; ?>
<div class=box-input-focus></div>
<div class=preloader><img src="<?php echo Yii::app()->createUrl('img/loader.gif'); ?>"></div>