<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacoes_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacoes)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('acessorios_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->acessorios)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('chave')); ?>:
	<?php echo GxHtml::encode($data->chave); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('valor')); ?>:
	<?php echo GxHtml::encode($data->valor); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />

</div>