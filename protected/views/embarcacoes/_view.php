<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_macros_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoMacros)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_modelos_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoModelos)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('titulo')); ?>:
	<?php echo GxHtml::encode($data->titulo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('slug')); ?>:
	<?php echo GxHtml::encode($data->slug); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ano')); ?>:
	<?php echo GxHtml::encode($data->ano); ?>
	<br />
	<?php echo GxHtml::encode($data->embarcacaoModelos->getAttributeLabel('titulo')); ?>:
	<?php echo GxHtml::encode($data->embarcacaoModelos->titulo); ?>
	<br />
	<?php echo GxHtml::encode($data->embarcacaoModelos->embarcacaoFabricantes->getAttributeLabel('titulo')); ?>:
	<?php echo GxHtml::encode($data->embarcacaoModelos->embarcacaoFabricantes->titulo); ?>
	<br />
	
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('estados_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->estados)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cidades_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->cidades)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('valor')); ?>:
	<?php echo GxHtml::encode($data->valor); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('estado')); ?>:
	<?php echo GxHtml::encode($data->estado); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('qntmotores')); ?>:
	<?php echo GxHtml::encode($data->qntmotores); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('descricao')); ?>:
	<?php echo GxHtml::encode($data->descricao); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('views')); ?>:
	<?php echo GxHtml::encode($data->views); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('video')); ?>:
	<?php echo GxHtml::encode($data->video); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('destaque')); ?>:
	<?php echo GxHtml::encode($data->destaque); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('plano_usuarios_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->planoUsuarios)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>