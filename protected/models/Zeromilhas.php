<?php
class Zeromilhas {
    

    public static function materiasRelacionadas($model) {

        if($model == null) {
            return array();
        }

        $criteria_noticias = new CDbCriteria();
        $criteria_noticias->with = array('conteudoImagens', 'conteudoCategorias');
        $criteria_noticias->limit = 4;
        $criteria_noticias->condition = 't.status = 1 AND t.macro = "N" AND (t.titulo LIKE :busca OR t.texto LIKE :busca OR conteudoCategorias.titulo LIKE :busca)';
        $criteria_noticias->params = array(':busca' => '%' . $model->slug . '%');
        $noticias = Conteudos::model()->findAll($criteria_noticias);

        return $noticias;
    }


    public static function devolverLogoEmpresa($empresa) {

        return Yii::app()->baseUrl . '/public/empresas/' . $empresa->logo;
    }

    public static function embarcsSemelhantes($model) {

        if($model == null) {
            return array();
        }

        $tamanho = (double) $model->embarcacaoModelos->tamanho;
        $tamanhoMax = $tamanho + 15.00;
        $tamanhoMin = $tamanho - 15.00;

        $sql = "select distinct embarcacoes.imagemprincipal, embarcacoes.id, embarcacoes.slug, embarcacao_fabricantes.titulo as fabricante, embarcacao_modelos.titulo as modelo, CONCAT(embarcacao_fabricantes.titulo, embarcacao_modelos.titulo) as titulo";
        $sql .= " from embarcacoes";
        $sql .= " inner join embarcacao_fabricantes on embarcacoes.embarcacao_fabricantes_id = embarcacao_fabricantes.id";
        $sql .= " inner join embarcacao_modelos on embarcacoes.embarcacao_modelos_id = embarcacao_modelos.id";
        $sql .= " inner join embarcacao_tipos on embarcacao_modelos.embarcacao_tipos_id = embarcacao_tipos.id";
        $sql .= " inner join embarcacao_imagens on embarcacoes.id = embarcacao_imagens.embarcacoes_id";
        $sql .= " inner join usuarios_embarcacoes on usuarios_embarcacoes.embarcacoes_id = embarcacoes.id";
        $sql .= " inner join empresas on empresas.id = usuarios_embarcacoes.empresas_id";
        $sql .= " where embarcacao_tipos.id = ".$model->embarcacaoModelos->embarcacaoTipos->id;
        $sql .= " and embarcacoes.status = 2";
        $sql .= " and embarcacoes.macros_id = 3";
        $sql .= " and embarcacao_modelos.tamanho >= ".$tamanhoMin;
        $sql .= " and embarcacao_modelos.tamanho <= ".$tamanhoMax;
        $sql .= " and embarcacoes.id <> ".$model->id;
        $sql .= " and empresas.destaque = 1";
        $sql .= " ORDER BY RAND()";
        $sql .= " LIMIT 10;";

        $embarcacoes_semelhantes = Yii::app()->db->createCommand($sql)->queryAll();

        // embarcações semelhantes (detalhe embarcação estaleiro)
        /*$id_tipo_embarcacao = $model->embarcacaoModelos->embarcacaoTipos->id;
        $criteria_semelhantes = new CDbCriteria;
        $criteria_semelhantes->with = array(
                                  'embarcacaoFabricantes',
                                  'embarcacaoModelos'=>array(
                                      'with'=>'embarcacaoTipos'
                                  ),
                                  'embarcacaoImagens'
                              );

        //$criteria_semelhantes->together = true;
        $criteria_semelhantes->condition = '(embarcacaoTipos.id =:embarcacao_tipos) AND (t.id != :emb_id) AND (t.status = :status) AND (t.macros_id = 3) AND (embarcacaoModelos.tamanho >= :tamanhoMin) AND (embarcacaoModelos.tamanho <= :tamanhoMax)';
        $criteria_semelhantes->params = array(':embarcacao_tipos' => $id_tipo_embarcacao, ':emb_id' => $model->id, ':status' => Embarcacoes::ACTIVE, ':tamanhoMin' => $tamanhoMin, ':tamanhoMax' => $tamanhoMax);
        $criteria_semelhantes->limit = 10;
        $embarcacoes_semelhantes = Embarcacoes::model()->findAll($criteria_semelhantes);

        foreach($embarcacoes_semelhantes as $key => $emb) {

            $id_empresa = UsuariosEmbarcacoes::model()->find('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $emb->id))->empresas_id;

            if($id_empresa != null) {

                $emp = Empresas::model()->findByPk($id_empresa);

                if($emp->destaque == 0) {
                    unset($embarcacoes_semelhantes[$key]);
                }
            }
        }*/

        return $embarcacoes_semelhantes;
    }

