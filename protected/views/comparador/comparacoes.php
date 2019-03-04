
<section class="content">
	<div class="line-pricad-1">
		<div class="container">
			<div class="box-pricad-1" style="display:inline-block;">
				<span class="title-pricad-2"><a style="color:#fff;" href="<?php echo Yii::app()->homeUrl;?>">Home</a> > Comparar Embarcações</span>
				<span class="title-pricad-1" style="width: 414px !important;">Comparar Embarcações</span>
				<div style="float:right;margin-top:53px;">
					<select id="drop-macros-comparador" class="select-anuncio-pad" style="width:230px;">
						<option value="" selected="selected">Continue Comparando</option>
						<option value="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda');?>">Lanchas</option>
						<option value="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda');?>">Veleiros</option>
						<option value="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda');?>">Jet Skis</option>
						<option value="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda');?>">Pesca</option>
					</select>
				</div>
			</div>	
		</div>	
	</div>
	<div id="comparador">
		<div class="container">

			<ul id="informacoes-comparador">
				<li class="label-comparador">
					<div class="label-cell odd">
							<div class="block-label">
								<span class="text-label">Marca:</span>
								<i class="icon2-deemb "></i>
							</div>

						</div>

						<div class="label-cell">
							<div class="block-label">
								<span class="text-label">Modelo:</span>
								<i class="icon2-deemb "></i>
							</div>

						</div>

						<div class="label-cell odd">
							<div class="block-label">
								<span class="text-label">Valor:</span>
								<i class="icon1-deemb "></i>
							</div>

						</div>

						<div class="label-cell">
							<div class="block-label">
								<span class="text-label">Tipo:</span>
								<i class="icon2-deemb "></i>
							</div>

						</div>

						<div class="label-cell odd">
							<div class="block-label">
								<span class="text-label">Novo ou Usado:</span>
								<i class="icon3-deemb "></i>
							</div>

						</div>

						<div class="label-cell">
							<div class="block-label">
								<span class="text-label">Ano:</span>
								<i class="icon4-deemb "></i>
							</div>

						</div>

						<div class="label-cell odd">
							<div class="block-label">
								<span class="text-label">Tamanho:</span>
								<i class="icon5-deemb "></i>
							</div>

						</div>

						<div class="label-cell">
							<div class="block-label">
								<span class="text-label">Motorização:</span>
								<i class="icon2-deemb "></i>
							</div>

						</div>

						<div class="label-cell odd">
							<div class="block-label">
								<span class="text-label">Passageiros:</span>
								<i class="icon6-deemb "></i>
							</div>

						</div>

						<div class="label-cell">
							<div class="block-label">
								<span class="text-label">Localização:</span>
								<i class="icon7-deemb "></i>
							</div>

						</div>

				</li>
				<?php foreach($barcos_comparados as $barco):?>

					<li class="results-comparador">
						<div class="link-result"><?php echo Embarcacoes::getThumb($barco, array('class'=>'bg-img-listagem-lat'), true); ?></div>
					
						<div class="result-cell">

							<div class="block-result">
								<span class="text-result">
									<?php echo $barco->embarcacaoFabricantes->titulo; ?>
								</span>
							</div>
						</div>

						<div class="result-cell">
		
							<div class="block-result">
								<span class="text-result">
									<?php echo $barco->embarcacaoModelos->titulo; ?>
								</span>
							</div>
						</div>

						<div class="result-cell">
							<div class="block-result">
								<span class="text-result">
									<?php
										if($barco->valor == 0.00 || $barco->valor == "") {
											echo 'Não informado';
										}
										else {
											echo 'R$ '.Utils::formataValorView((float)$barco->valor);
										}
									?>
								</span>
							</div>
						</div>

						<div class="result-cell">
							<div class="block-result">
								<span class="text-result">
									<?php echo $barco->embarcacaoModelos->embarcacaoTipos->titulo; ?>
								</span>
							</div>
						</div>

						<div class="result-cell">
				
							<div class="block-result">
								<span class="text-result">
									<?php 
										// gambiarra para exibir o estado do barco **NÃO TIRE ISSO DAQUI**
										$novoOuUsado = $barco->estado;
										if($novoOuUsado == "U") {
											$novoOuUsado = "Usado";
										}
										else {
											$novoOuUsado = "Novo";
										}
										echo $novoOuUsado; 
									?>
								</span>
							</div>
						</div>

						<div class="result-cell">
				
							<div class="block-result">
								<span class="text-result">
									<?php
										if($barco->ano != null && $barco->ano != 0) {
											echo $barco->ano;
										}
										else {
											echo 'Não informado';
										}
									?>
								</span>
							</div>
						</div>

						<div class="result-cell">
					
							<div class="block-result">
								<span class="text-result">
									<?php 
										if($barco->embarcacaoModelos->tamanho == 0.00) {
											echo 'Não informado';
										}
										else {
											echo number_format($barco->embarcacaoModelos->tamanho, 0, '.', ''). ' pés';
										}
									?>
								</span>
							</div>
						</div>

						<div class="result-cell">
						
							<div class="block-result">
								<span class="text-result">
									<?php 
										// se for jetski o motor é diferente
										if($barco->embarcacao_macros_id == 1) {
											if($barco->embarcacaoModelos->motor_de_fabrica != null) {
												echo $barco->embarcacaoModelos->motor_de_fabrica;
											}
											else {
												echo 'Não informado';
											}
										}


										// lancha ou veleiro
										else {

											if(count($barco->motores) > 0) {
												$motor = $barco->motores[0];
												echo count($barco->motores).'x '.$motor->motorModelos->motorFabricantes->titulo.' '.$motor->motorModelos->titulo.' '.$motor->motorModelos->potencia. ' HP';
											}

											else {
												echo 'Não informado';
											}
										}
								    ?>
								</span>
							</div>
						</div>

						<div class="result-cell">
					
							<div class="block-result">
								<span class="text-result">
									<?php
										echo 'Dia: '.$barco->embarcacaoModelos->passageiros.' / Noite: '.$barco->embarcacaoModelos->acomodacoes;
									?>
								</span>
							</div>
						</div>

						<div class="result-cell">
						
							<div class="block-result">
								<span class="text-result">
									<?php echo $barco->cidades->nome . ' <br/> '.$barco->estados->uf;?>
								</span>
							</div>
						</div>

						<div class="result-controls">
						
							
							<div class="delete">
								<a class="deletar-comparador" data-id="<?php echo $barco->id;?>" alt="excluir" href="#"><i class="excluir cancelar-ordem icone-excluir-pag"></i><span>Excluir</span></a>
							</div>
							<a href="<?php echo Embarcacoes::mountUrl($barco);?>" class="botao-deemb-3 add-favoritos">Mais Detalhes</a>
							<!-- id do dono da embarc -->
							<?php
								$usuarioDonoEmbarc = UsuariosEmbarcacoes::model()
								->find('embarcacoes_id = :embarcacoes_id', 
									array(':embarcacoes_id' => $barco->id));
							?>
							<a data-email-embarc="<?php echo $barco->email;?>" 
								data-id-dono-embarc="<?php echo $usuarioDonoEmbarc->usuarios_id?>" 
								data-id-embarc="<?php echo $barco->id;?>" 
								class="btn-contato botao-deemb-3 add-favoritos"
								 id="btn-contato" 
								 >Contato</a>
							
						</div>
					
					</li>
				<?php endforeach;?>
			</ul>
		</div>
	</div>

	<!-- lightbox -->
	<div class="lbox-msgenviada" id="lbox-msgok">	
			<div class="texts-lbox-ag">	
				<div class="div-title-form-msgok">
					<span class="form-lb-title" id="msg-lgbox">Sua mensagem foi enviada com sucesso!</span>
				</div>
			</div>	
				<input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
		</div>

				<div class="lbox-ag" id="lbox-detemba">	
					<div class="texts-lbox-ag">	
						<input type="button" id="close-form-contato" class="fechar-form close" value="X">
						<span class="ev-titleb">Envie uma mensagem para o vendedor desta embarcação</br></span>
						<span id="erro-contato" style="color:red;"></span>
					</div>

						<div id="erro-contato-anunciante" class="div-sucess-lbox">
				</div>	
			
				<div class="form-nome-ag">
					<?php if(!Yii::app()->user->isGuest):?>
						<input placeholder="Seu nome"id="nome-contato-anunciante" value="<?php echo Usuarios::getUsuarioLogado()->nome;?>" class="terms-ag-1" type="text">
					<?php else:?>
						<input placeholder="Seu nome"id="nome-contato-anunciante" class="terms-ag-1" type="text">
					<?php endif;?>
				</div>
				<div class="form-nome-ag">
					<?php if(!Yii::app()->user->isGuest):?>
						<input placeholder="Seu e-mail" value="<?php echo Usuarios::getUsuarioLogado()->email;?>" id="email-contato-anunciante" class="terms-ag-1" type="text">
					<?php else:?>
						<input placeholder="Seu e-mail" id="email-contato-anunciante" class="terms-ag-1" type="text">
					<?php endif;?>
			
				</div>
				<div class="form-nome-ag">
					<?php if(!Yii::app()->user->isGuest):?>
						<input placeholder="Telefone" value="<?php Usuarios::getUsuarioLogado()->celular;?>" id="telefone-contato-anunciante" class="terms-ag-1" type="text">
					<?php else:?>
						<input placeholder="Telefone" id="telefone-contato-anunciante" class="terms-ag-1" type="text">
					<?php endif;?>
				</div>
				<div class="form-nome-ag">
					<textarea style="height:130px; width:365px;" id="mensagem-contato-anunciante" class="terms-ag-1" placeholder="Mensagem"></textarea>
				</div>
				<input type="button" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-submit-contato" value="ENVIAR MENSAGEM">					 				

				<!-- hiddens, infos da embarcação -->
				<div id="infos-embarc"></div>
		
			</div>

				<?php
					if(count($embarcacoes_semelhantes) > 0) {
						$this->renderPartial('/embarcacoes/_embarcacoes_semelhantes', array('embarcacoes_semelhantes'=>$embarcacoes_semelhantes));
					}
				?>

</section>

<?php
	if(count($barcos_comparados) == 0) {
		echo '<input type="hidden" id="nao-ha-barcos" value="1"/>';
	}
	else {
		echo '<input type="hidden" id="nao-ha-barcos" value="0"/>';
	}
?>