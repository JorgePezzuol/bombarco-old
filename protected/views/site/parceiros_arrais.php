<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/partners.js', CClientScript::POS_END);
?>
<section class="content partner">
		<div class="line-gray-pb-top">
			<div class="container">
				<div>
					<span class="title-pb-1"><?php echo $title; ?></span>
					<span class="title-pb-2">Home > Parceiros > <?php echo $title; ?></span>
				</div>
			</div>
		</div>

		<div class="container partner-content-wrap">

			<div class="pure-g">

				<div class="pure-u-5-8">

					<div class="partner-content">

						<div class="pure-g">
							
							<div style="display:none;" class="pure-u-1-5">
								<img class="partner-logo" src="<?php echo Yii::app()->baseUrl; ?>/img/<?php echo $logo; ?>">
							</div>
						
							<div class="pure-u-4-5">
								<div style="margin-left:0px !important;" class="subtitle"><?php echo $subtitle; ?></div>
							</div>
						</div>

						<p style="text-align:justify;"><?php echo $text; ?></p>
						
						<img style="display:none;" class="partner-banner" src="<?php echo Yii::app()->baseUrl; ?>/public/banners/<?php echo $banner1; ?>">
						

					</div>

				</div>

				<div class="pure-u-3-8">

					<form id="form_partner" name="form_partner" action="<?php echo Yii::app()->createUrl('contatos/partner'); ?>" method="POST" class="partner-form-wrap">

						<div class="subtitle"><?php echo $texto_form ?></div>

						<div class="form-error">Erro de contato</div>

						<input type="text" name="estado" placeholder="Qual seu estado?*" class="partner-input" required />
						<input type="text" name="cidade" placeholder="Qual sua cidade?*" class="partner-input" required />

						<div class="select-type">
							<select name="type" id="tipo_arrais" class="partner-input">
								<option value="Arrais de amador">Arrais de amador</option>
								<option value="Mestre amador">Mestre amador</option>
								<option value="Capitão Amador">Capitão Amador</option>
							</select>
						</div>

						<input type="text" name="name" placeholder="Nome*" class="partner-input" required />
						<input type="email" name="email" placeholder="Email*" class="partner-input" required />
						<input type="tel" name="phone" id="phone" placeholder="Telefone*" class="partner-input" required />

						<input onclick="_gaq.push(['_trackEvent', 'link', 'click', 'link-click-Transporte']);" type="submit" value="<?php echo $texto_botao ?>" class="partner-submit" onclick="ga('send', 'event', 'link', 'click', 'Transporte');" />

						<small>* Campos obrigatórios</small>

						<input type="hidden" name="type_partner" value="ARR" />
						<input type="hidden" name="partner" value="<?php echo $partner; ?>" />
						<input type="hidden" name="price" value="0"/>
						<input type="text" name="PuUK8SmP" value="" style="display:none !important;" />

					</form>

				</div>

			</div>

		</div>

</section>