    public static function mountUrlOfertas($model) {

        $macros = array(
            0 => array('slug' => 'sem-macro', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            1 => array('slug' => 'jet-skis', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            2 => array('slug' => 'lanchas', 'condition' => array('N' => 'novas', 'U' => 'usadas')),
            3 => array('slug' => 'veleiros', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            4 => array('slug' => 'barcos-pesca', 'condition' => array('N' => 'novos', 'U' => 'usados')),
        );

        $slug = $model->embarcacaoModelos->embarcacaoFabricantes->slug . '-' . $model->embarcacaoModelos->slug . '-' . $model->id;

        $macro_id = $model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;

        $url = 'embarcacoes/';
        $url .= $macros[$macro_id]['slug'] . '-a-venda/';
        $url .= $model->embarcacaoModelos->embarcacaoFabricantes->slug . '/';

        $link = preg_replace("/\s/", "-", Yii::app()->createUrl($url));
        return $link;
    }

    public static function mountUrlTabela($model) {

        $url = Yii::app()->createUrl("tabela/".$model->embarcacaoModelos->embarcacaoFabricantes->slug);

        return $url;
    }


    public static function gerarLinkDetalhe($id_modelo, $slug_modelo = null) {

        $id_usuario = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:id", array(":id"=>$id_modelo))->usuarios_id;
        $estaleiro = Empresas::model()->find("usuarios_id=:id and macros_id = 3", array(":id"=>$id_usuario));

        if($estaleiro != null) {
            $link_detalhe = "/catalogo/".$estaleiro->slug."/".Embarcacoes::model()->findByPk($id_modelo)->slug;    
        }
        else {
            return $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        }        

        return $link_detalhe;
    }

    public static function checarDestaque($modelo) {

        $id_usuario = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:id", array(":id"=>$modelo->id))->usuarios_id;
        $estaleiro = Empresas::model()->find("usuarios_id=:id and macros_id = 3", array(":id"=>$id_usuario));

        if($estaleiro->destaque == 1) {
            return true;
        }

        return false;
    }

    public static function separarDestaque($modelos) {

        $destaques = array();
        $normais = array();

        foreach($modelos as $m) {

            $id_usuario = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:id", array(":id"=>$m->id));

            if($id_usuario == null) continue;

            $id_usuario = $id_usuario->usuarios_id;
            $estaleiro = Empresas::model()->find("usuarios_id=:id and macros_id = 3", array(":id"=>$id_usuario));

            if($estaleiro != null) {
                if($estaleiro->destaque == 1) {

                    $destaques[] = $m;
                }
                else {
                    $normais[] = $m;
                }    
            }

            
        }
        
        return array("destaques"=>$destaques, "normais"=>$normais);
    }


	public static function listarTipos() {

        $criteria = new CDbCriteria;
        $criteria->condition = 'status = 1 AND id NOT IN(0, 19, 22, 38, 25, 28, 30, 35, 27, 38, 21, 7, 24, 37, 10)';
        $criteria->order = "titulo asc";

		$tipos = EmbarcacaoTipos::model()->findAll($criteria);

		$resp = array();

		foreach($tipos as $index => $t) {

			$criteria = new CDbCriteria;
            $criteria->with = array('embarcacaoModelos');
            $criteria->together = true;
            $criteria->condition = "t.macros_id = 3 AND t.status = 2 AND embarcacaoModelos.embarcacao_tipos_id = ".$t->id;
            $count = Embarcacoes::model()->count($criteria); 

            if($count == 0) {
            	unset($tipos[$index]);
            	continue;
            }

            $reg = array();
            $reg["titulo"] = $t->titulo;
            $reg["slug"] = $t->slug;
            $reg["id"] = $t->id;
            $reg["count"] = $count;  

            $resp[] = $reg; 
		}

		return $resp;
	}

	public static function listarMarcas() {

		$criteria = new CDbCriteria;
        $criteria->condition = 'macros_id=:macros_id AND status = 2 AND logo IS NOT NULL';
        $criteria->order = "razao asc";
        $criteria->params = array(":macros_id"=>Macros::$macro_by_slug['estaleiro']);
		$marcas = Empresas::model()->findAll($criteria);

		$resp = array();

		foreach($marcas as $index => $m) {

            $array_with = array(
                'usuariosEmbarcacoes' => array(
                    'condition' => 'empresas_id = ' . $m->id
                ),
                'embarcacaoModelos'
            );

            $count = count(Embarcacoes::model()->with($array_with)->together()->findAllByAttributes(array('status' => 2, 'macros_id' => 3)));

            if($count == 0) {
            	unset($marcas[$index]);
            	continue;
            }

            $reg = array();
            $reg["razao"] = $m->razao;
            $reg["slug"] = $m->slug;
            $reg["id"] = $m->id;
            $reg["count"] = $count;  

            $resp[] = $reg; 
		}

		return $resp;

	}

    public static function devolverCategoria($slug_categoria) {

        $categorias = array("flybridge"=>2, "cabinada"=>1, "proa-aberta"=>5, "bass-boat"=>36, "pesca-em-geral"=>8, "jet-ski"=>29, "multicasco"=>27, "botes-inflaveis"=>9, "offshore"=>13, "veleiro"=>21, "pontoon"=>20, "aluminio"=>18, "jet-boat"=>33, "trawler"=>4, "console-central"=>27, "iate"=>6, "pratica-de-esporte"=>26, "fibra"=>34, "hard-top"=> 23, "cruzeiro"=>21, "aluminio-Alumínio"=>35, "2-passageiros"=>29, "inflavel"=>9);

        if(isset($categorias[$slug_categoria])) {

            return $categorias[$slug_categoria];
        }

        // retorna flybridge se n achou
        return 2;
    }

}


?>