<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_macros_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoMacros)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('usuarios_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->usuarios)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('imagem')); ?>:
	<?php echo GxHtml::encode($data->imagem); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('imagem_topo')); ?>:
	<?php echo GxHtml::encode($data->imagem_topo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fomato')); ?>:
	<?php echo GxHtml::encode($data->fomato); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('local')); ?>:
	<?php echo GxHtml::encode($data->local); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('orientacao')); ?>:
	<?php echo GxHtml::encode($data->orientacao); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('views')); ?>:
	<?php echo GxHtml::encode($data->views); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cliques')); ?>:
	<?php echo GxHtml::encode($data->cliques); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('inicio')); ?>:
	<?php echo GxHtml::encode($data->inicio); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fim')); ?>:
	<?php echo GxHtml::encode($data->fim); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>