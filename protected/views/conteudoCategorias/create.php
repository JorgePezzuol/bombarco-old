
<div class="container">
		<h1 class="title-admin-form3">Cadastro de Categoria de Notícias</h1>
</div>

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>