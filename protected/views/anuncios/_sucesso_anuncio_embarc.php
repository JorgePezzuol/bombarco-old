<section class="content">
	<div class="line-cad-sucess">
		<div class="container">
				<div class="box-cad-sucess">
					<div class="quad-sup-cad-sucess">
						<icon class="icon-cad-sucess"></i>
						<span class="text1-cad-sucess">Anuncio Cadastrado!</span>
						<span class="text2-cad-sucess">Iremos analisar o seu anuncio e validar seu pagamento, em "x" tempo estará no ar, aguarde contato.</span>
					</div>
					<div class="quad-inf-cad-sucess">
						<?php if($tipo == 'plano'): ?>
							<a class="botao-sucess-cad-2" href="<?php echo Yii::app()->createUrl("anuncios/anunciarEmbarcacao?tipo_anuncio=plano"); ?>" id="btn-sucess-cad-2">Cadastrar novo anúncio</a>
							<a class="botao-sucess-cad-1" href="<?php echo Yii::app()->homeUrl ?>" id="btn-sucess-cad-1">Voltar para home</a>
						<?php else: ?>
							<a class="botao-sucess-cad-2" href="<?php echo Yii::app()->createUrl("anuncios/index"); ?>" id="btn-sucess-cad-2">Cadastrar novo anúncio</a>
							<a class="botao-sucess-cad-1" href="<?php echo Yii::app()->homeUrl ?>" id="btn-sucess-cad-1">Voltar para home</a>
						<?php endif ?>
					</div>
				</div>
		</div>
	</div>
</section>
