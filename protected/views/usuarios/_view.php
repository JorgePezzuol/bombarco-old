<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('usuario_classificacoes_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->usuarioClassificacoes)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('pessoa')); ?>:
	<?php echo GxHtml::encode($data->pessoa); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nome')); ?>:
	<?php echo GxHtml::encode($data->nome); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('username')); ?>:
	<?php echo GxHtml::encode($data->username); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('email')); ?>:
	<?php echo GxHtml::encode($data->email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('senha')); ?>:
	<?php echo GxHtml::encode($data->senha); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('cpf')); ?>:
	<?php echo GxHtml::encode($data->cpf); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('telefone')); ?>:
	<?php echo GxHtml::encode($data->telefone); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('estados_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->estados)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cidades_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->cidades)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('endereco')); ?>:
	<?php echo GxHtml::encode($data->endereco); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('googleplus')); ?>:
	<?php echo GxHtml::encode($data->googleplus); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('facebook')); ?>:
	<?php echo GxHtml::encode($data->facebook); ?>
	<br />
	*/ ?>

</div>