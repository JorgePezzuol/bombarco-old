<?php

class ApiController extends GxController {

    public function filters() {
        return array(
                'accessControl',
                );
    }

    public function accessRules() {
        return array(
                array('allow',
                    'actions'=>array('semelhantes', 'noticias', 'outrosModelos'),
                    'users'=>array('*'),
                ),
                array('deny',
                    'users'=>array('*'),
                    ),
                );
    }


    public function actionNoticias() {

        header("Access-Controll-Allow-Origin: *");

        if(isset($_GET["t"]) && AccessToken::model()->findByPk($_GET["t"]) != null) {

            $modelo = $_GET["modelo"];
            $marca = $_GET["marca"];

            $sql = "SELECT conteudos.titulo, conteudo_imagens.imagem, LEFT(conteudos.texto, 100) AS texto, conteudos.slug";
            $sql .= " FROM conteudos";
            $sql .= " INNER JOIN conteudo_imagens ON conteudo_imagens.conteudos_id = conteudos.id";
            $sql .= " AND (conteudos.titulo LIKE '%".$marca."%' OR conteudos.texto LIKE '%".$modelo."%')";
            $sql .= " AND conteudos.status = 1";
            $sql .= " LIMIT 1";

            $noticias = Yii::app()->db->createCommand($sql)->queryAll();

            $noticias_array = array();

            foreach($noticias as $noticia) {

                $api = new Api();
                $api->setTitulo($noticia["titulo"]);
                $api->setImagemPrincipal($noticia["imagem"]);
                $api->setTexto($noticia["texto"]);
                $api->setUrl($noticia["slug"]);

                $noticias_array[] = $api->toArray();
            }


            echo json_encode($noticias_array);
        }


    }


    public function actionSemelhantes() {

        header("Access-Controll-Allow-Origin: *");

        if(isset($_GET["t"]) && AccessToken::model()->findByPk($_GET["t"]) != null) {

            $modelo = $_GET["modelo"];

            // criterio de semelhantes: mesmo modelo e entre tamanho(-5) e tamanho(+5)
            $tamanho = (double)$_GET["tamanho"];
            $tamanhoMin = $tamanho - 5;
            $tamanhoMax = $tamanho + 5;

            $sql = "SELECT embarcacoes.slug, embarcacoes.id, embarcacoes.imagemprincipal, embarcacao_fabricantes.titulo AS marca, embarcacao_modelos.titulo AS modelo";
            $sql .= " FROM embarcacoes";
            $sql .= " INNER JOIN embarcacao_modelos ON embarcacao_modelos.id = embarcacoes.embarcacao_modelos_id";
            $sql .= " INNER JOIN embarcacao_tipos ON embarcacao_tipos.id = embarcacao_modelos.embarcacao_tipos_id";
            $sql .= " INNER JOIN embarcacao_fabricantes ON embarcacao_fabricantes.id = embarcacoes.embarcacao_fabricantes_id";
            $sql .= " AND embarcacao_modelos.tamanho >= ".$tamanhoMin;
            $sql .= " AND embarcacao_modelos.tamanho <= ".$tamanhoMax;
            $sql .= " AND embarcacao_modelos.titulo LIKE '%".$modelo."%'";
            $sql .= " AND embarcacoes.status = 2";
            $sql .= " AND embarcacoes.macros_id = 3 LIMIT 4";

            $embarcacoes = Yii::app()->db->createCommand($sql)->queryAll();

            $semelhantes = array();

            foreach($embarcacoes as $embarc) {

                $api = new Api();
                $api->setImagemPrincipal($embarc["imagemprincipal"]);
                $api->setUrl($this->createAbsoluteUrl("estaleiros/".$embarc['marca']."/".$embarc["slug"]."/".$embarc["id"]));
                $api->setEmbarcacoesId($embarc["id"]);
                $api->setMarca($embarc["marca"]);
                $api->setUrlMarca(Empresas::getPaginaEstaleiro($embarc["id"]));
                $api->setModelo($embarc["modelo"]);

                $semelhantes[] = $api->toArray();
            }

            echo json_encode($semelhantes);
        }
    }

    public function actionOutrosModelos() {

        header("Access-Controll-Allow-Origin: *");

        if(isset($_GET["t"]) && AccessToken::model()->findByPk($_GET["t"]) != null) {

            $modelo = $_GET["modelo"];
            $marca = $_GET["marca"];

            $sql = "SELECT embarcacoes.slug, embarcacoes.id, embarcacoes.imagemprincipal, embarcacao_fabricantes.titulo as marca, embarcacao_modelos.titulo as modelo";
            $sql .= " FROM embarcacoes";
            $sql .= " INNER JOIN embarcacao_fabricantes ON embarcacao_fabricantes.id = embarcacoes.embarcacao_fabricantes_id";
            $sql .= " INNER JOIN embarcacao_modelos ON embarcacao_modelos.id = embarcacoes.embarcacao_modelos_id";
            $sql .= " AND embarcacao_modelos.titulo NOT LIKE '%".$modelo."%'";
            $sql .= " AND embarcacao_fabricantes.titulo LIKE '%".$marca."%'";
            $sql .= " AND embarcacoes.status = 2";
            $sql .= " AND embarcacoes.macros_id = 3 LIMIT 4";

            $embarcacoes = Yii::app()->db->createCommand($sql)->queryAll();

            $outros_modelos = array();

            foreach($embarcacoes as $embarc) {

                $api = new Api();
                $api->setImagemPrincipal($embarc["imagemprincipal"]);
                $api->setUrl($this->createAbsoluteUrl("estaleiros/".$embarc["marca"]."/".$embarc["slug"]."/".$embarc["id"]));
                $api->setEmbarcacoesId($embarc["id"]);
                $api->setMarca($embarc["marca"]);
                $api->setUrlMarca(Empresas::getPaginaEstaleiro($embarc["id"]));
                $api->setModelo($embarc["modelo"]);

                $outros_modelos[] = $api->toArray();
            }

            echo json_encode($outros_modelos);
        }
    }
} // fim classe
