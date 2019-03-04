<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('macro')); ?>:
	<?php echo GxHtml::encode($data->macro); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('titulo')); ?>:
	<?php echo GxHtml::encode($data->titulo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('texto')); ?>:
	<?php echo GxHtml::encode($data->texto); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('facebook')); ?>:
	<?php echo GxHtml::encode($data->facebook); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('video')); ?>:
	<?php echo GxHtml::encode($data->video); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('conteudo_categorias_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->conteudoCategorias)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('usuarios_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->usuarios)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacoes_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacoes)); ?>
	<br />
	*/ ?>

</div>