<style>
.ui-datepicker {
    width: 216px;
    height: auto;
    margin: 5px auto 0;
    font: 9pt Arial, sans-serif;
    -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
    -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .5);
    background-color: #FFF;
}
.ui-datepicker th {
color: #3e3e3e;
}

.ui-datepicker th.ui-datepicker-week-end {
color:red;
}

</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
				<?php echo Yii::t('app', 'Campos com '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'são obrigatórios'); ?>. <a href="<?php echo Yii::app()->createUrl('admin/comunidade'); ?>">Voltar</a>
			</p>
		</div>
	</div>

	<br/><br/>
	<div class="container">
		<?php if(Yii::app()->user->hasFlash('mensagem')): ?>
        <span style="padding:10px 4px;background:#eee; color:#000; display:block; margin:20px 0;">
			<?php echo Yii::app()->user->getFlash('mensagem'); ?>
        </span>
		<?php endif;?>
	</div>

	<div class="line-admin-cad-mod">
		<div class="container">
			<div class="box-admin-form2">
				<div class="linha-admin-form">
					<div class="container">
						<div class="box-admin-form">
							<span class="text-admin-form"><b>Tipo da Notícia*</b></span>
							<div class="embarcacao_macros_id">
								<?php echo $form->dropDownList($model, 'macro', array(''=>'Selecione','B'=>'Blog', 'N'=>'Notícias', 'P'=>'Primeiro Barco', 'T'=>'Raio X'), array('class'=>'select-anuncio-pad', 'id'=>'macro_conteudo')); ?>
							</div>
							<?php echo $form->error($model,'macro'); ?>
							<div class="errorMessage" id="error-macro"></div>
						</div><!-- row -->


						<div class="box-admin-form" id="categoria-noticia" style="display:none;">
							<span class="text-admin-form"><b>Categoria da Notícia</b></span>
							<div class="embarcacao_macros_id" id="div-conteudo-macros">

							</div>
							<?php echo $form->error($model,'conteudo_categorias_id'); ?>
							<div class="errorMessage" id="error-sub-categoria"></div>
						</div><!-- row -->


						<div class="box-admin-form">
							<span class="text-admin-form"><b>Título*</b></span>
							<?php echo $form->textField($model, 'titulo', array('class'=>'campo-admin-form', 'id'=>'conteudo_titulo')); ?>
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

						<!--<div class="box-admin-form">
						<span class="text-admin-form"><b>Tags</b></span>

							<textarea id="tags" name="tags"></textarea>
						</div>-->


						<!--<div class="box-admin-form">
						<span class="text-admin-form"><b>Facebook</b></span>
						<?php /*echo $form->textField($model, 'facebook', array('maxlength' => 45, 'class'=>'campo-admin-form')); */?>
						<?php /*echo $form->error($model,'facebook');*/ ?>
						</div>-->

					</div>
				</div>

				<div class="linha-admin-form" id="categoria-embarcacao">
					<div class="container">
						<!--<div class="box-admin-form">
							<span class="text-admin-form"><b>Categoria de Embarcação*</b></span>
							<div class="embarcacao_macros_id">
								<?php /*echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)), array('empty'=>'Selecione', 'id'=>'embarcacao_macros_conteudo', 'class'=>'select-anuncio-pad'));*/ ?>
							</div>
							<div class="errorMessage" id="error-emb-macro"></div>
							<?php /*echo $form->error($model,'embarcacao_macros_id');*/ ?>
						</div>-->
							<!--<div class="box-admin-form">
								<span class="text-admin-form"><b>Empresa</b></span>
								<div class="embarcacao_macros_id">
									<?php /*echo $form->dropDownList($model, 'empresas_id', GxHtml::listDataEx(Empresas::model()->findAllAttributes(null, true)), array('empty'=>'Selecione', 'id'=>'empresas_conteudo', 'class'=>'select-anuncio-pad'));*/ ?>
								</div>
								<div class="errorMessage" id="error-emb-macro"></div>
								<?php /*echo $form->error($model,'embarcacao_macros_id');*/ ?>
							</div>-->

						<div class="box-admin-form">
							<span class="text-admin-form"><b>Data*</b></span>
							<?php echo $form->textField($model, 'data', array('class'=>'campo-admin-form')); ?>
							<div class="errorMessage" id="error-data"></div>
							<?php echo $form->error($model,'data'); ?>
						</div><!-- row -->

						<br/><br/><br/>



				<br/>
                        
                        
						<div class="box-admin-form3" style="display:none;">
							<?php echo $form->fileField($conteudoImagem, 'imagem', array('id'=>'file-imagem-update')); ?>
							<?php echo $form->error($conteudoImagem,'imagem'); ?>

						</div>

						<div class="box-admin-form" style="border-bottom: none !important; text-align:center;">
							<?php if($conteudoImagem->imagem != ""): ?>
							<?php echo CHtml::image(Yii::app()->request->baseUrl.'/public/conteudos/'.$conteudoImagem->imagem, 'Imagem da noticia', array('id'=>'imagem-noticia', 'width'=>'250px', 'height'=>'170px')); ?>
							<?php else:?>
								<!-- id da imagem -->

							<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/sem_foto_bb.jpg', 'Imagem da noticia', array('id'=>'imagem-noticia', 'width'=>'250px', 'height'=>'170px')); ?>
							<?php endif;?>
						</div>
                        
					</div>
				</div>


								<div class="linha-admin-form">
					
						<div class="box-admin-form">
						<!--<span class="text-admin-form"><b>Texto*</b></span>-->
							<div>
							<?php echo $form->textArea($model, 'texto',
							array('maxlength' => 20000, 'rows'=>'3', 'cols'=>'30', 'id'=>'texto-noticia')); ?>
							</div>
							<?php echo $form->error($model,'texto'); ?>
						</div><!-- row -->
				
				</div>
                

				<br/><br/>

				<div class="linha-admin-form" style="text-align:center;">
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
