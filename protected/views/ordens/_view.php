<?php
/* @var $this OrdensController */
/* @var $data Ordens */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transacoes_id')); ?>:</b>
	<?php echo CHtml::encode($data->transacoes_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usuarios_id')); ?>:</b>
	<?php echo CHtml::encode($data->usuarios_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ordem_tipos_id')); ?>:</b>
	<?php echo CHtml::encode($data->ordem_tipos_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_item')); ?>:</b>
	<?php echo CHtml::encode($data->id_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_criacao')); ?>:</b>
	<?php echo CHtml::encode($data->data_criacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_ativacao')); ?>:</b>
	<?php echo CHtml::encode($data->data_ativacao); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>