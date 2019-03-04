	<div class="line-cadastro-8">
		<div class="container">
			<!-- essa div contem os acessorios -->
			<div id="div-acessorios">

				<!-- div de acessorios do jetski -->
				<div id="acessorios-jetski" style="display:none;">
					<div id="equipamentos-jetski">
						<label>Acessórios e Equipamentos</label>
						<?php
							foreach($acessoriosJetSki as $acessorio) {
								print '<br/>';
								print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][jetski][]"/>';
								print $acessorio->titulo;
							}
						?>
					</div>
				</div>
				<!-- fim acessorios jetski -->

				<!-- div de acessorios de lancha -->
				<div id="acessorios-lancha" style="display:none;">
					<div id="equipamentos-lancha" style="float:left;">
						<label>Acessórios e Equipamentos</label>
						<?php
							foreach($acessoriosLancha as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
					<div id="navegacao-lancha" style="float:left;">
						<label>Comunicação e Navegação</label>
						<?php
							foreach($acessoriosLancha as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
					<div id="eletronicos-lancha" style="float:left;">
						<label>Eletrônicos</label>
						<?php
							foreach($acessoriosLancha as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
				</div>
				<!-- fim acessorios lancha -->

				<!-- div de acessorios de veleiro -->
				<div id="acessorios-veleiro" style="display:none;">
					<div id="equipamentos-veleiro" style="float:left;">
						<label>Acessórios e Equipamentos</label>
						<?php
							foreach($acessoriosVeleiro as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
					<div id="navegacao-veleiro" style="float:left;">
						<label>Comunicação e Navegação</label>
						<?php
							foreach($acessoriosVeleiro as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
					<div id="eletronicos-veleiro" style="float:left;">
						<label>Eletrônicos</label>
						<?php
							foreach($acessoriosVeleiro as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>

					<div id="velamestra-veleiro" style="float:left;">
						<label>Vela Mestra</label>
						<?php
							foreach($acessoriosVeleiro as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_MESTRA']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>

					<div id="velagenoa-veleiro" style="float:left;">
						<label>Vela Genoa</label>
						<?php
							foreach($acessoriosVeleiro as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_GENOA']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
				</div>
				<!-- fim acessorios veleiro -->


				<!-- div de acessorios de pesca -->
				<div id="acessorios-pesca" style="display:none;">
					<div id="equipamentos-pesca" style="float:left;">
						<label>Acessórios e Equipamentos</label>
						<?php
							foreach($acessoriosPesca as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][pesca][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
					<div id="navegacao-pesca" style="float:left;">
						<label>Comunicação e Navegação</label>
						<?php
							foreach($acessoriosPesca as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][pesca][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
					<div id="eletronicos-pesca" style="float:left;">
						<label>Eletrônicos</label>
						<?php
							foreach($acessoriosPesca as $acessorio) {
								if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
									print '<br/>';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][pesca][]"/>';
									print $acessorio->titulo;
								}
							}
						?>
					</div>
				</div>
				<!-- fim acessorios pesca -->

				<div style="clear:both;"></div>
			</div>
		</div>	
	</div>