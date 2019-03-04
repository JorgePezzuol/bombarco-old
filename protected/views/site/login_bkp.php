<?php

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

?>
<section class="content">

			<div class="line-banner-idt"> 
				<div class="container">	
						<div class="div-textos-idt">
							<span class="title">Identificacão</span>
							<span class="title-2">Home > Anunciar > Identificação</span>
							<span class="title-3">Faça seu login ou crie sua conta</span>	
						</div>
				</div>	
			</div>	
			<!--Conteudo da Pagina-->	
			
	<div class="line-gray-idt">
		<div class="container">		
			<div>
				
					<div style="position: relative; top: 385px; visibility:hidden;">
						<section class="botao-facebok-idt">	
							<a class="facebook-idt" id="btn-face-idt" onclick="facebookLogin()">Login com Facebook</a>
						</section>	
						<section class="botao-google-idt">	
							<a class="google-idt" id="btn-face-idt" onclick="login()">Login com Google+</a>
						</section>
						<div id="profile"></div>
					</div>
					<!--Caixa 1-->

					<div class="lbox-msgenviada" id="lbox-msgok">	
						<div class="texts-lbox-ag">	
							<div class="div-title-form-msgok">

								<span class="form-lb-title" id="msg-lgbox2">
									Entre com seu email
								</span>
								
								<div class="search-idt" style="margin-top:10px;">	
										<input name="esqeceu-senha-email" id="esqeceu-senha-email" placeholder="Seu email" class="terms-idtf" type="text">
								</div>
									
							</div>
						</div>	
						<br/>
							<input type="button" class="botao-lb-form-msgok enviar" id="btn-enviar-email-esqeceu-senha" value="Ok">
					</div>
					
						<div class="form-idt">					
								<a id="esqeceu-senha" style="cursor:pointer;" class="title-idt-es">Esqueceu sua senha?</a>	
								<text class="title-idt">Ja é cadastrado</text>
								<text class="title-idt-2">no Bombarco?<br>Faça seu login.</text>
								<?php if(Yii::app()->user->hasFlash('erro-login')):?>
								    <div class="errorMessage3">
								        <?php echo Yii::app()->user->getFlash('erro-login'); ?>
								    </div>
								<?php endif; ?>
								<form action="login" id="form-login" method="post">
									<div>
										<div class="campo-idt">
											<div class="search-idt">	
												<input name="username" placeholder="Seu e-mail" class="terms-idtf" type="text">
											</div>
										</div>	
													
										<div class="campo-idt-2">
											<div class="search-idt-2">									
													<input name="senha" placeholder="Sua senha" class="terms-idtf" class="search-idt-2" type="password">
											</div>
										</div>	
											<div class="botao-entrar-idt">	
												<input type="submit" class="entrar-idt" style="font-weight:none;"  id="btn-entrar-idt" value="ENTRAR" onclick="_gaq.push(['_trackEvent', 'Login', 'click', 'Entrar'])">
												<input type="hidden" name="login"/>
											</div>
									</div>

								</form>		
						</div>	

					<!--Caixa 2-->
					<div class="form-idt-2">
						<div style = "position: relative; top: 193px;left: 31px;">
						<text class="title-idt-3">Não possui conta?</text>
						<text class="title-idt-4">Cadastre em</text>
						<text class="title-idt-5">minutos.</text>
						</div >
							<div style ="position:relative; top: 290px;">		
								<section class="botao-cadastrar-idt">	
									<?php echo CHtml::link('CADASTRAR',array('usuarios/create'), array('class' => 'cadastrar-idt', 'id' => 'btn-cadastrar-idt', 'onclick' => '_gaq.push(["_trackEvent", "Login", "click", "Cadastrar"]);')); ?>
                                     </div>
								</section>
							</div>
					</div>	
				
			</div>	
		</div>	
	</div>			

</section>