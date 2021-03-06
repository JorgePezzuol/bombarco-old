<?php

// se tirar isso aqui, nao ta funcionando o update
Yii::import("application.models.Anuncio");

class EmpresasController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index','teste123',  'view', 'empresas', 'vertelefone', 'empresadetalhe', 'estaleiros', 'contato', 'estaleirosloadmore', 'estaleiro', 'estaleirosindex', 'estaleirosdetalhe'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('deletarFotoTurbinada', 'update', 'updateLogoAjax', 'updateCapaAjax', 'removerCapaOuLogo', 'updateFotoTurbinada', 'createFotoTurbinada', 'changeStatus'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('darTurbinadas', 'admin', 'adminAnunciosPagos', 'desativarAnuncio', 'adminEstaleiros', 'delete', 'ativarAnuncio', 'minicreate', 'create', 'createestaleiro'),
                                'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
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

    public function actionTeste123() {
        $this->render('empresas_gratuitas');
    }


    /**
     * Turbinadas
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionDarTurbinadas($id) {

        $empresa = Empresas::model()->findByPk($id);
        $usuario = Usuarios::model()->find('id=:id', array(':id' => $empresa->usuarios_id));
        $plano = PlanoUsuarios::model()->with('planos')->together()->find('planos.flag="plano_empresa" and usuarios_id', array(':usuarios_id' => $empresa->usuarios_id));
        $dataFimPlano = Utils::formatDateTimeToView($plano->fim);

        $mensagem = '';

        if (isset($_POST['turbinadas']) && $_POST['turbinadas'] != null) {

            $turbinadas = $_POST['turbinadas'];
            EmpresasHasEmpresaRecursosAdicionais::model()->deleteAll('empresas_id = :id', array(':id'=>$id));

            foreach ($turbinadas as $turbo) {

                if ($turbo == 'video') {

                    $recAdicional = new EmpresasHasEmpresaRecursosAdicionais;
                    $recAdicional->empresas_id = $id;
                    $recAdicional->empresa_recursos_adicionais_id = Anuncio::$_turbinados_empresa['VIDEO'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                } elseif ($turbo == 'fotos') {

                    $recAdicional = new EmpresasHasEmpresaRecursosAdicionais;
                    $recAdicional->empresas_id = $id;
                    $recAdicional->empresa_recursos_adicionais_id = Anuncio::$_turbinados_empresa['FOTOS'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                } elseif ($turbo == 'descricao') {

                    $recAdicional = new EmpresasHasEmpresaRecursosAdicionais;
                    $recAdicional->empresas_id = $id;
                    $recAdicional->empresa_recursos_adicionais_id = Anuncio::$_turbinados_empresa['DESCRICAO'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                } elseif ($turbo == 'telefone') {

                    $recAdicional = new EmpresasHasEmpresaRecursosAdicionais;
                    $recAdicional->empresas_id = $id;
                    $recAdicional->empresa_recursos_adicionais_id = Anuncio::$_turbinados_empresa['TELEFONE_EMPRESA'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                } elseif ($turbo == 'cpm') {

                    $recAdicional = new EmpresasHasEmpresaRecursosAdicionais;
                    $recAdicional->empresas_id = $id;
                    $recAdicional->empresa_recursos_adicionais_id = Anuncio::$_turbinados_empresa['CPM'];
                    $recAdicional->status = 1;
                    $recAdicional->save();

                }

            }

            $mensagem = 'Turbinadas alteradas!';
        }

        // Salvando CPM
        if (isset($_POST['cpm']) && !empty($_POST['cpm'])) {

            if (isset($empresa->empresasImpressoes) && !empty($empresa->empresasImpressoes[0])) {

                $impressoes = $empresa->empresasImpressoes[0];
                $impressoes->limitviews = $_POST['cpm'];
                $impressoes->limitdate = $empresa->planoUsuarios->fim;
                $impressoes->save();

            } else {

                $impressoes = new EmpresasImpressoes;
                $impressoes->empresas_id = $id;
                $impressoes->limitviews = $_POST['cpm'];
                $impressoes->limitdate = $empresa->planoUsuarios->fim;
                $impressoes->status = 1;
                $impressoes->save();
            }

            $empresa = Empresas::model()->findByPk($id);
        }

        $this->render('turbinadas_empresas', array('empresa' => $empresa, 'dataFimPlano' => $dataFimPlano, 'mensagem' => $mensagem));
    }



    public function actionContato() {

        // setar dados de contato
        $contato = new Contatos;
        $contato->nome_rem = $_POST["nome"];
        $contato->email_rem = $_POST["email"];
        $contato->telefone_rem = $_POST["telefone"];
        $contato->data = date('Y-m-d H:i:s');
        $contato->email_dest = 'atendimento@bombarco.com.br';

        // contato tipo estaleiro
        $contato->tipo = 'E';

        // salvar e enviar email
        if ($contato->save()) {

            // enviar email para admin a respeito da contratação de plano de estaleiro
            $message = new YiiMailMessage;
            $message->view = "mail_estaleiro_admin";
            $message->subject = 'Planos de Estaleiros';
            $message->setBody(array('email'=>$_POST['email'], 'nome'=> $_POST["nome"], 'telefone'=> $_POST['telefone'], 'nomeEmpresa'=>$_POST['nome_empresa']), 'text/html');
            $message->addTo(Yii::app()->params['bombarcoAtendimento']);
            //$message->addTo("jorge_pezzuol@bombarco.com.br");
            $message->from = $_POST['email'];
            //$message->from = Yii::app()->params['bombarcoAtendimento'];

            // envia msg
            if (!Yii::app()->mail->send($message)) {

                // erro
                echo '-1';
            }

            // msg enviada ok
            else {
                echo '1';
            }
        }


        // erro ao salvar o contato
        else {
            echo '-1';
        }
    }

    public function actionVertelefone() {

        if (isset($_POST)) {

            $usuarios_id = $_POST['usuarios_id'];


            if (Yii::app()->user->id != $usuarios_id && !Yii::app()->user->isAdmin()) {
                $empresa = Empresas::model()->find('usuarios_id=:user', array(':user' => $usuarios_id));
                $contador = $empresa->vertelefone;
                $contador2 = $empresa->vertelefone + 1;

                //var_dump($contador . ' '.$contador2);
                $empresa->vertelefone = $contador2;
                $empresa->update();
            }
        }
    }

    public function actionDeletarFotoTurbinada() {

        if (isset($_POST)) {

            $id = $_POST['id'];
            $imagem = EmpresaImagens::model()->find('id=:id', array(':id' => $id));
            if ($imagem != null) {
                $imagem->delete();
                echo '1';
            } else {
                echo '-1';
            }
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
        $model = Empresas::model()->findByPk($id);
        $model->status = Anuncio::$_status_anuncio['ANUNCIO_ATIVADO'];
        $model->data_ativacao = date("Y-m-d H:i:s");

        $planoUsuarios = PlanoUsuarios::model()->findByPk($model->planoUsuarios->id);
        $planoUsuarios->fim = date('Y-m-d H:i:s', strtotime('today + ' . $planoUsuarios->planos->duracaomeses . ' month'));
        $planoUsuarios->update();

        $model->update();

        $message = new YiiMailMessage;
        $message->view = "ativar_anuncio_empresa";
        $message->subject = 'Bombarco - Ativação Anúncio de Empresa';
        $message->setBody(array('model' => $model, 'nomeCliente' => $model->razao,
            'link' => Empresas::mountUrl($model, Macros::$macro_by_slug['empresa'])), 'text/html');
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
     * Action que muda o status da embarcação, indicando que o anuncio foi vendido
     * ou volta para o status de ativo (2)
     * @param  [type] $id [ID da embarcação]
     * @return [type]     [description]
     */
    public function actionDesativarAnuncio($id, $operacao = null) {

        $transaction = Yii::app()->db->beginTransaction();

        try {

            $model = Empresas::model()->findByPk($id);
            // se operação for diferente de null, quer dizer que é para
            // voltar a embarcação para status de ativo (2)
            if ($operacao != null) {
                $model->status = Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"];
            } else {
                $model->status = Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"];
            }

            $model->update();

            // commit
            $transaction->commit();
        } catch (Exception $e) {
            echo '-1';
        }


        // tudo ok, embarcação deletada com sucesso
        echo '1';
    }

    /**
     * Extendendo loadModel para validar permissão do user logado
     * @param  [type] $key        [description]
     * @param  [type] $modelClass [description]
     * @return [type]             [description]
     */
    public function loadModel($key, $modelClass) {

        $model = parent::loadModel($key, $modelClass);

        if (Yii::app()->user->isBusiness() && Yii::app()->controller->action->id === 'update') {

            // Se essa empresa me pertence retorna o Model
            if ($model->usuarios_id == Yii::app()->user->getId()) {

                return $model;
            } else { // se não redireciona para Admin
                $this->redirect(array('view', array('id' => $key)));
            }
        } else {

            return $model;
        }
    }

    /**
     * Listagem de Empresas
     * @return [type] [description]
     */
    public function actionEmpresas() {

        $this->redirect('http://guiadocapitao.com.br/');

        // atualizar empresas
        /*Empresas::atualizarEmpresasVencidas();

        $termo = Yii::app()->request->getParam('termo');
        $categoria = Yii::app()->request->getParam('categoria');
        $localizacao = Yii::app()->request->getParam('localizacao');
        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Empresas::LIMIT_SEARCH) : null;

        $array_view = array();
        $title = array('Guia de Empresas');

        $array_params = array(
            'termo' => $termo,
            'categoria' => $categoria,
            'localizacao' => $localizacao
        );

        // Se for AJAX retorna TRUE
        $ajax = Yii::app()->request->getParam('ajax');

        // montando criteria de empresas
        $condition = 't.macros_id = :macro AND t.status = :status';
        $params = array(':macro' => Macros::$macro_by_slug['empresa'], ':status' => Empresas::ACTIVE);

        // Se existir Categoria
        if ($categoria != null) {

            $condition .= ' AND t.empresa_categorias_id = :categoria';

            $categoria = EmpresaCategorias::model()->find('slug=:slug', array(':slug' => $categoria));

            if ($categoria != null) {
                $array_view['categoria'] = $categoria;
                $params[':categoria'] = $categoria->id;
                $title[] = $categoria->titulo;
            } else {
                $params[':categoria'] = -1;
            }
        }

        // Se existir localizacão
        if ($localizacao != null) {

            $condition .= ' AND t.estados_id = :estado';

            $estado = Estados::model()->find('slug=:slug', array(':slug' => $localizacao));
            if ($estado != null) {
                $array_view['estado'] = $estado;
                $params[':estado'] = $estado->id;
                $title[] = $estado->nome;
            } else {
                $params[':estado'] = -1;
            }
        }

        // Busca digitada
        if ($termo != null) {
            $condition .= " AND (t.razao LIKE :termo OR t.email LIKE :termo OR t.slug LIKE :termo OR t.minidescricao LIKE :termo OR t.descricao LIKE :termo)";
            $params[':termo'] = '%' . $termo . '%';
            $title[] = $termo;
        }

        // Buscando empresas
        $criteria = new CDbCriteria();
        $criteria->with = array('empresaImagens', 'empresaCategorias');
        $criteria->condition = $condition . ' AND t.plano_usuarios_id IS NOT NULL';
        $criteria->params = $params;
        $criteria->order = 'RAND()';

        // Empresas com planos pagos
        if (Yii::app()->theme->name != 'mobile' || ($ajax == null && $ajax != TRUE)){
            $criteria->with['planoUsuarios'] = array('with'=>'planos','condition'=>'planos.gratuito=0');
            $empresas = Empresas::model()->findAll($criteria);
        }

        // Planos Gratuitos
        $criteria->with['planoUsuarios'] = array('with'=>'planos','condition'=>'planos.gratuito=1');

        // Limite para o mobile
        if (Yii::app()->theme->name == 'mobile')
            $criteria->limit = Empresas::LIMIT_SEARCH_MOBILE;

        // Offset
        if ($offset != null)
            $criteria->offset = $offset;

        $criteria->limit = Empresas::LIMIT_SEARCH;
        $gratuitas = Empresas::model()->findAll($criteria);

        // Somente Gratuitas terão "Carregar Mais", então ignorar find de Empresas
        if ($ajax != null && $ajax == TRUE) {

            $html = '';

            foreach ($gratuitas as $key => $value) {

                if (Yii::app()->theme->name != 'mobile') {

                    $href = Empresas::mountUrl($value, $value->macros_id);

                    $html .= '<li class="category-guia-gl-free">
                                    <span class="table-guia-gl">
                                        <a style="text-decoration:none; color:#000" href="' . $href . '">' . $value->razao . '</a>
                                    </span>
                                </li>';
                }

                // html ver mais tema mobile
                else {

                    $html .= '<div class="result-content result-middle pure-g">';

                    $html .= '<a href="' . Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']) . '" class="link-result">';

                    $html .= '<div class="result-image pure-u-1-3">';
                    if ($value->logo != null) {
                        $html .= '<img class="bg-img-guia-gl" src="' . Yii::app()->baseUrl . '/public/empresas/' . $value->logo . '" />';
                    } else {
                        $html .= '<img class="bg-img-guia-gl" src="' . Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg">';
                    }

                    $html .= '</div>';
                    $html .= '<div class="result-infos pure-u-2-3">';
                    $html .= '<div class="infos-content">';
                    $html .= '<article class="result-title-middle">' . $value->razao . '</article>';
                    $html .= '</div>';
                    $html .= '</div>';

                    $html .= '</a>';

                    $html .= '</div>';
                }
            }

            echo json_encode(array('html' => $html, 'count' => count($gratuitas)));

        } else {

            Yii::app()->clientScript->registerMetaTag(Utils::mountDescription($title), 'description', null, array(), 'bombarco_description');
            $this->setPageTitle(Utils::mountTitle($title));

            $this->render('guia-listagem', array(
                'array_params' => $array_params,
                'array_view' => $array_view,
                'empresas' => $empresas,
                'gratuitas' => $gratuitas,
            ));
        }*/
    }

    /**
     * Carregamento AJAX de mais Empresas
     * @return [type] [description]
     */
    public function actionEmpresasLoadMore() {

        $offset = Yii::app()->request->getQuery('offset', 0);

        // Buscando empresas
        $criteria = new CDbCriteria();
        $criteria->with = array('empresaImagens');
        $criteria->limit = 12;
        $criteria->offset = $offset;
        $criteria->together = true;
        $criteria->condition = 't.macros_id = :macro AND t.status = :status';
        $criteria->params = array(':macro' => Macros::$macro_by_slug['empresa'], ':status' => Empresas::ACTIVE);

        $empresas = Empresas::model()->findAll($criteria);

        echo CJSON::encode($empresas);
    }

    /**
     * Detalhe da Empresa
     * @return [type] [description]
     */
    public function actionEmpresaDetalhe($slug) {
        
        $this->redirect('http://guiadocapitao.com.br/');

        /*$model = Empresas::model()->findByAttributes(array('slug' => $slug));

        // Title
        if (!empty($model->nomefantasia)) {
            $this->setPageTitle($model->nomefantasia . ' - Guia de Empresas Bombarco');
        } else {
            $this->setPageTitle($model->razao . ' - Guia de Empresas Bombarco');
        }

        if (Yii::app()->user->id != $model->usuarios_id) {
            $model->cliques += 1;
            $model->update();
        }



        // Se a Empresa não estiver Ativa e eu não for o dono dela
        // redireciona para Home
        if (empty($model) || ($model->status != Empresas::ACTIVE && $model->usuarios_id != Yii::app()->user->id && !Yii::app()->user->isAdmin()))
            $this->redirect(Yii::app()->homeUrl);

        $noticias = Conteudos::model()->with('conteudoImagens')->findAllByAttributes(array('macro' => 'N', 'status' => 1), array('condition' => 't.data between date_sub(now(), interval 999 day) and CURDATE()', 'order' => 't.data DESC, id DESC', 'limit' => 3));


        $this->render('det-estaleiros-guia', array(
            'model' => $model,
            'noticias' => $noticias
        ));*/
    }

    /**
     * Listagem de Estaleiros
     * @return [type] [description]
     */
    public function actionEstaleiros() {

        $this->redirect("/catalogo");
        exit;

        // atualizar empresas
        Empresas::atualizarEmpresasVencidas();

        // Buscando estaleiros
        $criteria = new CDbCriteria();
        $criteria->with = array('empresaImagens');
        $criteria->limit = Empresas::LIMIT_SEARCH;
        $criteria->together = true;
        $criteria->condition = 'destaque = 0 and macros_id = :macro AND status = :status';
        $criteria->params = array(':macro' => Macros::$macro_by_slug['estaleiro'], ':status' => Empresas::ACTIVE);
        $estaleiros = Empresas::model()->findAll($criteria);

        // Estaleiros em destaque
        $criteria_destaques = new CDbCriteria();
        $criteria_destaques->with = array('empresaImagens', 'empresaRecursosAdicionaises');
        $criteria_destaques->together = true;
        //$criteria_destaques->condition = 'empresaRecursosAdicionaises.id = :recursos AND t.macros_id = :macro AND t.status = :status';
        $criteria_destaques->condition = 't.destaque = 1 AND t.macros_id = :macro AND t.status = :status';
        //$criteria_destaques->params = array(':macro' => Macros::$macro_by_slug['estaleiro'], ':recursos' => EmpresaRecursosAdicionais::$recursos_by_slug['destaque_busca'], ':status' => Empresas::ACTIVE);
        $criteria_destaques->params = array(':macro' => Macros::$macro_by_slug['estaleiro'], ':status' => Empresas::ACTIVE);
        $destaques = Empresas::model()->findAll($criteria_destaques);

        $this->render('estaleiro-index', array(
            'estaleiros' => $estaleiros,
            'destaques' => $destaques,
        ));
    }

    /**
     * Carregamento AJAX de mais Estaleiros
     * @return [type] [description]
     */
    public function actionEstaleirosLoadMore() {

        $offset = Yii::app()->request->getQuery('offset', 0);

        // Buscando estaleiros
        $criteria = new CDbCriteria();
        $criteria->with = array('empresaImagens');
        $criteria->limit = Empresas::LIMIT_SEARCH_MORE;
        $criteria->together = true;
        $criteria->offset = $offset;
        $criteria->condition = 'destaque = 0 and macros_id = :macro AND status = :status';
        $criteria->params = array(':macro' => Macros::$macro_by_slug['estaleiro'], ':status' => Empresas::ACTIVE);

        $estaleiros = Empresas::model()->findAll($criteria);

        echo CJSON::encode($estaleiros);
    }

    /**
     * Detalhe do Estaleiro
     * @return [type] [description]
     */
    public function actionEstaleiro() {
                $this->redirect("/catalogo");
        exit;
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Empresas'),
        ));
    }

    public function actionView($id) {

        $this->render('view', array(
            'model' => $this->loadModel($id, 'Empresas'),
        ));
    }

    public function actionCreate() {
        $model = new Empresas;


        if (isset($_POST['Empresas'])) {
            $model->setAttributes($_POST['Empresas']);
            $relatedData = array(
                'empresaRecursosAdicionaises' => $_POST['Empresas']['empresaRecursosAdicionaises'] === '' ? null : $_POST['Empresas']['empresaRecursosAdicionaises'],
            );

            if ($model->saveWithRelated($relatedData)) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    /**
     * Ação de criar Estaleiro
     * @param  [type] $id_usuario [ID do usuário dono do Estaleiro]
     * @return [type]             [description]
     */
    public function actionCreateEstaleiro() {

        $empresa = new Empresas;
        $usuario = new Usuarios;
        $plano = new PlanoUsuarios;

        $flgCadastroOK = true;

        if (isset($_POST['Usuarios'], $_POST['Empresas'], $_POST['PlanoUsuarios'])) {

            // transaction
            $transaction = Yii::app()->db->beginTransaction();

            try {

                $email_usuario = $_POST["Usuarios"]["email"];
                $usuario_existe = Usuarios::model()->find("email=:email", array(":email"=>$email_usuario)) != null ? true : false;

                if($usuario_existe) {

                    $usuario = Usuarios::model()->find("email=:email", array(":email"=>$email_usuario));

                    // ver se ja tem estaleiro
                    if(Empresas::model()->find("usuarios_id=:usuarios_id", array(":usuarios_id"=>$usuario->id)) != null) {
                        $flgCadastroOK = false;
                    }

                    else {
                        $usuarios_id = $usuario->id;    

                        $usuario->usuario_classificacoes_id = Anuncio::$_classificacoes_de_usuario['ESTALEIRO'];
                        $usuario->pessoa = Anuncio::$_pessoa['JURIDICA'];
                        $usuario->update();
                    }

                    
                    
                }

                // não existe
                else {

                    // salvar dados do usuario
                    $usuario->setAttributes($_POST['Usuarios']);
                    $usuario->usuario_classificacoes_id = Anuncio::$_classificacoes_de_usuario['ESTALEIRO'];
                    $usuario->pessoa = Anuncio::$_pessoa['JURIDICA'];
                    $usuario->telefone = "0000-0000";
                    $usuario->celular = "0000-0000";
                    $usuario->save();

                    $usuarios_id = $usuario->id;
                }


                if($flgCadastroOK == true) {
                     // plano
                    $plano->setAttributes($_POST['PlanoUsuarios']);
                    $planoEstaleiro = Planos::validarPlanosEstaleiro($plano->planos_id);
                    if ($planoEstaleiro != null) {
                        $plano->valor = (float) $planoEstaleiro->valor;
                        $plano->status = Anuncio::$_status_plano['PAGO'];
                        $plano->planos_id = $planoEstaleiro->id;
                        $plano->qntpermitida = $planoEstaleiro->qntpermitida;
                    }


                    // salvar dados da empresa
                    $empresa->setAttributes($_POST['Empresas']);
                    $empresa->empresa_categorias_id = 1;
                    //$empresa->status = Anuncio::$_status['ATIVA'];
                    $empresa->status = Empresas::ACTIVE;
                    $empresa->macros_id = Anuncio::$_macros['ESTALEIRO'];
                    $empresa->usuarios_id = $usuarios_id;

                    // salvar logo e capa
                    if (CUploadedFile::getInstance($empresa, 'capa') != null) {

                        //$empresa->capa = CUploadedFile::getInstance($empresa,'capa');

                        $capa = CUploadedFile::getInstance($empresa, 'capa');

                        if ($capa != null) {
                            $empresa->capa = Utils::genImageName($capa);
                        }

                        // salvar imagem de capa no servidor
                        if (!$capa->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $empresa->capa)) {
                            $empresa->addError('capa', 'Ocorreu um erro ao salvar a capa');
                            $flgCadastroOK = false;
                        }
                    }

                    if (CUploadedFile::getInstance($empresa, 'logo') != null) {
                        //$empresa->logo = CUploadedFile::getInstance($empresa,'logo');

                        $logo = CUploadedFile::getInstance($empresa, 'logo');

                        if ($logo != null) {
                            $empresa->logo = Utils::genImageName($logo);
                        }

                        if (!$logo->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $empresa->logo)) {
                            $empresa->addError('logo', 'Ocorreu um erro ao salvar o logo');
                            $flgCadastroOK = false;
                        }
                    }

                    if ($empresa->save()) {

                        $plano->usuarios_id = $usuarios_id;
                        $plano->save();

                        // vincular a coluna de plano da tabela de empresas
                        if ($plano->save()) {
                            $emp = Empresas::model()->findByPk($empresa->id);
                            $emp->plano_usuarios_id = $plano->id;
                            $emp->update();
                        }
                    }
                }

                else {
                    Yii::app()->user->setFlash('erro', 'Usuário já possui um estaleiro!');
                }


                // commitar
                if ($flgCadastroOK) {

                    Yii::app()->user->setFlash('sucesso', 'Sucesso ao cadastrar o estaleiro');
                    $transaction->commit();

                    // logar como o usuário para cadastrar as embarcações
                    $identity = new UserIdentity(null, null);
                    $identity->switchUser($usuario->id);
                    Yii::app()->user->login($identity);
                }
            } catch (Exception $e) {
                Yii::app()->user->setFlash('erro', 'Ocorreu um erro crítico. Favor tente mais tarde');
                $transaction->rollback();
                var_dump($e->getMessage());
                //exit;
            }
        }



        // renderizar form de cadastro de empresa/estaleiro
        $this->render('estaleiro-create', array('empresa' => $empresa,
            'usuario' => $usuario, 'plano' => $plano, 'flgCadastroOK' => $flgCadastroOK));
    }

    public function actionUpdate($id) {

        // pegar a empresa do usuário
        //$empresa = Usuarios::getEmpresa();
        $empresa = $this->loadModel($id, 'Empresas');

        // usuário
        $usuario = Usuarios::getUsuarioLogado();

        // estado do usuario
        $estado = $usuario->estados;

        // cidade do usuario
        $cidade = $usuario->cidades;

        // logo e capa
        $logo = $empresa->logo;
        $capa = $empresa->capa;

        // possivel mensagem de erro
        $erro = '';

        if (count($_POST)) {
            $transaction = Yii::app()->db->beginTransaction();

            try {

                // setar atributos
                $empresa->setAttributes($_POST['Empresas']);
                $empresa->logo = $logo;
                $empresa->capa = $capa;
                $return = $empresa->update();
                // atualizar empresa
                if (!$return) {
                    $erro = "Ocorreu um erro ao atualizar os dados.";
                }

                // comitar os saves
                if ($erro == '') {
                    $transaction->commit();
                    $this->redirect(Empresas::mountUrl($empresa, $empresa->macros_id));
                    exit;
                }

            } catch (Exception $e) {

                $erro = "Ocorreu um erro ao atualizar os dados da empresa.";
                $transaction->rollback();

                // salvar log de erro
                $logErro = new Logs;
                $logErro->chave = 'Erro update empresa';
                $logErro->valor = $e->getMessage();
                $logErro->save();
            }
        }

        // renderizar pagina com os dados da empresa
        $this->render('update', array('erro' => $erro, 'empresa' => $empresa));
    }

    // método que altera a imagem de logo da empresa, executado via ajax
    public function actionUpdateLogoAjax() {

        if (isset($_POST)) {

            // pegar a empresa do usuário
            $empresa = Empresas::model()->findByPk((int) $_POST['id_empresa']);
            $imagem = CUploadedFile::getInstance($empresa, 'logo');

            $size = $imagem->size / 1024;

            if ($imagem->type != Anuncio::$_extensoes_permitidas['JPEG'] && $imagem->type != Anuncio::$_extensoes_permitidas['JPG'] && $imagem->type != Anuncio::$_extensoes_permitidas['PNG']) {
                echo '-1';
                exit;
            }

            // se for mais que 1000 kb, informar erro
            if ($size > 1020 || $size < 5) {
                echo '-1';
                exit;
            }

            $empresa->logo = Utils::genImageName($imagem);

            if ($empresa->logo != null) {
                if ($imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $empresa->logo)) {
                    if (!$empresa->update()) {

                        echo "-1";
                    }

                    // deu certo
                    else {
                        echo $empresa->logo;
                    }
                }
            }
        }
    }

    // método que altera a imagem de capa da empresa, executado via ajax
    public function actionUpdateCapaAjax() {

        if (isset($_POST)) {

            // pegar a empresa do usuário
            $empresa = Empresas::model()->findByPk((int) $_POST['id_empresa']);
            $imagem = CUploadedFile::getInstance($empresa, 'capa');

            $size = $imagem->size / 1024;

            if ($imagem->type != Anuncio::$_extensoes_permitidas['JPEG'] && $imagem->type != Anuncio::$_extensoes_permitidas['JPG'] && $imagem->type != Anuncio::$_extensoes_permitidas['PNG']) {
                echo '-1';
                exit;
            }


            // se for mais que 1000 kb, informar erro
            if ($size > 1020 || $size < 5) {

                echo '-1';
                exit;
            }

            $empresa->capa = Utils::genImageName($imagem);

            if ($empresa->capa != null) {
                if ($imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $empresa->capa)) {
                    if (!$empresa->update()) {
                        echo "-1";
                    }

                    // certo
                    else {
                        echo $empresa->capa;
                    }
                }
            }
        }
    }

    // remover capa ou logo
    public function actionRemoverCapaOuLogo() {

        if (isset($_POST)) {

            $capalogo = $_POST['capalogo'];
            $id_empresa = $_POST['id_empresa'];



            $empresa = $this->loadModel($id_empresa, 'Empresas');

            // 1 - capa // 2 - logo
            if ($capalogo == '2') {

                $empresa->logo = null;
            } else {
                $empresa->capa = null;
            }



            if ($empresa->update()) {

                echo '1';
            } else {
                echo '-1';
            }
        }
    }

    // ḿétodo que altera a imagem da turbinada com o ID passado
    public function actionUpdateFotoTurbinada() {


        // create
        if ($_POST['flgCreateOuUpdate'] == 1) {

            $id_empresa = (int) $_POST['id_empresa'];
            $imagemTurbinadaEmpresa = new EmpresaImagens;
            $imagemTurbinadaEmpresa->empresas_id = $id_empresa;
            $imagemTurbinadaEmpresa->status = 1;

            $imagem = CUploadedFile::getInstanceByName('img-turbinada');

            $size = $imagem->size / 1024;

            if ($imagem->type != Anuncio::$_extensoes_permitidas['JPEG'] && $imagem->type != Anuncio::$_extensoes_permitidas['JPG'] && $imagem->type != Anuncio::$_extensoes_permitidas['PNG']) {
                echo '-1';
                exit;
            }


            // se for mais que 1000 kb, informar erro
            if ($size > 1020 || $size < 5) {

                echo '-1';
                exit;
            }

            $imagemTurbinadaEmpresa->imagem = Utils::genImageName($imagem);

            if ($imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $imagemTurbinadaEmpresa->imagem)) {
                $imagemTurbinadaEmpresa->save();
                echo $imagemTurbinadaEmpresa->imagem;
            } else {
                echo "-1";
            }
        }

        // update
        else {

            $id_empresa = (int) $_POST['id_empresa'];

            $id_img_turbinada = (int) $_POST['id_imagem'];

            $imgTurbinada = EmpresaImagens::model()->find('empresas_id=:empresas_id AND id=:id', array(':empresas_id' => $id_empresa, ':id' => $id_img_turbinada));

            if ($imgTurbinada != null) {

                $imagem = CUploadedFile::getInstanceByName('img-turbinada');

                $size = $imagem->size / 1024;

                if ($imagem->type != Anuncio::$_extensoes_permitidas['JPEG'] && $imagem->type != Anuncio::$_extensoes_permitidas['JPG'] && $imagem->type != Anuncio::$_extensoes_permitidas['PNG']) {
                    echo '-1';
                    exit;
                }


                // se for mais que 1000 kb, informar erro
                if ($size > 1020 || $size < 5) {

                    echo '-1';
                    exit;
                }

                $imagemTurbinadaEmpresa->imagem = Utils::genImageName($imagem);


                if ($imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $imgTurbinada->imagem)) {
                    if (!$imgTurbinada->update()) {
                        // erro
                        echo "-1";
                    } else {

                        // certo
                        echo $imagemTurbinadaEmpresa->imagem;
                    }
                }
            }
        }
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Empresas')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin() {
        $model = new Empresas('searchAdmin');
        $model->unsetAttributes();

        if (isset($_GET['Empresas']))
            $model->setAttributes($_GET['Empresas']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionAdminAnunciosPagos() {
        $model = new Empresas('searchAnunciosPagos');
        $model->unsetAttributes();

        if (isset($_GET['Empresas']))
            $model->setAttributes($_GET['Empresas']);

        $this->render('admin_anuncios_pagos', array(
            'model' => $model,
        ));
    }

    public function actionAdminEstaleiros() {
        $model = new Empresas('searchEstaleiros');
        $model->unsetAttributes();

        if (isset($_GET['Empresas']))
            $model->setAttributes($_GET['Empresas']);

        $this->render('admin_estaleiros', array(
            'model' => $model,
        ));
    }

    /**
     * Index de Guia de Empresas
     * @return [type] [description]
     */
    public function actionIndex() {

        $this->redirect('http://guiadocapitao.com.br/');

        // atualizar empresas
        /*Empresas::atualizarEmpresasVencidas();
        $search = Yii::app()->request->getParam('search');

        // destaque empresas q tem cpm
        $criteria_destaques = new CDbCriteria();
        $criteria_destaques->with['planoUsuarios'] = array('with'=>'planos','condition'=>'planos.gratuito=0');
        $criteria_destaques->condition = 'empresas_impressoes.status = 1 and t.status = 2';
        $criteria_destaques->distinct = true;
        $criteria_destaques->join = 'INNER JOIN empresas_impressoes ON empresas_impressoes.empresas_id = t.id';
        $criteria_destaques->order = 'RAND()';

        $destaques = Empresas::model()->findAll($criteria_destaques);

        $categorias = EmpresaCategorias::model()->findAll();

        $this->render('guia-index', array('destaques' => $destaques, 'categorias' => $categorias));*/
    }

    /**
     * Página de busca de Estaleiros
     * @return [type] [description]
     */
    public function actionEstaleirosIndex() {

        $this->redirect("/catalogo");
        exit;
        // atualizar empresas
        Empresas::atualizarEmpresasVencidas();

        $termo = Yii::app()->request->getParam('termo');
        $categoria = Yii::app()->request->getParam('categoria');
        $localizacao = Yii::app()->request->getParam('localizacao');
        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Empresas::LIMIT_SEARCH_ESTALEIRO) : null;

        $array_params = array(
            'termo' => $termo,
            'categoria' => $categoria,
            'localizacao' => $localizacao
        );
        $title = array('Estaleiros');

        // Se for AJAX retorna TRUE
        $ajax = Yii::app()->request->getParam('ajax');


        /* ==========  Destaques  ========== */
        $condition_destaque = 't.macros_id = :macro AND t.status = :status AND t.destaque = 1';
        $params_destaque = array(':macro' => Macros::$macro_by_slug['estaleiro'], ":status" => Empresas::ACTIVE);

        // Busca digitada
        if ($termo != null) {
            $condition_destaque .= " AND (t.razao LIKE :termo OR t.email LIKE :termo OR t.slug LIKE :termo)";
            $params_destaque[':termo'] = '%' . $termo . '%';
            $title[] = $termo;
        }

        // Estaleiros em destaque
        $criteria_destaques = new CDbCriteria();
        /*$criteria_destaques->with = array(
            'empresaImagens',
            'planoUsuarios' => array(
                'with' => 'planos',
                /* VER AQUI => EMPRESAS EM DESTAQUE O PLANO GRATS É 0, VER PRA MUDAR AO INVES DISSO SER T.DESTAQUE = 1
                'condition' => 'planos.gratuito = 0'
            )
        );*/
        $criteria_destaques->limit = Empresas::LIMIT_SEARCH_ESTALEIRO;
        $criteria_destaques->order = "razao ASC";
        $criteria_destaques->condition = $condition_destaque;
        $criteria_destaques->params = $params_destaque;


        /* ==========  Estaleiros  ========== */
        $condition = 'destaque = 0 and t.macros_id = :macro AND t.status = :status AND logo IS NOT NULL';
        $params = array(':macro' => Macros::$macro_by_slug['estaleiro'], ":status" => Empresas::ACTIVE);

        // Busca digitada
        if ($termo != null) {
            $condition .= " AND (t.razao LIKE :termo OR t.email LIKE :termo OR t.slug LIKE :termo)";
            $params[':termo'] = '%' . $termo . '%';
        }

        $criteria = new CDbCriteria();
        $criteria->with = array('empresaImagens');
        $criteria->limit = Empresas::LIMIT_SEARCH_ESTALEIRO;
        $criteria->order = "razao ASC";
        if ($offset != null) {
            $criteria->offset = $offset;
        }
        //$criteria->together = true;
        $criteria->condition = $condition;
        $criteria->params = $params;
        $estaleiros = Empresas::model()->findAll($criteria);

        // retornando HTML
        if ($ajax != null && $ajax == true) {

            $html = '';

            foreach ($estaleiros as $key => $value) {

                if (Yii::app()->theme->name != 'mobile') {


                    $html .= '<li class="category-free">';
                    $html .= '<a href="' . Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']) . '">';

                    if (!empty($value->logo)) {
                        $html .= '<img alt="'.$value->razao.'" class="bg-img-est" src="' . Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $value->logo . '">';
                    } else {
                        $html .= '<img alt="'.$value->razao.'" class="bg-img-est" src="' . Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg">';
                    }

                    $html .= '</a>';
                    $html .= '</li>';
                }

                // html ver mais tema mobile
                else {

                    $html .= '<div class="result-content result-middle pure-g">';

                    $html .= '<a href="' . Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']) . '" class="link-result">';

                    $html .= '<div class="result-image pure-u-1-3">';
                    if ($value->logo != null) {
                        $html .= '<img alt="'.$value->razao.'" class="bg-img-guia-gl" src="' . Yii::app()->baseUrl . '/public/empresas/' . $value->logo . '" />';
                    } else {
                        $html .= '<img alt="'.$value->razao.'" class="bg-img-guia-gl" src="' . Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg">';
                    }

                    $html .= '</div>';
                    $html .= '<div class="result-infos pure-u-2-3">';
                    $html .= '<div class="infos-content">';
                    $html .= '<article class="result-title-middle">' . $value->razao . '</article>';
                    $html .= '</div>';
                    $html .= '</div>';

                    $html .= '</a>';

                    $html .= '</div>';
                }
            }

            echo json_encode(array('html' => $html, 'count' => count($estaleiros)));

        } else {


            Yii::app()->clientScript->registerMetaTag(Utils::mountDescription($title), 'description', null, array(), 'bombarco_description');
            $this->setPageTitle(Utils::mountTitle($title));

            $destaques = Empresas::model()->findAll($criteria_destaques);

            $this->render('estaleiros-index', array(
                'estaleiros' => $estaleiros,
                'destaques' => $destaques,
                'array_params' => $array_params
            ));
        }
    }

    /**
     * Detalhe de Estaleiro
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionEstaleirosDetalhe($slug) {

                $this->redirect("/catalogo");
        exit;

        $estaleiro = Empresas::model()->findByAttributes(array('slug' => $slug));

        if($estaleiro == null) {
            $this->redirect(Yii::app()->createUrl("estaleiros"));
        }

        // Title
        if (!empty($estaleiro->nomefantasia)) {
            $this->setPageTitle($estaleiro->nomefantasia . ' - Estaleiros Bombarco');
        } else {
            $this->setPageTitle($estaleiro->razao . ' - Estaleiros Bombarco');
        }

        if (Yii::app()->user->id != $estaleiro->usuarios_id) {
            $estaleiro->cliques += 1;
            $estaleiro->update();
        }

        // Se o Estaleiro não estiver Ativo e eu não for o dono dela
        // redireciona para Home
        if (empty($estaleiro) || ($estaleiro->status != Empresas::ACTIVE && $estaleiro->usuarios_id != Yii::app()->user->id && !Yii::app()->user->isAdmin()))
            $this->redirect(Yii::app()->homeUrl);

        $noticias = Conteudos::model()->with('conteudoImagens')->findAllByAttributes(array('macro' => 'N', 'status' => 1, 'usuarios_id' => $estaleiro->usuarios_id), array('condition' => 't.data between date_sub(now(), interval 999 day) and CURDATE()', 'order' => 't.data DESC, id DESC', 'limit' => 3));

        $this->render('estaleiro-view', array(
            'model' => $estaleiro,
            'noticias' => $noticias
        ));
    }



    /**
     * Altera o status do ańúncio
     * @return [type] [description]
     */
    public function actionChangeStatus($id) {

        $res = array(
            'error' => 0,
            'msg' => 'Status alterado com sucesso!'
        );

        try {

            $status = Yii::app()->request->getParam('status');

            if (empty($id) || empty($status)) {
            	var_dump($id);
            	var_dump($status);
                throw new Exception("Informe o ID e Status", 1);
            }

            $empresa = Empresas::model()->findByPk($id);

            if (empty($empresa))
                throw new Exception("Empresa não existe", 1);

            // Se estiver ATIVANDO o anúncio
            if ($status == Anuncio::$_status_anuncio['ANUNCIO_ATIVADO']) {

                if (empty($empresa->planoUsuarios))
                    throw new Exception("Plano não existe", 1);

                // Se o plano não estiver pago
                if ($empresa->planoUsuarios->status != Anuncio::$_status_plano['PAGO'])
                    throw new Exception("Plano não esta ativo", 2);

                // Se o plano estiver vencido
                if (PlanoUsuarios::isOverdue($empresa->planoUsuarios))
                    throw new Exception("Plano vencido", 2);
            }

            $empresa->status = $status;
            if (!$empresa->saveAttributes(array('status')))
                throw new Exception("Erro ao alterar Status", 2);

        } catch (Exception $e) {
            $res['error'] = $e->getCode();
            $res['msg'] = $e->getMessage();
        }

        echo json_encode($res);
        exit();
    }

}
