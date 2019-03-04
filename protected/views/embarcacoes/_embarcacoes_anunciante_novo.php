<div class="anuncios">
	<?php if (count($embarcacoes) > 2) : ?>
		<div class="bx-controls-direction3">
			<span class="bx-prev"></span>
				<i class="icon"></i>
			<span class="bx-next"></span>
				<i class="icon"></i>
		</div>
	<?php endif; ?>

	<div id="div-detemba">
		<div class="box-unit-detemba" style="width:350px;margin-top:30px">	
			<span class="veja-mais"><i class="fa fa-plus"></i> Veja mais anúncios do anunciante</span>
			<?php if (count($embarcacoes) > 2): ?>
				<ul class="categories-detemba">
			<?php else: ?>
				<ul class="categories-detemba2">
			<?php endif; ?>

				<!--<li class="category-detemba">
					<a href="#">
						<img class="bg-img-detemba" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/lancha-pesca.jpg">
					</a>
					<div class="textos-detemba">
						<span class="text-emba-title"> Lorem ipsum dolor sit consectetur adipiscing. </span>
						<span class="text-emba-ano"> Ano: </span>
						<span class="text-emba-estado"> Estado: </span>
						<span class="text-deemb-price"> R$ 500.000,00 </span>
						<span class="text-emba-ano-rnd"> 2014 </span>
						<span class="text-emba-estado-rnd"> SP </span>
					</div>
				</li>-->

				<?php
					foreach($embarcacoes as $emb) {

						$imagem = Yii::app()->request->baseUrl.'/img/sem_foto_bb.jpg';

																	// se for embarc de estaleiro gera outro link
						if($emb->macros_id == 3) {
							//$link = Embarcacoes::mountUrl($emb);

							$empresa = Empresas::model()->findByPk($emb->usuariosEmbarcacoes[0]->empresas->id);
							//$link = Embarcacoes::getThumb($emb, array('class' => 'bg-img-emba'), true, array(), $empresa->slug);
							$link = Embarcacoes::mountUrl($emb, $empresa->slug);	
						}
						else {
							$link = Embarcacoes::mountUrl($emb);	
						}

						if(EmbarcacaoImagens::obterImgPrincipal($emb->id)) {
							$imagem = $imagem = Yii::app()->request->baseUrl.'/public/embarcacoes/'.EmbarcacaoImagens::obterImgPrincipal($emb->id);
						}

						if(Estados::model()->findByPk($emb->estados_id) != null) {
							$uf = Estados::model()->findByPk($emb->estados_id)->nome;
						}
						else {
							$uf = 'Não informado';
						}

						echo '<li class="category-detemba">
							<a href="'.$link.'">
								<img class="bg-img-detemba" alt="'.Embarcacoes::getAlt($emb).'" title="'.Embarcacoes::getAlt($emb).'" src="'.$imagem.'">
							</a>
							<div class="textos-detemba">
								<h4 class="text-emba-title">'.$emb->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' .$emb->embarcacaoModelos->titulo.'</h4>
								<h4 class="text-emba-ano"> Ano: ';
									if($emb->ano == 0) {
										echo ' Não informado';
									}
									else {
										echo $emb->ano;
									}
								echo '</h4>
								<h4 class="text-emba-estado"> Estado: </h4>';

								if($emb->valor != '' && $emb->valor != '0.00') {
									echo '<h4 class="text-deemb-price"> R$ '.Utils::formataValorView((float)$emb->valor).'</h4>	';
								}

								else {
									echo '<h4 class="text-deemb-price" style="font-size:14px;">R$ Não informado</h4>	';
								}


								echo '<h4 class="text-emba-estado-rnd">'.$uf.'</h4>
							</div>
						</li>';
					}
				?>



			</ul>
		</div>
	</div>
</div>