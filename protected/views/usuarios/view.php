<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/moment.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_usuarios.js?'.microtime(), CClientScript::POS_END);

Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/pure-min.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/style.css?'.microtime());

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

//$planos_empresas = PlanoUsuarios::getPlans($model->id, Anuncio::$_macros['GUIA_EMPRESAS']);
$planos_anuncios = PlanoUsuarios::getPlans($model->id, Anuncio::$_macros['VENDEDOR']);
$planos_estaleiros = PlanoUsuarios::getPlans($model->id, Anuncio::$_macros['ESTALEIRO']);
?>



<section class="admin-container">

	<div class="container">

		<div style="padding: 0px !important; margin-top:70px;" class="title">Usuário - <?php echo $model->nome; ?><small style="    
    margin-left: 15px;"><a style="font-size: 10px;" href="<?php echo Yii::app()->createUrl("admin/usuarios");?>">< Voltar a lista</a> | <a target="_blank" style="font-size: 10px;" href="<?php echo Yii::app()->createUrl("usuarios/switchuser", array("id"=>$model->id));?>">Simular</a></small></div>

		<br/>

		<div class="pure-g">

			<div class="pure-u-1-1">

				<div class="container-box">
					<?php $this->widget('zii.widgets.CDetailView', array(
						'data' => $model,
						'attributes' => array(
						array(
							'name' => 'pessoa',
							'value' => ($model->pessoa = 'F') ? 'Física' : 'Jurídica'
						),
						'email',
						'cpf',
						'telefone',
						array(
							'name' => 'estados',
							'type' => 'raw',
							'label' => 'UF',
							'value' => $model->estados !== null ? GxHtml::valueEx($model->estados) : null,
							),
						array(
							'name' => 'cidades',
							'label' => 'Cidade',
							'type' => 'raw',
							'value' => $model->cidades !== null ? GxHtml::valueEx($model->cidades) : null,
							),
						),
					)); ?>
				</div>

			</div>

			<div class="pure-u-1-1">
				<div class="container-box">

					<div class="title">
						CLASSIFICADOS (<?php echo count($planos_anuncios); ?>)
						<?php if (!PlanoUsuarios::hasPlan($model->id, Anuncio::$_macros['VENDEDOR'])): ?>
							<a style="background: rgb(28, 184, 65);color:#fff;" href="#" class="btn-create-plan pure-button" data-type="<?php echo Anuncio::$_macros['VENDEDOR'];?>">Cadastrar</a>
						<?php endif ?>
					</div>

					<?php if (!empty($planos_anuncios)): ?>

						<?php foreach ($planos_anuncios as $key => $value): ?>

							<div class="sub-title pure-g">
								<div class="pure-u-2-5"><span><?php echo $value->planos->titulo; ?></span></div>
								<div class="pure-u-2-5 wrap-status">
									<?php if($value->status == Anuncio::$_status_plano['PAGO']): ?>
										<span style="color: green;">	
									<?php elseif($value->status == Anuncio::$_status_plano['CRIADO']): ?>	
										<span style="color:blue;">	
									<?php else: ?>	
										<span style="color:red;">	
									<?php endif; ?>
											<?php echo PlanoUsuarios::showStatus($value); ?>
										</span>
								</div>
								<div class="pure-u-1-5 wrap-btn">
									<a style="color:#fff;" href="#"
									   data-id="<?php echo $value->id; ?>"
									   data-plan="<?php echo $value->planos_id; ?>"
									   data-type="<?php echo $value->planos->macros_id; ?>"
									   data-qnt="<?php echo $value->qntpermitida; ?>"
									   data-status="<?php echo $value->status; ?>"
									   data-inicio="<?php echo $value->inicio; ?>"
									   data-fim="<?php echo $value->fim; ?>"
									   class="btn-edit-plan pure-button pure-button-primary">Editar</a>
									<a href="#"
									   data-id="<?php echo $value->id; ?>"
									   style="color:#fff;background-color:red;"
									   class="btn-del-plan pure-button">Deletar</a>
								</div>


							</div>
						<?php endforeach ?>

					<?php else: ?>
						<div class="sub-title"><span>Sem plano</span></div>
					<?php endif ?>

				</div>
			</div>



			<div class="pure-u-1-1">
				<div class="container-box">

					<div class="title">ESTALEIROS (<?php echo count($planos_estaleiros); ?>)
					<?php if (empty($planos_estaleiros) && empty($planos_empresas)): ?>
						<a style="background: rgb(28, 184, 65);color:#fff;" href="#" class="btn-create-plan pure-button" data-type="<?php echo Anuncio::$_macros['ESTALEIRO'];?>">Cadastrar</a>
					<?php endif ?>
					</div>

					<?php if (!empty($planos_estaleiros)): ?>

						<?php foreach ($planos_estaleiros as $key => $value): ?>
							<div class="sub-title pure-g">
								<div class="pure-u-2-5"><span><?php echo $value->planos->titulo; ?></span></div>
								<div class="pure-u-2-5 wrap-status"><span><?php echo PlanoUsuarios::showStatus($value); ?></span></div>
								<div class="pure-u-1-5 wrap-btn">
									<a href="#"
									   data-id="<?php echo $value->id; ?>"
									   data-plan="<?php echo $value->planos_id; ?>"
									   data-type="<?php echo $value->planos->macros_id; ?>"
									   data-qnt="<?php echo $value->qntpermitida; ?>"
									   data-status="<?php echo $value->status; ?>"
									   data-inicio="<?php echo $value->inicio; ?>"
									   data-fim="<?php echo $value->fim; ?>"
									   class="btn-edit-plan pure-button">Editar</a>
									<a href="#"
									   data-id="<?php echo $value->id; ?>"
									   style="color:#fff;background-color:red;"
									   class="btn-del-plan pure-button">Deletar</a>
								</div>
							</div>
						<?php endforeach ?>

					<?php else: ?>
						<div class="sub-title"><span>Sem plano</span></div>
					<?php endif ?>

				</div>
			</div>


		</div>

	</div>
