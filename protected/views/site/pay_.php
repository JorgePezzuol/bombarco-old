<?php
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>'<span class="icon-th-list"></span> Pagamento com Cartão',
	'titleCssClass'=>''
));
?>

<?php echo CHtml::beginForm('', 'post', array("id"=>"form-pay-card"));?>

<div class="form-card">

    <label>Número do cartão</label>
    <input type="text" name="card_number">

    <br>

	<div class="row-fluid">
		<label class="radio span2">
			<input type="radio" name="card_flag" id="cardAmerican" value="american" checked>
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/american-express.png'); ?>
		</label>

		<label class="radio span2">
			<input type="radio" name="card_flag" id="cardVisa" value="visa">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/visa.png'); ?>
		</label>

		<label class="radio span2">
			<input type="radio" name="card_flag" id="cardDiners" value="diners">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/american-express.png'); ?>
		</label>

		<label class="radio span2">
			<input type="radio" name="card_flag" id="cardMaster" value="mastercard">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/mastercard.png'); ?>
		</label>

		<label class="radio span2">
			<input type="radio" name="card_flag" id="cardDiscover" value="discover">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/discover.png'); ?>
		</label>

		<label class="radio span2">
			<input type="radio" name="card_flag" id="cardElo" value="elo">
			<?php echo CHtml::image(Yii::app()->baseUrl.'/images/american-express.png'); ?>
		</label>
	</div>

	<br>

	<label>Nome impresso no cartão</label>
    <input type="text" name="card_name">

    <br>

    <label>Validade</label>
    <select name="card_validate_month" id="card_validate_month" class="input-small">
    	<option value="01">Janeiro</option>
    	<option value="02">Fevereiro</option>
    	<option value="03">Marco</option>
    	<option value="04">Abril</option>
    	<option value="05">Maio</option>
    	<option value="06">Junho</option>
    	<option value="07">Julho</option>
    	<option value="08">Agosto</option>
    	<option value="09">Setembro</option>
    	<option value="10">Outubro</option>
    	<option value="11">Novembro</option>
    	<option value="12">Dezembro</option>
    </select>
    /
    <select name="card_validate_year" id="card_validate_year" class="input-small">
    	<option value="2014">2014</option>
    	<option value="2015">2015</option>
    	<option value="2016">2016</option>
    	<option value="2017">2017</option>
    	<option value="2018">2018</option>
    	<option value="2019">2019</option>
    	<option value="2020">2020</option>
    </select>

	<br>

    <label>Código de seguranca</label>
    <input type="text" name="card_cvv" class="input-small">

    <br>

    <select name="card_number_payments" id="card_number_payments" class="input-small">
    	<option value="1">1x</option>
    	<option value="2">2x</option>
    	<option value="3">3x</option>
    	<option value="4">4x</option>
    	<option value="5">5x</option>
    	<option value="6">6x</option>
    	<option value="7">7x</option>
    	<option value="8">8x</option>
    	<option value="9">9x</option>
    	<option value="10">10x</option>
    	<option value="11">11x</option>
    	<option value="12">12x</option>
    </select>
</div>

<?php
echo CHtml::hiddenField('tid', '1234567890');
echo CHtml::hiddenField('reference', '1');
echo CHtml::ajaxSubmitButton("Pagar",
					    array('pagamentoCartao'),
					    array(
					    	'type'=>'POST',
							'data'=>'js:$("#form-pay-card").serialize()',
							'success'=>'js:function(data){
								console.log(data);
							}'
						),
						array("id"=>"submit-card","class"=>"btn btn-primary"));
?>

<?php echo CHtml::endForm();?>

<?php $this->endWidget(); ?>

<hr>

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>'<span class="icon-th-list"></span> Pagamento com Boleto',
	'titleCssClass'=>''
));
?>
<?php echo CHtml::beginForm('', 'post', array("id"=>"form-pay-boleto"));?>

<?php
echo CHtml::hiddenField('amount', '10.00');
echo CHtml::hiddenField('tid', '1234567890');
echo CHtml::hiddenField('reference', '1');
echo CHtml::ajaxSubmitButton("Pagar",
					    array('site/pagamentoBoleto'),
					    array(
					    	'type'=>'POST',
							'data'=>'js:$("#form-pay-boleto").serialize()',
							'success'=>'js:function(data){
								alert(data);
							}'
						),
						array("id"=>"submit-boleto","class"=>"btn btn-primary"));
?>

<?php echo CHtml::endForm();?>

<?php $this->endWidget(); ?>
