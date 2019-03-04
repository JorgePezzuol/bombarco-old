
<?php //if(Yii::app()->controller->getRoute() == 'site/index'):?>


<!--<span class="banner-float" style="display:none;">
			<div id="ajax_video"></div>
			<a href="#" class="action-float"><img class="img-float" src="<?php echo Yii::app()->baseUrl . '/img/Banner_Float-06.png'?>"></a>
			<a href="#" class="close-float">x</a>
</span>-->
<?php // endif;?>


<!--Start footer-->
<?php if(Yii::app()->controller->id == 'embarcacoes' && Yii::app()->controller->action->id == 'view') {

} else { ?>
<footer class="footer full-width">
	<div class="container">
		<a href="<?php echo Yii::app()->homeUrl; ?>" title="Bombarco - Líder em classificados náuticos" class="link-logo sprite"></a>
		<!-- <a href="http://azclick.com.br/" onclick="javascript: return ! window.open(this.href);" title="AzClick - Agência Full Service" class="link-logoaz sprite flt-right"></a> -->
		<br class="clear" />
	</div>
</footer>
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl . '/assets/css/grids-min.css'; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl . '/assets/css/swiper.min.css'; ?>" />


<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl . '/assets/js/jquery.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl . '/assets/js/gulp/lib.js'; ?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl . '/assets/js/gulp/main.js'; ?>"></script>




<!--End do footer-->
