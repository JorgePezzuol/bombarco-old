<?php
/* scripts */
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/anunciar_pagamento.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
?>

<?php
	$flgOrdensApagar = false;
	if($ordens != null) {
		$flgOrdensApagar = false;	// variavel que indica se há ordens de pedido pendentes ou nao
		foreach($ordens as $index => $ordem) {
			if($ordem->status != Anuncio::$_status_ordem['PAGA']) {
				$flgOrdensApagar = true;
			}
		}
	}
?>



<section class="content">
	<?php

	echo '<div class="line-header-cad">
				<div class="container">
					<div class="box-cadastro-line-header">
						<div class="quadro-box-cadastro-lh-a">';
							echo '<a href="'.Yii::app()->homeUrl.'" class="icone-foto-cadastro-lh1"></a>
						</div>	
						<div class="quadro-box-cadastro-lh-b">
							<div class="div-text-cadastro-lh1">
								<span class="text-cadastro-lh1">';
									
									echo Yii::app()->request->getParam('qnt').' ANÚNCIOS POR '.Yii::app()->request->getParam('meses').' MESES';
								echo '</span>
							</div>	
							<icon class="icone-foto-cadastro-lh4"></i>
						</div>
						<div class="quadro-box-cadastro-lh-c">
							
							<div class="div-text-cadastro-lh1">
								<span class="text-cadastro-lh1">CADASTRO DO ANÚNCIO</span>
							</div>	
							<icon class="icone-foto-cadastro-lh4"></i>
						</div>
						<div class="quadro-box-cadastro-lh-d">
							<div class="div-text-cadastro-lh1">
								<span class="text-cadastro-lh1">EFETUE O PAGAMENTO</span>
							</div>
							<div class="div-text-cadastro-lh2">
								<span class="text-cadastro-lh2">3.</span>
							</div>	

						</div>
						<div class="quadro-box-cadastro-lh-e">
							<div class="div6-cadastro-green">
										<span class="text-cadastro-green6">TOTAL:</span>
									</div>
									<div class="div-text-cadastro-lh3">
										<span class="text-cadastro-lh3">R$</span>
									</div>
									<div class="div-text-cadastro-lh4">';
										echo '<span class="text-cadastro-lh4">'.Utils::formataValorView(Yii::app()->request->getParam('valor')).'</span>';
									echo '</div>
									<icon class="icone-foto-cadastro-lh3"></i>
						</div>
					</div>	
				</div>	
			</div>';

	?>
	<?php
	//echo '<br><br><br><br/>';
	echo '<div class="linha-pagamento-1">
		<div class="container">
			<div class="box-cadastro-1">
				<span class="title-pag-2"> Home > Anunciar > Cadastro > Pagamento </span>
				<span class="title-pag-1"> Pagamentos </span>
				<span class="title-pag-3">	VALOR TOTAL :</span>';
				if(Usuarios::hasPlanoAnuncio()) {
					echo "<a class='botao-pag-1' href='anunciarEmbarcacao?tipo_anuncio=plano' id='btn-pagamento'>ADICIONAR ANUNCIO</a>";
				}
				else {
					echo "<a class='botao-pag-1' href='index' id='btn-pagamento'>ADICIONAR ANUNCIO</a>";
				}
				
				if($flgOrdensApagar && $somaOrdens != null) {

					echo '<a class="link-pagamento botao-pag-2" id="btn-pagamento">EFETUAR PAGAMENTOS</a>';
				}
				echo '<div class="div-title-pag-4">';
					echo '<span class="title-pag-4">';
							if($somaOrdens == null) {
								echo 'R$ 0,00';
							}
							else {
								echo 'R$ '. Utils::formataValorView($somaOrdens);
							}
					echo '</span>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	?>
	


	<?php echo CHtml::beginForm('', 'post', array("id"=>"form-pay-card"));?>
	<div class="linha-pagamento-2">
		<div class="container">
			<div class="quadro-pag-l2-a">
			</div>	
			<div class="quadro-pag-l2-b">
				<span class="text-pag-1">#ORDEM<span>
			</div>
			<div class="quadro-pag-l2-c">
				<span class="text-pag-1">DESCRIÇÃO<span>
			</div>
			<div class="quadro-pag-l2-d">
				<span class="text-pag-1">VALOR<span>
			</div>
			<div class="quadro-pag-l2-e">
				<span class="text-pag-1">STATUS<span>
			</div>
			<div class="quadro-pag-l2-f">
				<span class="text-pag-1">CANCELAR<span>
			</div>
		</div>	
	</div>


	<?php
		if($ordens != null) {
			$flgOrdensApagar = false;	// variavel que indica se há ordens de pedido pendentes ou nao
			foreach($ordens as $index => $ordem) {

				echo '<div class="linha-pagamento-3">
					<div class="linha-pagamento-lista1">
						<div class="container">
							<div class="quadro-pag-l-l2-a">	
							</div>
							<div class="quadro-pag-l-l2-b">
								<span class="text-pag-2">'.$ordem->id.'<span>
							</div>
							<div class="quadro-pag-l-l2-c">
								<span class="text-pag-2">'.$ordem->descricao.'<span>
							</div>
							<div class="quadro-pag-l-l2-d">
								<span class="text-pag-2">R$ '.Utils::formataValorView($ordem->valor).'<span>
							</div>
							<div class="quadro-pag-l-l2-e">
								<span class="text-pag-2"><b>'.Ordens::getTextoStatus($ordem->status).'</b><span>
							</div>
							<div class="quadro-pag-l-l2-f">';
							if($ordem->status != Anuncio::$_status_ordem['PAGA']) {
								echo '<a class="cancelar-ordem icone-excluir-pag" id="'.$ordem->id.'" alt="excluir" a href="#"></a>';
							}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
					
			}
		}
	?>	

		
	<div class="form-card linha-pagamento-4">
		<div class="container">
			<div class="box-pag-cartao">
				<div class="quad-box-pag-cartao">
					<span class="title-pag-5"> Insira os dados do seu cartão </span>
					<span class="text-pag-3">Você está em um ambiente seguro.<span>
				</div>	
				<!--<div class="quad-box-pag-cartao2">	
					<div class="quad-box-pag-cartao2b">	
					</div>	
					<div class="quad-box-pag-cartao2b">	
					</div>
					<div class="quad-box-pag-cartao2b">	
					</div>
					<div class="quad-box-pag-cartao2b">	
					</div>
					<div class="quad-box-pag-cartao2b">	
					</div>
				</div>-->


				<div class="row-fluid">
					<label class="radio span2">
						<input type="radio" name="card_flag" id="cardAmerican" value="american" checked>
						<?php echo CHtml::image(Yii::app()->baseUrl.'/img/american-express.png'); ?>
					</label>

					<label class="radio span2">
						<input type="radio" name="card_flag" id="cardVisa" value="visa">
						<?php echo CHtml::image(Yii::app()->baseUrl.'/img/visa.png'); ?>
					</label>

					<!--<label class="radio span2">
						<input type="radio" name="card_flag" id="cardDiners" value="diners">
						<?php echo CHtml::image(Yii::app()->baseUrl.'/img/american-express.png'); ?>
					</label>-->

					<label class="radio span2">
						<input type="radio" name="card_flag" id="cardMaster" value="mastercard">
						<?php echo CHtml::image(Yii::app()->baseUrl.'/img/mastercard.png'); ?>
					</label>

					<!--<label class="radio span2">
						<input type="radio" name="card_flag" id="cardDiscover" value="discover">
						<?php echo CHtml::image(Yii::app()->baseUrl.'/img/discover.png'); ?>
					</label>-->

					<!--<label class="radio span2">
						<input type="radio" name="card_flag" id="cardElo" value="elo">
						<?php echo CHtml::image(Yii::app()->baseUrl.'/img/american-express.png'); ?>
					</label>-->
				</div>

				<div class="quad-box-pag-cartao2">
					<span class="text-sup-form-pagamento">*Número do cartão</span>
							<div class="campo-form-pagamento">
								<input name="card_number" id="card_number" class="font-form" type="text">
							</div>
							<div class="errorMessage" id="error-numero-cartao"></div>
					<div class="quad-box-pag-cartao2c">	
					</div>	

				</div>		
				<div class="quad-box-pag-cartao2">
					<div class="div-text-sup-form-pagamento2">
						<span class="text-sup-form-pagamento2">Validade (Mês):</span>
					</div>	
					<div class="select-form-pagamento">
						<select name="card_validate_month" id="card_validate_month" class="select-anuncio-pad">
							    	<option value="01">Janeiro</option>
							    	<option value="02">Fevereiro</option>
							    	<option value="03">Marco</option>
							    	<option value="04">Abril</option>
							    	<option value="05">Maio</option>
							    	<option value="06">Junho</option>
							    	<option value="07">Julho</option>
							    	<option value="08">Agosto</option>
							    	<option value="09">Setembro</option>
							    	<option value="10">Outubro</option>
							    	<option value="11">Novembro</option>
							    	<option value="12">Dezembro</option>
						</select>
						<div class="errorMessage" id="error-mes"></div>
					</div>	
					
					<div class="select-form-pagamento">
						<div class="div-text-sup-form-pagamento2">
							<span class="text-sup-form-pagamento2">Validade (Ano):</span>
						</div>	
						<select name="card_validate_year" id="card_validate_year" class="select-anuncio-pad">
							  	<option value="2014">2014</option>

						    	<option value="2015">2015</option>
						    	<option value="2016">2016</option>
						    	<option value="2017">2017</option>
						    	<option value="2018">2018</option>
						    	<option value="2019">2019</option>
						    	<option value="2020">2020</option>
						    	<option value="2021">2021</option>
						    	<option value="2022">2022</option>
						    	<option value="2023">2023</option>
						    	<option value="2024">2024</option>
						    	<option value="2025">2025</option>
						</select>
						<div class="errorMessage" id="error-ano"></div>
					</div>			
				</div>	
				<div class="quad-box-pag-cartao2">
						<span class="text-sup-form-pagamento">*Nome impresso no cartão</span>
							<div class="campo-form-pagamento">
								<input name="card_name" id="card_name" class="font-form" type="text">
							</div>
							<div class="errorMessage" id="error-nome-cartao"></div>
						<span class="text-sup-form-pagamento3">*Codigo de segurança</span>
							<div class="campo-form-pagamento2">
								<input name="card_cvv" class="font-form" id="card_cvv" type="text">
							</div>	
							<div class="errorMessage" id="error-card-cvv"></div>


							<input type="checkbox" style="margin-top:4px; margin-right:5px;" id="termos-condicao"/>Li e aceito os termos de condição.
							<div class="errorMessage" id="error-termos" style="top:1px !IMPORTANT;"></div>

				</div>	
				<div class="quad-box-pag-cartao2" style="display:none;">
					<div class="div-text-sup-form-pagamento2">
						<span class="text-sup-form-pagamento2">*Número de parcelas</span>
					</div>	
					<div class="select-form-pagamento2">
						<select name="card_number_payments" id="card_number_payments" class="select-anuncio-pad">
					    	<option value="1">1x</option>
					    	<option value="2">2x</option>
					    	<option value="3">3x</option>
					    	<option value="4">4x</option>
					    	<option value="5">5x</option>
					    	<option value="6">6x</option>
					    	<option value="7">7x</option>
					    	<option value="8">8x</option>
					    	<option value="9">9x</option>
					    	<option value="10">10x</option>
					    	<option value="11">11x</option>
					    	<option value="12">12x</option>
						</select>
					</div>	
				</div>	
			</div>	
			
			</div>
		</div>	
	</div>

	<!-- lightbox termos de condição -->
	<div class="lbox-ag" id="lbox-detemba">	

			<div class="texts-lbox-ag">	
				<div class="title-lbox-menor-div">
					<span class="ev-titleb">Termos de Condição</br></span>
				</div>
			</div>

			<div id="texto" style="margin: 30px;
