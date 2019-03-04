<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('email')); ?>:
	<?php echo GxHtml::encode($data->email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('razao')); ?>:
	<?php echo GxHtml::encode($data->razao); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tipo')); ?>:
	<?php echo GxHtml::encode($data->tipo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('logo')); ?>:
	<?php echo GxHtml::encode($data->logo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('capa')); ?>:
	<?php echo GxHtml::encode($data->capa); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('maps')); ?>:
	<?php echo GxHtml::encode($data->maps); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('cnpj')); ?>:
	<?php echo GxHtml::encode($data->cnpj); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('telefone')); ?>:
	<?php echo GxHtml::encode($data->telefone); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('estados_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->estados)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cidades_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->cidades)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cep')); ?>:
	<?php echo GxHtml::encode($data->cep); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('endereco')); ?>:
	<?php echo GxHtml::encode($data->endereco); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('numero')); ?>:
	<?php echo GxHtml::encode($data->numero); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('bairro')); ?>:
	<?php echo GxHtml::encode($data->bairro); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fanpage')); ?>:
	<?php echo GxHtml::encode($data->fanpage); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('empresa_categorias_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->empresaCategorias)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('usuarios_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->usuarios)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('macros_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->macros)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>