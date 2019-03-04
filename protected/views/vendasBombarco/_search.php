<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
    'id'=>'formfiltrar'
)); ?>

<b>De :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'language' => 'pt-BR',
    'name'=>'VendasBombarco[data_de]', 
     'options'=>array(
        'showAnim'=>'fold',
        //'dateFormat'=>'yy-mm-dd',
        'dateFormat'=>'dd/mm/yy',

    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'id' => 'data_de'
    ),
));
?>

<b style="margin-left:7px;>">Até :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'language' => 'pt-BR',
    'name'=>'VendasBombarco[data_ate]',
     'options'=>array(
        'showAnim'=>'fold',
        //'dateFormat'=>'yy-mm-dd',
        'dateFormat'=>'dd/mm/yy',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'id' => 'data_ate'
    ),
));
?>
<br/><br/>

<div class="form-inline">
  <div class="radio">
    <label><input type="radio" value="1" name="pelobb"> Vendas <b>pela</b> plataforma</label>
  </div>
  <div class="radio">
    <label><input type="radio" value="0" name="pelobb"> Vendas <b>fora</b> da plataforma</label>
  </div>
  <input type="submit" id="btnfiltrar" class="btn btn-primary" value="Filtrar" style="margin-left:10px;"/>
</div>



<?php $this->endWidget(); ?>

<script>
    $(document).ready(function() {
        $("#btnfiltrar").on("click", function(e) {
            e.preventDefault();
            if($("#data_de").val() != "" && $("#data_ate").val() != "") {
                $(".hasDatepicker").each(function() {
                    if($(this).val() == "") {
                        $(this).css("border-color", "");
                    }
                });
               $("#formfiltrar").submit(); 
            }
            else {
                $(".hasDatepicker").each(function() {
                    if($(this).val() == "") {
                        $(this).css("border-color", "red");
                    }
                });
            }
        });
    });
</script>