font-size: 12px;
overflow-y: auto;
height: 330px;">
A empresa Bombarco Serviços de Informação na Internet Ltda ME, inscrita no CNPJ/MF sob o nº 10.352.973/0001-43, estabelecida em Mogi das Cruzes, na Rua Cruzeiro do Sul, 323, Vila Oliveira, Mogi das Cruzes, SP, doravante denominada Bombarco e seus domínios, a partir do presente Termo e Condições de Uso estabelece como deverá ser utilizado o conteúdo e a publicidade contida no website www.bombarco.com.br.

Este documento integra um conjunto de ações que o Bombarco estabelecejuntamente com o Política de Privacidade e Segurança de Dados e Informações, visando informar e assegurar as responsabilidades, deveres e obrigações que todo internauta, usuário e anunciante assumem ao acessar o Portal Bombarco.

Osusuários, internautas e anunciantesdeverão ler, certificar-se de haver entendido e aceitar todas as condições estabelecidas no Termo e Condições Gerais de Uso e Política de Privacidade e Segurança de Dados e Informações, antes de utilizar como internauta e/ou se cadastrar como usuário e/ouanunciante do website www.bombarco.com.br.

Ao utilizar oBombarco, o usuário, internauta e anuncianteaceitam e concordam de forma tácita as regras aqui descritas. 

