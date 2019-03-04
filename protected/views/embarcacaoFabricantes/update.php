
<div class="container">
		<h1 class="title-admin-form">Alterar o fabricante <?php echo $model->titulo;?></h1>
</div>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'update'));
?>