<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('titulo')); ?>:
	<?php echo GxHtml::encode($data->titulo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('valor')); ?>:
	<?php echo GxHtml::encode($data->valor); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ultimo')); ?>:
	<?php echo GxHtml::encode($data->ultimo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacoes_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacoes)); ?>
	<br />

</div>