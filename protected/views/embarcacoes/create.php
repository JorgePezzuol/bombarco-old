<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Create'),
);
?>

<h1><?php echo Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php
if ($usuario != null) {

	$this->renderPartial('/anuncios/_form', array('model'=>$model, 
				'recursosAdicionais'=>$recursosAdicionais,
				'acessoriosJetSki'=>$acessoriosJetSki,
				'acessoriosLancha'=>$acessoriosLancha,
				'acessoriosVeleiro'=>$acessoriosVeleiro,
				'acessoriosPesca'=>$acessoriosPesca,
				'qntPermitida'=>$qntPermitida,
				'meses'=>$meses,
				'qntAnunciosCadastrados'=>$qntAnunciosCadastrados,
				'maxprice'=>$maxprice,
				'erro'=>$erro,
				'flgEstaleiro'=>true
			)
		);

} 
?>