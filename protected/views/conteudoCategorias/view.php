<h1>Modelo - <?php echo GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
echo CHtml::link('Cadastrar Novo', array('conteudoCategorias/create'), array('class'=>'pure-button pure-button-primary'));
echo CHtml::link('Voltar a Lista', array('conteudoCategorias/admin'), array('class'=>'pure-button pure-button-primary'));
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'titulo',
	),
)); ?>

<?php
	echo GxHtml::openTag('ul');
	foreach($model->conteudoses as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('conteudos/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>