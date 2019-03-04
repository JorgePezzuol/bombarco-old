<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacoes_id')); ?>:
	<?php echo GxHtml::encode($data->embarcacoes_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('venda_pelo_bombarco')); ?>:
	<?php echo GxHtml::encode($data->venda_pelo_bombarco); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data')); ?>:
	<?php echo GxHtml::encode($data->data); ?>
	<br />

</div>