Definições:

Classificam-se como "internauta" todas as pessoas que de alguma forma acessam o Portal Bombarco.

Classificam-se como "usuários" todas as pessoas que se cadastram neste site e recebem uma identificação individual, intransferível e exclusiva. 

Classificam-se como “anunciantes” todas as pessoas físicas e pessoas jurídicas que se cadastram neste site e recebem uma identificação individual, intransferível e exclusiva e veiculam anúncios ou publicidade no Portal do Bombarco.

1.	Capacidade para cadastrar-se: 

1.1.	Oconteúdo e a publicidade contidos no Bombarco estão disponíveis e são direcionadas apenas para pessoas físicas de boa-fée que gozem de capacidade civil e pessoas jurídicas também de boa-fée idôneas, pessoas físicas incapazes como rege o Código Civil Brasileiro, ou que tenham sido inabilitadas do Bombarco (temporária ou definitivamente) e pessoas jurídicas que não tenham interesse legítimo não podem utilizar os recursos ou contratar. Qualquer pessoa, nominada usuário, internauta e anunciante, que pretenda utilizar os recursos do website Bombarco, deverá aceitar o presente Termo e Condições Gerais de Uso, bem como, as demais Políticas e Princípios que o regem.

1.2.	Também não é permitido que uma mesma pessoa física e/ou jurídica tenha mais de um cadastro. Se o Bombarco detectar, através do sistema de verificação de dados, cadastros duplicados serão inabilitados definitivamente.

1.3.	Pessoas Jurídicas somente poderão cadastrar-se através de seu representante legal. 

2.	Cadastro: 

2.1.	O cadastro é necessário para o uso dos recursos disponíveis nas seções descritas no item 4 deste Termo. O cadastro é pessoal e intransferível, deve ser preenchido corretamente todas informações solicitadas no formulário, tem duração por tempo indeterminado e pode ser solicitado o cancelamento pelo e-mail atendimento@bombarco.com.br a qualquer momento pelo usuário e/ou anunciante, sem qualquer ônus para quaisquer das partes. Os dados pessoais informados pelo usuário e/ou anunciante no ato do registro não são divulgados para terceiros, conforme exposto na Política de Privacidade. 

