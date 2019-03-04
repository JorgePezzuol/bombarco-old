<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('tid')); ?>:
	<?php echo GxHtml::encode($data->tid); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tid_externo')); ?>:
	<?php echo GxHtml::encode($data->tid_externo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('valor')); ?>:
	<?php echo GxHtml::encode($data->valor); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('descricao')); ?>:
	<?php echo GxHtml::encode($data->descricao); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data_criacao')); ?>:
	<?php echo GxHtml::encode($data->data_criacao); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data_confirmacao')); ?>:
	<?php echo GxHtml::encode($data->data_confirmacao); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('formapagamento')); ?>:
	<?php echo GxHtml::encode($data->formapagamento); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('detalhes')); ?>:
	<?php echo GxHtml::encode($data->detalhes); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('usuarios_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->usuarios)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('plano_usuarios_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->planoUsuarios)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacoes_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacoes)); ?>
	<br />
	*/ ?>

</div>