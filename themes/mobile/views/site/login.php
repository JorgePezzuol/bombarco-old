<?php

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

?>

<div class="header-search full-width header-result-categorie">
	<div class="container">
		<a href="javascript:history.back();" class="header-back sprite inline-block"></a>
		<article class="title-categorie inline-block">Login / Cadastre</article>
		<br class="clear" />
	</div>
</div>

<div class="content-login">
	<div class="container container-form">					
		<!-- <a id="esqeceu-senha" style="cursor:pointer;" class="title-idt-es">Esqueceu sua senha?</a> -->	
		<article class="text-login">Já é cadastrado? <br /> <span class="second-text">Faça seu login</span></article>
		<?php if(Yii::app()->user->hasFlash('erro-login')):?>
		    <div class="errorMessage3">
		        <?php echo Yii::app()->user->getFlash('erro-login'); ?>
		    </div>
		<?php endif; ?>
		<form action="login" id="form-login" method="post">
			<label class="label-contato">E-mail</label>
			<input name="username" class="input-text" type="email">
			<label class="label-contato">Senha</label>									
			<input name="senha" class="input-text" type="password">
			<input type="submit" class="input-submit"  id="btn-entrar-idt" value="ENTRAR">
			<input type="hidden" name="login"/>

		</form>
		<!-- esqueci senha -->
		<a id="esqeceu-senha" class="text-lost-password">Esqueceu sua senha?</a>
			
		<article class="text-login text-cadastre">Não possui conta? <br /> <span class="second-text">Cadastre-se em minutos</span></article>			
		<?php echo CHtml::link('CADASTRAR',array('usuarios/create'), array('class' => 'cadastrar-idt', 'id' => 'btn-cadastrar-idt')); ?>
	</div>

	<div class="box-opacity box-lostpassword" id="lbox-msgok">
		<i class="btn-close-boxlostpassword inline-block sprite"></i>
		<div class="container">
			<article class="text-msg">Entre com seu email</article>	
			<div id="erro-mail-lostpassword"></div>
			<input name="esqeceu-senha-email" id="esqeceu-senha-email" class="input-text" type="email">
			<input type="button" class="botao-lb-form-msgok enviar btn-ok" id="btn-enviar-email-esqeceu-senha" value="Ok">
			<div class="btn-ok btn-ok-closelostpassword">Ok</div>
		</div>
	</div>	

</div>