2.2.	A identificação do anunciante (login) é necessária para o acesso as seções descritas no item 4deste Termo. Para a identificação, é necessário que o anunciante utilize seu e-mail e sua senha do Bombarco informados no momento do cadastro. 

2.3.	O anunciante ou usuário está ciente que deverá preencher seus dados e/ou dados da empresa que representa, e apenas será confirmado o cadastro que preencher todos os campos obrigatórios. Os futurosusuários ou anunciantes deverão completá-lo com informações exatas, precisas e verdadeiras, e assumem o compromisso de atualizar os dados pessoais sempre que neles ocorrer alguma alteração, sob pena de exclusão do contato sem qualquer ônus à Bombarco. 

2.4.	O Bombarco não se responsabiliza pela correção dos dados pessoais inseridos por seus usuários e/ou anunciantes. Estes os quais garantem e respondem, em qualquer caso, pela atualização, veracidade, exatidão e autenticidade dos dados cadastrados.

2.5.	O Bombarco se reserva o direito de utilizar todos os meios válidos e possíveis para identificar seus usuários e/ou anunciantes, bem como, solicitar dados adicionais e documentos que estime serem pertinentes a fim de conferir os dados pessoais informados. 

2.6.	Caso o Bombarco decida checar a veracidade dos dados cadastrais de um usuário e/ou anunciante e se constate haver entre eles dados incorretos ou inverídicos, ou ainda, caso o usuário e/ou anunciante se furte ou negue o envio de documentos requeridos, o Bombarco poderá bloquear, suspender temporariamente ou cancelar definitivamente o cadastro, sem prejuízo de outras medidas que entender necessárias e oportunas. 

2.7.	Havendo a aplicação de qualquer das sanções acima referidas, automaticamente serão cancelados todos os atos do usuário e/ou anunciante, não assistindo aos mesmos, por essa razão, qualquer sorte de indenização ou ressarcimento. 

2.8.	O anunciante está ciente e autoriza a divulgação das fotos e vídeosenviados das embarcações, dos dados fornecidos das embarcações e dos telefones para contato que deverão ser informados no momento do cadastro da embarcação na Seção “Anunciar”.

3.	Aos internautas, usuários e anunciantes que acessam o site do Bombarco é terminantemente proibido:

3.1.	Utilizar o site do Bombarco com qualquer propósito criminoso;

3.2.	Utilizar os recursosdisponíveis neste site para fins diversos daqueles a que se destinam; 

3.3.	Enviar ou transmitir quaisquer tipos de informações que induzam, incitem ou resultem em atitudes discriminatórias, ofensivas a qualquer pessoa ou produto, mensagens violentas ou delituosas que atentem contra a moral e bons costumes e que contrariam a ordem pública; 

3.4.	Utilizar os dados para contato de anunciantes com outro propósito que não seja o de encaminhar proposta comercial pertinente ao anunciado; 

3.5.	Enviar, transmitir ou usar qualquer tipo de informação que seja de propriedade de terceiros; 

3.6.Alterar, apagar ou corromper dados e informações do website ou de terceiros; 

3.7.Violar a privacidade de outros usuários e/ou anunciantes; 

3.8.	Enviar ou transmitir arquivos com vírus de computador, com conteúdo destrutivo, invasivo ou que causem dano temporário ou permanente nos equipamentos do destinatário ou do Bombarco; 

3.9.Utilizar endereços de computadores, de rede ou de correio eletrônico falsos; 

3.10.	Violar o direito autoral de terceiros, por meio de qualquer tipo de reprodução de material, sem a prévia autorização por escrito e com reconhecimento de firmado proprietário.

3.11	Anunciar empresa ou embarcação que não seja da sua propriedade ou que não esteja autorizado a anunciar 

3.12	Cada anúncio tem sua característica, podendo ser contratado diferentes tipos de turbinadas que aumentam o nível de exposição do anúncio, portanto, é proibido aproveitar o mesmo anúncio contratado para anunciar outraEmbarcação e ou Guia de Empresa em qualquer hipótese, ou inserir informações e/ ou fotos e vídeos, ou, de qualquer modo, fazer referência a outra embarcação.  

3.13	Anunciar embarcação com valor irrisório


4.	Recursos oferecidos:

4.1.	O Bombarco oferece, ao usuário, internauta e anunciante, acesso ao conteúdo disponível nas seções: comprar embarcações, estaleiros, guia de empresas, comunidades, anunciar e tabela de preços.

4.2.	O Bombarco, portanto, possibilita aos usuários, anunciantes e aos internautas travarem conhecimento uns dos outros e permite que negociem entre si, sempre diretamente, sem qualquer intermediação ou intervenção na finalização dos negócios, não sendo, nesta qualidade, vendedor, fornecedor de quaisquer produtos e/ou serviços, bem como, não prestando serviços de consultoria, garantia, avaliação, guarda, entrega,transporte e devoluçãoou ainda participante em nenhum negócio entre o internauta e/ou usuário e/ou anunciante(s).
4.3.	Dessa forma, o Bombarco não assume responsabilidade por nenhuma consequência que possa advir de qualquer relação entre o internauta e/ou usuário com o (s) anunciante (s), seja ela direta ou indireta. 
4.4.	Assim, o Bombarco não é responsável por qualquer expectativa de negócio, ação ou omissão do usuário, e/ou internauta e/ou anunciante baseada nas informações, anúncios, fotos, vídeos ou outros materiais veiculados no Portal Bombarco. 
4.5.	A Tabela de preço é uma tabela não oficial, somente mostraa média de preços deembarcações que já foram anunciadas no Bombarco ou não, servindo apenas para consulta. Os preços efetivamente praticados variam em função da região, conservação, cor, acessórios, motor, ano ou qualquer outro fator que possa influenciar as condições de oferta e procura por umaembarcação específica. 

