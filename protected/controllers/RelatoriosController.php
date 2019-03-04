<?php

class RelatoriosController extends GxController {

    public function filters() {
        return array(
                'accessControl',
                );
    }

    public function accessRules() {
        return array(
                array('allow',
                    'actions' => array('relatorioGeralDeEmails', 'perguntasClassificados', 'teste', 'relatorioDeBanner'),
                                                    'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
                        return true;
                    }
                    return false;
                }
                ),
                array('allow',
                    'actions' => array('dashboardMarcas', 'dashboardModelos', 'dashboardMeusModelos'),
                    'users' => array('@'),
                ),
                array('deny',
                    'users'=>array('*'),
                    ),
                );

    }


    public function actionDashboardMarcas($de = null, $ate = null, $periodo = null) {

        if($de == 'null' && $ate == 'null' && $periodo == 'null') {
            $periodo = 9999;
        }

        $relatorio = new Relatorio();

        $rel_marcas = $relatorio->dashboardMarcas($de, $ate, $periodo);
        $nome_arquivo = "marcas_mais_buscadas_catalogo_bb";

        $relatorio->array_to_csv_download_rank_marcas($rel_marcas, $nome_arquivo.".csv", $de, $ate);
        
    }

    public function actionDashboardModelos($de = null, $ate = null, $periodo = null) {

        if($de == 'null' && $ate == 'null' && $periodo == 'null') {
            $periodo = 9999;
        }

        $relatorio = new Relatorio();

        $rel_modelos = $relatorio->dashboardModelos($de, $ate, $periodo);
        $nome_arquivo = "modelos_mais_buscados_catalogo_bb";

        $relatorio->array_to_csv_download_rank_modelos($rel_modelos, $nome_arquivo.".csv", $de, $ate);
        
    }

    public function actionDashboardMeusModelos($de = null, $ate = null, $periodo = null) {

        if($de == 'null' && $ate == 'null' && $periodo == 'null') {
            $periodo = 9999;
        }

        $relatorio = new Relatorio();

        $rel_modelos = $relatorio->dashboardMeusModelos($de, $ate, $periodo);
        $nome_arquivo = "meus_modelos_catalogo_bb";

        $relatorio->array_to_csv_download_rank_meus_modelos($rel_modelos, $nome_arquivo.".csv", $de, $ate);
        
    }


    public function actionPerguntasClassificados() {

        if(isset($_GET["de"]) && isset($_GET["ate"])) {

            $data_de = $_GET["de"];
            $data_ate = $_GET["ate"];

            $relatorio = new Relatorio();
            $emails = $relatorio->perguntasClassificados($data_de, $data_ate);

            foreach($emails as $e) {
                echo $e["email_rem"];
                echo "</br>";
            }

            //$array_to_csv = array();
            //$relatorio->array_to_csv_download($emails, "email_de_perguntas_classificados.csv");
        }
        
    }


    public function actionTeste() {

        //$dir = '/opt/lampp/temp';
        $dir = '/var/www/bombarco.com.br/tmp';

        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if (substr($file, 0, 5) === 'sess_') {
                    var_dump($file);
                    exit;
                    $filelastmodified = filemtime($dir . '/' . $file);
                    @unlink($dir . '/' . $file);
                }
            }
            closedir($handle);
        }
    }

    public function actionRelatorioGeralDeEmails() {

        if(Yii::app()->request->getPost("data_de") != "" && Yii::app()->request->getPost("data_ate") != "") {

            $data_de = Utils::formatDateTimeToDb(Yii::app()->request->getPost("data_de"));
            $data_ate = Utils::formatDateTimeToDb(Yii::app()->request->getPost("data_ate"));

            $relatorio = new Relatorio();

            $emails = $relatorio->relatorioGeralDeEmails($data_de, $data_ate);

            $nome_arquivo = "relatorio_de_emails_".Yii::app()->request->getPost("data_de") . "_".Yii::app()->request->getPost("data_ate");
            $relatorio->array_to_csv_download($emails, $nome_arquivo.".csv");
        }

        $this->render("relatorioGeralDeEmails");



    }



    public function actionRelatorioDeBanner() {

        $de = Yii::app()->request->getPost("de");
        $ate = Yii::app()->request->getPost("ate");
        $banners_id = Yii::app()->request->getPost("banners_id");

        $relatorio = new Relatorio();

        echo json_encode($relatorio->relatorioDeBanner($banners_id, $de, $ate), true);

        
        
    }


} // fim classe
