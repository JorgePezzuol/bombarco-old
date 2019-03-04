
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/css/sb-admin.css';?>" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/css/datepicker.css';?>" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/css/plugins/morris.css';?>" rel="stylesheet">

        	<!--<link href="<?php //echo Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg-editor.min.css';?>" rel="stylesheet" type="text/css">-->
			<!--<script src="<?php //echo Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg-editor.min.js';?>"></script>-->
			<!--<script src="<?php //echo Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg.min.js';?>"></script>-->

			<script src="<?php echo Yii::app()->baseUrl . '/js/tinymce/jquery.tinymce.min.js';?>"></script>
			<script src="<?php echo Yii::app()->baseUrl . '/js/tinymce/tinymce.min.js';?>"></script>


<script src="<?php echo Yii::app()->baseUrl . '/themes/admin/js/scripts.js?'.microtime();?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/js/conteudos.js?'.microtime();?>"></script>

<div class="container">
		<h1 class="title-admin-form3">Cadastro de Notícias</h1>
</div>


<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create',
		'conteudoImagem'=>$conteudoImagem,
		'seo'=>$seo));
?>

<script>
	$(document).ready(function() {
		$("#teste").datepicker({
			format: 'dd/mm/yyyy',
	    	language: 'pt-BR',
	    	weekStart: 0,
	    	startDate:'0d',
	    	todayHighlight: true
		});
	});
</script>