<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_modelos_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoModelos)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_fabricantes_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoFabricantes)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('description')); ?>:
	<?php echo GxHtml::encode($data->description); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('keywords')); ?>:
	<?php echo GxHtml::encode($data->keywords); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('follow')); ?>:
	<?php echo GxHtml::encode($data->follow); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('index')); ?>:
	<?php echo GxHtml::encode($data->index); ?>
	<br />
	*/ ?>

</div>