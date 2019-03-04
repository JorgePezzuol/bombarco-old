<?php


		//telefone
		$character1 = '(';
		$character2 = ')';
		$tel_call = $model->telefone;
		$string = str_replace($character1, "", $tel_call);
		$string_final = str_replace($character2, "", $string);
		
		//embarcacoes estaleiros
		$embarcacoes = Embarcacoes::estaleiro($model->id);
?>
<?php if ($model->destaque == '1'): ?>
<div class="header-estaleiros full-width">
	<div class="container">
		<a href="javascript:history.back();" class="btn-back inline-block sprite flt-left"></a>
		<?php if (!empty($model->logo)): ?>
			<div class="box-logo inline-block">
				<img class="" src="<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $model->logo; ?>">
			</div>
		<?php endif; ?>	
	</div>
</div>
<?php endif; ?>
<div class="box-title full-width">
	<div class="container">
		<article class="title"><?php echo $model->razao; ?></article>
	</div>
</div>

<div class="box-actions">
	<div class="container">
		<a href="#" class="item-action action-email inline-block"></a>
		<?php if ($model->destaque == '1'): ?>
			<a href="tel:<?php echo $string_final; ?>" class="item-action action-tel inline-block"></a>
			<a href="<?php echo 'http://maps.google.com.br/?q='.$model->endereco. ' '.$model->bairro.', '.$model->numero.', '.$model->cidades->nome.', '.$model->cep;?>" class="item-action action-place inline-block last"></a>
		<?php endif; ?>
	</div>
