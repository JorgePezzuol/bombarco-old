<?php

class UtilsController extends GxController {

    /**
     * Carrega as cidades baseado no estado
     * @return [type] [description]
     */
    public function actionLoadCities() {
        $estado_id = (int) $_POST['estados_id'];

        $data = Cidades::model()->findAll('estados_id=:estados_id', array(':estados_id' => $estado_id));
        $data = CHtml::listData($data, 'id', 'nome');

        echo "<option value=''>Cidades</option>";
        foreach ($data as $value => $nome)
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($nome), true);
    }

    /**
     * Carrega as cidades baseado no estado
     * @return [type] [description]
     */
    public function actionLoadCities2() {
        $estado_id = (int) $_POST['estados_id'];

        echo CJSON::encode(Cidades::model()->findAll('estados_id=:estados_id', array(':estados_id' => $estado_id)));
    }

    // consultar endereço com base no cep
    public function actionConsultarCep() {
        $cep = $_POST['cep'];

        $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);

        $dados['sucesso'] = (string) $reg->resultado;
        $dados['rua'] = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
        $dados['bairro'] = (string) $reg->bairro;
        $dados['cidade'] = (string) $reg->cidade;
        $dados['estado'] = (string) $reg->uf;

        echo json_encode($dados);
    }

    // carregar todos os modelos de motor baseado na marca e gerar o <select>
    public function actionLoadMotorModelos() {


        $motor_fabricantes_id = (int) $_POST['motor_fabricantes_id'];

        $data = MotorModelos::model()->findAll('motor_fabricantes_id=:motor_fabricantes_id AND status = 1 order by titulo asc', array(':motor_fabricantes_id' => $motor_fabricantes_id));

        echo CJSON::encode($data);

        /* $data = CHtml::listData($data,'id','titulo');

          echo "<option value=''>Modelos</option>";
          foreach($data as $value=>$titulo)
          echo CHtml::tag('option', array('value'=>$value), CHtml::encode($titulo), true); */
    }

    // carregar a potência do motor baseado em seu modelo
    public function actionLoadMotorModeloPotencia() {
        $motor_marcas_id = (int) $_POST['motor_fabricantes_id'];

        $data = MotorModelos::model()->findAll('id=:id', array(':id' => $motor_marcas_id + 1));
        $data = CHtml::listData($data, 'id', 'potencia');

        natsort($data);

        echo "<option value=''>Modelos</option>";
        foreach ($data as $value => $potencia)
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($potencia), true);
    }

    // método que consulta a potência de um dado ID de modelo de motor
    public function actionLoadPotenciaTipoMotor() {

        if (isset($_POST['id_modelo_motor'])) {
            // id do modelo de motor a ser buscado a potencia
            $id_modelo_motor = (int) $_POST['id_modelo_motor'];
            $motorPotencia = MotorModelos::model()->find('id=:id', array(':id' => $id_modelo_motor));

            // buscar o tipo do motor
            $motorTipo = MotorTipos::model()->find('id=:id', array(':id' => $motorPotencia->motor_tipos_id));


            if ($motorPotencia != null && $motorTipo != null) {
                // array que conterá a potencia e tipo do motor
                $motor = array();
                $motor["potencia"] = $motorPotencia->potencia;
                $motor["tipo"] = $motorTipo->titulo;
                $motor["tipo_id"] = $motorPotencia->motor_tipos_id;
                //echo $motor->potencia;
                echo json_encode($motor, true);
            } else {
                echo '-1';
            }
        }
    }

    // load tags
    public function actionLoadTags() {

        echo CJSON::encode(Tags::model()->findAll());
    }

    public function actionLoadAcessorios() {

        $macro_id = (int) $_POST['macro_id'];

        $acessorios = AcessorioModelos::model()->findAll('embarcacao_macros_id=:embarcacao_macros_id', array(':embarcacao_macros_id' => $macro_id));

        if (count($acessorios) > 0)
            echo CJSON::encode($acessorios);
        else
            echo "-1";
    }

    // método que lista todos os tipos de embarcação para formar o <select>
    public function actionLoadTiposEmbarcacao() {

        $embarcacao_macros_id = (int) $_POST['embarcacao_macros_id'];

        $tipos = EmbarcacaoTipos::model()->findAll('embarcacao_macros_id = :embarcacao_macros_id', array(':embarcacao_macros_id' => $embarcacao_macros_id));

        if (count($tipos) > 0) {
            echo CJSON::encode($tipos);
        } else {
            // erro
            echo "-1";
        }
    }

    // método que lista o num de passageiros dia/noite, o tipo da embarcação e o tamannho
    // baseado no ID do modelo
    public function actionLoadTipoTamanhoNumPassageiros() {

        $id_modelo_embarc = (int) $_POST['id_modelo_embarc'];

        // vai conter o tipo, tamanho e num de passageiros dia e noite
        $mapResponse = array();

        $modeloEmbarc = EmbarcacaoModelos::model()->find('id=:id', array(':id' => $id_modelo_embarc));

        if ($modeloEmbarc != null) {

            $tipoEmbarc = EmbarcacaoTipos::model()->find('id=:id', array(':id' => $modeloEmbarc->embarcacao_tipos_id));

            if ($tipoEmbarc != null) {
                $mapResponse["tipo"] = $tipoEmbarc->titulo;
                $mapResponse["id_tipo"] = $tipoEmbarc->id;
                $mapResponse["tamanho"] = $modeloEmbarc->tamanho;
                $mapResponse["dia"] = $modeloEmbarc->passageiros;
                $mapResponse["noite"] = $modeloEmbarc->acomodacoes;
                $mapResponse["motor_de_fabrica"] = $modeloEmbarc->motor_de_fabrica;

                // campos estaleiro
                $mapResponse["boca"] = $modeloEmbarc->boca;
                $mapResponse["pesocasco"] = $modeloEmbarc->pesocasco;
                $mapResponse["calado"] = $modeloEmbarc->calado;
                $mapResponse["pedireito"] = $modeloEmbarc->pedireito;
                $mapResponse["tanqueagua"] = $modeloEmbarc->tanqueagua;
                $mapResponse["tanquecombustivel"] = $modeloEmbarc->tanquecombustivel;
                $mapResponse["ncamarotes"] = $modeloEmbarc->ncamarotes;
                $mapResponse["nbanheiros"] = $modeloEmbarc->nbanheiros;
                echo json_encode($mapResponse, true);
            } else {
                echo "-1";
            }
        } else {
            echo "-1";
        }
    }

    // método que lista os fabricantes de acordo com a macro
    public function actionLoadFabricantesEmbarcacoes() {

        $embarcacao_macros_id = (int) $_POST['embarcacao_macros_id'];
        $status = 1;

        $fabricantes = EmbarcacaoFabricantes::model()->findAll('embarcacao_macros_id=:embarcacao_macros_id AND status=:status ORDER BY titulo ASC', array(':embarcacao_macros_id' => $embarcacao_macros_id, ':status' => $status));

        if (count($fabricantes) > 0) {
            echo CJSON::encode($fabricantes);
        } else {
            echo "-1";
        }
    }

    // método que lista os fabricantes DA TABELA BOMBARCO de acordo com a macro
    public function actionLoadFabricantesEmbarcacoesTabela() {

        $embarcacao_macros_id = (int) $_POST['embarcacao_macros_id'];
        $status = 1;

        $criteria = new CDbCriteria;
        $criteria->distinct = true;
        $criteria->join = 'INNER JOIN tabela_embarcacoes ON tabela_embarcacoes.embarcacao_fabricantes_id = t.id and t.embarcacao_macros_id =:embarcacao_macros_id';
        $criteria->params = array(':embarcacao_macros_id' => $embarcacao_macros_id);
        $criteria->order = 't.titulo ASC';
        $fabricantes = EmbarcacaoFabricantes::model()->findAll($criteria);

        echo CJSON::encode($fabricantes);
    }

    // método que lista todos os modelos do fabricante em questao
    public function actionLoadModelosEmbarcacoes() {

        $embarcacao_fabricantes_id = (int) $_POST['embarcacao_fabricantes_id'];

        $modelos = EmbarcacaoModelos::model()->findAll('embarcacao_fabricantes_id=:embarcacao_fabricantes_id AND status=1 ORDER BY titulo ASC', array(':embarcacao_fabricantes_id' => $embarcacao_fabricantes_id));

        if (count($modelos) > 0) {
            echo CJSON::encode($modelos);
        } else {
            echo "-1";
        }
    }

    public function actionLoadModelosEmbarcacoes2() {
        $embarcacao_fabricantes_id = (int) $_POST['embarcacao_fabricantes_id'];

        $data = EmbarcacaoModelos::model()->findAll('embarcacao_fabricantes_id=:embarcacao_fabricantes_id and status = 1 order by titulo asc', array(':embarcacao_fabricantes_id' => $embarcacao_fabricantes_id));
        $data = CHtml::listData($data, 'id', 'titulo');

        natsort($data);

        echo "<option value=''>Selecione</option>";
        foreach ($data as $value => $titulo)
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($titulo), true);
    }

    // método que lista todos os modelos do fabricante em questao (da tabela bombarco)
    public function actionLoadModelosEmbarcacoesTabela() {

        $embarcacao_fabricantes_id = (int) $_POST['embarcacao_fabricantes_id'];

        $criteria = new CDbCriteria;
        $criteria->distinct = true;
        $criteria->join = 'INNER JOIN tabela_embarcacoes ON tabela_embarcacoes.embarcacao_modelos_id = t.id and t.embarcacao_fabricantes_id=:embarcacao_fabricantes_id';
        $criteria->params = array(':embarcacao_fabricantes_id' => $embarcacao_fabricantes_id);
        $criteria->order = 't.titulo ASC';
        $modelos = EmbarcacaoModelos::model()->findAll($criteria);

        echo CJSON::encode($modelos);
    }

    // método que lista todos os modelos do fabricante em questao (da tabela bombarco)
    public function actionLoadModelosEmbarcacoesTabelaSlug() {

        $slug = $_POST['embarcacao_fabricantes_slug'];

        $embarcacao_fabricantes_id = EmbarcacaoFabricantes::model()->find("slug=:slug", array(":slug"=>$slug))->id;

        $criteria = new CDbCriteria;
        $criteria->distinct = true;
        $criteria->condition = 't.status = 1';
        $criteria->join = 'INNER JOIN tabela_embarcacoes ON tabela_embarcacoes.embarcacao_modelos_id = t.id and t.embarcacao_fabricantes_id=:embarcacao_fabricantes_id';
        $criteria->params = array(':embarcacao_fabricantes_id' => $embarcacao_fabricantes_id);
        $criteria->order = 't.titulo ASC';
        $modelos = EmbarcacaoModelos::model()->findAll($criteria);

        echo CJSON::encode($modelos);
    }

    // método que retorna o plano do usuário e as embarcações do plano
    public function actionObterEmbarcacoesDoPlano() {

        // ter certeza que usuário está logado
        if (Yii::app()->user->getId() > 0) {
            // obter o plano atual do usuário (caso tenha)
            $plano = Usuarios::getPlanoCorrenteAnuncio();

            if ($plano != null) {
                echo CJSON::encode($plano);
            } else {
                echo "-1";
            }
        } else {
            echo "-1";
        }
    }

    // método que traz todos os tipos de motores ativos
    public function actionLoadTiposMotor() {

        echo CJSON::encode(MotorTipos::model()->findAll('status = 1'));
    }

    // método executado para gerar uma transação dos pedidos (ordens)
    public function actionGerarTransacao() {

        $id_ordens = json_decode($_POST["id_ordens"]);

        // gera a transacao com base em todas as ordens do usuario com status 1
        $transacao = Usuarios::getTransacao($id_ordens);

        if ($transacao != null) {
            echo CJSON::encode($transacao);
        } else {
            echo "-1";
        }
    }

    // método eexecutado quando o usuario clica em cancelar a ordem de pedido
    public function actionCancelarOrdemDePedido() {

        $id = (int) $_POST['id_ordem'];

        // transaction
        $transaction = Yii::app()->db->beginTransaction();

        try {

            // verificar se a ordem a ser cancelada é do usuario logado (pode ter alterado o html)
            $usuarioLogado = Usuarios::model()->findByPk(Yii::app()->user->getId());

            // usuario ok
            if ($usuarioLogado != null) {
                // loop ordens do usuario
                foreach ($usuarioLogado->ordens as $ordem) {
                    // achou a ordem
                    if ($ordem->id == $id) {
                        // cancelar a ordem
                        // pegar o id do recurso adicional
                        $id_item = $ordem->id_item;
                        $alias_ordem = $ordem->ordemTipos->alias;

                        // id_item da ordem possui FK de um registro da tabela de `embarcacoes_has_embarcacao_recursos_adicionais`
                        if ($alias_ordem == 'plano_anuncio') {

                            // usuario decidiu deletar seu plano
                            $planoAnuncio = PlanoUsuarios::model()->find('id=:id', array(':id' => $id_item));

                            // buscar todas as embarcçaões preenchidas e deletar
                            foreach ($planoAnuncio->embarcacoes as $embarc) {

                                // deletar registros das embarcação na tabela EmbarcacoesHasEmbarcacaoRecursosAdicionais
                                foreach ($embarc->embarcacaoRecursosAdicionaises as $embarcRecAdicionais) {

                                    $embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()
                                            ->find('embarcacoes_id=:embarcacoes_id AND embarcacao_recursos_adicionais_id=:embarcacao_recursos_adicionais_id', array(
                                        ':embarcacoes_id' => $embarc->id,
                                        ':embarcacao_recursos_adicionais_id' => $embarcRecAdicionais->id));

                                    $ord = Ordens::model()->find('id_item=:id_item', array(':id_item' => $embarcRecAdicionais->id));

                                    foreach ($usuarioLogado->ordens as $o) {
                                        if ($o->id_item == $embarcRecAdicionais->id) {
                                            $o->delete();
                                        }
                                    }
                                }

                                EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->deleteAll('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $embarc->id));

                                // deletar acessorios
                                EmbarcacaoAcessorios::model()->deleteAll('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $embarc->id));

                                // embarcacao_motores
                                Motores::model()->deleteAll('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $embarc->id));

                                // usuarios embarcacoes
                                UsuariosEmbarcacoes::model()->deleteAll('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $embarc->id));

                                // imagens
                                EmbarcacaoImagens::model()->deleteAll('embarcacoes_id = :id', array(':id' => $embarc->id));

                                // impressoes
                                EmbarcacaoImpressoes::model()->deleteAll('embarcacoes_id = :id', array(':id' => $embarc->id));

                                // deletar embarc ?
                                $emb_a_deletar = Embarcacoes::model()->findByPk($embarc->id);
                                $emb_a_deletar->delete();
                            } // foreach


                            $planoAnuncio->status = Anuncio::$_status['INATIVA'];
                            $planoAnuncio->save();
                        } elseif ($alias_ordem == 'plano_empresa') {

                            // obter empresa
                            $empresa = Usuarios::getEmpresa();

                            // usuario decidiu deletar seu plano
                            $planoAnuncio = PlanoUsuarios::model()->find('id=:id', array(':id' => $id_item));

                            // deletar impressoes
                            EmpresasImpressoes::model()->deleteAll('empresas_id=:id', array(':id' => $empresa->id));

                            // deletar imagens
                            EmpresaImagens::model()->deleteAll('empresas_id=:id', array(':id' => $empresa->id));

                            // recs adicionais
                            $empresa = Usuarios::getUsuarioLogado()->empresa;
                            foreach ($empresa->empresaRecursosAdicionaises as $empresaRecAdicionais) {
                                foreach ($usuarioLogado->ordens as $o) {
                                    if ($o->id_item == $empresaRecAdicionais->id) {
                                        //$o->delete();
                                    }
                                }
                            }

                            foreach ($empresa->empresaRecursosAdicionaises as $empresaRecAdicionais) {
                                $e = EmpresasHasEmpresaRecursosAdicionais::model()
                                        ->find('empresas_id=:empresas_id AND empresa_recursos_adicionais_id=:id', array(':empresas_id' => $empresa->id, ':id' => $empresaRecAdicionais->id));

                                foreach ($usuarioLogado->ordens as $o) {
                                    if ($o->id_item == $e->id) {
                                        $o->delete();
                                    }
                                }
                            }
                            EmpresasHasEmpresaRecursosAdicionais::model()->deleteAll('empresas_id=:empresas_id', array(':empresas_id' => $empresa->id));

                            // atualizar tabela de UsuariosEmbarcacoes (pode ser que contratou plano de embarcação e criou um registr la)
                            $empresasComEmbarcacoes = UsuariosEmbarcacoes::model()->findAll('empresas_id=:empresas_id', array(':empresas_id' => $empresa->id));
                            if (count($empresasComEmbarcacoes) > 0) {
                                foreach ($empresasComEmbarcacoes as $e) {
                                    $e->empresas_id = null;
                                    $e->update();
                                }
                            }



                            /* foreach($embarc->embarcacaoRecursosAdicionaises as $embarcRecAdicionais) {

                              $embarcRecAdicionais=EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()
                              ->find('embarcacoes_id=:embarcacoes_id AND embarcacao_recursos_adicionais_id=:embarcacao_recursos_adicionais_id', array(
                              ':embarcacoes_id' => $embarc->id,
                              ':embarcacao_recursos_adicionais_id' => $embarcRecAdicionais->id));

                              $ord = Ordens::model()->find('id_item=:id_item', array(':id_item'=>$embarcRecAdicionais->id));

                              foreach($usuarioLogado->ordens as $o) {
                              if($o->id_item == $embarcRecAdicionais->id) {
                              $o->delete();
                              }
                              }
                              } */



                            // voltar usuario como pessoa física, já que deletou a empresa
                            Usuarios::model()->updateByPk(Yii::app()->user->id, array('pessoa' => 'F', 'usuarios_classificacoes_id' => 1));

                            // deletar da tabela empresas
                            $empresa->delete();


                            // deletar plano
                            $planoAnuncio->delete();
                        } elseif ($alias_ordem == 'adicional_embarcacao') {

                            // resgatar o registro do recurso adicional vinculado ao FK da ordem 
                            $embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->find('id=:id', array(':id' => $id_item));

                            if ($embarcRecAdicionais == null)
                                echo "-1";


                            if ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'fotos') {
                                foreach ($embarcRecAdicionais->embarcacoes->embarcacaoImagens as $embarcImg) {
                                    if ($embarcImg->turbo == 1) {
                                        if (!$embarcImg->delete())
                                            echo "-1";
                                    }
                                }
                            }


                            // se for URL de vidoe, vamos apagar o video da embarc
                            elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'video') {
                                $embarcRecAdicionais->embarcacoes->video = null;
                                $embarcRecAdicionais->embarcacoes->update();
                            }

                            // se for titulo
                            elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'titulo') {
                                $embarcRecAdicionais->embarcacoes->titulo = null;
                                $embarcRecAdicionais->embarcacoes->update();
                            }

                            // se for rec adicional de destaque na busca .. vamos voltar ao status 0 de destaque
                            elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'destaque_busca') {
                                $embarcRecAdicionais->embarcacoes->destaque = 0;
                                $embarcRecAdicionais->embarcacoes->update();
                            }

                            // se for cpm, apagar o registro da tabela EmbarcaoesIMpressoes
                            elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'cpm') {
                                $id_embarc = $embarcRecAdicionais->embarcacoes->id;
                                $impressao = EmbarcacaoImpressoes::model()->find("embarcacoes_id=:embarcacoes_id", array(":embarcacoes_id"=>$id_embarc));
                                
                                if(!$impressao->delete()) {
                                    echo "-1";
                                }
                                //EmbarcacaoImpressoes::model()->delete('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $id_embarc));
                            }

                            if (!$embarcRecAdicionais->delete())
                                echo "-1";
                        }

                        // ordem id_item possui um FK de algum turbinado de empresa, vamos verificar qual
                        elseif ($alias_ordem == 'adicional_empresa') {

                            // obter empresa
                            $empresa = Usuarios::getEmpresa();

                            // resgatar o registro do recurso adicional vinculado ao FK da ordem 
                            $empresaRecAdicionais = EmpresasHasEmpresaRecursosAdicionais::model()->find('id=:id', array(':id' => $id_item));

                            // erro
                            if ($empresaRecAdicionais == null)
                                echo "-1";

                            // verificar se é um rec adicional de imagem (caso for, temos q deletar as imagens)
                            if ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'fotos') {

                                // loop para deletar as fotos da empresa
                                foreach ($empresa->empresaImagens as $imagem) {
                                    if (!$imagem->delete())
                                        echo "-1";
                                }
                            }

                            // deletar cpm
                            elseif ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'cpm') {
                                $id_empresa = $empresa->id;
                                $empresaImpressoes = EmpresasImpressoes::model()->find('empresas_id=:empresas_id', array(':empresas_id' => $id_empresa));
                                $empresaImpressoes->delete();
                            }

                            // deletar video
                            elseif ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'video') {
                                $empresa->video = null;
                                $empresa->update();
                            }

                            // deletar telefone
                            elseif ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'telefone') {
                                $empresa->telefone = null;
                                $empresa->update();
                            }

                            // descrição
                            elseif ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'descricao') {
                                $empresa->descricao = null;
                                $empresa->update();
                            }


                            // deletar registro do recurso adicional
                            if (!$empresaRecAdicionais->delete()) {
                                echo "-1";
                            }
                        } else {
                            
                        }

                        // deletar ordem
                        $ordem->delete();
                    } // achou ordem
                } // foreach
                // commit

                $transaction->commit();
            } // if
        } catch (Exception $e) {
            $transaction->rollback();

            // salvar log de erro
            $logErro = new Logs;
            $logErro->chave = 'Erro cancelar ordem pedido';
            $logErro->valor = $e->getMessage();
            $logErro->save();
            echo '-1';
        }

        // ok
        echo "1";
    }

    /* ==========================================
      =            Actions de Selects            =
      ========================================== */

    /**
     * Retorna o HTML do DropDown de Modelos
     * a partir do fabricante
     * @return [type] [description]
     */
    public function actionLoadModelos() {

        $fabricante = $_POST['id'];

        echo EmbarcacaoModelos::selectBusca($fabricante);
    }

    /**
     * Retorna os valores mínimos e máximos de preco
     * a partir do modelo
     * @return [type] [description]
     */
    public function actionLoadRanges() {

        $modelo = $_POST['id'];

        echo Embarcacoes::selectRanges($modelo);
    }

    /**
     * Retorna os valores mínimos e máximos de pés
     * a partir do modelo
     * @return [type] [description]
     */
    public function actionLoadSizeRanges() {

        $macro = $_POST['macro_id'];
        $fabricante = (isset($_POST['fabricante_id'])) ? $_POST['fabricante_id'] : null;

        echo EmbarcacaoModelos::selectSizeRanges($macro, $fabricante);
    }

    /**
     * Action que Lista os tipos de embarcacoes
     * a partir da macro
     * @return [type] [description]
     */
    public function actionLoadTypes() {

        $macro = $_POST['id'];

        echo EmbarcacaoTipos::listTypes($macro);
    }

    /* -----  End of Actions de Selects  ------ */





    /* =========================================
      =            Actions Drop Down            =
      ========================================= */

    /**
     * Retorna o HTML do DropDown de Fabricantes
     * a partir da macro
     * @return [type] [description]
     */
    public function actionDropDownFabricantes() {

        $id = $_POST['id'];
        $input_name = $_POST['input_name'];
        $input_id = $_POST['input_id'];
        $placeholder = (isset($_POST['placeholder']) && !empty($_POST['placeholder'])) ? $_POST['placeholder'] : 'Selecione';
        $selected = (isset($_POST['selected']) && !empty($_POST['selected'])) ? $_POST['selected'] : '';

        //echo EmbarcacaoFabricantes::dropDownFormModelo($input_name, $input_id, $id, $placeholder, $selected);
        echo EmbarcacaoFabricantes::dropDown($input_name, $input_id, $id, $placeholder, $selected);
    }

    /**
     * Retorna o HTML do DropDown de Fabricantes
     * a partir da macro
     * @return [type] [description]
     */
    public function actionDropDownTipos() {

        $id = $_POST['id'];
        $input_name = $_POST['input_name'];
        $input_id = $_POST['input_id'];
        $placeholder = (isset($_POST['placeholder']) && !empty($_POST['placeholder'])) ? $_POST['placeholder'] : 'Selecione';
        $selected = (isset($_POST['selected']) && !empty($_POST['selected'])) ? $_POST['selected'] : '';

        echo EmbarcacaoTipos::dropDown($input_name, $input_id, $id, $placeholder, $selected);
    }

    /**
     * Retorna o HTML do DropDown de Fabricantes
     * a partir da macro
     * @return [type] [description]
     */
    public function actionDropDownModelos() {

        $id = $_POST['id'];
        $input_name = $_POST['input_name'];
        $input_id = $_POST['input_id'];
        $placeholder = (isset($_POST['placeholder']) && !empty($_POST['placeholder'])) ? $_POST['placeholder'] : 'Selecione';
        $selected = (isset($_POST['selected']) && !empty($_POST['selected'])) ? $_POST['selected'] : '';

        echo EmbarcacaoModelos::dropDown($input_name, $input_id, $id, $placeholder, $selected);
    }

    /* -----  End of Actions Drop Down  ------ */

    // APAGA OS sess_* files do diretorio /var/www/bombarco.com.br/tmp
    public function actionApagarArquivosDeSessaoTemporarios() {

        $dir = '/var/www/bombarco.com.br/tmp';

        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if (substr($file, 0, 5) === 'sess_') {
                    @unlink($dir . '/' . $file);
                }
            }
            closedir($handle);
        }
    }
}

// fim utils