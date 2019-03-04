

<div class="line-deemb4">
		<div class="container">
			<div class="box-deemb4">
				<div class="box-l2-deemb">
					<div class="div-title-l2-deemb">
						<span class="title-l2-deemb"><b>Embarcações Semelhantes</b></span>
					</div>
					<?php if (count($embarcacoes_semelhantes) > 4) : ?>
						<div class="bx-controls-direction4">
							<span class="bx-prev"></span>
								<i class="icon"></i>
							<span class="bx-next"></span>
								<i class="icon"></i>
						</div>
					<?php endif; ?>

						<div id="div-detemba">
							<div class="box-unit-detemba" style="width:980px">	
								<?php if (count($embarcacoes_semelhantes) > 4): ?>
									<ul class="embarcacoes-semelhantes-slider">
								<?php else: ?>
									<ul class="embarcacoes-semelhantes-slider2">
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
										foreach($embarcacoes_semelhantes as $emb) {

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
											

											if(isset($emb->embarcacaoImagens[0]->imagem)) {
												$imagem = $imagem = Yii::app()->request->baseUrl.'/public/embarcacoes/'.$emb->embarcacaoImagens[0]->imagem;
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
													<h4 class="text-emba-ano"> Ano:';
														if($emb->ano == 0) {
															echo ' Não informado';
														}
														else {
															echo $emb->ano;
														}
													echo '</h4>
													<h4 class="text-emba-estado"> Estado: </h4>';

													if($emb->valor > 0) {
														echo '<h4 class="text-deemb-price"> R$ '.number_format($emb->valor, 2, ",", ".").'</h4>	';
													}

													else {
														echo '<h4 class="text-deemb-price" style="font-size:14px;">Não informado</h4>	';
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
			</div>
		</div>
	</div>
