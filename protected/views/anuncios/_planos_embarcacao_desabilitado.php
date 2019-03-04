<?php
	// dados do plano para informar ao usuario
	$qntpermitida = $plano->qntpermitida;
	$data_fim = date('d/m/Y', strtotime($plano->fim));
	$qtdeAnunciosCadastrados = $qtdeAnunciosCadastrados;

	// se estiver pago, informar a data do vencimento, caso nao informar que não esta pago ainda
	if($plano->status == Anuncio::$_status_plano['PAGO']) {

		// verificar se há slots sobrando
		if($qntpermitida == $qtdeAnunciosCadastrados) {
			$msg = 'Usuário: '.Usuarios::model()->findByPk(Yii::app()->user->id)->nome . ' - Pacote para empresas '.$qntpermitida.' anúncios ('.$qtdeAnunciosCadastrados.'/'.$qntpermitida.')';
			$msg .= ' / Vecimento: ' . $plano->fim;
			$msg .= '<br/>';
			$msg .= 'Anúncios disponíveis: 0';
		}

		else {
			$msg = 'Pacote para empresas de '.$qntpermitida.' anúncios ('.$qtdeAnunciosCadastrados.'/'.$qntpermitida.') / Vecimento: ' . $plano->fim;
			$msg .= '<br/>';
			$disponivel = ($qntpermitida - $qtdeAnunciosCadastrados);
			$msg .= 'Anúncios disponíveis: '.$disponivel;
		}
	}

	// nao esta pago
	else {
		$msg = 'Pacote para empresas de '.$qntpermitida.' anúncios ('.$qtdeAnunciosCadastrados.'/'.$qntpermitida.') / Não está pago';
	}
?>

<div class="box-line-3-planos-a">
		<div id="nao-ha-slots" style="text-align:center; margin-top:110px;">
			<span class="text1-l3-an-a" 
			style="color: #0F2E44 !important;
					font-size: 25px !important;
					position: relative !important;
					top: 20px !important;">
				Você já escolheu um plano! 
				<br/><br/>
				<b style="font-size:16px;"><?php echo $msg;?></b>
			</span>	
			<br/><br/><br/>

			<?php if($qtdeAnunciosCadastrados == $qntpermitida):?>
			<div id="links-plano">
				<a class="botao-contratar-an" style="width: 235px !important; margin-left:30px;" href="<?php echo Yii::app()->createUrl("embarcacoes/admin")?>">MEUS ANÚNCIOS</a>
			</div>
			<?php else:?>
			<div id="links-plano">
				<a class="botao-contratar-an" style="width: 235px !important; margin-left:30px;" href="<?php echo Yii::app()->createUrl("anuncios/anunciarEmbarcacao?tipo_anuncio=plano")?>">ADICIONAR ANÚNCIO</a>
			</div>
			<?php endif;?>
			

			

			<!--<div id="links-plano" style="margin-left:212px;">
				<a class="botao-contratar-an" style="float:left; width: 235px !important;" href="<?php echo Yii::app()->createUrl("anuncios/anunciarEmbarcacao?tipo_anuncio=plano")?>">CONTINUAR ANUNCIANDO</a>
				<a class="botao-contratar-an" style="float:left; margin-left:10px; background-color:#0F2E44!important;border:1px solid #0F2E44 !important;" href="<?php echo Yii::app()->createUrl("anuncios/anunciarEmbarcacao?tipo_anuncio=plano")?>">ALTERAR PLANO</a>
			</div>-->
	

		</div>

	

</div>	