5.	Acesso ao conteúdo:

5.1.	O cadastro no site BOMBARCO é gratuito;
5.2.	O anunciante precisará de cadastro, no momento em que tiver interesse em: Anunciar (embarcações, empresas ou serviços, estaleiros e banners), deverá escolher o plano que melhor lhe atender, onde valores diferem, dependendo do nível de exposição do anúncio no site. 


6.	Uso do conteúdo disponível no BOMBARCO

6.1.	É expressamente proibida a comercialização do conteúdo oferecido pelo Bombarco de forma integral ou parcial, bem como é expressamente proibida a reprodução ou retransmissão do conteúdo por qualquer pessoa física ou jurídica, através de qualquer meio. 

6.2.	 O usuário, internauta e anunciante entendem que o conteúdo disponível no aludido website, dentro dos padrões de ética e bom senso, enriquece e facilita o desenvolvimento de pesquisas na área náutica, porém não substitui a orientação de profissionais. Dessa forma, o Bombarco não se responsabiliza em possível ocorrência de interpretação divergente por quaisquer das partes envolvidas, erro, fraude, inexatidão ou incoerência de dados, fotos e vídeos ou outros materiais relacionados a anúncios ou à imprecisão das informações contidas e enviadaspor anunciantes, usuários ou internautas no Portal Bombarco.

6.3.	 O usuário, internauta e anuncianteentendem que o Bombarco é o meio de veiculação, não representa o anunciante e editor de informações, por esse motivo as partes acima citadas, assumem todos os riscos e se responsabilizam por quaisquer danos ou prejuízos sofridos e/ou causados pelo uso de qualquer material obtido no Bombarco, assim como se comprometem a enviar apenas informações e materiais legítimos e verídicos. 

6.4.	O usuário e anunciante do Bombarco se comprometem a preencher sob sua responsabilidade, todos os dados do anúncio feito em qualquer seção do site de forma correta, verídica, e nos padrões do site Bombarco, sob pena de ser responsabilizado por qualquer dano, bem como ser retirado o anúncio sem prévio aviso e sem qualquer indenização e/ou reembolso. 

6.5.	Não é permitido fazer propaganda de empresas na Seção "Anunciar Embarcações", onde o espaço é destinado tão somente para a venda da embarcação. Portanto, fotos e/ou descrição da embarcação que contenham site, e-mail não serão aceitos, sendo o anúncio excluído automaticamente.  

6.5.	Não é permitido fazer propaganda de embarcaçãona Seção "Anunciar Guia de Empresa", onde o espaço é destinado tão somente para a divulgação da empresa. Portanto, fotos e/ou descrição de embarcação não serão aceitos, sendo o anúncio excluído automaticamente.  

6.6	Os anúncios em Comprar Embarcações aparecem de forma randômica, exceto quando o anunciante comprar Turbinada de Prioridade de Exibição e quando a embarcação não tiver valor. 

7.	Responsabilidade 

7.1.	Bombarconão é proprietário dos produtos e/ou embarcações oferecidos, não os avalia, faz a guarda, tem a posse e tampouco realiza as ofertas de venda. Assim como, não intervém na entrega ou no transporte dos mesmos,cuja negociação se inicie no site ou não, esclarecendoainda, que não se responsabiliza pelos serviços oferecidos por empresas ou profissionais anunciantes no portal. 

7.2.	Pelo exposto na cláusula 7.1. oBombarconão se responsabiliza pela existência, quantidade, qualidade, estado, integridade ou legitimidade dos produtos e/ou embarcações oferecidos, adquiridos ou alienados pelos usuários, internautas e anunciantes. 

7.3.	Bombarco não se responsabiliza pela veracidade dos dados pessoais cadastrados por usuários e anunciantes inseridos em seus cadastros.Bombarco não outorga garantia por vícios ocultos ou aparentes nas negociações entre os anunciantescom o internauta, usuário e outros anunciantes. Cada anuncianteestá ciente e aceita ser o único responsável por negociação e fechamento de negócios, pelos produtos, embarcações e informações que anuncia, venda ou pelas ofertas/compras que realiza. 

7.4.	Bombarco não será responsável pelo cumprimento das obrigações assumidas por quaisquer das partes envolvidas. O anunciante reconhece e aceita que ao realizar negociações com usuários, outros anunciantese internautas faz por sua conta e risco. Em nenhum caso Bombarco será responsável pelo lucro cessante ou por qualquer outro dano e/ou prejuízo que o usuário, internauta e anunciantepossam sofrer devido às negociações realizadas ou não realizadas através do Bombarco. 

