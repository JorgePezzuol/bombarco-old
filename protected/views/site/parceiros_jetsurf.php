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
					<span class="title-pb-2"><a target="_blank" href="https://www.bombarco.com.br/">Home</a> > Parceiros > <?php echo $title; ?></span>
				</div>
			</div>
		</div>

		<div class="container partner-content-wrap">

			<div class="pure-g">

				<div class="pure-u-5-8">

					<div class="partner-content">

						<div class="pure-g">

							<div class="pure-u-1-3">
								<img class="partner-logo" src="<?php echo Yii::app()->baseUrl; ?>/img/<?php echo $logo; ?>">
							</div>

							<br/>
							<div class="pure-u-4-5">
								<div style="margin-left:0px !important;" class="subtitle"><?php echo $subtitle; ?></div>
							</div>
						</div>

						<p style="text-align:justify;"><?php echo $text; ?></p>
						

						<img class="partner-banner" src="<?php echo Yii::app()->baseUrl; ?>/img/<?php echo $banner1; ?>">


					</div>

				</div>

				<div class="pure-u-3-8">

					<form id="form_partner" name="form_partner" action="<?php echo Yii::app()->createUrl('contatos/partner'); ?>" method="POST" class="partner-form-wrap">

						<div class="subtitle"><?php echo $texto_form ?></div>

						<div class="form-error">Erro de contato</div>

						<div class="select-type" style="display:none;">
							<select name="type" id="partner_input" class="partner-input">
								<option value="Jetski">Jetski</option>
							</select>
						</div>

						<input type="text" name="name" placeholder="Nome*" class="partner-input" required />
						<input type="email" name="email" placeholder="Email*" class="partner-input" required />
						<input type="text" name="cidade_estado" placeholder="Cidade*" class="partner-input" required />
						<input type="tel" name="phone" id="phone" placeholder="Telefone com ddd*" class="partner-input" required />
						


						<input onclick="_gaq.push(['_trackEvent', 'link', 'click', 'link-click-Marina']);" type="submit" value="<?php echo $texto_botao ?>" class="partner-submit" />


						<small>* Campos obrigatórios</small>

						<input type="hidden" name="type_partner" value="<?php echo $type; ?>" />
						<input type="hidden" name="partner" value="<?php echo $partner; ?>" />
						<input type="text" name="PuUK8SmP" value="" style="display:none !important;" />

					</form>

				</div>

			</div>

		</div>

</section>
