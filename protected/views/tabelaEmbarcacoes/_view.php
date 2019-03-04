<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('ano')); ?>:
	<?php echo GxHtml::encode($data->ano); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('valor')); ?>:
	<?php echo GxHtml::encode($data->valor); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_modelos_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoModelos)); ?>
	<br />

</div>