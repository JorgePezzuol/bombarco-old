<div class="container-fluid">
    <div class="page-header">
        <h1>Gerar relatório de e-mails</h1>
    </div>
    <form method="post" class="form-inline" action="<?php echo Yii::app()->createUrl("relatorios/relatorioGeralDeEmails"); ?>">
        <div class="form-group">
            <label for="data_de">Data inicial:</label>
            <input type="text" class="form-control" name="data_de" id="data_de"/>
        </div>
        <div class="form-group">
            <label for="data_ate">Data Final:</label>
            <input type="text" class="form-control" name="data_ate" id="data_ate"/>
        </div>
        <button type="submit" class="btn btn-primary">Confirmar</button>
        <input type="hidden" name="gerar_relatorio" value="1"/>
    </form>
</div>


<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js'); ?>
<script>
	$(document).ready(function() {

		$("#data_de").mask("99/99/9999");
		$("#data_ate").mask("99/99/9999");
	});
</script>