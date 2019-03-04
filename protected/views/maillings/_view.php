<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('email')); ?>:
	<?php echo GxHtml::encode($data->email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data')); ?>:
	<?php echo GxHtml::encode($data->data); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('useragent')); ?>:
	<?php echo GxHtml::encode($data->useragent); ?>
	<br />

</div>