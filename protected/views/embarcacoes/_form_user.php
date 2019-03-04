<h2>Primeiro selecione um Usuário</h2>
<div class="form">
	<?php
	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		            'name'=>'searchuser',
		            'value'=>'',
		            'source'=>CController::createUrl('/usuarios/searchuser'),
		            'options'=>array(
			            'showAnim'=>'fold',         
			            'minLength'=>'3',
			            'select'=>'js:function(event, ui) {
			                        window.location = Yii.app.createUrl("embarcacoes/create/"+ui.item.value);
			                        return false;
			                  	}',
			            ),
		            'htmlOptions'=>array(
		            'onfocus' => 'js: this.value = null; $("#searchuser").val(null); $("#selectedvalue").val(null);',
		            'class' => 'input-xlarge',
		            'placeholder' => "Digite o nome/username/email de um usuário...",
		            ),
		        ));
	?>
</div>