</section>

<div id="lbox_form_plans" class="lbox-default">
	<a href="#" class="btn-close close">X</a>
	<?php echo CHtml::beginForm(array('PlanoUsuarios/AJAXCreate'), 'POST', array('id'=>'form_plans', 'class' => 'pure-form pure-form-stacked')); ?>
    	<fieldset>
	        <legend>Gerenciar Plano</legend>

	        <div class="pure-g">
	            <div class="pure-u-1 pure-u-md-1-3">
	                <label for="first-name">Selecione o plano</label>
	                <?php echo CHtml::dropDownList(
						'PlanoUsuarios[planos_id]',
						'',
						CHtml::listData(Planos::model()->findAll("gratuito=0"), 'id', 'titulo_dropdown'),
						array(
							'class' => 'lbox-form-input required',
							'options' => Planos::arrayOptionsPlanos()
						)
					);?>
	            </div>

	            <div class="pure-u-1 pure-u-md-1-3">
	                <label for="last-name">Data início</label>
	               	<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'name'=>'PlanoUsuarios[inicio]',
							'language' => 'pt-BR',
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat' => 'dd/mm/yy',
							),
							'htmlOptions'=>array(
								'class'=>'lbox-form-input required',
								'placeholder'=>'Início do Plano'
							),
						));
					?>
	            </div>

	            <div class="pure-u-1 pure-u-md-1-3">
	                <label for="email">Data fim</label>
	                <?php
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'name'=>'PlanoUsuarios[fim]',
						'language' => 'pt-BR',
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat' => 'dd/mm/yy',
						),
						'htmlOptions'=>array(
							'class'=>'lbox-form-input required',
							'placeholder'=>'Fim do Plano'
						),
					));
					?>
	            </div>

	            <div class="pure-u-1 pure-u-md-1-3">
	                <label for="city">Qtde de anúncios</label>
	                <?php echo CHtml::numberField('PlanoUsuarios[qntpermitida]', '', array('class'=>'lbox-form-input required', 'placeholder'=>'Quantidade de anúncios')); ?>
	            </div>

	            <div class="pure-u-1 pure-u-md-1-3">
	                <label for="state">Status</label>
					<?php echo CHtml::dropDownList('PlanoUsuarios[status]', '', Anuncio::$_status_plano_id, array('class'=>'lbox-form-input required', 'placeholder'=>'Status')); ?>
	            </div>
	        </div>

	        <br/>
	        <div class="pure-controls" style="text-align:center;">
	        	<?php echo CHtml::submitButton('Cadastrar', array('class'=>'lbox-form-submit pure-button pure-button-primary')); ?>
	        </div>
	        <?php echo CHtml::hiddenField('PlanoUsuarios[usuarios_id]', $model->id); ?>
			<?php echo CHtml::hiddenField('PlanoUsuarios[id]', ''); ?>
			
	    </fieldset>
	<?php CHtml::endForm(); ?>
</div>

