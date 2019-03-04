<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('inicio')); ?>:
	<?php echo GxHtml::encode($data->inicio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fim')); ?>:
	<?php echo GxHtml::encode($data->fim); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('qntpermitida')); ?>:
	<?php echo GxHtml::encode($data->qntpermitida); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('valor')); ?>:
	<?php echo GxHtml::encode($data->valor); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('planos_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->planos)); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('usuarios_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->usuarios)); ?>
	<br />
	*/ ?>

</div>