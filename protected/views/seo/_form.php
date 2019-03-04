
<div class="container">

<a class="glyphicon glyphicon-arrow-left" href="<?php echo Yii::app()->createUrl('admin/seo'); ?>"> VOLTAR</a>




<h1>Dados da página</h1>


<br/>
<?php $form = $this->beginWidget('GxActiveForm', array(
		'id' => 'seo-form',
		'enableAjaxValidation' => true,
		'enableClientValidation'=>true,
		'htmlOptions'=>array(
            'class'=>'form-horizontal',
        )
	));
?>
	

	<?php
	    foreach(Yii::app()->user->getFlashes() as $key => $message) {
	    	echo '<div class="alert alert-'.$key.'">';
			echo $message;
			echo '</div>';
	    }
	?>
	
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">URL:</label>
    <div class="col-sm-10">
    <?php 
    	if($model->scenario == 'update') {
    	echo $form->textField($model, 'url', array('required'=>true, 'readOnly'=> true, 'placeholder' => 'Entre com a URL', 'maxlength' => 250, 'class'=>'form-control'));

    	} else {
    		echo $form->textField($model, 'url', array('required'=>true, 'placeholder' => 'Entre com a URL', 'maxlength' => 250, 'class'=>'form-control'));
    	}
    ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Título:</label>
    <div class="col-sm-10"> 
      <?php echo $form->textField($model, 'title', array('required'=>true, 'placeholder' => 'Entre com o título da página', 'maxlength' => 65, 'class'=>'form-control')); ?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Descrição:</label>
    <div class="col-sm-10"> 
      <?php echo $form->textField($model, 'description', array('id' => 'descricao', 'placeholder'=>'Entre com a descrição', 'maxlength' => 250, 'class'=>'form-control')); ?>
      <span style="color:blue;" id="count"></span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Keywords:</label>
    <div class="col-sm-10"> 
            <?php echo $form->textField($model, 'keywords', array('placeholder'=>'Entre com as keyword', 'maxlength' => 250, 'class'=>'form-control')); ?>
    </div>
  </div>
  <div class="form-group"> 
  	<div class="col-sm-offset-2 col-sm-10">
		<div class="checkbox">
		  <label><?php echo $form->checkBox($model, 'index'); ?>Index</label>
		</div>
		<div class="checkbox">
		  <label><?php echo $form->checkBox($model, 'follow'); ?>Follow</label>
		</div>
	</div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
    	<div class="form-actions text-center">
    		<button type="submit" class="btn btn-primary">CONFIRMAR</button>
    	</div>
      
    </div>
  </div>
<?php $this->endWidget(); ?>

	
</div>


<script>
  $(document).ready(function() {

      if($("#descricao").val() != "") {
        $("#count").text($("#descricao").val().length);
      }
      else {
        $("#count").text("0"); 
      }
      
      $("#descricao").on("keydown", function() {

          $("#count").text($(this).val().length);
      });

      $("#descricao").on("blur", function() {

          if($("#descricao").val() == "") {
              $("#count").text("0");  
          }

          $("#count").text($(this).val().length);
          
      });
  });
</script>


