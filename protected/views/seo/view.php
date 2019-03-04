<div class="container">
	<h1 class="title-admin-form3">Meta Tags de <?php echo $model->title; ?></h1>
</div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'url',
'title',
'description',
'keywords',
'follow:boolean',
'index:boolean',
	),
)); ?>

