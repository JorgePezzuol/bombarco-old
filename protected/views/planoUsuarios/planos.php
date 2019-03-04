<?php
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/plano_usuarios.js', CClientScript::POS_END);
?>


<br class="clr">
<?php if($flag == "anuncio_individual"): ?>

	<section class="header-row">
		<div class="row-line">
			<div class="container">
				<span class="row-title">Plano Individual</span> <a href="javascript:window.history.back(-1);" class="bt-voltar">Voltar</a>
			</div>
		</div>
	</section>

	<section id="dados-cliente" class="planos-list">
		<div class="container">
			<div class="box-info-3-3" style="background: #F1F1F1 !important;">
						<div class="box-line-3-planos-ind">
					<div class="quadro-line-3-planos-ind">
						<div class="div-text2-l3-an-a">
							<span class="text2-l3-an-a">
								Valor da Embarcação
							</span>	
						</div>	
							<div class="div-select-an">								
							<span class="select-form-anunciar">
								<select id="valor-individual" class="select-anuncio-pad">
									<option value="">Selecione...</option>
										<option value="10000.00">Até R$ 10 mil</option>
										<option value="50000.00">Até R$ 50 mil</option>
										<option value="250000.00">Até R$ 250 mil</option>
										<option value="0.00">Mais que R$ 250 mil</option>
								</select>
							</span>	
						</div>
					</div>	
					<div class="quadro3-line-3-planos-ind">
						<div class="div-text2-l3-an-a">
							<span class="text2-l3-an-a">Validade do Anúncio
							</span>	
						</div>	
						<div class="div-select-an">								
							<span class="select-form-anunciar">
							<select id="meses-individual" class="select-anuncio-pad">
								<option value="">Selecione...</option>
								<option value="3" selected="selected">3 Meses</option>
								<option value="6">6 Meses</option>
							</select>
							</span>	
						</div>
					</div>
					<div class="quadro2-line-3-planos-ind">
						<div class="div-text3-l3-an-a">
							<span id="valor-anuncio-individual" class="text3-l3-an-a">
								R$ 32,00
							</span>	
						</div>
						<div class="div-botao-contratar-an">
								<a class="botao-contratar-an" id="btn-anuncio-individual" href="#">CONTRATAR</a>
						</div>		
					</div>	
				</div>

			</div>
			<br class="clr">
		</div>
	</section>

	<!-- plano de embarcacoes -->
	<?php else:?>

		<section class="header-row">
			<div class="row-line">
				<div class="container">
					<span class="row-title"></span><a href="javascript:window.history.back(-1);" class="bt-voltar">Voltar</a>
				</div>
			</div>
		</section>

		<section id="dados-cliente" class="planos-list">
			<div class="container">
				<div class="box-info-3-3" style="background: #F1F1F1 !important;">
						<div class="box-line-3-planos-escolha">
							<div class="quadro-line-3-planos-escolha">
								<div class="div-text4-l3-an-a">
									<span class="text4-l3-an-a">6 ANÚNCIOS</span>	
								</div>
							</div>	
							<div class="quadro-line-3-planos-escolha">
								<div class="div-text2-l3-an-a">
									<span class="text2-l3-an-a">Validade do anúncio</span>	
								</div>	
									<div class="div-select-an">								
										<span class="select-form-anunciar">
											<select id="6-anuncios" class="anuncios select-anuncio-pad" data-qntpermitida="6">
												<!-- o value contém os ID's dos planos na tabela planos e a quantidade total de anúncios
												permitidos, separados por | -->
												<option value="">Selecione</option>
												<option value="3" selected="selected">3 meses</option>
												<option value="6">6 meses</option>
												<option value="12">1 ano</option>
											</select>
										</span>	
									</div>
							</div>
							<div class="quadro2-line-3-planos-escolha">
								<div class="div-text3-l3-an-a">
									<span data-qntpermitida="6" class="valor-span text3-l3-an-a">R$ 486,00</span>	
								</div>	

							

								<div class="div-botao-contratar-an">
										<a data-qntpermitida="6" class="href-planos botao-contratar-an" href="<?php echo Yii::app()->createUrl('planoUsuarios/renovarPlano', array('id_plano_usuarios_atual'=>$id_plano_usuarios_atual, 'id_plano_renovado'=>9));?>">CONTRATAR</a>
								</div>	
							</div>	
						</div>	
						<div class="box-line-3-planos-escolha">
							<div class="quadro-line-3-planos-escolha">
								<div class="div-text4-l3-an-a">
									<span class="text4-l3-an-a">15 ANÚNCIOS</span>	
								</div>
							</div>	
							<div class="quadro-line-3-planos-escolha">
								<div class="div-text2-l3-an-a">
									<span class="text2-l3-an-a">Validade do anúncio</span>	
								</div>	
									<div class="div-select-an">								
										<span class="select-form-anunciar">
											<!-- o value contém os ID's dos planos na tabela planos e a quantidade total de anúncios
												permitidos, separados por | -->
											<select id="15-anuncios" class="anuncios select-anuncio-pad" data-qntpermitida="15">
												<option value="">Selecione</option>
												<option value="3" selected="selected">3 meses</option>
												<option value="6">6 meses</option>
												<option value="12">1 ano</option>
											</select>
										</span>	
									</div>
							</div>
							<div class="quadro2-line-3-planos-escolha">
								<div class="div-text3-l3-an-a">
									<span data-qntpermitida="15" id="h1-15-anuncios" class="valor-span text3-l3-an-a">R$ 675,00</span>	
								</div>
								<div class="div-botao-contratar-an">
										<a data-qntpermitida="15" class="href-planos botao-contratar-an" href="<?php echo Yii::app()->createUrl('planoUsuarios/renovarPlano', array('id_plano_usuarios_atual'=>$id_plano_usuarios_atual, 'id_plano_renovado'=>10));?>">CONTRATAR</a>
								</div>		
							</div>	
						</div>
						<div class="box-line-3-planos-escolha">
							<div class="quadro-line-3-planos-escolha">
								<div class="div-text4-l3-an-a">
									<span class="text4-l3-an-a">30 ANÚNCIOS</span>	
								</div>
							</div>	
							<div class="quadro-line-3-planos-escolha">
								<div class="div-text2-l3-an-a">
									<span class="text2-l3-an-a">Validade do anúncio</span>	
								</div>	
									<div class="div-select-an">								
										<span class="select-form-anunciar">
											<!-- o value contém os ID's dos planos na tabela planos e a quantidade total de anúncios
												permitidos, separados por | -->
											<select id="30-anuncios" class="anuncios select-anuncio-pad" data-qntpermitida="30">
												<option value="">Selecione</option>
												<option value="3" selected="selected">3 meses</option>
												<option value="6">6 meses</option>
												<option value="12">1 ano</option>
											</select>
										</span>	
									</div>
							</div>
							<div class="quadro2-line-3-planos-escolha">
								<div class="div-text3-l3-an-a">
									<span data-qntpermitida="30" id="h1-30-anuncios" class="valor-span text3-l3-an-a">R$ 1080,00</span>	
								</div>	
								<div class="div-botao-contratar-an">
										<a data-qntpermitida="30" class="href-planos botao-contratar-an" href="<?php echo Yii::app()->createUrl('planoUsuarios/renovarPlano', array('id_plano_usuarios_atual'=>$id_plano_usuarios_atual, 'id_plano_renovado'=>11));?>">CONTRATAR</a>
								</div>	
							</div>	
						</div>
						<div class="box-line-3-planos-escolha">
							<div class="quadro-line-3-planos-escolha">
								<div class="div-text4-l3-an-a">
									<span class="text4-l3-an-a">60 ANÚNCIOS</span>	
								</div>
							</div>	
							<div class="quadro-line-3-planos-escolha">
								<div class="div-text2-l3-an-a">
									<span class="text2-l3-an-a">Validade do anúncio</span>	
								</div>	
									<div class="div-select-an">								
										<span class="select-form-anunciar">
											<!-- o value contém os ID's dos planos na tabela planos e a quantidade total de anúncios
												permitidos, separados por | -->
											<select id="60-anuncios" class="anuncios select-anuncio-pad" data-qntpermitida="60">
												<option value="">Selecione</option>
												<option value="3" selected="selected">3 meses</option>
												<option value="6">6 meses</option>
												<option value="12">1 ano</option>
											</select>
										</span>	
									</div>
							</div>
							<div class="quadro2-line-3-planos-escolha">
								<div class="div-text3-l3-an-a">
									<span data-qntpermitida="60" id="h1-60-anuncios" class="valor-span text3-l3-an-a">R$ 1.800,00</span>	
								</div>	
								<div class="div-botao-contratar-an">
										<a data-qntpermitida="60" class="href-planos botao-contratar-an" href="<?php echo Yii::app()->createUrl('planoUsuarios/renovarPlano', array('id_plano_usuarios_atual'=>$id_plano_usuarios_atual, 'id_plano_renovado'=>12));?>">CONTRATAR</a>
								</div>	
							</div>	
						</div>



				</div>
				<br class="clr">
			</div>
		</section>
	<?php endif;?>
	

		<!-- hidden -->
		<!-- id do plano atual -->
<input type="hidden" value="<?php echo $id_plano_usuarios_atual;?>" id="id_plano_usuarios_atual"/>

	</div>
</section>

