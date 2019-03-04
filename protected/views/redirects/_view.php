<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('de')); ?>:
	<?php echo GxHtml::encode($data->de); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('para')); ?>:
	<?php echo GxHtml::encode($data->para); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />

</div>