7.5.	Caso o usuário, internauta e anuncianteacesse o site de parceiros, patrocinadores, outros anunciantes e demais sites que sejam acessados através do Portal Bombarco, é possível que haja solicitação de informações financeiras e/ou pessoais. Entretanto, tais e quaisquer informações não estarão sendo enviadas para o Bombarco, e sim diretamente ao solicitante, não tendo o Bombarco, portanto, qualquer acesso, conhecimento ou responsabilidade pela utilização e manejo dessa informação.

7.6.	Bombarcorecomenda que toda transação seja realizada com toda a cautela e diligência utilizada nas práticas comerciais, assim como bom senso. O anunciante deverá medir os riscos da negociação, levando em consideração que possa estar, eventualmente, lidando com menores de idade ou pessoas de má-fé. O Bombarco não é responsável pelas transações entre os anunciantes e terceiros.

7.7.	O usuário, internauta e anunciante assumem todas as responsabilidades provenientes de relações contratuais ou extracontratuais entre pessoas físicas ou jurídicas, assumidas através do Bombarco.

7.8. Nos casos em que um ou mais usuários, anunciantesou algum internauta inicie qualquer tipo de reclamação ou ação legal contra um ou mais anunciantes, todos e cada um dos anunciantes envolvidos nas reclamações ou ações eximem de toda responsabilidade o Bombarco, bem como qualquer membro de sua equipe, sejamseus diretores, gerentes, empregados, colaboradores, representantes, procuradores e etc.

7.9.	O usuário, internauta e anunciante são responsáveis por todos os equipamentos e programas de computador para a utilização do website, assim como pelas despesas de acesso à internet (acesso discado, banda larga, etc) e também pelos danos que possam ocorrer ao seu equipamento, decorrentes da má utilização de qualquer software/hardware ou por falhas técnicas ocorridas em seu provedor de acesso à internet. 

7.10.	 O Bombarco não se responsabiliza, direta ou indiretamente, por quaisquer danos e/ou prejuízos causados pela utilização do site inclusive danos causados por vírus de computador ou equivalentes.

7.11.	 O anunciantee o usuário se comprometem a informar dados verídicos e sempre atualizar na ocorrência de alterações, solicitados no ato do registro tanto de dados pessoais quanto de dados da empresa, embarcação, produtos, etc. No caso de informar dados incorretos, incompletos ou desatualizados, o Bombarco se reserva o direito de cancelar o registro do respectivo anunciante ou usuário, sem aviso prévio, indenização, devolução ou reembolso de valores.

7.12.	 A senha para acesso ao conteúdo é de uso pessoal e intransferível, o usuário e o anunciante obrigam-se a mantê-la em sigilo, sendo responsável por quaisquer danos e/ou prejuízos que o uso indevido da senha venha a causar.Em caso de uso indevido da mesma por terceiros, o usuário e anunciante se compromete a comunicar imediatamente o Bombarco. 

7.13.	 Para garantir a segurança em casos em que o usuário ou anunciante acessa o website www.bombarco.com.br o usuário e o anunciante se comprometem a clicar no link "Sair", localizado na parte superior de todas as páginas do Bombarco, que desconecta o usuário e o anunciante da sua área no Portal, evitando que terceiros se utilizem indevidamente de suasenha. 	

8. Regras para publicação de conteúdo

8.1.	A publicação dos conteúdos tais como: entrevistas, mensagens contendo experiências, dicas e opiniões, todas enviadas ou produzidas pelo Bombarco, jornalistas, editoras, empresas de publicidade e outras, usuários ou internautassão totalmente gratuitas. Atualmente, o Bombarco aceita conteúdo para publicação em algumas seçõesdo site desde que usuário ou internauta aceite e atenda aos requisitos descritos nas regras de publicação específicas de cada conteúdo.

8.2.	O usuário, anunciante ou internauta, ao enviar material para a publicação, assume todas as responsabilidades sobre o material publicado e exime o Bombarco de quaisquer danos e/ou prejuízos decorrentes. 


8.3.	O Bombarco não se responsabiliza, direta ou indiretamente, pela republicação, modificação, cópia total ou parcial, reexibição, retransmissão, publicação ou criação de conteúdo derivados a partir do conteúdo publicado por terceiros que não possuam autorização expressa dos seus respectivos autores, o responsável sempre será o indivíduo que enviou o material para publicação. 

8.4.	O conteúdo enviado para o Bombarco pode ser eventualmente remetido por usuário, anunciante ou internauta que, agindo de má-fé, se intitulem autores dos mesmos, cometendo crime de falsidade ideológica previsto em lei. Devido às características da internet, o Bombarco não pode se assegurar da total veracidade das informações fornecidas pelos usuários, anunciantes ou internautas nessas situações. 

8.5.	Caso o autor de algum conteúdo publicado no Bombarco suspeite que seu material tenha sido remetido indevidamente ao site ou que algum desses materiais de sua autoria foi parcial ou totalmente reproduzido em nome de terceiros no website www.bombarco.com.br, o mesmo deverá imediatamente entrar em contato com a empresa Bombarco, através do e-mailatendimento@bombarco.com.br para retiradado conteúdo no website e tomada de providências. 

