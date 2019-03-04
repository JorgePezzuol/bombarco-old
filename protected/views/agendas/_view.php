<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('titulo')); ?>:
	<?php echo GxHtml::encode($data->titulo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('texto')); ?>:
	<?php echo GxHtml::encode($data->texto); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('local')); ?>:
	<?php echo GxHtml::encode($data->local); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data_inicio')); ?>:
	<?php echo GxHtml::encode($data->data_inicio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data_fim')); ?>:
	<?php echo GxHtml::encode($data->data_fim); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('imagem')); ?>:
	<?php echo GxHtml::encode($data->imagem); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('fanpage')); ?>:
	<?php echo GxHtml::encode($data->fanpage); ?>
	<br />
	*/ ?>

</div>