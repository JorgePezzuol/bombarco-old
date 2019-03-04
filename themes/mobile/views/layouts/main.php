<?php
header('Content-Type: text/html; charset=utf-8');
//Utils::redirectWWW();
//Utils::redirectManual();
//Utils::redirect();
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl . '/assets/css/style.css'; ?>" /> -->


	<style type="text/css">
		<?php
		 echo file_get_contents("themes/mobile/assets/css/style.css");
		?>
	</style>

	<?php

		if(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index') {
			$this->setPageTitle("Lanchas, Veleiros e Jet Skis. Bombarco - Líder em classificados Náuticos!");
			Yii::app()->clientScript->registerMetaTag('Compre, venda e anuncie suas Lanchas, Veleiros e Jet Skis. O Bombarco é Líder em classificados Náuticos! Acesse nosso Portal e veja como é Fácil.', 'description', null, array(), 'bombarco_description');
		}

		if (!YII_DEBUG) {
				Utils::metaTags($this);
		} else {
				echo '<meta name="robots" content="noindex"><meta name="googlebot" content="noindex">';
				echo '<title>' . CHtml::encode($this->pageTitle) . '</title>';
		}


		/*Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/assets/css/style.css');
		Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/assets/css/grids-min.css');
		Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/assets/css/swiper.min.css');
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/lib.js');
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/gulp/main.js');*/
	?>


	<!-- textarea editor -->
	<!-- <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
	 <script type="text/javascript">
		//<![CDATA[
		// bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		// text area do form de notícia
		bkLib.onDomLoaded(function() { area2 = new nicEditor({fullPanel : true}).panelInstance('texto-noticia'); })
		//]]>
	</script>-->
	<!-- fim text area editor -->

</head>


<body>

	<?php

		require_once('header.php');

	 ?>

	<?php echo $content; ?>

	<?php

		//if(Yii::app()->controller->id != 'embarcacoes' && Yii::app()->controller->action->id != 'view') {
			require_once('footer.php');
		//}

	 ?>

</body>
</html>
