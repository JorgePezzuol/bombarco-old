<div class="form">
	<?php $form = $this->beginWidget('GxActiveForm', array(
		'id' => 'conteudos-form',
		'enableAjaxValidation' => false,
		'enableClientValidation'=>true,
		'htmlOptions' => array('enctype' => 'multipart/form-data')
		));
	?>

	<div class="line-admin-top">
		<div class="container">
			<p class="text2-admin-form">
				<?php echo Yii::t('app', 'Campos com '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'são obrigatórios'); ?>.
			</p>
		</div>
	</div>

	<div class="container">
		<?php if(Yii::app()->user->hasFlash('mensagem')): ?>
			<?php echo Yii::app()->user->getFlash('mensagem'); ?>
		<?php endif;?>
	</div>

	<div class="line-admin-cad-mod">
		<div class="container">
			<div class="box-admin-form2">
				<div class="linha-admin-form">
					<div class="container">


						<div class="box-admin-form">
							<span class="text-admin-form"><b>Título*</b></span>
							<?php echo $form->textField($model, 'titulo', array('maxlength' => 45, 'class'=>'campo-admin-form', 'id'=>'conteudo_titulo')); ?>
							<?php echo $form->error($model,'titulo'); ?>
							<div class="errorMessage" id="error-titulo"></div>
						</div><!-- row -->

					</div>
				</div>
				<div class="linha-admin-form">
					<div class="container">

						<div class="box-admin-form">
						<span class="text-admin-form"><b>Vídeo</b></span>
						<?php echo $form->textField($model, 'video', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'video'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
						<span class="text-admin-form"><b>Tags</b></span>

							<textarea id="tags" name="tags"></textarea>
						</div><!-- row -->


						<div class="box-admin-form">
						<span class="text-admin-form"><b>Facebook</b></span>
						<?php echo $form->textField($model, 'facebook', array('maxlength' => 45, 'class'=>'campo-admin-form')); ?>
						<?php echo $form->error($model,'facebook'); ?>
						</div><!-- row -->

					</div>
				</div>


				<div class="linha-admin-form">
					<div class="container">
						<div class="box-admin-form">
						<span class="text-admin-form"><b>Texto*</b></span>
							<div>
								<?php echo $form->textArea($model, 'texto',
							array('maxlength' => 4000, 'id'=>'texto-noticia')); ?>
							</div>
							<?php echo $form->error($model,'texto'); ?>
						</div><!-- row -->

						<div class="box-admin-form3">
							<?php echo $form->fileField($conteudoImagem, 'imagem'); ?>
							<?php echo $form->error($conteudoImagem,'imagem'); ?>
						</div>
					</div>
				</div>

				<div class="linha-admin-form" id="categoria-embarcacao">
					<div class="container">
						<div class="box-admin-form">
							<span class="text-admin-form"><b>Categoria de Embarcação</b></span>
							<div class="embarcacao_macros_id">
								<?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('empty'=>'Selecione', 'id'=>'embarcacao_macros_conteudo', 'class'=>'select-anuncio-pad')); ?>
							</div>
							<div class="errorMessage" id="error-emb-macro"></div>
							<?php echo $form->error($model,'embarcacao_macros_id'); ?>
						</div><!-- row -->

						<div class="box-admin-form">
							<span class="text-admin-form"><b>Data</b></span>
							<?php echo $form->textField($model, 'data', array('class'=>'campo-admin-form')); ?>
							<div class="errorMessage" id="error-data"></div>
							<?php echo $form->error($model,'data'); ?>
						</div><!-- row -->

					</div>
				</div>

				<br/><br/>

				<div class="linha-admin-form" style="margin-top:80px;">
					<div class="container">
						<div class="box-admin-form">
							<span class="text-admin-form"><b>Habilitar SEO</b></span>
							<input type="checkbox" id="check-seo"/>
						</div><!-- row -->
					</div>


				</div>

				<div id="seo" style="display:none;">

					<div class="linha-admin-form">
						<div class="container">

							<div class="box-admin-form">
							<span class="text-admin-form"><b>Title da Página</b></span>
							<?php echo $form->textArea($seo, 'title', array('maxlength' => 65, 'class'=>'campo-admin-form')); ?>
							<?php echo $form->error($seo,'title'); ?>
							</div><!-- row -->

							<div class="box-admin-form" id="categoria-noticia">
								<span class="text-admin-form"><b>Description da Página</b></span>
								<?php echo $form->textArea($seo, 'description', array('maxlength' => 150, 'class'=>'campo-admin-form')); ?>
								<?php echo $form->error($seo,'description'); ?>
							</div><!-- row -->

						</div>
					</div>

					<div class="linha-admin-form">
						<div class="container">

							<div class="box-admin-form">
							<span class="text-admin-form"><b>Keywords</b></span>
							<?php echo $form->textArea($seo, 'keywords', array('maxlength' => 250, 'class'=>'campo-admin-form')); ?>
							<?php echo $form->error($seo,'keywords'); ?>
							</div><!-- row -->

						</div>

						<div class="box-admin-form">
							<span class="text-admin-form"><b>Follow</b></span>
							<div class="embarcacao_macros_id">
								<?php echo $form->dropDownList($seo, 'follow', array(1=>'Follow', '0'=>'No Follow'), array('class'=>'select-anuncio-pad')); ?>
							</div>
							<?php echo $form->error($seo,'follow'); ?>
						</div><!-- row -->

							<div class="box-admin-form">
								<span class="text-admin-form"><b>Index</b></span>
								<div class="embarcacao_macros_id">
								<?php echo $form->dropDownList($seo, 'index', array(1=>'Index', 0=>'No Index'), array('class'=>'select-anuncio-pad')); ?>
							</div>
							<?php echo $form->error($seo,'index'); ?>
							</div><!-- row -->
					</div>

				</div>

				<div class="linha-admin-form">
					<div class="container">
						<?php /* ?>
							<label><?php echo GxHtml::encode($model->getRelationLabel('embarcacoes')); ?></label>
							<?php echo $form->checkBoxList($model, 'embarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>
							<label><?php echo GxHtml::encode($model->getRelationLabel('tabelaEmbarcacoes')); ?></label>
							<?php echo $form->checkBoxList($model, 'tabelaEmbarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(TabelaEmbarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>
							<?php */
							?>
						<?php
						echo GxHtml::submitButton(Yii::t('app', 'CADASTRAR'), array('class'=>'botao-cad-admin', 'id'=>'btn-cadastrar'));
						$this->endWidget();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- form -->
