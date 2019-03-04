<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_macros_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoMacros)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_fabricantes_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoFabricantes)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('embarcacao_tipos_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->embarcacaoTipos)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('titulo')); ?>:
	<?php echo GxHtml::encode($data->titulo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tamanho')); ?>:
	<?php echo GxHtml::encode($data->tamanho); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('passageiros')); ?>:
	<?php echo GxHtml::encode($data->passageiros); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('acomodacoes')); ?>:
	<?php echo GxHtml::encode($data->acomodacoes); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('comprimento')); ?>:
	<?php echo GxHtml::encode($data->comprimento); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('boca')); ?>:
	<?php echo GxHtml::encode($data->boca); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('calado')); ?>:
	<?php echo GxHtml::encode($data->calado); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('pedireito')); ?>:
	<?php echo GxHtml::encode($data->pedireito); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('pesocasco')); ?>:
	<?php echo GxHtml::encode($data->pesocasco); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tanquecombustivel')); ?>:
	<?php echo GxHtml::encode($data->tanquecombustivel); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tanqueagua')); ?>:
	<?php echo GxHtml::encode($data->tanqueagua); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('consumo')); ?>:
	<?php echo GxHtml::encode($data->consumo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ncamarotes')); ?>:
	<?php echo GxHtml::encode($data->ncamarotes); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nbanheiros')); ?>:
	<?php echo GxHtml::encode($data->nbanheiros); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>