</div>
<?php if ($model->destaque == '1'): ?>
	<div class="tabs-estaleiro full-width">
		<div class="pure-g">

			<?php if ( count($embarcacoes) > 0 ) {  ?>
				<div class="pure-u-1-2 tab text-center"><a href="#" class="link-tab active" data-tab="1">Embarcações</a></div>
				<div class="pure-u-1-2 tab text-center"><a href="#" class="link-tab" data-tab="2">Informações</a></div>
			<?php } else { ?>
				<div class="pure-u-1-2 tab text-center"><a href="#" class="link-tab active" data-tab="2">Informações</a></div>
			<?php } ?>

		</div>
	</div>

	<div class="more-infos results-search full-width results-tabs-estaleiro">
		<div class="container">
			<?php if(count($embarcacoes) > 0): ?>
				<div class="list-results tab-slide" data-tab="1">	
					<?php foreach ($embarcacoes as $key => $value): ?>
						

						<div class="result-content pure-g">
							<a href="<?php echo Embarcacoes::mountUrl($value); ?>" class="link-result">
								<div class="result-image pure-u-1-4">
									<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
								</div>
								<div class="result-infos pure-u-3-4">
									<?php  
										$result_title = $value->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo;
										$result_pes = substr($value->embarcacaoModelos->tamanho, 0, strpos($value->embarcacaoModelos->tamanho, '.'));
										$result_price = $value->valor != '0.00' ? Utils::formataValorView($value->valor) : "N/Info.";
									?>
									<div class="infos-content">
										<article class="result-title"><?php echo $result_title; ?></article>
										<?php if($value->embarcacao_macros_id == 1):?>
											<i class="ico-dianoite sprite inline-block"></i>
											<article class="info-content inline-block">
												<span class="info-text">Dia: <span class="bold"><?php echo $value->embarcacaoModelos->passageiros; ?></span></span> <br />
												<span class="info-text">Noite: <span class="bold"><?php echo $value->embarcacaoModelos->acomodacoes; ?></span></span>
											</article>
										<?php else:?>
											<i class="ico-pes inline-block sprite"></i>
											<span class="result-pes inline-block"><?php echo $result_pes; ?> PÉS</span>
										<?php endif;?>
										<span class="result-price inline-block">R$ <?php echo $result_price; ?> </span>
									</div>
								</div>
							</a>
						</div>


					<?php endforeach; ?>

					<?php if (count($embarcacoes) == Embarcacoes::LIMIT_SEARCH): ?>
						<a class="btn-seemore" id="carregar-deest" data-id="<?php echo $model->id; ?>" data-limit="<?php echo Embarcacoes::LIMIT_SEARCH; ?>">Carregar mais</a>
					<?php endif; ?>
				</div>
			<?php endif;?>
			<?php if(count($embarcacoes) > 0) { ?>
				<div class="box-infos tab-slide display-none" data-tab="2">
			<?php } else { ?>
				<div class="box-infos tab-slide" data-tab="2">
			<?php } ?>
				<?php if ($model->descricao): ?>
					<div class="single-box" data-tabdescription="1">
						<div class="content-box">
							<p class="title">Descrição</p>
							<p class="mini-description">
								<?php  
									$string = $model->descricao;
									$resume = substr($string, 0, 35);
									echo ''. $resume .'...';
								?>
							</p>
							<i class="ico-arrow inline-block sprite"></i>
							<article class="box-description" data-description="1">
								<?php echo $model->descricao; ?>
							</article>
						</div>
					</div>
				<?php endif ?>
				<?php if ($model->telefone): ?>
					<div class="single-box" data-tabdescription="2">
						<div class="content-box">
							<p class="title">Telefone</p>
							<p class="mini-description">
								<?php  
									$string = $model->telefone;
									$resume = substr($string, 0, 10);
									echo ''. $resume .'...';
								?>
							</p>
							<i class="ico-arrow inline-block sprite"></i>
							<article class="box-description" data-description="2">
								<?php echo $model->telefone; ?>
							</article>
						</div>
					</div>
				<?php endif ?>
				<?php if ($model->endereco): ?>
					<div class="single-box" data-tabdescription="3">
						<div class="content-box">
							<p class="title">Endereço</p>
							<p class="mini-description">
								<?php  
									$string = $model->endereco;
									$resume = substr($string, 0, 35);
									echo ''. $resume .'...';
								?>
							</p>
							<i class="ico-arrow inline-block sprite"></i>
							<article class="box-description" data-description="3">
								<?php echo $model->endereco .' '.$model->bairro .', '. $model->numero .'<br>'.$model->cidades->nome.' - CEP:'.$model->cep; ?>
							</article>
						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="box-contato box-contato-estaleiro box-contato-empresa">
	
	<div class="header-contato full-width">
		<div class="container">
			<i class="btn-close-boxcontato inline-block sprite"></i>
			<article class="header-text">Envie uma mensagem para esse estaleiro</article>
			<div id="erro-contato-empresa"></div>
		</div>
	</div>

	<div class="content-contato full-width">
		<div class="container container-form">
			<label class="label-contato">Nome</label>
			<?php if (!Yii::app()->user->isGuest): ?>
                <?php
                $nome = "Nome";

                if (Usuarios::getUsuarioLogado()->nome != "") {
                    $nome = Usuarios::getUsuarioLogado()->nome;
                }
                ?>
                <input id="nome-contato-empresa" value="<?php echo $nome; ?>" class="input-text" type="text">
            <?php else: ?>
                <input id="nome-contato-empresa" class="input-text" value="" type="text" />
            <?php endif; ?>


			<label class="label-contato">Email</label>
			<?php if (!Yii::app()->user->isGuest): ?>
                <input value="<?php echo Usuarios::getUsuarioLogado()->email; ?>" id="email-contato-empresa" class="input-text" type="email">
            <?php else: ?>
                <input value="" id="email-contato-empresa" class="input-text" type="email">
            <?php endif; ?>

			<label class="label-contato">Telefone</label>
			<input id="telefone-contato-empresa" class="input-text input-tel" type="tel" />

			<label class="label-contato">Mensagem</label>
			<textarea id="mensagem-contato-empresa" class="input-textarea"></textarea>

  			<input type="hidden" id="email_empresa" value="<?php echo $model->email; ?>"/>
            <input type="hidden" id="razao" value="<?php echo $model->razao; ?>"/>
            <input type="hidden" id="usuarios_id" value="<?php echo $model->usuarios_id; ?>"/>
			
			<?php
				echo CHtml::hiddenField('flgEstaleiro' , 1, array('id' => 'flgEstaleiro'));
                    
        echo CHtml::hiddenField('usuarios_id_empresa', $model->usuarios_id, array('id' => 'usuarios_id_empresa'));
  
			?>

			<input type="button" name="botao-cadastrar-form" class="input-submit" id="btn-contato-empresa" value="Enviar Mensagem" />
			<i class="ico-submit sprite inline-block"></i>
		</div>
	</div>

</div>
    
    
    
    