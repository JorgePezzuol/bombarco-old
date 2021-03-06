<?php

// se tirar isso aqui, nao ta funcionando o update
Yii::import("application.models.Anuncio");

class EmbarcacoesController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('consultarDonoEmbarc', 'index', 'view', 'estaleiro', 'lista', 'busca', 'embarcacoes', 'loadmorefrombusiness', 'maisDesseAnunciante_mobile', 'validarImagem', 'contabilizarVerTelefone', 'atualizarAnunciosVencidos', 'buscaAnunciante'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('alterarOrdemImg', 'turbinar', 'favoritosMobile', 'listaEstaleiro', 'adminMinhasEmbarcsEstaleiro', 'create', 'update', 'admin', 'sucesso', 'updateFoto', 'deletarFoto', 'favoritos', 'favoritarEmbarcacao', 'desativarOuPausarAnuncio', 'desativarOuPausarAnuncio2', 'desfavoritarEmbarcacao', 'deletarAnuncio', 'uploadFotoAnuncio', 'expirarAnuncio', 'alterarOrdemImg2', 'alterarOrdemImg', 'adminSlugs', 'avisarModelo'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('admin', 'minicreate', 'create', 'delete', 'adminGeral', 'anuncioNaoAutorizado', 'adminEstaleiros', 'changeStatus', 'adminAnunciosParaValidar', 'ativarAnuncio', 'statusAnuncio', 'darTurbinadas', 'alteraSlug'),
                                'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin() || Yii::app()->user->isSeo()) {
                        return true;
                    }
                    return false;
                }
            ),
            array('deny', 
                'users' => array('*'),
            ),
        );
    }


    public function actionAvisarModelo() {

        if(isset($_POST)) {
            $embarcacao_fabricantes_id = $_POST["embarcacao_fabricantes_id"];
            $embarcacao_modelos_id = $_POST["embarcacao_modelos_id"];
            $embarcacao_macros_id = $_POST["embarcacao_macros_id"];

            $av = new AvisosMinhaConta();
            $av->embarcacao_fabricantes_id = $embarcacao_fabricantes_id;
            $av->embarcacao_modelos_id = $embarcacao_modelos_id;
            $av->embarcacao_macros_id = $_POST["embarcacao_macros_id"];
            $av->usuarios_id = Yii::app()->user->id;

            if($av->save()) {
                echo "1";
            }
            else {
                echo "0";
            }
        }
    }


    public function actionAlteraSlug() {


        $id = $_POST["id"];
        $slug = $_POST["slug"];

        $redirect = new Redirects();
        $redirect->de = Embarcacoes::model()->findByPk($id)->slug;
        $redirect->para = $slug;
        $redirect->status = 99;
        $redirect->save();

        echo Embarcacoes::model()->updateByPk($id, array("slug"=>$slug));    

    }

    public function actionAdminSlugs() {

        $embarcs = Embarcacoes::model()->findAll("status = 2");

        $this->render("admin_slug", array("embarcs" => $embarcs));

    }

    // atribuir turbinada a embarcação
    public function actionTurbinar($id) {

      $embarcacao = Embarcacoes::model()->findByPk($id);
      $usuario_embarcacoes = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:embarcacoes_id", array(":embarcacoes_id"=>$id));

      if($usuario_embarcacoes == null || $usuario_embarcacoes->usuarios_id != Yii::app()->user->id) {
          $this->redirect(array('embarcacoes/lista'));
      }  
      
        // se ja turbinou todas
        if(Embarcacoes::retornarQtdeTurbinadas($id) == count(Anuncio::$_turbinados_embarcacao)) {
              $this->redirect(array("anuncios/anuncioPagamento?minha_conta=1"));
        }

        // turbinados
        $recursosAdicionais = EmbarcacaoRecursosAdicionais::model()->listarRecursosAdicionais();

        // qtde de meses do plano do barco
        $plano_usuarios = $embarcacao->planoUsuarios;
        $meses = Planos::model()->findByPk($plano_usuarios->planos_id)->duracaomeses;

        if($meses == null) {
          $meses = 3;
        }

        // id do dono do barc
        $usuarios_id = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:embarcacoes_id", array(":embarcacoes_id" => $id))->usuarios_id;

        // ver se tem turbinada, e ver se passouo do limite de views ja
        $flgCpm = Embarcacoes::checkCpm($id);

        // verificar se marcou turbinado
        if (isset($_POST['Embarcacoes']['recursos_adicionais'])) {

            try {

                    // transaction
                    $transaction = Yii::app()->db->beginTransaction();

                      // loop para verificar os recursos adicionais escolhidos
                      foreach ($_POST['Embarcacoes']['recursos_adicionais'] as $idTurbinado) {

                          // para cada turbinado escolhido criar o objeto que relaciona os turbinados a empresa
                          $embarcRecs = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
                          $embarcRecs->embarcacoes_id = $id;
                          $embarcRecs->embarcacao_recursos_adicionais_id = $idTurbinado;
                          $embarcRecs->save();


                          // criar ordem de plano
                          $ordem = new Ordens;
                          $ordem->usuarios_id = $usuarios_id;

                          // se for CPM, o calculo do valor é diferente...

                          $ordem->valor = EmbarcacaoRecursosAdicionais::getPrecoPorId($idTurbinado);
                          $ordem->data_criacao = date("Y-m-d H:i:s");
                          // lembrar de por como constante (ID 5 da tabela ordens_tipo é RECURSO ADICIONAL EMBARCACAO)
                          $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['ADICIONAL_EMBARCACAO'];
                          $ordem->descricao = 'Turbinada anúncio ' . ' - ' . EmbarcacaoRecursosAdicionais::getTituloTurbinado($idTurbinado) . "| pedido: ".$id;
                          $ordem->status = Anuncio::$_status_ordem['CRIADA'];
                          // FK do item da ordem (aqui no caso é o ID do turbinado)
                          $ordem->id_item = (int) $embarcRecs->id;


                          // verificar se optou pelo turbinado de 10 imagens
                          if ($idTurbinado == Anuncio::$_turbinados_embarcacao['FOTOS']) {

                          } // if marcou turbinado fotos


                          // cpm
                          if ($idTurbinado == Anuncio::$_turbinados_embarcacao['CPM']) {

                              $impressao = EmbarcacaoImpressoes::model()->find("embarcacoes_id=:embarcacoes_id", array(":embarcacoes_id"=>$id));

                              if($impressao != null) {
                                $impressao->delete();
                              }

                              $ordem->valor = $_POST['hidden-valor-cpm'];
                              $embarcacaoImpressao = new EmbarcacaoImpressoes;
                              $limitedate = $_POST['EmbarcacaoImpressoes']['limitdate'];
                              // calcular o termino do cpm
                              $embarcacaoImpressao->limitdate = date('Y-m-d H:i:s', strtotime('today + ' . $limitedate . ' month'));
                              $embarcacaoImpressao->limitviews = $_POST['EmbarcacaoImpressoes']['limitviews'];
                              $embarcacaoImpressao->embarcacoes_id = $id;
                              $embarcacaoImpressao->save();
                          } // fim cpm



                          // titulo turbo
                          if($idTurbinado == Anuncio::$_turbinados_embarcacao["TITULO"] && $_POST["Embarcacoes"]["titulo"] != "") {

                                $embarcacao->titulo = $_POST['Embarcacoes']['titulo'];
                                $embarcacao->update();

                          } // fim titulo


                          // video turbo
                          if($idTurbinado == Anuncio::$_turbinados_embarcacao["VIDEO"] && $_POST["Embarcacoes"]["video"] != "") {

                                $embarcacao->video = $_POST['Embarcacoes']['video'];
                                $embarcacao->update();

                          } // fim video


                          // destaque
                          if($idTurbinado == Anuncio::$_turbinados_embarcacao["DESTAQUE_BUSCA"]) {
                                $embarcacao->destaque = Anuncio::$_status_destaque_embarcacao['PENDENTE'];
                          } // fim destaque

                          // salvar a ordem
                          $ordem->save();
                      } // loop turbinados

                      // transaction
                      $transaction->commit();
                      //Yii::app()->user->setFlash('success', 'データを保存しました'); 
                      Yii::app()->user->setFlash('success', 'Sucesso. Sua turbinada será ativada quando o pagamento for efetuado. <a href="'.Yii::app()->createUrl("anuncios/anuncioPagamento?minha_conta=1").'">Link de pagamentos</a>'); 

                      if(Embarcacoes::retornarQtdeTurbinadas($id) == count(Anuncio::$_turbinados_embarcacao)) {
                            $this->redirect(array("anuncios/anuncioPagamento?minha_conta=1"));
                      }

            } catch (Exception $ex) {
                  $transaction->rollback();
                  Yii::app()->user->setFlash('error', 'Ocorreu um erro inesperado, tente mais tarde.');
                  //var_dump("deu merda");
            }


            
        } // if marcou turbinado

        $this->render("dar_turbinadas", array('recursosAdicionais'=>$recursosAdicionais, 'meses'=>$meses, 'embarcacao' => $embarcacao, 'flgCpm'=>$flgCpm));
    }

    public function actionConsultarDonoEmbarc() {

        $embarcacoes_id = $_POST['embarcacacao_id'];
        $usuarios_id = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:embarcacoes_id", array(":embarcacoes_id"=> $embarcacoes_id))->usuarios_id;

        echo CJSON::encode(Usuarios::model()->findByPk($usuarios_id));

    }


    /**
     * Detalhe da Embarcacão com Estaleiro
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function actionEstaleiro($estaleiro, $modelo, $slug) {
      $this->redirect("/catalogo");
      exit;
      // pegando o ID a partir do@ slug
      $id = $slug;
      $fabricante = $estaleiro;
      // carregando model da embarcacão
      $model = $this->loadModel($id, 'Embarcacoes');

      // dar update em suas visualizações (soh contabilizar se nao for admin e não for eu mesmo)
      if (!Yii::app()->user->isAdmin() &&
              Yii::app()->user->id != UsuariosEmbarcacoes::model()
                      ->find('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $id))->usuarios_id) {
          $model->views += 1;
          $model->update();
      }

      // flags que indicam se o titulo do anuncio será exibido ou nao
      $flgTitulo = false;
      $flgVideo = false;

      if (Embarcacoes::checkTurbo($model, 'titulo') == true) {
          // indica que o titulo será exibido
          $flgTitulo = true;
      }

      if (Embarcacoes::checkTurbo($model, 'video') == true && $model->video != null) {
          // indica que o video será exibido
          $flgVideo = true;
      }

      // flag que indica se o usuario já favoritou essa embarcação
      $flgJaFavoritou = false;

      // testa se o usuario corrente ja favoritou a embarcação
      if (!Yii::app()->user->isGuest) {
          if (EmbarcacoesFavoritasUsuario::model()->exists('usuarios_id=:usuarios_id AND embarcacoes_id_embarcacao=:id_embarcacao', array(':usuarios_id' => Yii::app()->user->Id, ':id_embarcacao' => $model->id))) {
              // ja favoritou
              $flgJaFavoritou = true;
          }
      }

      // obter o ID do usuario dono da embarcação
      $usuarioDonoEmbarc = UsuariosEmbarcacoes::model()->find('embarcacoes_id = :embarcacoes_id', array(':embarcacoes_id' => $model->id));

      // obter dados do usuario em questao para exibir no detalhe da embarc
      $user = Usuarios::model()->findByPk($usuarioDonoEmbarc->usuarios_id);

      $estado = 'Não informado';
      $cidade = 'Não informado';
      $telefone = 'Não informado';
      $nomeEmpresa = ($user->pessoa == 'J') ? $user->nomefantasia : $user->nome;

      // dados do dono da embarcação a serem exibidos no detalhe
      $estado = Estados::model()->findByPk($user->estados_id);
      if (!empty($estado))
          $estado = $estado->nome;

      $cidade = Cidades::model()->findByPk($user->cidades_id);
      if (!empty($cidade))
          $cidade = $cidade->nome;

      if (!empty($user->telefone)) {
          $telefone = $user->telefone;

          if (!empty($user->celular))
              $telefone .= ' / ' . $user->celular;

      } else if (!empty($user->celular)) {
          $telefone = $user->celular;
      }

      if ($user->pessoa == Anuncio::$_pessoa['JURIDICA']) {

          // obter o nome da empresa, já q ele é uma pessoa jurídica
          $empresa = Empresas::model()->find('usuarios_id = :usuarios_id', array(':usuarios_id' => $user->id));

          if (!empty($empresa)) {

              $nomeEmpresa = $empresa->nomefantasia;

              if (!empty($empresa->cidades_id) && isset($empresa->cidades) && !empty($empresa->cidades))
                  $cidade = $empresa->cidades->nome;

              if (!empty($empresa->estados_id) && isset($empresa->estados) && !empty($empresa->estados))
                  $estado = $empresa->estados->nome;

              if (!empty($empresa->telefone))
                  $telefone = $empresa->telefone;
          }
      }

      // mais desse anunciante (estaleiro)
      $criteria = new CDbCriteria;
      $criteria->with = array('usuariosEmbarcacoes', 'embarcacaoModelos', 'embarcacaoImagens');
      $criteria->together = true;
      $criteria->condition = 'usuariosEmbarcacoes.usuarios_id = :user AND usuariosEmbarcacoes.embarcacoes_id != :emb_id AND t.status = :status AND t.macros_id = 3';
      $criteria->params = array(':user' => $usuarioDonoEmbarc->usuarios_id, ':emb_id' => $model->id, ':status' => Embarcacoes::ACTIVE);
      $embarcacoes = Embarcacoes::model()->findAll($criteria);

      // array contendo os ID's dos barcos mais deste anunciante
      $array_ids = array();
      foreach ($embarcacoes as $e) {
          $array_ids[] = $e->id;
      }


      $tamanho = (int) $model->embarcacaoModelos->tamanho;
      $tamanhoMax = $tamanho + 5;
      $tamanhoMin = $tamanho - 5;

      // embarcações semelhantes (detalhe embarcação estaleiro)
      $id_tipo_embarcacao = $model->embarcacaoModelos->embarcacaoTipos->id;
      $criteria_semelhantes = new CDbCriteria;
      $criteria_semelhantes->with = array(
                              'embarcacaoModelos'=>array(
                                  'with'=>'embarcacaoTipos'
                              ),
                              'embarcacaoImagens',
                              'usuariosEmbarcacoes'=>array(
                                  'with'=>array(
                                      'empresas' => array(
                                          'condition' => 'empresas.destaque = 1 AND empresas.status = 2'
                                      ),
                                  )
                              )
                          );

      //$criteria_semelhantes->together = true;
      $criteria_semelhantes->condition = '(embarcacaoTipos.id =:embarcacao_tipos) AND (t.id != :emb_id) AND (t.status = :status) AND (t.macros_id = 3) AND (embarcacaoModelos.tamanho >= :tamanhoMin) AND (embarcacaoModelos.tamanho <= :tamanhoMax)';
      $criteria_semelhantes->params = array(':embarcacao_tipos' => $id_tipo_embarcacao, ':emb_id' => $model->id, ':status' => Embarcacoes::ACTIVE, ':tamanhoMin' => $tamanhoMin, ':tamanhoMax' => $tamanhoMax);
      $embarcacoes_semelhantes = Embarcacoes::model()->findAll($criteria_semelhantes);

      // retirar as embarcacoes que podem vir "repetidas" da query do mais desse anunciante no array de semelhantes
      foreach($embarcacoes_semelhantes as $key => $value) {

          if (in_array($value->id, $array_ids)) {

              unset($embarcacoes_semelhantes[$key]);
          }
      }
   

      /* ==========  Breadcrumbs  ========== */

      // Macro vinda do Fabricante
      $macro_id = $model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;

      $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
      $breadcrumbs[] = array('texto' => 'Embarcacões', 'link' => Yii::app()->createUrl('embarcacoes'));
      if ($macro_id != 0) {
          $breadcrumbs[] = array('texto' => EmbarcacaoMacros::$macro[$macro_id] . ' à venda', 'link' => Yii::app()->createUrl('embarcacoes/' . EmbarcacaoMacros::$_macros[$macro_id]['slug'] . '-a-venda/'));
      }
      $breadcrumbs[] = array('texto' => $model->embarcacaoModelos->embarcacaoFabricantes->titulo, 'link' => EmbarcacaoFabricantes::mountUrl($model));
      $breadcrumbs[] = array('texto' => $model->embarcacaoModelos->titulo, 'link' => EmbarcacaoModelos::mountUrl($model));

      /* ==========  SEO  ========== */
      $title = array(EmbarcacaoMacros::$macro_singular[$macro_id],
                     $model->embarcacaoModelos->embarcacaoFabricantes->titulo,
                     $model->embarcacaoModelos->titulo);

      if (preg_match('/(\-nova|\-novas|\-novo|\-novos|\-usada|\-usadas|\-usado|\-usados)/', $_SERVER['REQUEST_URI']))
          $title[] = Embarcacoes::$_estado_f[$model->estado];

      Yii::app()->clientScript->registerMetaTag(Utils::mountDescription($title), 'description', null, array(), 'bombarco_description');
      $this->setPageTitle(Utils::mountTitle($title));

      $acessoriosJetSki = AcessorioModelos::listarAcessoriosJetSki();
      $acessoriosLancha = AcessorioModelos::listarAcessoriosLancha();
      $acessoriosVeleiro = AcessorioModelos::listarAcessoriosVeleiro();
      $acessoriosPesca = AcessorioModelos::listarAcessoriosPesca();


      /* ==========  Setando View  ========== */
      $view = 'view';
      $pag_estaleiro = '';

      // Se for uma embarcacão de Estaleiro
      if ((int) $model->macros_id == Macros::$macro_by_slug['estaleiro']) {

          // obter a pagina do estaleiro
          $pag_estaleiro = Empresas::getPaginaEstaleiro($model->id);
          $view = 'view-emba-esta'; // Detalhe diferente
      }


      /* meta tags compartilhar facebook */
      $img = EmbarcacaoImagens::obterImgPrincipalAbs($model->id);
      if (isset($model->embarcacaoImagens[0])) {

          // se tiver imagem, vamos por uma thumb ao compartilhar
          Yii::app()->clientScript->registerMetaTag(Yii::app()->request->baseUrl . '/public/embarcacoes/' . $img, 'og:image:secure_url');

      } else { // não tem imagem

          Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true) . '/img/sem_foto_bb.jpg', 'og:image');

      }

      Yii::app()->clientScript->registerMetaTag(Anuncio::$_categoria_por_numero[$macro_id] . ' ' . $model->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $model->embarcacaoModelos->titulo, 'og:title');
      Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true), 'og:site_name');
      Yii::app()->clientScript->registerMetaTag($model->descricao, 'og:description');
      /* fim meta tags */

      $this->render($view, array(
          'model' => $model,
          'flgJaFavoritou' => $flgJaFavoritou,
          'idUsuarioDonoEmbarc' => $usuarioDonoEmbarc->usuarios_id,
          'acessoriosJetSki' => $acessoriosJetSki,
          'acessoriosLancha' => $acessoriosLancha,
          'acessoriosVeleiro' => $acessoriosVeleiro,
          'acessoriosPesca' => $acessoriosPesca,
          'estado' => $estado,
          'cidade' => $cidade,
          'telefone' => $telefone,
          'nomeEmpresa' => $nomeEmpresa,
          'embarcacoes' => $embarcacoes,
          'embarcacoes_semelhantes' => $embarcacoes_semelhantes,
          'flgTitulo' => $flgTitulo,
          'breadcrumbs' => $breadcrumbs,
          'flgVideo' => $flgVideo,
          'pag_estaleiro' => $pag_estaleiro
      ));
    }

    /**
     * Área de turbinadas
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionDarTurbinadas($id) {

        $anuncio = Embarcacoes::model()->findByPk($id);
        $usuario = Usuarios::model()->find('id=:id', array(':id' => $anuncio->planoUsuarios->usuarios_id));
        $plano = PlanoUsuarios::model()->with('planos')->together()->find('planos.flag="plano_empresa" and usuarios_id', array(':usuarios_id' => $anuncio->planoUsuarios->usuarios_id));
        $dataFimPlano = Utils::formatDateTimeToView($plano->fim);

        $mensagem = '';

        if (isset($_POST['turbinadas']) && !empty($_POST['turbinadas'])) {

            $turbinadas = $_POST['turbinadas'];
            EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->deleteAll('embarcacoes_id = :id', array(':id'=>$id));

            foreach ($turbinadas as $turbo) {

                if ($turbo == 'cpm') {

                    $recAdicional = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
                    $recAdicional->embarcacoes_id = $id;
                    $recAdicional->embarcacao_recursos_adicionais_id = Anuncio::$_turbinados_embarcacao['CPM'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                } elseif ($turbo == 'fotos') {

                    $recAdicional = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
                    $recAdicional->embarcacoes_id = $id;
                    $recAdicional->embarcacao_recursos_adicionais_id = Anuncio::$_turbinados_embarcacao['FOTOS'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                } elseif ($turbo == 'video') {

                    $recAdicional = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
                    $recAdicional->embarcacoes_id = $id;
                    $recAdicional->embarcacao_recursos_adicionais_id = Anuncio::$_turbinados_embarcacao['VIDEO'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                } elseif ($turbo == 'destaque_busca') {

                    $recAdicional = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
                    $recAdicional->embarcacoes_id = $id;
                    $recAdicional->embarcacao_recursos_adicionais_id = Anuncio::$_turbinados_embarcacao['DESTAQUE_BUSCA'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                } elseif ($turbo == 'titulo') {

                    $recAdicional = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
                    $recAdicional->embarcacoes_id = $id;
                    $recAdicional->embarcacao_recursos_adicionais_id = Anuncio::$_turbinados_embarcacao['TITULO'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                }

            }

            $mensagem = 'Alterações salvas';
        }

        // Salvando CPM
        if (isset($_POST['cpm']) && !empty($_POST['cpm'])) {

            if (isset($anuncio->embarcacaoImpressoes) && !empty($anuncio->embarcacaoImpressoes[0])) {

                $impressoes = $anuncio->embarcacaoImpressoes[0];
                $impressoes->limitviews = $_POST['cpm'];
                $impressoes->limitdate = $anuncio->planoUsuarios->fim;
                $impressoes->save();

            } else {

                $impressoes = new EmbarcacaoImpressoes;
                $impressoes->embarcacoes_id = $id;
                $impressoes->limitviews = $_POST['cpm'];
                $impressoes->limitdate = $anuncio->planoUsuarios->fim;
                $impressoes->status = 1;
                $impressoes->save();
            }

            $anuncio = Embarcacoes::model()->findByPk($id);
        }

        $this->render('turbinadas_anuncio', array('anuncio' => $anuncio, 'dataFimPlano' => $dataFimPlano, 'mensagem' => $mensagem));
    }

    public function actionSucesso() {
        $this->render('sucesso');
    }

    public function actionContabilizarVerTelefone() {

        if (isset($_POST['id_embarcacao'])) {

            $user = UsuariosEmbarcacoes::model()->find('embarcacoes_id=:emb_id', array(':emb_id' => $_POST['id_embarcacao']));
            if ($user->usuarios_id != Yii::app()->user->id && !Yii::app()->user->isAdmin()) {
                $id = (int) $_POST['id_embarcacao'];
                $emb = Embarcacoes::model()->findByPk($id);
                $emb->vertelefone += 1;
                $emb->update();
            }
        }
    }

    /**
     * Extendendo loadModel para validar permissão do user logado
     * @param  [type] $key        [description]
     * @param  [type] $modelClass [description]
     * @return [type]             [description]
     */
    public function loadModel($key, $modelClass) {
        $model = parent::loadModel($key, $modelClass);

        if (!Yii::app()->user->isAdmin() && Yii::app()->controller->action->id === 'update') {

            // Se essa embarcacão me pertence retorna o Model
            if ($model->usuariosEmbarcacoes[0]->usuarios_id == Yii::app()->user->id) {
                return $model;
            } else { // se não redireciona para Admin
                $this->redirect(array('admin'));
            }
        } else {

            // Se a embarcação não estiver Ativa e eu não for o dono dela nem for o Admin BomBarco
            // redireciona de volta para a página anterior
            if (empty($model) || ($model->status != Embarcacoes::ACTIVE && $model->status != Embarcacoes::SOLD && $model->status != Embarcacoes::EXPIRED && $model->usuariosEmbarcacoes[0]->usuarios_id != Yii::app()->user->id && !Yii::app()->user->isAdmin()))
                $this->redirect(Yii::app()->homeUrl);

            return $model;
        }
    }

    /**
     * Carrega a "home" de Embarcacoes, sem nenhum filtro ou busca
     * é aquela página que se divide em cada Macro
     * @return [type] [description]
     */
    public function actionIndex() {

        $criteria = new CDbCriteria();
        $criteria->with = array('cidades', 'estados', 'embarcacaoImagens');
        $criteria->limit = 3;
        $criteria->order = 'RAND()';
        $criteria->condition = 't.embarcacao_macros_id = :macro AND t.status = :status AND t.macros_id != :macro_estaleiro';
        $criteria->params = array(':macro_estaleiro' => Macros::$macro_by_slug['estaleiro'], ':status' => Embarcacoes::ACTIVE);

        $criteria->params[':macro'] = EmbarcacaoMacros::$macro_by_slug['jetski'];
        $jetskis = Embarcacoes::model()->findAll($criteria);

        $criteria->params[':macro'] = EmbarcacaoMacros::$macro_by_slug['lancha'];
        $lanchas = Embarcacoes::model()->findAll($criteria);

        $criteria->params[':macro'] = EmbarcacaoMacros::$macro_by_slug['veleiro'];
        $veleiros = Embarcacoes::model()->findAll($criteria);

        $criteria->params[':macro'] = EmbarcacaoMacros::$macro_by_slug['barcos-pesca'];
        $pescas = Embarcacoes::model()->findAll($criteria);

        $this->render('index', array(
            'jetskis' => $jetskis,
            'lanchas' => $lanchas,
            'veleiros' => $veleiros,
            'pescas' => $pescas
        ));
    }

    public function actionBuscaAnunciante($anunciante) {

        //Embarcacoes::atualizarAnunciosVencidos(); 

        $tmp = explode("-", $anunciante);
        $usuarios_id = end($tmp);

        // Array de valores para a view
        $array_view = array();
        

        $user = Usuarios::model()->findByPk($usuarios_id);

        $nomeEmpresa = ($user->nome != '') ? $user->nome : $user->nomefantasia;
        $array_view["anunciante"] = $nomeEmpresa;
        $array_view["usuarioDonoEmbarc"] = $user;

        $criteria = new CDbCriteria();
        $criteria->with = array(
                                  'embarcacaoImagens', 
                                  'planoUsuarios'=>array("with"=>"usuarios")
                                );
        //$criteria->condition = ' t.status = :status AND t.macros_id != :macro_estaleiros AND planoUsuarios.status = 2 AND planoUsuarios.inicio < NOW() AND planoUsuarios.fim > NOW()';
        $criteria->condition = ' t.status = :status AND t.macros_id != :macro_estaleiros AND planoUsuarios.status = 2 and usuarios.id = :usuarios_id';

        $params = array(':macro_estaleiros' => Macros::$macro_by_slug['estaleiro'], ':status' => Embarcacoes::ACTIVE, ':usuarios_id' => $usuarios_id);       

        // Ordenando resultado
        $criteria->order = 't.valor DESC';
        $criteria->params = $params;

        /* ==========  executando Busca  ========== */
        $embarcacoes = Embarcacoes::model()->findAll($criteria);
        $array_view['embarcacoes'] = $embarcacoes;
    
        $this->setPageTitle($anunciante . " | Bombarco");
        Yii::app()->clientScript->registerMetaTag("Encontre lanchas com ótimos preços no Bombarco. O melhor site de classificados náuticos do Brasil. Pesquise agora.", 'description', null, array(), 'bombarco_description');

        $this->render('busca_anunciante', array(
            'array_view' => $array_view
            )
        );
        
    }

    /**
     * Action de Busca
     * @param  integer $macro    [Jetski, Lancha ou Veleiro]
     * @param  integer $condicao [Novo ou Usado]
     * @return [type]            [description]
     */
    public function actionBusca() {

        //Embarcacoes::atualizarAnunciosVencidos(); 

        // Array de valores para a view
        $array_view = array();

        /* ==========  Recuperando valores querystring  ========== */
        $macro = Yii::app()->request->getParam('macro') != null ? (int) Yii::app()->request->getParam('macro') : 0;
        $condicao = Yii::app()->request->getParam('condicao');
        $fabricante_slug = Yii::app()->request->getParam('fabricante');
        $modelo_slug = Yii::app()->request->getParam('modelo');
        $preco_min = Yii::app()->request->getParam('preco-min');
        $preco_max = Yii::app()->request->getParam('preco-max');
        $pes_min = Yii::app()->request->getParam('pes-min');
        $pes_max = Yii::app()->request->getParam('pes-max');
        $tipos = (Yii::app()->request->getParam('tipos') != null) ? explode('&', Yii::app()->request->getParam('tipos')) : null;
        $uf_slug = Yii::app()->request->getParam('local');
        $ordem = Yii::app()->request->getParam('ordem');
        $busca = Yii::app()->request->getParam('buscando');

        $ordem = preg_replace('/[^A-ù]/', "", $ordem);

        if ($busca != null) {
            // log de busca
            $log = new LogBuscas;
            $log->data = date("Y-m-d h:i:s");
            $log->usuario = Yii::app()->user->id;
            $log->busca = $busca;
            $log->ip = $_SERVER['REMOTE_ADDR'];
            $log->save();
        }


        if($fabricante_slug == "triton-boats") {
            $fabricante_slug = "triton-yachts";
        }
         

        // páginando
        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Embarcacoes::LIMIT_SEARCH) : null;

        // Se for ajax vem TRUE, para retornar um HTML
        $ajax = Yii::app()->request->getParam('ajax');

        $criteria = new CDbCriteria();
        $criteria->with = array(
                                  'embarcacaoImagens', 
                                  'planoUsuarios'=>array("with"=>"usuarios")
                                );
        //$criteria->condition = ' t.status = :status AND t.macros_id != :macro_estaleiros AND planoUsuarios.status = 2 AND planoUsuarios.inicio < NOW() AND planoUsuarios.fim > NOW()';
        $criteria->condition = ' t.status = :status AND t.macros_id != :macro_estaleiros AND planoUsuarios.status = 2';
        $criteria->limit = Embarcacoes::LIMIT_SEARCH;

        $params = array(':macro_estaleiros' => Macros::$macro_by_slug['estaleiro'], ':status' => Embarcacoes::ACTIVE);

        // Iniciando Criteria
        // para filtrar o resultado
        $criteria->offset = $offset;

        // Ordenando resultado
        if ($ordem != "") {
            $criteria->order = 't.valor ' . $ordem;
        } else {
            $criteria->order = 'RAND(:hour)';
            $params[':hour'] = date('ymdh');
        }

        /* ==========  Array com os parametros vindos da URL  ========== */
        $array_params = array(
            'macro' => $macro,
            'condicao' => $condicao,
            'fabricante' => $fabricante_slug,
            'modelo' => $modelo_slug,
            'preco_min' => $preco_min,
            'preco_max' => $preco_max,
            'pes_min' => $pes_min,
            'pes_max' => $pes_max,
            'uf' => $uf_slug,
            'tipos' => ($tipos != null) ? Yii::app()->request->getParam('tipos') : null,
            'ordem' => $ordem,
            'busca' => $busca
        );


        // Macro de embarcacoes
        $array_view['macro'] = $macro;
        if ($macro != 0) {

            // Trazendo somente anúncios de Fabricantes de Pesca
            $criteria->with += array('embarcacaoModelos' => array(
                                                                'with' => 'embarcacaoFabricantes',
                                                                'condition' => 'embarcacaoFabricantes.embarcacao_macros_id = :macro',
                                                                'params' => array(':macro'=>$macro)
                                                                )
                                                            );

            //$criteria->addCondition('t.embarcacao_macros_id = :macro');
            //$params[':macro'] = $macro;
        }

        // Estado da embarcacao (Nova/Usada)
        if ($condicao != null) { // Se for NULL vem os 2 (Novo e Usado)
            $criteria->addCondition("t.estado = :condicao");
            $params[':condicao'] = $condicao;
            $array_view['condicao'] = $condicao;
        }

        // Fabricante
        if ($fabricante_slug != null) {
          	$busca = null;
            $fabricante = EmbarcacaoFabricantes::model()->findByAttributes(array('slug' => $fabricante_slug, 'embarcacao_macros_id' => $macro));

            if (!empty($fabricante)) {
                $array_view['fabricante'] = $fabricante;

                $criteria->addCondition('embarcacaoModelos.embarcacao_fabricantes_id = :fabricante');
                $params[':fabricante'] = $fabricante->id;
            }
        }


        // Modelo
        if ($modelo_slug != null && !empty($fabricante)) {

            $modelo = EmbarcacaoModelos::model()->findByAttributes(array('slug' => $modelo_slug, 'embarcacao_fabricantes_id' => $fabricante->id));

            if ($modelo != null) {
                $array_view['modelo'] = $modelo;

                $criteria->addCondition('t.embarcacao_modelos_id = :modelo');
                $params[':modelo'] = $modelo->id;
            }
        } else { // Se não tiver modelo, pode procurar por Tipo

            $array_view['tipos'] = $tipos;

            // Tipo
            if ($tipos != null) {

                // Filtrando tipos
                $criteria_tipos = new CDbCriteria();
                $criteria_tipos->with = array('embarcacaoModeloses');
                $criteria_tipos->addInCondition('t.slug', $tipos);

                // Seleciona o tipo e os modelos que fazem parte dele
                $tipo_modelos = EmbarcacaoTipos::model()->findAll($criteria_tipos);

                if ($tipo_modelos != null) {

                    // Monta o array de IDs de modelos
                    $modelos_ids = array();
                    foreach ($tipo_modelos as $key => $value) {

                        foreach ($value->embarcacaoModeloses as $key2 => $value2) {
                            $modelos_ids[] = $value2->id;
                        }
                    }
                }
            }
        }

        // Localizacão
        if ($uf_slug != null) {
            $uf = Estados::model()->findByAttributes(array('slug' => $uf_slug));
            if (!empty($uf)) {
                $criteria->addCondition('t.estados_id = :uf');
                $params[':uf'] = $uf->id;
                $array_view['uf'] = $uf;
            }
        }

        // Busca digitada
        if ($busca != null) {

            // casos específicos de marcas
            if ($busca == 'schaefer' || $busca == 'Schaefer') {
                $busca = 'schaefer yachts';
            } elseif ($busca == 'triton' || $busca == 'Triton') {
                $busca = 'triton boats';
            } elseif ($busca == 'real' || $busca == 'Real') {
                $busca = 'Real Powerboats';
            }

            // LIKE
            // tirando espaços e colocando caractér 'coringa' no lugar dos espaços
            $busca = str_replace(' ', '%', $busca);

            $criteria->addCondition('(t.slug LIKE :busca
											OR t.titulo LIKE :busca
                      OR usuarios.nome LIKE :busca
                      OR usuarios.razaosocial LIKE :busca
											OR t.descricao LIKE :busca
											OR embarcacaoModelos.titulo LIKE :busca
											OR embarcacaoFabricantes.titulo LIKE :busca
											OR embarcacaoFabricantes.slug LIKE :busca
											OR embarcacaoModelos.slug LIKE :busca)');
            $params[':busca'] = '%' . $busca . '%';
        }

        // parametros da busca
        $criteria->params = $params;

        // Se existem Tipos e um array de IDs de modelos
        if ($tipos != null && isset($modelos_ids)) {
            // Add um filtro
            $criteria->addInCondition('t.embarcacao_modelos_id', $modelos_ids);
        }


        /*==========  Entre precos  ==========*/
        // Se existe preço mínimo ou máximo
        if ($preco_min != null || $preco_max != null) {

            // se tem preço mínimo
            if ($preco_min != null) {
                $preco_min = number_format(str_replace('.', '', $preco_min), 2, '.', '');
                $array_view['preco_min'] = $preco_min;
            } else {
                $preco_min = 1.00;
            }

            // se tem preço máximo
            if ($preco_max != null) {
                $preco_max = number_format(str_replace('.', '', $preco_max), 2, '.', '');
                $preco_max = ($preco_max == 2000000.00) ? 999999999.99 : $preco_max;
                $array_view['preco_max'] = $preco_max;
            } else {
                $preco_max = 999999999.99;
            }

            $criteria->addBetweenCondition('t.valor', $preco_min, $preco_max);

            // Nunca aparecer SEM PREÇO
            $criteria->addCondition('t.valor IS NOT NULL');
        }


        /*==========  Entre pés  ==========*/
        // Se existir pés mínimos ou máximos
        if ($pes_min != null || $pes_max != null) {

            $pes_min = (empty($pes_min)) ? 0 : intval($pes_min);
            $pes_max = ($pes_max != null && $pes_max < 200) ? intval($pes_max) : 9999;

            $criteria->addBetweenCondition('embarcacaoModelos.tamanho', $pes_min, $pes_max);

            // Nunca vir pés vazios
            $criteria->addCondition('embarcacaoModelos.tamanho > 0');

            $array_view['pes_min'] = $pes_min;
            $array_view['pes_max'] = $pes_max;
        }


        /* ==========  executando Busca  ========== */
        $embarcacoes = Embarcacoes::model()->findAll($criteria);
        $array_view['embarcacoes'] = $embarcacoes;

        /* milena solicitou que as embarcs com valor n informado viessem por ultimo */
        $embarc_sem_valor = array();
        foreach ($array_view['embarcacoes'] as $key => $embarc) {
        	$embimg = EmbarcacaoImagens::model()->find("embarcacoes_id=:id AND principal = 1", array(":id"=>$embarc->id));
            if($embarc->valor == 0.00 || $embimg == null) {
                $embarc_sem_valor[] = $embarc;
                unset($array_view['embarcacoes'][$key]);
            }
        }
        foreach($embarc_sem_valor as $e) {
            $array_view['embarcacoes'][] = $e;
        }
        /* fim solicitacao milena */

        // Executando via AJAX
        // HTML do Ver Mais.
        if ($ajax == true) {

            $html = '';

            /* milena solicitou que as embarcs com valor n informado viessem por ultimo */
            $embarc_sem_valor = array();
            foreach ($embarcacoes as $key => $embarc) {
            	$embimg = EmbarcacaoImagens::model()->find("embarcacoes_id=:id AND principal = 1", array(":id"=>$embarc->id));
                if($embarc->valor == 0.00 || $embimg == null) {
                    $embarc_sem_valor[] = $embarc;
                    unset($embarcacoes[$key]);
                }
            }
            foreach($embarc_sem_valor as $e) {
                $embarcacoes[] = $e;
            }
            /* fim solicitacao milena */

            foreach ($embarcacoes as $embarc) {

                // Macro vinda do Fabricante
                $macro_id = $embarc->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;

                if (Yii::app()->theme->name != 'mobile') {
                    $html .= '<li class="category-tabela">';

                    $html .= Embarcacoes::getThumb($embarc, array('class' => 'bg-img-tabela'), true);

                    if ($embarc->destaque == 2) {
                        $html .= '<i class="faixa-destaque-emba"></i>';
                    }

                    $html .= '<div class="textos-tabela-bb">';

                    $titulo = "";
                    if(Embarcacoes::checkTurbo($embarc, "titulo") == true) {
                        $titulo = $embarc->titulo;
                    }                                                                                                                                                                 

                    $html .= '<h2 class="text-tabela-bb-title">' . $embarc->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarc->embarcacaoModelos->titulo. ' '. '<b>'.$titulo.'</b></h2>';

                      if($embarc->status == Embarcacoes::ACTIVE) {

                            $html .= '<h2 class="text-tabela-bb-ano">Ano: <b>' . $embarc->ano . '</b></h2>';
                            $html .= '<h2 class="text-tabela-bb-estado">Estado: <b>' . Embarcacoes::$_estado[$embarc->estado] . '</b></h2>';
                            $html .= '<h2 class="text-tabela-bb-price">R$ ';
                            $embarc->valor > 0 ? $html .= number_format($embarc -> valor, 2, ',', '.') : $html .= "Valor não informado";
                            $html .= '</h2>';

                            $html .= '<div  style="cursor:pointer;" class="balao_contato" data-email="'. $embarc->email . '" data-embarcid="'. $embarc->id . '">';
                            $html .= '<img style="cursor:pointer; float:left;" class="balao" data-email="'. $embarc->email . '" data-embarcid="'. $embarc->id . '" src="'. Yii::app()->createUrl("img/icon_chat.png"). '"/>';
                            $html .= '<span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>';
                            $html .= '</div>';

                      }

                      else {
                            $html .= '<h2 class="text-tabela-bb-price">Anúncio vendido</h2>';
                      } 



                    // $html .= '<h2 class="text-tabela-bb-ano-rnd">'.$embarc->ano.'</h2>';
                    // $html .= '<h2 class="text-tabela-bb-estado-rnd">'.Embarcacoes::$_estado[$embarc->estado].'</h2>';

                    $html .= '</div>';

                    $html .= '</li>';
                } else {



                    // fazer aqui o html do tema mobile que será gerado para o ver mais
                    $html .= '<div class="result-content pure-g">';

                    $html .= '<a href="' . Embarcacoes::mountUrl($embarc) . '" class="link-result">';
                    $html .= '<div class="result-image pure-u-1-4">';
                    $html .= Embarcacoes::getThumb($embarc, array('class' => 'bg-img-tabela'), true);
                    $html .= '</div>';

                    $html .= '<div class="result-infos pure-u-3-4">';

                    $result_title = $embarc->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarc->embarcacaoModelos->titulo;
                    $result_pes = substr($embarc->embarcacaoModelos->tamanho, 0, strpos($embarc->embarcacaoModelos->tamanho, '.'));
                    $result_price = $embarc->valor != '0.00' ? Utils::formataValorView($embarc->valor) : "N/Info.";

                    $html .= '<div class="infos-content">';

                    if ($embarc->destaque == 2) {
                        $html .= '<div class="box-featured sprite"></div>';
                    }

                    $html .= '<article class="result-title">' . $result_title . ' </article>';


                    $html .= '<article class="info-content">';
                    if ($macro_id == 1) {
                        $html .= '<span class="info-text">' . $embarc->embarcacaoModelos->embarcacaoTipos->titulo . '</span>';
                    } else {
                        $html .= '<i class="ico-pes inline-block sprite"></i>';
                        $html .= '<span class="result-pes inline-block">' . $result_pes . ' PÉS</span>';
                    }

                    $html .= '<span class="result-price inline-block">R$ ' . $result_price . ' </span>';
                    $html .= '</article>';
                    $html .= '</div>';

                    $html .= '</div>';

                    $html .= '</a>';

                    $html .= '</div>';
                }
            }

            echo json_encode(array('html' => $html, 'count' => count($embarcacoes)));

        } else { // Renderizando a pagina


            /*==============================================
            =            BreadCrumbs e Metatags            =
            ==============================================*/

            $url = 'embarcacoes/';
            $title = array();

            $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
            $breadcrumbs[] = array('texto' => 'Embarcacões', 'link' => Yii::app()->createUrl($url));
            if ($macro != 0) {
                $breadcrumbs[] = array('texto' => EmbarcacaoMacros::$macro[$macro] . ' à venda', 'link' => Yii::app()->createUrl('embarcacoes/' . EmbarcacaoMacros::$_macros[$macro]['slug'] . '-a-venda/'));
                $title = array(EmbarcacaoMacros::$macro[$macro] . ' à venda');
            }

            if (!empty($condicao))
                $title = array(EmbarcacaoMacros::$macro[$macro], EmbarcacaoMacros::$_macros[$macro]['condition'][$condicao]);

            if (isset($fabricante) && $fabricante != null) {
                $breadcrumbs[] = array('texto' => $fabricante->titulo, 'link' => Yii::app()->createUrl('embarcacoes/' . EmbarcacaoMacros::$_macros[$macro]['slug'] . '-a-venda/' . $fabricante->slug));
                $title[] = $fabricante->titulo;
            }

            if (isset($modelo) && $modelo != null) {
                $breadcrumbs[] = array('texto' => $modelo->titulo, 'link' => Yii::app()->createUrl('embarcacoes/' . EmbarcacaoMacros::$_macros[$macro]['slug'] . '-a-venda/' . $fabricante->slug . '/' . $modelo->slug));
                $title[] = $modelo->titulo;
            }

            $this->setPageTitle(Utils::mountTitle($title) . " | Bombarco");
            Yii::app()->clientScript->registerMetaTag("Encontre " . Utils::mountTitle($title) . " com ótimos preços no Bombarco. O melhor site de classificados náuticos do Brasil. Pesquise agora.", 'description', null, array(), 'bombarco_description');

            /*-----  End of BreadCrumbs e Metatags  ------*/


            $this->render('busca', array(
                'array_view' => $array_view,
                'array_params' => $array_params,
                'breadcrumbs' => $breadcrumbs
                )
            );
        }
    }

    // action executado via ajax que valida o tamanho máximo da imagem de anuncios de embarcs
    // Return: 		-1 => erro
    // 				 1 => sucesso ao validar a imagem
    public function actionValidarImagem() {

        // pega imagem do preview
        $imagem = CUploadedFile::getInstanceByName('imagem');

        $size = $imagem->size / 1024;

        if ($imagem->type != Anuncio::$_extensoes_permitidas['JPEG'] && $imagem->type != Anuncio::$_extensoes_permitidas['JPG'] && $imagem->type != Anuncio::$_extensoes_permitidas['PNG']) {
            echo '-1';
            exit;
        }

        // se for mais que 1000 kb, informar erro
        if ($size > 1020 || $size < 20) {

            echo '-1';
            exit;
        } else {

            echo '1';
        }
    }

    /**
     * Detalhe da Embarcacão
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function actionView($fabricante = null, $modelo = null, $slug) {

        // pegando o ID a partir do slug
        $tmp = explode("-", $slug);
        $id = end($tmp);

        // carregando model da embarcacão
        if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
            $model = Embarcacoes::model()->findByPk($id);
        }
        else {
          $model = $this->loadModel($id, 'Embarcacoes');
        }

        if($model->macros_id == 3) {

            $link_detalhe = Zeromilhas::gerarLinkDetalhe($model->id);
            $this->redirect(Yii::app()->createUrl($link_detalhe));
            exit;
        }

        /*if (
            empty($model) ||
            $model->embarcacaoModelos->slug != $modelo ||
            $model->embarcacaoModelos->embarcacaoFabricantes->slug != $fabricante
            )
            //throw new CHttpException(404, "Anúncio não encontrado");
            $this->redirect(Yii::app()->createUrl("embarcacoes/lanchas-a-venda"));*/
        if(empty($model)) {
            $this->redirect(Yii::app()->createUrl("embarcacoes/lanchas-a-venda"));
        }

        // dar update em suas visualizações (soh contabilizar se nao for admin e não for eu mesmo)
        if (!Yii::app()->user->isAdmin() &&
                Yii::app()->user->id != UsuariosEmbarcacoes::model()
                        ->find('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $id))->usuarios_id) {
            $model->views += 1;
            $model->update();
        }

        // flags que indicam se o titulo do anuncio será exibido ou nao
        $flgTitulo = false;
        $flgVideo = false;

        if (Embarcacoes::checkTurbo($model, 'titulo') == true) {
            // indica que o titulo será exibido
            $flgTitulo = true;
        }

        if (Embarcacoes::checkTurbo($model, 'video') == true && $model->video != null) {
            // indica que o video será exibido
            $flgVideo = true;
        }

        // flag que indica se o usuario já favoritou essa embarcação
        $flgJaFavoritou = false;

        // testa se o usuario corrente ja favoritou a embarcação
        if (!Yii::app()->user->isGuest) {
            if (EmbarcacoesFavoritasUsuario::model()->exists('usuarios_id=:usuarios_id AND embarcacoes_id_embarcacao=:id_embarcacao', array(':usuarios_id' => Yii::app()->user->Id, ':id_embarcacao' => $model->id))) {
                // ja favoritou
                $flgJaFavoritou = true;
            }
        }

        // obter o ID do usuario dono da embarcação
        $usuarioDonoEmbarc = UsuariosEmbarcacoes::model()->find('embarcacoes_id = :embarcacoes_id', array(':embarcacoes_id' => $model->id));

        // obter dados do usuario em questao para exibir no detalhe da embarc
        $user = Usuarios::model()->findByPk($usuarioDonoEmbarc->usuarios_id);

        $estado = 'Não informado';
        $cidade = 'Não informado';
        $telefone = 'Não informado';
        $nomeEmpresa = ($user->pessoa == 'J') ? $user->nomefantasia : $user->nome;

        // dados do dono da embarcação a serem exibidos no detalhe
        $estado = Estados::model()->findByPk($user->estados_id);
        if (!empty($estado))
            $estado = $estado->nome;

        $cidade = Cidades::model()->findByPk($user->cidades_id);
        if (!empty($cidade))
            $cidade = $cidade->nome;

        if (!empty($user->telefone)) {
            $telefone = $user->telefone;

            if (!empty($user->celular))
                $telefone .= ' / ' . $user->celular;

        } else if (!empty($user->celular)) {
            $telefone = $user->celular;
        }

        if ($user->pessoa == Anuncio::$_pessoa['JURIDICA']) {

            // obter o nome da empresa, já q ele é uma pessoa jurídica
            $empresa = Empresas::model()->find('usuarios_id = :usuarios_id', array(':usuarios_id' => $user->id));

            if (!empty($empresa)) {

                $nomeEmpresa = $empresa->nomefantasia;

                if (!empty($empresa->cidades_id) && isset($empresa->cidades) && !empty($empresa->cidades))
                    $cidade = $empresa->cidades->nome;

                if (!empty($empresa->estados_id) && isset($empresa->estados) && !empty($empresa->estados))
                    $estado = $empresa->estados->nome;

                if (!empty($empresa->telefone))
                    //$telefone = $empresa->telefone;
                    $telefone = $user->celular;
            }
        }



            // mais desse anunciante (estaleiro)
            $criteria = new CDbCriteria;
            $criteria->with = array('usuariosEmbarcacoes', 'embarcacaoModelos', 'embarcacaoImagens');
            $criteria->together = true;

            // criteria semelhantes
            $criteria_semelhantes = new CDbCriteria;


            // estaleiro sewmelhantes
             if ($model->macros_id == 3) {

                  $criteria->condition = 'usuariosEmbarcacoes.usuarios_id = :user AND usuariosEmbarcacoes.embarcacoes_id != :emb_id AND t.status = :status AND t.macros_id = 3';

                  $criteria_semelhantes->with = array(
                        'embarcacaoModelos'=>array(
                            'with'=>'embarcacaoTipos'
                        ),
                        'embarcacaoImagens',
                        'usuariosEmbarcacoes'=>array(
                            'with'=>array(
                                'empresas' => array(
                                    'condition' => 'empresas.destaque = 1'
                                )
                            )
                        )
                    );

                  $criteria_semelhantes->condition = '(embarcacaoTipos.id =:embarcacao_tipos) AND (t.id != :emb_id) AND (t.status = :status) AND (t.macros_id = 3) AND (embarcacaoModelos.tamanho >= :tamanhoMin) AND (embarcacaoModelos.tamanho <= :tamanhoMax)';
             }

             // anuncio normal sewmelhantes
             else {

                  $criteria->condition = 'usuariosEmbarcacoes.usuarios_id = :user AND usuariosEmbarcacoes.embarcacoes_id != :emb_id AND t.status = :status AND t.macros_id != 3'; 

                  $criteria_semelhantes->with = array(
                      'embarcacaoModelos'=>array(
                          'with'=>'embarcacaoTipos'
                      ),
                      'embarcacaoImagens',
                      'usuariosEmbarcacoes'
                  );
                  $criteria_semelhantes->condition = '(embarcacaoTipos.id =:embarcacao_tipos) AND (t.id != :emb_id) AND (t.status = :status) AND (t.macros_id != 3) AND (embarcacaoModelos.tamanho >= :tamanhoMin) AND (embarcacaoModelos.tamanho <= :tamanhoMax)';

             }

            $criteria->params = array(':user' => $usuarioDonoEmbarc->usuarios_id, ':emb_id' => $model->id, ':status' => Embarcacoes::ACTIVE);
            $embarcacoes = Embarcacoes::model()->findAll($criteria);

            // array contendo os ID's dos barcos mais deste anunciante
            $array_ids = array();
            foreach ($embarcacoes as $e) {
                $array_ids[] = $e->id;
            }


            $tamanho = (int) $model->embarcacaoModelos->tamanho;
            $tamanhoMax = $tamanho + 3;
            $tamanhoMin = $tamanho - 3;

            // embarcações semelhantes (detalhe embarcação estaleiro)
            $id_tipo_embarcacao = $model->embarcacaoModelos->embarcacaoTipos->id;
            $criteria_semelhantes->together = true;
            $criteria_semelhantes->params = array(':embarcacao_tipos' => $id_tipo_embarcacao, ':emb_id' => $model->id, ':status' => Embarcacoes::ACTIVE, ':tamanhoMin' => $tamanhoMin, ':tamanhoMax' => $tamanhoMax);
            $embarcacoes_semelhantes = Embarcacoes::model()->findAll($criteria_semelhantes);

            // retirar as embarcacoes que podem vir "repetidas" da query do mais desse anunciante no array de semelhantes
            for ($i = 0; $i < count($embarcacoes_semelhantes); $i++) {
                if (in_array($embarcacoes_semelhantes[$i]->id, $array_ids)) {
                    unset($embarcacoes_semelhantes[$i]);
                }
            }
        



        /* ==========  Breadcrumbs  ========== */

        // Macro vinda do Fabricante
        $macro_id = $model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;

        $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
        $breadcrumbs[] = array('texto' => 'Embarcacões', 'link' => Yii::app()->createUrl('embarcacoes'));
        if ($macro_id != 0) {
            $breadcrumbs[] = array('texto' => EmbarcacaoMacros::$macro[$macro_id] . ' à venda', 'link' => Yii::app()->createUrl('embarcacoes/' . EmbarcacaoMacros::$_macros[$macro_id]['slug'] . '-a-venda/'));
        }
        $breadcrumbs[] = array('texto' => $model->embarcacaoModelos->embarcacaoFabricantes->titulo, 'link' => EmbarcacaoFabricantes::mountUrl($model));
        $breadcrumbs[] = array('texto' => $model->embarcacaoModelos->titulo, 'link' => EmbarcacaoModelos::mountUrl($model));

        /* ==========  SEO  ========== */
        $title = array(EmbarcacaoMacros::$macro_singular[$macro_id],
                       $model->embarcacaoModelos->embarcacaoFabricantes->titulo,
                       $model->embarcacaoModelos->titulo);

        if (preg_match('/(\-nova|\-novas|\-novo|\-novos|\-usada|\-usadas|\-usado|\-usados)/', $_SERVER['REQUEST_URI']))
            $title[] = Embarcacoes::$_estado_f[$model->estado];

        Yii::app()->clientScript->registerMetaTag(Utils::mountDescription($title), 'description', null, array(), 'bombarco_description');
        $this->setPageTitle(Utils::mountTitle($title));


        $acessoriosJetSki = AcessorioModelos::listarAcessoriosJetSki();
        $acessoriosLancha = AcessorioModelos::listarAcessoriosLancha();
        $acessoriosVeleiro = AcessorioModelos::listarAcessoriosVeleiro();
        $acessoriosPesca = AcessorioModelos::listarAcessoriosPesca();


        /* ==========  Setando View  ========== */
        if(Utils::checarSeEhMobile() == true) {
          $view = 'view_mobile';
        }
        else {
          $view = 'view';  
        }
        
        $pag_estaleiro = '';

        // Se for uma embarcacão de Estaleiro
        if ((int) $model->macros_id == Macros::$macro_by_slug['estaleiro']) {

            // obter a pagina do estaleiro
            $pag_estaleiro = Empresas::getPaginaEstaleiro($model->id);
            $view = 'view-emba-esta'; // Detalhe diferente
        }


        $img = EmbarcacaoImagens::obterImgPrincipalAbs($model->id);
        

        // se tiver imagem, vamos por uma thumb ao compartilhar
        Yii::app()->clientScript->registerMetaTag("https://www.bombarco.com.br" . Yii::app()->request->baseUrl . $img, 'og:image');
        //Yii::app()->clientScript->registerMetaTag(Yii::app()->request->baseUrl . '/public/embarcacoes/' . $img, 'og:image');

        /*else { // não tem imagem

            Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true) . '/img/sem_foto_bb.jpg', 'og:image');

        }*/

        Yii::app()->clientScript->registerMetaTag(Anuncio::$_categoria_por_numero[$macro_id] . ' ' . $model->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $model->embarcacaoModelos->titulo, 'og:title');
        Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true), 'og:site_name');
        Yii::app()->clientScript->registerMetaTag($model->descricao, 'og:description');
        /* fim meta tags */
		
        $cv = new ClassificadosViewsModelos();
        $cv->embarcacoes_id = $model->id;
        $cv->data = date('Y-m-d H:i:s');
        $cv->save();

        $this->render($view, array(
            'model' => $model,
            'flgJaFavoritou' => $flgJaFavoritou,
            'idUsuarioDonoEmbarc' => $usuarioDonoEmbarc->usuarios_id,
            'acessoriosJetSki' => $acessoriosJetSki,
            'acessoriosLancha' => $acessoriosLancha,
            'acessoriosVeleiro' => $acessoriosVeleiro,
            'acessoriosPesca' => $acessoriosPesca,
            'estado' => $estado,
            'cidade' => $cidade,
            'telefone' => $telefone,
            'nomeEmpresa' => $nomeEmpresa,
            'embarcacoes' => $embarcacoes,
            'embarcacoes_semelhantes' => $embarcacoes_semelhantes,
            'flgTitulo' => $flgTitulo,
            'breadcrumbs' => $breadcrumbs,
            'flgVideo' => $flgVideo,
            'pag_estaleiro' => $pag_estaleiro,
            'title' => $title
        ));
    }

    /* action de carregar mais deste anunciante para o mobile */

    public function actionMaisDesseAnunciante_mobile() {

        // carregar mais (mobile)
        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Embarcacoes::LIMIT_SEARCH) : null;

        $usuarios_id = Yii::app()->request->getParam('usuarios_id');

        $embarcacoes_id = Yii::app()->request->getParam('embarcacoes_id');

        $embarcacoes = Embarcacoes::maisDesseAnunciante_mobile($usuarios_id, $embarcacoes_id, $offset);

        $html = '';

        foreach ($embarcacoes as $emb) {

            // Macro vinda do Fabricante
            $macro_id = $emb->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;

            $result_title = $emb->embarcacaoFabricantes->titulo . ' ' . $emb->embarcacaoModelos->titulo;
            $result_pes = substr($emb->embarcacaoModelos->tamanho, 0, strpos($emb->embarcacaoModelos->tamanho, '.'));
            $result_price = $emb->valor != '0.00' ? Utils::formataValorView($emb->valor) : "Não informado";

            $html .= '<div class="result-content pure-g">';
            $html .= '<a href="' . Embarcacoes::mountUrl($emb) . '" class="link-result">';
            $html .= '<div class="result-image pure-u-1-4">';
            $html .= Embarcacoes::getThumb($emb, array('class' => 'bg-img-resbus'), true);
            $html .= '</div>';
            $html .= '<div class="result-infos pure-u-3-4">';
            $html .= '<div class="infos-content">';

            if ($emb->destaque == 2) {
                $html .= '<div class="box-featured sprite"></div>';
            }

            $html .= '<article class="result-title">' . $result_title . '</article>';


            if ($macro_id == 1) {

                $html .= '<article class="info-content inline-block">';
                $html .= '<span class="info-text info-text-passageiros">' . $emb->embarcacaoModelos->embarcacaoTipos->titulo . '</span>';
                $html .= '</article>';
            } else {

                $html .= '<i class="ico-pes inline-block sprite"></i>';
                $html .= '<span class="result-pes inline-block">';

                if ($result_pes == '0.00') {
                    $html .= 'N/F';
                } else {
                    $html .= $result_price . ' Pés';
                }
            }


            $html .= '</span>';
            $html .= '<span class="result-price inline-block">';
            $html .= $result_price;
            $html .= '</span>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</a>';
            $html .= '</div>';
        }

        echo json_encode(array('html' => $html, 'count' => count($embarcacoes)));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Embarcacoes')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    // action grid embarcacoes de estaleiro do usuario logado
    public function actionListaEstaleiro() {

        $model = new Embarcacoes('searchMinhasEmbarcsEstaleiro');
        $model->unsetAttributes();


        if (isset($_GET['Embarcacoes']))
            $model->setAttributes($_GET['Embarcacoes']);

        $this->render('listaEstaleiro', array(
            'model' => $model,
        ));
    }

    // action grid embarcacoes de estaleiro do usuario logado
    public function actionAdminMinhasEmbarcsEstaleiro() {

        $model = new Embarcacoes('searchMinhasEmbarcsEstaleiro');
        $model->unsetAttributes();


        if (isset($_GET['Embarcacoes']))
            $model->setAttributes($_GET['Embarcacoes']);

        $this->render('admin_minhas_embarcs_estaleiro', array(
            'model' => $model,
        ));
    }

    // grid todos os anuncios do usuario logado
    public function actionLista() {

        // veio do email pra desativar a embarc
        if(isset($_GET["id"])) {
            $embarc = Embarcacoes::model()->findByPk($_GET["id"]);
            $embarc->status = Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"];
            $embarc->update();
        }

        unset($_GET['active']);
        $model = new Embarcacoes('search');

        $model->unsetAttributes();

        if (isset($_GET['Embarcacoes']))
            $model->setAttributes($_GET['Embarcacoes']);

        $this->render('lista', array(
            'model' => $model,
        ));
    }

    // grid todos os anuncios do usuario logado
    public function actionAdmin() {

        $model = new Embarcacoes('search');

        $model->unsetAttributes();

        if (isset($_GET['Embarcacoes']))
            $model->setAttributes($_GET['Embarcacoes']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    // grid todos as embarcs de estaleiro
    public function actionAdminEstaleiros() {

        $model = new Embarcacoes('searchEmbarcacoesEstaleiro');
        $model->unsetAttributes();


        if (isset($_GET['Embarcacoes']))
            $model->setAttributes($_GET['Embarcacoes']);

        $this->render('admin_embarcacoes_estaleiros', array(
            'model' => $model,
        ));
    }

    // grid todos os anuncios do site
    public function actionAdminGeral() {

        $model = new Embarcacoes('searchAdmin');
        $model->unsetAttributes();


        if (isset($_GET['Embarcacoes']))
            $model->setAttributes($_GET['Embarcacoes']);

        $this->render('admin_geral', array(
            'model' => $model,
        ));
    }

    // grid anuncios pagos para o admin validar
    public function actionAdminAnunciosParaValidar() {

        $model = new Embarcacoes('searchAdminAnunciosParaValidar');
        $model->unsetAttributes();

        if (isset($_GET['Embarcacoes']))
            $model->setAttributes($_GET['Embarcacoes']);

        $this->render('admin_anuncios', array(
            'model' => $model,
        ));
    }

    public function actionFavoritosMobile() {

        $criteria = new CDbCriteria;
        $criteria->join = 'INNER JOIN embarcacoes_favoritas_usuario on embarcacoes_favoritas_usuario.embarcacoes_id_embarcacao = t.id';
        $criteria->condition = 'usuarios_id=:usuarios_id';
        $criteria->params = array(':usuarios_id' => Yii::app()->user->id);
        $embs = Embarcacoes::model()->findAll($criteria);


        $this->render('favoritos', array(
            'embarcacoes' => $embs,
        ));
    }

    // grid favoritos do usuario logado
    public function actionFavoritos() {

        $model = new Embarcacoes('favoritos');
        $model->unsetAttributes();


        if (isset($_GET['Embarcacoes'])) {

            $model->setAttributes($_GET['Embarcacoes']);
        }

        $this->render('favoritos', array(
            'model' => $model,
        ));
    }

    // método executado via ajax para favoritar a embarcação
    public function actionFavoritarEmbarcacao() {

        $id_embarcacao = $_POST['id_embarcacao'];
        $id_embarcacao = preg_replace('/[^0-9]/', "", $id_embarcacao);
        $id_usuario = Yii::app()->user->Id;

        if (Embarcacoes::model()->exists('id=:id', array(':id' => $id_embarcacao))) {
            $embFavorita = new EmbarcacoesFavoritasUsuario;
            $embFavorita->usuarios_id = (int) $id_usuario;
            $embFavorita->embarcacoes_id_embarcacao = (int) $id_embarcacao;

            // retornar resposta do ajax
            if (!$embFavorita->save()) {
                // erro
                echo '-1';
            } else {
                // ok
                echo '1';
            }
        } else {
            echo '-1';
        }
    }

    // método executado via ajax para desfavoritar a embarcação
    public function actionDesfavoritarEmbarcacao($id_embarcacao = null) {

        if ($id_embarcacao == null) {
            $id_embarcacao = $_POST['id_embarcacao'];
        }
        $id_usuario = Yii::app()->user->Id;

        $embFavorita = EmbarcacoesFavoritasUsuario::model()->find('usuarios_id = :usuario AND embarcacoes_id_embarcacao = :embarcacao', array(':usuario' => $id_usuario, ':embarcacao' => $id_embarcacao));

        // retornar resposta do ajax
        if (!$embFavorita->delete()) {
            // erro
            echo '-1';
        } else {
            // ok
            echo '1';
        }
    }

    public function actionUpdate($id) {

        // model da embarcação a ser editado
        

        if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
            $model = Embarcacoes::model()->findByPk($id);
        }
        else {
          $model = $this->loadModel($id, 'Embarcacoes');
        }

        $fabricantes_id_old = $model->embarcacao_fabricantes_id;
        $model_id_old = $model->embarcacao_modelos_id;

        $motor = Motores::model()->find('embarcacoes_id =:emb_id', array(':emb_id' => $model->id));

        if ($motor == null) {
            $motor = new Motores;
        }

        // flg indica se é embarc de estaleiro
        $flgEstaleiro = false;
        if ($model->macros_id == Anuncio::$_macros['ESTALEIRO']) {
            $flgEstaleiro = true;
        }

        // listar turbinados
        $recursosAdicionais = EmbarcacaoRecursosAdicionais::model()->listarRecursosAdicionais();

        // listar todos os tipos de acessórios passando o ID das macros de embarcação (jetski, lancha, veleiro)
        $acessoriosJetSki = AcessorioModelos::listarAcessoriosJetSki();
        $acessoriosLancha = AcessorioModelos::listarAcessoriosLancha();
        $acessoriosVeleiro = AcessorioModelos::listarAcessoriosVeleiro();
        $acessoriosPesca = AcessorioModelos::listarAcessoriosPesca();

        // array que contem os acessorios ja selecionados pelo usuario
        $acessoriosJatem = array();
        foreach ($model->embarcacaoAcessorioses as $acessCorrente) {
            $acessoriosJatem[] = $acessCorrente->acessorios_id;
        }


        // submitou formulario
        if (isset($_POST['Embarcacoes'])) {

            // transaction
            $transaction = Yii::app()->db->beginTransaction();

            try {

                $model->setAttributes($_POST['Embarcacoes']);

                // Setando fabricante na mão, Yii não pegou
                $model->embarcacao_fabricantes_id = (isset($_POST['Embarcacoes']['embarcacao_fabricantes_id'])) ? $_POST['Embarcacoes']['embarcacao_fabricantes_id'] : $model->embarcacao_fabricantes_id;

                $limitepreco = (isset($model->planoUsuarios->planos->limitepreco)) ? $model->planoUsuarios->planos->limitepreco : 0.00;

                // plano gratuito n tem limite de preço
                if($model->planoUsuarios->gratuito == 1) {
                  $limitepreco = 0.00;
                }

                if ($limitepreco != 0.00) {

                    if ((int) str_replace(array('.', ','), array('', '.'), $model->valor) > (int) $limitepreco) {
                        $model->addError('valor', 'Limite de preço atingido');
                        throw new Exception("Limte de preço atingido", 1);
                    }
                }

                $model->valor = Utils::formataValor($model->valor);

                // se for o anuncio gratuito, mandar pro admin validar
                if($model->planoUsuarios->gratuito == 1) {

                    if($fabricantes_id_old != $model->embarcacao_fabricantes_id) {
                      $model->status = 1;
                    }

                    if($model_id_old != $model->embarcacao_modelos_id) {
                      $model->status = 1;
                    }
                }

                $fabricante = EmbarcacaoFabricantes::model()->findByPk($model->embarcacao_fabricantes_id)->titulo;
                $modelo = EmbarcacaoModelos::model()->findByPk($model->embarcacao_modelos_id)->titulo;
                $slug = $fabricante . "-" .$modelo;

                if(Embarcacoes::model()->find("slug=:slug and id <> :id", array(":slug"=>$slug, ":id"=>$model->id)) != null) {
                  $model->slug = $slug."-".$model->id;
                }
                $model->slug = $slug;


                if (!$model->update()) {
                    $model->addError('embarcacao_macros_id', 'Erro ao atualizar anúncio');
                    throw new Exception("Erro ao atualizar anúncio", 1);
                }

                if (isset($_POST['Motores'])) {

                    if ($model->qntmotores == 0) {

                        if (count($model->motores) > 0) {
                            $motores = Motores::model()->findAll('embarcacoes_id=:emb_id', array(':emb_id' => $model->id));

                            foreach ($motores as $m) {
                                $m->delete();
                            }
                        }
                    } else {

                        $motores = Motores::model()->findAll('embarcacoes_id=:emb_id', array(':emb_id' => $model->id));

                        foreach ($motores as $m) {
                            $m->delete();
                        }

                        $motor->setAttributes($_POST['Motores']);

                        for ($i = 0; $i < $model->qntmotores; $i++) {
                            $m = new Motores;
                            $m->motor_fabricantes_id = $motor->motor_fabricantes_id;
                            $m->motor_modelos_id = $motor->motor_modelos_id;
                            $m->embarcacoes_id = $model->id;
                            $m->horas = $motor->horas;
                            $m->status = 1;
                            $m->titulo = 'precisa de titulo';
                            if (!$m->save()) {
                                //var_dump($m->getErrors());
                                //exit;
                            }
                            $m->save();
                        }
                    }
                }



                // verificar se alterou acessorios
                if (isset($_POST['alterar-acessorios'])) {


                    // se resolveu alterar os acessorios, vamos excluir todos eles primeiro
                    foreach ($model->embarcacaoAcessorioses as $acessorioEmb) {
                        $acessorioEmb->delete();
                    }


                    if($model->embarcacaoMacros->id == 4) {
                      $macro = "pesca";
                    }
                    elseif($model->embarcacaoMacros->id == 2) {
                      $macro = "lancha";
                    }
                    elseif($model->embarcacaoMacros->id == 1) {
                      $macro = "jetski";
                    }
                    else {
                      $macro = "veleiro";
                    }

                    //var_dump($_POST['Embarcacoes']['acessorios']);
                    //exit;

                    if(isset($_POST['Embarcacoes']['acessorios'])) {
                        foreach ($_POST['Embarcacoes']['acessorios'][$macro] as $id_acessorio) {

                              // foreach dos acessorios para salvar
                              // mas antes, verificar se já não marcou o acessorio em questão
                              $embarcAcessorios = new EmbarcacaoAcessorios;
                              $embarcAcessorios->embarcacoes_id = $model->primaryKey;
                              $embarcAcessorios->acessorios_id = (int) $id_acessorio;
                              $embarcAcessorios->save();

                        }
                    }

                }

                // verificar se marcou turbinado
                if (isset($_POST['Embarcacoes']['recursos_adicionais'])) {

                    // loop para verificar os recursos adicionais escolhidos
                    foreach ($_POST['Embarcacoes']['recursos_adicionais'] as $idTurbinado) {
                        // para cada turbinado escolhido criar o objeto que relaciona os turbinados a empresa
                        $embarcRecs = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
                        $embarcRecs->embarcacoes_id = $model->primaryKey;
                        $embarcRecs->embarcacao_recursos_adicionais_id = $idTurbinado;
                        $embarcRecs->save();

                        // criar ordem de plano
                        $ordem = new Ordens;
                        $ordem->usuarios_id = Yii::app()->user->getId();
                        $ordem->valor = EmbarcacaoRecursosAdicionais::getPrecoPorId($idTurbinado);
                        $ordem->data_criacao = date("Y-m-d H:i:s");
                        // lembrar de por como constante (ID 5 da tabela ordens_tipo é RECURSO ADICIONAL EMBARCACAO)
                        $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['ADICIONAL_EMBARCACAO'];
                        $ordem->descricao = EmbarcacaoRecursosAdicionais::getTituloTurbinado($idTurbinado);
                        $ordem->status = 1;
                        // FK do item da ordem (aqui no caso é o ID do turbinado)
                        $ordem->id_item = (int) $embarcRecs->id;
                        $ordem->save();

                        // verificar se optou pelo turbinado de imagens
                        if ($idTurbinado == Anuncio::$_turbinados_embarcacao['FOTOS']) {

                            // loop para salvar as imagens turbinadas no banco
                            for ($i = 0; $i < Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMBARCACAO']; $i++) {
                                $instance_image = EmbarcacaoImagens::prepareNewImage('Embarcacoes[foto-turbinada][' . $i . ']', $model->primaryKey, 1);

                                if ($instance_image != null) {

                                    if ($instance_image == false) {
                                        $erro = "Erro ao salvar a imagem no servidor.";
                                    } else {
                                        $instance_image->save();
                                    }
                                }
                            }
                        } // if marcou turbinado
                    } // loop turbinados
                } // if marcou turbinado*/

                $transaction->commit();

                // redirecionar pag sucesso
                $urlAnuncio = Embarcacoes::mountUrl($model);
                Yii::app()->user->setFlash('general_alert', 'Anúncio editado com sucesso!');
                $this->redirect($urlAnuncio);

            } catch (Exception $e) {
                $transaction->rollback();

                // salvar log de erro
                $logErro = new Logs;
                if ($model->macros_id == 3) {
                    $logErro->chave = 'Erro update embarc estaleiro';
                } else {
                    $logErro->chave = 'Erro update embarcacao anuncio';
                }

                $logErro->valor = $e->getMessage();
                $logErro->save();
            }
        } // POST Embarcacoes
        // renderiza página
        $this->render('update', array('model' => $model,
            'recursosAdicionais' => $recursosAdicionais,
            'acessoriosJetSki' => $acessoriosJetSki,
            'acessoriosLancha' => $acessoriosLancha,
            'acessoriosVeleiro' => $acessoriosVeleiro,
            'acessoriosPesca' => $acessoriosPesca,
            'motor' => $motor,
            'acessoriosJatem' => $acessoriosJatem,
            'flgEstaleiro' => $flgEstaleiro
        ));
    }

    // método executado via ajax para deletar a foto no form de update
    public function actionDeletarFoto() {

        $id_foto = (int) $_POST['id'];

        $embarcacaoFoto = EmbarcacaoImagens::model()->findByPk($id_foto);

        if ($embarcacaoFoto->principal == 1) {
            $embarcacao = Embarcacoes::model()->findByPk($embarcacaoFoto->embarcacoes_id);


            $novaFotoPrincipal = EmbarcacaoImagens::model()->find('id <> :id_foto and embarcacoes_id =:embarcacoes_id', array(':id_foto' => $id_foto, ':embarcacoes_id' => $embarcacao->id));

            if ($novaFotoPrincipal != null) {
                $novaFotoPrincipal->principal = 1;
                $embarcacao->imagemprincipal = $novaFotoPrincipal->imagem;

                $novaFotoPrincipal->update();
            } else {
                $embarcacao->imagemprincipal = null;
            }
            $embarcacao->update();
        }

        // erro
        if (!$embarcacaoFoto->delete()) {
            echo '-1';
        }

        // ok
        else {
            echo '1';
        }
    }

    // método que da update na foto da embarcação via ajax
    public function actionUpdateFoto() {

        // lembrar de verificar se o usuario logado possui realmente um ID da foto passada
        $id_foto = (int) $_POST['id-img-turbinada'];

        $embarcacoes_id = (int) $_POST['embarcacoes_id'];

        $flgTurbinada = (int) $_POST['flgTurbinada'];

        $emb = Embarcacoes::model()->findByPk($embarcacoes_id);


        // create
        if ($id_foto == 0 || !EmbarcacaoImagens::model()->exists('id=:id', array(':id'=>$id_foto))) {

            $turbo = 1; // turbinada

            // não é turbinada
            if ($flgTurbinada == 0)
                $turbo = 0;

            $instance_image = EmbarcacaoImagens::prepareNewImage('img-turbinada', $embarcacoes_id, $turbo);

            if ($instance_image != null) {

                if ($instance_image == false) {
                    echo "-1";
                    exit;
                } else {

                    if ($emb->imagemprincipal == null) {
                        $instance_image->principal = 1;
                        $emb->imagemprincipal = $instance_image->imagem;
                        $emb->update();
                    }
                    $instance_image->save();
                    echo $instance_image->imagem;
                }
            } else {
                echo '-1';
                exit;
            }
        }

        // update
        else {

            // carregar imagem
            $imgTurbinada = EmbarcacaoImagens::model()->find('id=:id', array(':id' => $id_foto));

            $imagem = CUploadedFile::getInstanceByName('img-turbinada');

            $size = $imagem->size / 1024;

            if ($imagem->type != Anuncio::$_extensoes_permitidas['JPEG'] && $imagem->type != Anuncio::$_extensoes_permitidas['JPG'] && $imagem->type != Anuncio::$_extensoes_permitidas['PNG']) {
                echo '-1';
                exit;
            }

            // se for mais que 1000 kb, informar erro
            if ($size > 1020 || $size < 20) {
                echo '-1';
                exit;
            }

            if ($imagem != null) {
                $imgTurbinada->imagem = Utils::genImageName($imagem);
            }

            // update
            //$imgTurbinada->imagem = CUploadedFile::getInstanceByName('img-turbinada');

            if ($imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/embarcacoes/' . $imgTurbinada->imagem)) {
                if ($imgTurbinada->save()) {

                    // update ver se era imagem principal
                    if ($imgTurbinada->principal == 1) {

                        $emb->imagemprincipal = $imgTurbinada->imagem;
                        $emb->update();
                    }

                    if ($emb->imagemprincipal == null) {
                        $emb->imagemprincipal = $imgTurbinada->imagem;
                        $emb->update();
                    }

                    echo $imgTurbinada->imagem;
                } else
                    echo "-1";
            } else
                echo "-1";
        }
    }

    /**
     * Action que muda o status da embarcação, indicando que o anuncio foi vendido
     * ou volta para o status de ativo (2)
     * @param  [type] $id [ID da embarcação]
     * @return [type]     [description]
     */
    public function actionDesativarOuPausarAnuncio($id, $operacao = null) {

        $model = Embarcacoes::model()->findByPk($id);

        if (isset($_GET['pausar'])) {

            // 1 => pausar // 2 => despausar
            if ($_GET['pausar'] == 1) {
                $model->status = Anuncio::$_status_anuncio['ANUNCIO_PAUSADO'];
            }

            // despausar
            else {

                $model->status = Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"];
            }
        } else {
            // se operação for diferente de null, quer dizer que é para
            // voltar a embarcação para status de ativo (2)
            if ($operacao != null) {
                $model->status = Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"];
            } else {
                $model->status = Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"];
            }
        }

        if($model->update()) {
            // tudo ok, embarcação deletada com sucesso
            echo '1';    
        }
        else {
          echo "-1";
        }
    }

    public function actionDesativarOuPausarAnuncio2($id) {

        $model = Embarcacoes::model()->findByPk($id);

        if ($model->status == Anuncio::$_status_anuncio['ANUNCIO_PAUSADO']) {
          $model->status = Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"];
        } else {
           $model->status = Anuncio::$_status_anuncio['ANUNCIO_PAUSADO'];
        }

        if($model->update()) {
            // tudo ok, embarcação deletada com sucesso
            echo '1';    
        }
        else {
          echo "-1";
        }
    }

    /**
     * Action que ativa o anúncio
     * altera o status para 2 e envia o email de confirmação
     * @param  [type] $id [ID da embarcação]
     * @return [type]     [description]
     */
    public function actionAtivarAnuncio($id) {

        /*
          0 - criado anuncio
          1 - pago
          2 - ativo (validado pelo admin)
          3 - vendido ou acabou tempo de anuncio
         */
        $model = Embarcacoes::model()->findByPk($id);

        $av = new AvisosMinhaConta();
        $av->enviarAviso($model);

        $model->data_ativacao = date("Y-m-d H:i:s");
        $model->status = Anuncio::$_status_anuncio['ANUNCIO_ATIVADO'];

        // atualizar data de fim do plano da embarc, ja q foi ativado agora
        $planoUsuarios = PlanoUsuarios::model()->findByPk($model->planoUsuarios->id);

        // verificar se é plano grats
        $planoUsuarios->inicio = date('Y-m-d H:i:s');
        $planoUsuarios->fim = date('Y-m-d H:i:s', strtotime('today + ' . $planoUsuarios->planos->duracaomeses . ' month'));          
        $planoUsuarios->status = 2;
        $planoUsuarios->update();

        $model->update();

        // verificar se o modelo foi editado, caso sim, devemos fazer um update
        // pois as informações deste modelo estarão guardadas na tabela de EmbarcacaoModelosEditavel
        // Se ele não foi editado, ou seja, foi criado na hora do cadastro (clicou em Não achei modelo)
        if ($model->editado == 1) {

            // obter o model do modelo da embarc
            $modeloEmbarc = EmbarcacaoModelos::model()->findByPk($model->embarcacaoModelos->id);

            // id do modelo da embarc
            $id_modelo = $modeloEmbarc->id;

            // buscar na tabela de modelos editaveis para verificar se há um registro deste modelo
            $modeloEditado = EmbarcacaoModelosEditavel::model()->find('embarcacao_modelos_id=:id', array(":id" => $id_modelo));
            if ($modeloEditado != null) {
                // achou, vamos transferir as informações deste modelo que foi editado, para o modelo real da embarcação
                if ($modeloEditado->tamanho != null) {
                    $modeloEmbarc->tamanho = $modeloEditado->tamanho;
                }
                if ($modeloEditado->passageiros != null) {
                    $modeloEmbarc->passageiros = $modeloEditado->passageiros;
                }
                if ($modeloEditado->acomodacoes != null) {
                    $modeloEmbarc->acomodacoes = $modeloEditado->acomodacoes;
                }
                if ($modeloEditado->comprimento != null) {
                    $modeloEmbarc->comprimento = $modeloEditado->comprimento;
                }
                if ($modeloEditado->motor_de_fabrica != null) {
                    $modeloEmbarc->motor_de_fabrica = $modeloEditado->motor_de_fabrica;
                }
            }

            // clicou em "não achei fabricante" ou "não achei modelo"
            else {

                // status de ativo para o novo modelo aprovado
                $modeloEmbarc->status = 1;

                // se clicou em "Não achei fabricante", devemos atualizar também o status do fabricante, pois,
                // ele entrou com status desabilitado
                if ($modeloEmbarc->embarcacaoFabricantes->status == 0) {

                    // status de ativo para o novo fabricante aprovado
                    $modeloEmbarc->embarcacaoFabricantes->status = 1;

                    // atualizar fabricante
                    $modeloEmbarc->embarcacaoFabricantes->update();
                }
            }

            // atualizar modelo
            $modeloEmbarc->update();
        }

        // obter nome do cliente
        $idCliente = UsuariosEmbarcacoes::model()->find('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $model->id))->usuarios_id;
        $nomeCliente = Usuarios::model()->findByPk($idCliente)->nome;

        //Seu cadastro foi validado com sucesso e já está no ar em nosso site!
        $message = new YiiMailMessage;
        $message->view = "mail_ativar_anuncio";
        $message->subject = 'BomBarco - Ativação Anúncio - Embarcação ' . $model->embarcacaoModelos->titulo . ' ' . $model->embarcacaoModelos->embarcacaoFabricantes->titulo;
        $message->setBody(array('model' => $model, 'nomeCliente' => $nomeCliente), 'text/html');
        $message->addTo($model->email);
        $message->from = Yii::app()->params['bombarcoAtendimento'];

        // enviar email para o email cadastrado na embarcação, para informar que o anuncio foi validado ok
        if (Yii::app()->mail->send($message)) {
            echo '1';
        } else {
            echo '-1';
        }
    }

    /**
     * Action que envia um email ao usuario dono do anuncio, indicando que o mesmo
     * não foi aceito e da um update na coluna 'editado' da embarcação. Tornando status 3 (Anuncio Barrado)
     * @param  [type] $id [ID da embarcação]
     * @return [type]     [description]
     */
    public function actionAnuncioNaoAutorizado($id) {

        // achar embarcação pelo ID e setar 3 na coluna 'editado'
        // o que significa que o anuncio foi barrado (Admin não autorizou, mesmo estando pago)
        $model = Embarcacoes::model()->findByPk($id);
        $model->editado = 2;
        $model->update();

        // obter nome do cliente
        $idCliente = UsuariosEmbarcacoes::model()->find('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $model->id))->usuarios_id;
        $nomeCliente = Usuarios::model()->findByPk($idCliente)->nome;

        //Seu cadastro foi validado com sucesso e já está no ar em nosso site!
        $message = new YiiMailMessage;
        $message->view = "mail_anuncio_nao_autorizado";
        $message->subject = 'BomBarco - Anúncio Não Autorizado - Embarcação ' . $model->embarcacaoModelos->titulo . ' ' . $model->embarcacaoModelos->embarcacaoFabricantes->titulo;
        $message->setBody(array('model' => $model, 'nomeCliente' => $nomeCliente), 'text/html');
        $message->addTo($model->email);
        $message->from = Yii::app()->params['bombarcoAtendimento'];

        // enviar email para o email cadastrado na embarcação, para informar que o anuncio foi validado ok
        if (Yii::app()->mail->send($message)) {
            echo '1';
        } else {
            echo '-1';
        }
    }

    /**
     * Action AJAX
     * Carrega embarcacoes de uma empresa/estaleiro
     * @return [type]     [description]
     */
    public function actionLoadMoreFromBusiness() {

        // ID da empresa/estaleiro
        $id = (Yii::app()->request->getQuery('id') != null) ? Yii::app()->request->getQuery('id') : 0;
        $page = (Yii::app()->request->getQuery('page') != null) ? Yii::app()->request->getQuery('page') : 0;

        $empresa = Empresas::model()->findByPk($id);

        $embarcacoes = Embarcacoes::estaleiro($id, $page);

        $html = '';

        foreach ($embarcacoes as $key => $value) {
            $valor = 'Não informado';
            if ($value->valor != '0.00') {
                $valor = Utils::formataValorView($value->valor);
            }
            $ano = $value->ano;
            if ($value->ano == 0 || $value->ano == '') {
                $ano = 'Não informado';
            }

            $html .= '<div id="div-emba">';
            $html .= '<div class="box-unit-emba">';
            $html .= '<ul class="categories-emba">';
            $html .= '<li class="category-emba">';
            //$html .= Embarcacoes::getThumb($value, array('class' => 'bg-img-emba'), true, array(), $value -> slug);
            $html .= Embarcacoes::getThumb($value, array('class' => 'bg-img-emba'), true, array(), $empresa->slug);

            $html .= '</li>';
            $html .= '</ul>';
            $html .= '<div class="textos-emba">';
            $html .= '<span class="text-emba-title">' . $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $value->embarcacaoModelos->titulo . ' </span>';
            $html .= '<span class="text-emba-ano"> Ano: ' . $ano . '</span>';

            if (isset($value->estados) && isset($value->estados->uf)) {
                $html .= '<span class="text-emba-estado"> Estado: ' . $value->estados->uf . '</span>';
            } else {
                $html .= '<span class="text-emba-estado"> Estado: </span>';
            }

            $html .= '<span class="text-deemb-price" style="font-size:15px;"> R$ ' . $valor . '</span>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        echo json_encode(array('html' => $html, 'count' => count($embarcacoes)));
    }

    /**
     * Altera o status do anúncio
     * @return [type] [description]
     */
    public function actionStatusAnuncio($id) {

        $res = array(
            'error' => 0,
            'msg' => 'Status alterado com sucesso!'
        );

        try {

            $status = Yii::app()->request->getPost('status');

            if (empty($id) || empty($status))
                throw new Exception("Informe o ID e Status", 1);

            $anuncio = Embarcacoes::model()->findByPk($id);

            if (empty($anuncio))
                throw new Exception("Anúncio não existe", 1);

            // Se estiver ATIVANDO o anúncio
            if ($status == Anuncio::$_status_anuncio['ANUNCIO_ATIVADO']) {

                if (empty($anuncio->planoUsuarios))
                    throw new Exception("Plano não existe", 1);

                if ($anuncio->planoUsuarios->status != Anuncio::$_status_plano['PAGO']) {
                    $fim = date('Y-m-d H:i:s', strtotime('today + ' . 1 . ' month'));   
                    $plano = PlanoUsuarios::model()->findByPk($anuncio->planoUsuarios->id);
                    $plano->fim = $fim;
                    $plano->status = 2;
                    $plano->update();
                    //throw new Exception("Plano não esta ativo", 2);
                }
                    

                $today = new DateTime();
                $end = DateTime::createFromFormat('d/m/Y', $anuncio->planoUsuarios->fim);

                // Se o plano estiver vencido
                if ($today > $end) {
                    $fim = date('Y-m-d H:i:s', strtotime('today + ' . 1 . ' month'));   
                    $plano = PlanoUsuarios::model()->findByPk($anuncio->planoUsuarios->id);
                    $plano->fim = $fim;
                    $plano->status = 2;
                    $plano->update();

                    //throw new Exception("Plano vencido", 2);
                }
                    

                $totalAnuncios = Embarcacoes::model()->count('t.plano_usuarios_id = :plano_id AND t.status = :ativo', array(':plano_id'=>$anuncio->planoUsuarios->id, ':ativo'=>Anuncio::$_status_anuncio['ANUNCIO_ATIVADO']));

                // Se o limite de anúncios permitido foi alcançado
                if ($totalAnuncios >= $anuncio->planoUsuarios->qntpermitida)
                    throw new Exception("Limite de anúncios atingido", 2);
            }

            $anuncio->status = $status;
            if (!$anuncio->saveAttributes(array('status')))
                throw new Exception("Erro ao alterar Status", 2);

        } catch (Exception $e) {
            $res['error'] = $e->getCode();
            $res['msg'] = $e->getMessage();
        }

        echo json_encode($res);
        exit();
    }

    public function actionAlterarOrdemImg() {

        $ids_ordem = json_decode(stripslashes($_POST['ids_ordem']));


        foreach($ids_ordem as $id_ordem) {

            $explode = explode("|", $id_ordem);
            $id = $explode[0];
            $ordem = $explode[1];

            $embarc_img = EmbarcacaoImagens::model()->findByPk($id);

            $embarc_img->ordem = $ordem;

            if(!$embarc_img->update()) {
                echo "-1";
                exit();
            }

            if($embarc_img->ordem == 0) {
                EmbarcacaoImagens::atualizarImgPrincipal($id);
            }
        }

        echo "0";
    }


    public function actionAlterarOrdemImg2() {

        $img_ordens = json_decode($_POST['img_ordens']);

        foreach($img_ordens as $img) {

            $id = $img->id;
            $ordem = $img->ordem;

            $embarc_img = EmbarcacaoImagens::model()->findByPk($id);

            $embarc_img->ordem = $ordem;

            if(!$embarc_img->update()) {
                echo "-1";
                exit();
            }

            if($embarc_img->ordem == 0) {
                EmbarcacaoImagens::atualizarImgPrincipal($id);
            }
            

        }

        echo "0";
    }

    public function actionDeletarAnuncio() {

        $embarcacoes_id = $_GET["embarcacoes_id"];

        $embarc = Embarcacoes::model()->findByPk($embarcacoes_id);
        $plano = PlanoUsuarios::model()->findByPk($embarc->planoUsuarios->id);

        $embarc->status = Anuncio::$_status_anuncio["ANUNCIO_DELETADO"];

        // se tiver plano grats, vamos deletar
        if($plano->gratuito == 1) {

            $embarc->plano_usuarios_id = null;
            $embarc->update();
            
            if($plano->delete()) {
                echo "1";
            }
            else {
                echo "-1";
            }
        }

        else {

            if($embarc->update()) {
                echo "1";
            }
            else {
                echo "-1";
            }
        }

        



    }

    public function actionExpirarAnuncio() {

        $embarcacoes_id = $_GET["embarcacoes_id"];

        $embarc = Embarcacoes::model()->findByPk($embarcacoes_id);
        $plano = PlanoUsuarios::model()->findByPk($embarc->planoUsuarios->id);

        $embarc->status = Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"];

        // se tiver plano grats, vamos deletar
        if($plano->gratuito == 1) {

            $embarc->plano_usuarios_id = null;
            $embarc->update();
            
            if($plano->delete()) {
                echo "1";
            }
            else {
                echo "-1";
            }
        }

        else {

            if($embarc->update()) {
                echo "1";
            }
            else {
                echo "-1";
            }
        }

        



    }

    public function actionAtualizarAnunciosVencidos() {

        /* atualizar embarcacoes vencidas */
        Embarcacoes::atualizarAnunciosVencidos();
    }

    public function actionUploadFotoAnuncio() {

        $ordem = "";

        $explode_virgula = explode(",", $_POST["string_ordens"]);

        foreach($explode_virgula as $s) {
            $explode_token = explode("|", $s);
            if($explode_token[0] == $_FILES["qqfile"]["name"]) {
                $ordem = $explode_token[1];
                break;
            }
        }
        

        $nome_arquivo = EmbarcacaoImagens::salvarImagem($_FILES["qqfile"]);
        $imagemEmbarc = new EmbarcacaoImagens;

        if($nome_arquivo != null) {

            // gambiarra salvar imagens => explicaçao: Linha 880 AnunciosController.php
            // no UPDDATE nos passamos o ID da embarc, n precisando faze a gambs que ocorre no fluxo de anuncio
            //$embarcacoes_id = (isset($_POST["embarcacoes_id"]) == true ? $_POST["embarcacoes_id"] : 9258);
            $embarcacoes_id = $_POST["embarcacoes_id"]; 

            $imagemEmbarc = new EmbarcacaoImagens;
            if(!EmbarcacaoImagens::model()->exists('embarcacoes_id=:embarcacoes_id and principal = 1', array(':embarcacoes_id'=>$embarcacoes_id))) {
                $imagemEmbarc->principal = 1;
            }

            $imagemEmbarc->embarcacoes_id = $embarcacoes_id;
            $imagemEmbarc->imagem = $nome_arquivo;
            $imagemEmbarc->turbo = $_GET["turbo"];
            $imagemEmbarc->ordem = $ordem;
            $imagemEmbarc->status = 0;
            $sql = "SET foreign_key_checks = 0;";
            Yii::app()->db->createCommand($sql)->execute();       
            $imagemEmbarc->save()->ignore;
            $sql = "SET foreign_key_checks = 1;";
            Yii::app()->db->createCommand($sql)->execute();
            
        }
    }


    

// fim controller
}
