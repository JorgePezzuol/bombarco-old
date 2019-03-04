<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('vendas-bombarco-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

?>


<div class="container">
	<h1>Relatório de Vendas</h1>
	<br/>
	<?php $this->renderPartial('_search', array(
		'model' => $model,
	)); ?>


	<hr>

	<?php if(isset($_GET["VendasBombarco"])): ?>
		<?php $data_de = $_GET["VendasBombarco"]["data_de"]; ?>
		<?php $data_ate = $_GET["VendasBombarco"]["data_ate"]; ?>
		<span>Resultados a partir de <b><?php echo $data_de; ?></b> até <b><?php echo $data_ate;?></b></span>
		<?php if(isset($_GET["pelobb"])): ?>
			<?php if($_GET["pelobb"] == "0"): ?>
				<span> (<b>Não</b> vendidos pela plataforma)</span>
			<?php else: ?>
				<span> (Vendidos pela <b>plataforma</b>)</span>
			<?php endif; ?>
		<?php endif; ?>
		<br/><br/>
		<a href="<?php echo Yii::app()->createUrl("admin/vendas");?>">Resetar filtros</a>
	<?php endif; ?>
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'vendas-bombarco-grid',
	'dataProvider' => $model->search(),
	//'filter' => $model,
	'columns' => array(
		array(
			'name'=> 'embarcacoes_id',
			'header'=>'Embarcação',
			'value' =>'Embarcacoes::getAlt(Embarcacoes::model()->findByPk($data->embarcacoes_id))',
		),
		array(
			'header' => "Vendida pelo Bombarco?",
			'name' => 'venda_pelo_bombarco',
			'value' => '($data->venda_pelo_bombarco == 0) ? Yii::t(\'app\', \'Não\') : Yii::t(\'app\', \'Sim\')',
			//'filter' => array('0' => Yii::t('app', 'Não'), '1' => Yii::t('app', 'Sim')),
		),
		array(
			'header' => 'Proprietário',
			'name' => 'proprietario',
			'value' => 'Usuarios::buscarNomeDonoEmbarc($data->embarcacoes_id)',
		),
		array(
			'header' => 'E-mail',
			'name' => 'email',
			'value' => '$data->embarcacoes->email',
		),
		array(
			'header' => 'Valor',
			'name' => 'data',
			'value' =>'($data->embarcacoes->valor == 0.00) ? "Não informado" : "R$ ".number_format($data->embarcacoes->valor, 2, ",", ".")',
		),
		array(
			'header' => 'Data',
			'name' => 'data',
			'value' => 'Utils::formatDateTimeToView($data->data)',
		)
	),
)); ?>

</div>