8.6. O usuário ou internauta entende que o conteúdo publicado por ele ficará disponível para todos os visitantes do website www.bombarco.com.br por tempo indeterminado, (exceção dos pacotes de locação de espaço virtual) sem que isso acarrete ônus para qualquer uma das partes, a qualquer tempo. Da mesma forma, o usuário, anunciante ou internauta, se assim desejar, poderá solicitar a exclusão do conteúdo de sua autoria do Bombarco, sem qualquer ônus e a qualquer tempo. 

8.7. O website divulga, na seção AGENDA, diversos eventos da área náutica que ocorrem no Brasil. Todas as informações como datas, locais, programação, pessoas e recursos envolvidos nos eventos são de responsabilidade de seus organizadores e podem ser alterados sem aviso prévio. O Bombarco não assume, direta ou indiretamente, qualquer custo, reembolso, responsabilidade ou encargo proveniente da informação divulgada na seção acima citada.

8.8. O anunciante, ao publicar os seus dados pessoais e/ou dados da empresa que representa, como endereço, telefone, etc, na seção GUIA DE EMPRESAS,ANUNCIAR EMBARCAÇÃO, ESTALEIRO ou em qualquer meio de publicidade do website, está ciente que o Bombarco não se responsabiliza por quaisquer danos ou prejuízos diretos ou indiretos causados pela publicação.

8.9.	 O usuário encontra, no Bombarco, um espaço para publicarem seus comentários, situações em que se encontraram, que sirvam como dica sobre determinado conteúdo. Não serão publicados conteúdos ofensivos, ilegais, seja com teor discriminatório, racista ou pornográfico. O Bombarco se reserva o direito de não publicar ou excluir tais comentários que não se adéquem a estas regras, sem qualquer prévio comunicado.

8.10.	 O usuário ou internauta poderá, a qualquer tempo, pedir a exclusão de qualquer conteúdo próprio que tenha sido enviado e publicado no website, sem qualquer ônus, bastando para isso entrar em contato com o Bombarco através do e-mail: atendimento@bombarco.com.br. 

9. Propriedade intelectual, direitos autorais e de marcas 
9.1.	A propriedade intelectual de todo o material apresentando no Portal é de titularidade do Bombarco ou de seus anunciantes, usuários, clientes, parceiros e fornecedores, incluindo marcas, logotipos, produtos, sistemas, denominações de serviços, programas, bases de dados, imagens, arquivos ou materiais de qualquer outra espécie e que têm contratualmente autorizadas as suas veiculações neste Portal. 
9.2.	É proibida, sem a prévia e devida autorização por escrito e com firma reconhecida dos responsáveis acima identificados, a reprodução de qualquer material do Portal Bombarco, entendendo-se por reprodução todas as formas possíveis de comercialização, cópia, distribuição e veiculação. 
9.3.	As marcas comerciais apresentadas no Portal são de propriedade do Bombarco ou de seus anunciantes, clientes, parceiros ou fornecedores, sendo que a simples apresentação das marcas no Portal não poderá ser interpretada como sociedade, fusão ou concessão, sendo igualmente proibida a utilização ou qualquer tipo de reprodução de tais marcas comerciais. 
9.4.	O uso indevido de propriedade intelectual ou de marcas comerciais apresentadas no Portal Bombarco será caracterizado como violação das leis cíveis e criminais, em especial a lei que protege os direitos autorais/marcas e patentes e sujeitará o infrator às sanções judiciais cabíveis, sem prejuízo de indenização pelos prejuízos causados a Bombarco ou terceiros. 
9.5.	O nome e a marca Bombarco são marcas registradas da Bombarco Serviços de Informação na Internet Ltda. ME. O usuário, internauta e anunciante concordam em não reproduzir ou utilizar, sob qualquer título, a marca do Bombarco sem autorização prévia documentada e registrada.

9.6.	Todo conteúdo como textos e informações que o usuário ou internauta envie ou torne disponível para publicação em qualquer seção do website é de propriedade e responsabilidade de quem o produziu e o enviou.

9.7.	As matérias publicadas na seção COMUNIDADE – notícias, primeiro barco, blog e raio x são oriundas de fontes que permitiram sua reprodução desde que citadas suas respectivas fontes.

10. Política de Privacidade

10.1	A Política de Privacidade define o tratamento que o Bombarco dá às informações pessoais do usuário, internauta e anunciante que utilizam os serviços e recursos do website www.bombarco.com.br, podendo ser alterada regularmente.

11. Modificação do Termo de Uso

11.1	Bombarco poderá alterar, a qualquer tempo, este Termo e Condições Gerais de Uso, visando seu aprimoramento. O novo Termo e Condições Gerais de Uso entrará em vigor 10 (dez) dias após a publicação no site. No prazo de 5 (cinco) dias contados a partir da publicação das modificações, o usuário, internauta ou anunciante deverá comunicar-se pelo e-mail atendimento@bombarco.com.br caso não concorde com os termos alterados. Não havendo manifestação no prazo estipulado, entender-se-á que aceitaram tacitamente o novo Termo e Condições Gerais de Uso. 

12.	Disposições Finais

