

<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_macros_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoMacros)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('titulo')); ?>:
	<?php echo GxHtml::encode($data->titulo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('potencia')); ?>:
	<?php echo GxHtml::encode($data->potencia); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('motor_fabricantes_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->motorFabricantes)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('motor_tipos_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->motorTipos)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />

</div>	