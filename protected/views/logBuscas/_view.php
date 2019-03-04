<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('busca')); ?>:
	<?php echo GxHtml::encode($data->busca); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data')); ?>:
	<?php echo GxHtml::encode($data->data); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('usuario')); ?>:
	<?php echo GxHtml::encode($data->usuario); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ip')); ?>:
	<?php echo GxHtml::encode($data->ip); ?>
	<br />

</div>