12.1 O Bombarco não mantém, administra ou possui nenhuma relação com serviços e/ou produtos encontrados nas seções COMPRAR EMBARCAÇÃO, ANUNCIAREMBARCAÇÃO, GUIA DE EMPRESA, ESTALEIRO bem como não garante a eficácia e/ou a eficiência dos produtos ou serviços, seja no Brasil ou no exterior, assim como não se responsabiliza pelos danos e/ou prejuízos decorrentes da eventual utilização daqueles serviços, produtos ou embarcação. 

12.2. As opiniões expressas em NOTÍCIAS, PRIMEIRO BARCO E BLOGsão respeitadas e não necessariamente expressam o entendimento, convicção e ideia do Bombarco.

12.3. O usuário, anunciante e o internauta concordam queconteúdos (entrevistas, mensagens contendo experiências, dicas e opiniões), enviados para o aludido website,se for do interesse do Bombarco, poderá ser publicado em "banners" ou outras formas de publicidade com fins comerciais, sem que isso traga qualquer ônus para as partes.

12.4. O Bombarco enviará ao usuário e/ouanunciante mensagens resultantes da comunicação sobre o que lhe for pertinente, podendo se referir: a contratação da locação do espaço virtual no website www.bombarco.com, confirmação de cadastro, publicação de conteúdo e/ou envio de newsletter caso seja autorizado.
12.5. O anunciante está ciente que o Bombarco poderá enviar informações, a seu critério dar publicidade a conteúdos, conceder bonificação gratuita,todavia, qualquer tipo de concessão, não acarretará obrigação entre as partes, ou oneração a Bombarco, que poderá a qualquer tempo, alterar, suspenderou cancelar tais benefícios gratuitos.

<br><br/>
Equipe BOMBARCO.

			</div>

			<input type="button" name="botao-cadastrar-form" class="botao-concordar-pg close" id="close" value="ACEITO">
		
		</div>
		<!-- fim lightbox -->




		<div class="linha-pagamento-5">
				<div class="container">
					<h1 id="transacao-info" style="color:#00918E; margin-top:20px;" class="text-pag-os "></h1>
			<?php
				echo CHtml::hiddenField('tid', '1234567890');
				echo CHtml::hiddenField('reference', '1');
				echo CHtml::ajaxSubmitButton("Finalizar",
				    array('pagamentoCartao'),
				    array(
				    	'type'=>'POST',
						'data'=>'js:$("#form-pay-card").serialize()',
						'success'=>'js:function(data){

							//console.log(data);
							//return false;
							
							var resp = JSON.parse(data.trim());
							
							// msg de erro
							if(resp.error == 4 || resp.error == 3) {
								$("#error-numero-cartao").html("Pagamento não autorizado pelo operadora!");
							}

							else {
								location.href = Yii.app.createUrl("site/sucesso");
							}

							
						}, 
						beforeSend: function(request) {

						//	_gaq.push(["_trackEvent", "anuncios", "click", "Finalizar"]);
						//	ads_conversor("DxhCCJOQ7lkQkLPC4wM");
						
							if(!$("#termos-condicao").is(":checked")) {
								flgok = false;
								request.abort();
								$("#error-termos").html("Aceite os termos de condição");
								return false;
							}

							var card_number = $("#card_number").val();
							var card_name = $("#card_name").val();
							var card_cvv = $("#card_cvv").val();
							var ano = $("#card_validate_year").val();
							var mes = $("#card_validate_month").val();

							var flgok = true;

							if(!card_number) {
								$("#error-numero-cartao").html("Insira o número do cartão");
								flgok = false;
								request.abort();
							}

							if(!mes) {
								$("#error-mes").html("Selecione o mês de validação do cartão");
								flgok = false;
								request.abort();
							}

							if(!ano) {
								$("#error-ano").html("Selecione o ano de validação do cartão");
								flgok = false;
								request.abort();
							}

							if(!card_name) {
								$("#error-nome-cartao").html("Insira o nome do cartão");
								flgok = false;
								request.abort();
							}

							if(!card_cvv) {
								$("#error-card-cvv").html("Insira a senha de segurança do cartão");
								flgok = false;
								request.abort();
							}

							if(flgok) {
								if(!confirm("Prosseguir com pagamento?")) {
									request.abort();
								}
							}

					

						},
						error: function(x, h, r) {
							//console.log(JSON.stringify(x)+" "+JSON.stringify(h)+" "+JSON.stringify(r));
							$("#error-numero-cartao").html("Pagamento não autorizado pelo operadora!");
						}'
					),
					array("id"=>"submit-card","class"=>"botao-pag-3 btn btn-primary"));

				?>
				<?php echo CHtml::endForm();?>
			    
		</div>
	</div>

</section>


<footer class="footerr">
	<div class="line-footer-cad">
		<div class="container" style="text-align:center;">
			<div class="box-mfoter-6">
				<div class="">
					<a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="icone-footer"></a>

					<div id="armored_website" style="width: 115px; height: 32px; position: absolute; top: 20px;  right: 15px;"></div>
				</div>	
			</div>		
		</div>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1014012304;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "ISlSCJb7iVkQkLPC4wM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1014012304/?label=pl26CITUvFgQkLPC4wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>