<?php

class ConteudosController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'noticias', 'primeirobarco', 'testebombarco', 'noticiadetalhe', 'primeirobarcodetalhe', 'blog', 'blogdetalhe'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('admin', 'delete', 'minicreate', 'create', 'update', 'changeStatus', 'listarCategorias', 'updateFoto'),
                'expression' => '$user->isAdmin()'
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate() {

        $model = new Conteudos;
        $conteudoImagem = new ConteudoImagens;
        $seo = new ConteudoSeo;

        if (isset($_POST['Conteudos'])) {

            // flg que indica se os saves foram ok
            $flgsaveok = true;

            // transaction
            $transaction = Yii::app()->db->beginTransaction();

            try {

                // conteudos
                $model->setAttributes($_POST['Conteudos']);
                $model->status = 1;
                // formatar a data
                // se for categoria diferente de blog, setamos uma sub categoria para poder gerar o mountUrl dps
                if ($model->macro != 'B') {
                    $model->conteudo_categorias_id = 0;
                }

                $model->data = Conteudos::formatDateTimeToDb($model->data);

                if (!$model->save()) {
                    $flgsaveok = false;
                }

                // conteudo seo
                if (isset($_POST['ConteudoSeo']) && $_POST['ConteudoSeo']['title'] != "" && $_POST['ConteudoSeo']['description'] != "") {

                    $seo->setAttributes($_POST['ConteudoSeo']);
                    $seo->conteudos_id = $model->id;

                    if (!$seo->save()) {
                        $flgsaveok = false;
                    }
                }

                // conteudo imagens
                //$conteudoImagem->imagem = CUploadedFile::getInstance($conteudoImagem,'imagem');

                $imagem = CUploadedFile::getInstanceByName('ConteudoImagens[imagem]');

                if ($imagem != null) {
                    $conteudoImagem->imagem = Utils::genImageName($imagem);
                }

                $size = $imagem->size / 1024;

                // se for mais que 1000 kb, informar erro
                if ($size > 1020 || $size < 30) {
                    
                    $flgsaveok = false;
                }

                if ($imagem->type != Anuncio::$_extensoes_permitidas['JPEG'] && $imagem->type != Anuncio::$_extensoes_permitidas['JPG'] && $imagem->type != Anuncio::$_extensoes_permitidas['PNG']) {
                    $flgsaveok = false;
                }

                if ($imagem != null) {

                    if (!$imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/conteudos/' . $conteudoImagem->imagem)) {
                        $flgsaveok = false;
                    }
                }

                $conteudoImagem->conteudos_id = $model->id;

                if (!$conteudoImagem->save()) {
                    $flgsaveok = false;
                }



                // tags (separar a virgula e o espaço)
                $tags = explode(', ', $_POST['tags']);

                if (count($tags) > 0) {

                    foreach ($tags as $tag) {

                        if ($tag != "") {
                            $conteudoTags = new ConteudosHasTags;
                            $conteudoTags->tags_id = Tags::model()->find('slug=:slug', array(':slug' => $tag))->id;
                            $conteudoTags->conteudos_id = $model->primaryKey;
                            if (!$conteudoTags->save()) {

                                $flgsaveok = false;
                            }
                        }
                    }
                }


                // commitar
                if ($flgsaveok) {

                    $transaction->commit();
                    Yii::app()->user->setFlash('mensagem', 'Sucesso ao cadastrar a notícia!');
                } else {
                    Yii::app()->user->setFlash('mensagem', 'Ocorreu um erro ao cadastrar a notícia (Verifique o formato e tamanho da foto)!');
                }
            } catch (Exception $e) {
                $transaction->rollback();
            }
        }

        // scripts
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_conteudos.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/jquery-ui.css');
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery-ui.js');

        // zerar campos
        $model->unsetAttributes();
        $seo->unsetAttributes();
        $conteudoImagem->unsetAttributes();

        $this->render('create', array('model' => $model,
            'conteudoImagem' => $conteudoImagem,
            'seo' => $seo));
    }

    /*
     * Método que retorna uma lista contendo as categorias de conteudo
     * com base na macro passada (P, N ou B)
     */

    public function actionListarCategorias() {

        $macro = $_POST['macro_conteudo'];

        echo CJSON::encode(ConteudoCategorias::model()->findAll('macro=:macro', array(':macro' => $macro)));
    }

    public function actionUpdate($id) {


        $model = $this->loadModel($id, 'Conteudos');
        $conteudoImagem = ConteudoImagens::model()->find('conteudos_id =:conteudos_id', array(':conteudos_id' => $id));

        if (empty($conteudoImagem)) {
            $conteudoImagem = new ConteudoImagens();
        }

        $seo = ConteudoSeo::model()->find('conteudos_id=:conteudos_id', array(':conteudos_id' => $id));

        // ids das tags contendo o id da noticia
        $array_tags_id = ConteudosHasTags::model()->findAll('conteudos_id=:conteudos_id', array(':conteudos_id' => $id));

        // slugs das tags que a noticia ja possui
        $slug_tags = array();

        // popular array de slugs
        foreach ($array_tags_id as $tags_id) {
            $slug_tags[] = Tags::model()->findByPk($tags_id->tags_id)->slug;
        }


        if ($seo == null) {
            $seo = new ConteudoSeo;
        }

        if (isset($_POST['Conteudos'])) {

            // flg que indica se os saves foram ok
            $flgsaveok = true;

            // transaction
            $transaction = Yii::app()->db->beginTransaction();

            try {

                // conteudos
                $model->setAttributes($_POST['Conteudos']);
                $model->data = Conteudos::formatDateTimeToDb($model->data);

                if (!$model->update()) {
                    $flgsaveok = false;
                }

                // tags (separar a virgula e o espaço)
                /* $tags = explode(', ',$_POST['tags']);

                  if(count($tags) > 0) {

                  foreach($tags as $tag) {

                  if($tag != "") {
                  $conteudoTags = new ConteudosHasTags;
                  $conteudoTags->tags_id = Tags::model()->find('slug=:slug', array(':slug'=>$tag))->id;
                  $conteudoTags->conteudos_id = $model->primaryKey;
                  if(!$conteudoTags->save()) {
                  $flgsaveok = false;
                  }
                  }
                  }
                  } */

                // conteudo seo
                if (isset($_POST['ConteudoSeo'])) {

                    $seo->setAttributes($_POST['ConteudoSeo']);
                    $seo->conteudos_id = $model->id;

                    if (!$seo->save()) {
                        $flgsaveok = false;
                    }
                }


                // commitar
                if ($flgsaveok) {

                    $transaction->commit();
                    Yii::app()->user->setFlash('mensagem', 'Sucesso ao alterar a notícia!');
                } else {
                    Yii::app()->user->setFlash('mensagem', 'Ocorreu um erro ao alterar a notícia!');
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('mensagem', 'Ocorreu um erro ao alterar a notícia!');
            }
        }

        // scripts
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_conteudos.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/jquery-ui.css');
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery-ui.js');

        $this->render('update', array(
            'model' => $model,
            'seo' => $seo,
            'conteudoImagem' => $conteudoImagem));
    }

    public function actionUpdateFoto() {

        if (isset($_POST)) {

            // pegar a empresa do usuário
            $conteudoImagem = ConteudoImagens::model()->findByPk((int) $_POST['conteudo_imagem_id']);

            if ($conteudoImagem == null) {
                $conteudoImagem = new ConteudoImagens;
                $conteudoImagem->conteudos_id = $_POST['conteudos_id'];
            }

            $conteudoImagem->imagem = CUploadedFile::getInstance($conteudoImagem, 'imagem');

            if ($conteudoImagem->imagem != null) {

                if (!$conteudoImagem->imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/conteudos/' . $conteudoImagem->imagem)) {
                    echo '-1';
                } else {

                    $conteudoImagem->save();
                    echo '1';
                }
            }
        }
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Conteudos')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {

        // veio do 'Ver Mais'
        $busca = Yii::app()->request->getParam('busca');

        // noticias, primeiro barco e blog
        $noticias = '';
        $blog = '';
        $primeiro_barco = '';

        // se clicou em ver mais, temos q filtrar de acordo com a palavra buscada
        if ($busca != null) {

            $criteria_noticias = new CDbCriteria();
            $criteria_noticias->with = array('conteudoImagens', 'conteudoCategorias');
            $criteria_noticias->limit = 3;
            $criteria_noticias->condition = 't.status = 1 AND t.macro = "N" AND (t.titulo LIKE :busca OR t.texto LIKE :busca OR conteudoCategorias.titulo LIKE :busca)';
            $criteria_noticias->params = array(':busca' => '%' . $busca . '%');
            $noticias = Conteudos::model()->findAll($criteria_noticias);

            $criteria_primeiro_barco = new CDbCriteria();
            $criteria_primeiro_barco->with = array('conteudoImagens', 'conteudoCategorias');
            $criteria_primeiro_barco->limit = 3;
            $criteria_primeiro_barco->condition = 't.status = 1 AND t.macro = "P" AND (t.titulo LIKE :busca OR t.texto LIKE :busca OR conteudoCategorias.titulo LIKE :busca)';
            $criteria_primeiro_barco->params = array(':busca' => '%' . $busca . '%');
            $primeiro_barco = Conteudos::model()->findAll($criteria_primeiro_barco);

            $criteria_blog = new CDbCriteria();
            $criteria_blog->with = array('conteudoImagens', 'conteudoCategorias');
            $criteria_blog->limit = 3;
            $criteria_blog->condition = 't.status = 1 AND t.macro = "B" AND (t.titulo LIKE :busca OR t.texto LIKE :busca OR conteudoCategorias.titulo LIKE :busca)';
            $criteria_blog->params = array(':busca' => '%' . $busca . '%');
            $blog = Conteudos::model()->findAll($criteria_blog);
        }

        // não veio de "Ver Mais", exibir posts aleatórios
        else {

            $noticias = Conteudos::model()->findAllByAttributes(array('macro' => 'N', 'status' => 1), array('condition' => 't.data between date_sub(now(), interval 999 day) and CURDATE()',
                'order' => 't.data DESC', 'limit' => 3));

            $primeiro_barco = Conteudos::model()->findAllByAttributes(array('macro' => 'P', 'status' => 1), array('condition' => 't.data between date_sub(now(), interval 999 day) and CURDATE()',
                'order' => 't.data DESC', 'limit' => 3));

            $blog = Conteudos::model()->findAllByAttributes(array('macro' => 'B', 'status' => 1), array('condition' => 't.data between date_sub(now(), interval 999 day) and CURDATE()',
                'order' => 't.data DESC', 'limit' => 3));

            //$noticias = Conteudos::model()->findAllByAttributes(array('macro'=>'N'), array('limit'=>3, 'order'=>'data DESC'));
            //$primeiro_barco = Conteudos::model()->findAllByAttributes(array('macro'=>'P'), array('limit'=>3, 'order'=>'data DESC'));
            //$blog = Conteudos::model()->findAllByAttributes(array('macro'=>'B'), array('limit'=>3, 'order'=>'data DESC'));
        }

        $this->render('index', array(
            'noticias' => $noticias,
            'primeiro_barco' => $primeiro_barco,
            'blog' => $blog,
        ));
    }

    public function actionAdmin() {
        $model = new Conteudos('search');
        $model->unsetAttributes();

        if (isset($_GET['Conteudos']))
            $model->setAttributes($_GET['Conteudos']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Página: Notícias
     * @return [type] [description]
     */
    public function actionNoticias() {

        $categoria = Yii::app()->request->getQuery('categoria');
        $busca = Yii::app()->request->getQuery('busca');
        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Conteudos::LIMIT_SEARCH) : null;

        $array_view = array();

        $array_params = array(
            'busca' => $busca,
            'categoria' => $categoria
        );

        // Se for AJAX retorna TRUE
        $ajax = Yii::app()->request->getParam('ajax');

        $criteria = new CDbCriteria();
        $criteria->with = array('conteudoImagens', 'conteudoCategorias', 'embarcacaoMacros');
        $criteria->condition = 't.macro = "N" AND t.status = 1 AND t.data between date_sub(now(), interval 999 day) and CURDATE()';
        $criteria->order = 't.data DESC';
        $criteria->limit = Conteudos::LIMIT_SEARCH - 1; // Resultado menos 1, para encaixar no layout
        // Se for AJAX carregam 12 resultados
        if (!empty($ajax) && $ajax == true) {
            $criteria->limit = Conteudos::LIMIT_SEARCH;
        }

        // Condition e Params do Criteria
        $params = array();

        // Se existe categoria selecionada
        if ($categoria != null && $categoria != '-1') {

            $categoria = ConteudoCategorias::model()->findByAttributes(array('slug' => $categoria, 'macro' => Conteudos::$categorias_by_slug['noticias']));
            if ($categoria != null) {
                $array_view['categoria'] = $categoria;
                $criteria->addCondition('t.conteudo_categorias_id = :categoria');
                $params[':categoria'] = $categoria->id;
            }
        }

        // Se existe busca digitada
        if ($busca != null) {
            $criteria->addCondition('(t.titulo LIKE :busca OR t.texto LIKE :busca)');
            $params[':busca'] = '%' . $busca . '%';
        }

        if ($offset != null) {
            $criteria->offset = $offset;
        }

        $criteria->params = $params;
        $noticias = Conteudos::model()->findAll($criteria);

        // Se for AJAX exibe na tela
        if ($ajax != null && $ajax == true) {

            $html = '';

            foreach ($noticias as $key => $value) {

                $data = $value->data;
                $titulo = $value->titulo;
                $macro = (isset($value->embarcacaoMacros)) ? $value->embarcacaoMacros->titulo : '';

                $html .= '<li class="category-nt">';
                $html .= '<a href="' . Conteudos::mountUrl($value) . '">';
                $html .= Conteudos::getThumb($value, array('class' => 'bg-img-nt'), false);
                $html .= '<span class="blend"></span>';
                $html .= '<span class="table-nt">';
                $html .= '<span class="texts-nt">';
                $html .= '<span class="text-data-nt">' . $data . '</span>';
                if ($value->embarcacaoMacros != null) {
                    $html .= '<span class="text-tipo-nt">' . $macro . '</span>';
                }
                $html .= '<span class="text-barco-nt">' . $titulo . '</span>';
                $html .= '</span>';
                $html .= '</span>';
                $html .= '</a>';
                $html .= '</li>';
            }

            echo json_encode(array('html' => $html, 'count' => count($noticias)));
        } else {

            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/conteudos.js', CClientScript::POS_END);

            // Breadcrumbs
            $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
            $breadcrumbs[] = array('texto' => 'Comunidade', 'link' => Yii::app()->createUrl('comunidade'));
            $breadcrumbs[] = array('texto' => 'Notícias', 'link' => Yii::app()->createUrl('comunidade/noticias'));

            $this->render('noticias', array(
                'noticias' => $noticias,
                'array_params' => $array_params,
                'array_view' => $array_view,
                'breadcrumbs' => $breadcrumbs
            ));
        }
    }

    /**
     * Detalhe de Notícia
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function actionNoticiaDetalhe($slug) {

        $noticia = Conteudos::model()->findByAttributes(array('slug' => $slug));

        // Breadcrumbs
        $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
        $breadcrumbs[] = array('texto' => 'Comunidade', 'link' => Yii::app()->createUrl('comunidade'));
        $breadcrumbs[] = array('texto' => 'Notícias', 'link' => Yii::app()->createUrl('comunidade/noticias'));
        $breadcrumbs[] = array('texto' => $noticia->titulo, 'link' => Conteudos::mountUrl($noticia));

        $this->setPageTitle('Notícias Bombarco - ' . $noticia->titulo);

        $this->render('detalhepostpadrao', array(
            'titulo' => 'Notícias',
            'model' => $noticia,
            'breadcrumbs' => $breadcrumbs,
        ));
    }

    /**
     * Página: Primeiro Barco
     * @return [type] [description]
     */
    public function actionPrimeiroBarco() {

        $busca = Yii::app()->request->getQuery('busca');
        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Conteudos::LIMIT_SEARCH) : null;

        $array_params = array(
            'busca' => $busca
        );

        // Se for AJAX retorna TRUE
        $ajax = Yii::app()->request->getParam('ajax');

        $criteria = new CDbCriteria();
        $criteria->with = array('conteudoImagens', 'embarcacaoMacros');
        $criteria->condition = 't.macro = "P" AND t.status = 1 AND t.data between date_sub(now(), interval 999 day) and CURDATE()';
        //$criteria->together = true;
        $criteria->order = 'data DESC';
        $criteria->limit = Conteudos::LIMIT_SEARCH;

        // Condition e Params do Criteria
        $params = array();

        // Se existe busca digitada
        if ($busca != null) {
            $criteria->addCondition('(t.titulo LIKE :busca OR t.texto LIKE :busca)');
            $params[':busca'] = '%' . $busca . '%';
        }

        if ($offset != null) {
            $criteria->offset = $offset;
        }

        $criteria->params = $params;
        $primeiro_barco = Conteudos::model()->findAll($criteria);

        // Se for AJAX exibe na tela
        if ($ajax != null && $ajax == true) {

            $html = '';

            foreach ($primeiro_barco as $key => $value) {

                $macro = (isset($value->embarcacaoMacros)) ? $value->embarcacaoMacros->titulo : '';

                $html .= '<li class="category-pb">';
                $html .= '<a href="' . Conteudos::mountUrl($value, 'primeiro-barco') . '">';
                $html .= Conteudos::getThumb($value, array('class' => 'bg-img-pb'), false);
                $html .= '<span class="blend"></span>';
                $html .= '<span class="table-pb">';
                $html .= '<span class="texts-pb">';
                $html .= '<span class="text-data">' . $value->data . '</span>';
                $html .= '<span class="text-tipo">' . $macro . '</span>';
                $html .= '<span class="text-barco">' . $value->titulo . '</span>	';
                $html .= '</span>';
                $html .= '</span>';
                $html .= '</a>';
                $html .= '</li>';
            }

            echo json_encode(array('html' => $html, 'count' => count($primeiro_barco)));
        } else {

            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/conteudos.js', CClientScript::POS_END);

            // Breadcrumbs
            $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
            $breadcrumbs[] = array('texto' => 'Comunidade', 'link' => Yii::app()->createUrl('comunidade'));
            $breadcrumbs[] = array('texto' => 'Primeiro Barco', 'link' => Yii::app()->createUrl('comunidade/primeiro-barco'));

            $this->render('primeiro_barco', array(
                'primeiro_barco' => $primeiro_barco,
                'array_params' => $array_params,
                'breadcrumbs' => $breadcrumbs
            ));
        }
    }

    /**
     * Detalhe de Primeiro Barco
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function actionPrimeiroBarcoDetalhe($slug) {

        $primeiro_barco = Conteudos::model()->findByAttributes(array('slug' => $slug));

        // Breadcrumbs
        $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
        $breadcrumbs[] = array('texto' => 'Comunidade', 'link' => Yii::app()->createUrl('comunidade'));
        $breadcrumbs[] = array('texto' => 'Primeiro Barco', 'link' => Yii::app()->createUrl('comunidade/primeiro-barco'));
        $breadcrumbs[] = array('texto' => $primeiro_barco->titulo, 'link' => Conteudos::mountUrl($primeiro_barco));

        $this->setPageTitle('Primeiro Barco - ' . $primeiro_barco->titulo);

        $this->render('detalhepostpadrao', array(
            'titulo' => 'Primeiro Barco',
            'model' => $primeiro_barco,
            'breadcrumbs' => $breadcrumbs,
        ));
    }

    /**
     * Página: Primeiro Barco
     * @return [type] [description]
     */
    public function actionTesteBombarco() {

        $busca = Yii::app()->request->getQuery('busca');
        $macro = Yii::app()->request->getQuery('macro');
        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Conteudos::LIMIT_SEARCH) : null;

        // Se for AJAX retorna TRUE
        $ajax = Yii::app()->request->getParam('ajax');

        $array_params = array(
            'busca' => $busca,
            'macro' => $macro
        );

        $criteria = new CDbCriteria();
        $criteria->with = array('conteudoImagens', 'conteudoCategorias', 'embarcacaoMacros');
        $criteria->condition = 't.macro = "T" AND t.status = 1 AND t.data between date_sub(now(), interval 999 day) and CURDATE()';
        $criteria->order = 'data DESC';
        $criteria->limit = Conteudos::LIMIT_SEARCH;

        // Condition e Params do Criteria
        $params = array();

        if ($macro != null) {
            $criteria->addCondition("embarcacao_macros_id = :macro");
            $params[':macro'] = EmbarcacaoMacros::$macro_by_slug[$macro];
        }

        // Se existe busca digitada
        if ($busca != null) {
            $criteria->addCondition('(t.titulo LIKE :busca OR t.texto LIKE :busca)');
            $params[':busca'] = '%' . $busca . '%';
        }

        if ($offset != null) {
            $criteria->offset = $offset;
        }

        $criteria->params = $params;
        $teste_bombarco = Conteudos::model()->findAll($criteria);

        // Se for AJAX exibe na tela
        if ($ajax != null && $ajax == true) {

            $html = '';

            foreach ($teste_bombarco as $key => $value) {

                $html .= '<li class="category-videos–lw4">';
                $html .= '<div style="background-color:transparent">';
                $html .= '<a href="#">';
                $html .= '<div class="js-lazyYT" id="btn-video1"  data-youtube-id="' . Utils::getYoutubeID($value->video) . '" data-width="300" data-height="200"></div>';
                $html .= '</a>';
                $html .= '<div class="textos-videos-lw4">';
                $html .= '<span class="text-videos-lw4-title"> ' . $value->titulo . ' </span>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</li>';
            }

            echo json_encode(array('html' => $html, 'count' => count($teste_bombarco)));
        } else {

            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/conteudos.js', CClientScript::POS_END);

            $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
            $breadcrumbs[] = array('texto' => 'Comunidade', 'link' => Yii::app()->createUrl('comunidade'));
            $breadcrumbs[] = array('texto' => 'Teste Bom Barco', 'link' => Yii::app()->createUrl('comunidade/teste-bombarco'));

            // Últimos 3 videos
            $ultimos_videos = Conteudos::model()->with('conteudoImagens')->findAllByAttributes(array('macro' => 'T'), array('order' => 't.data DESC, id DESC', 'limit' => 3));

            $this->render('teste_bombarco', array(
                'teste_bombarco' => $teste_bombarco,
                'ultimos_videos' => $ultimos_videos,
                'array_params' => $array_params,
                'breadcrumbs' => $breadcrumbs,
            ));
        }
    }

    /**
     * Página: Blog
     * @return [type] [description]
     */
    public function actionBlog() {

        $categoria = Yii::app()->request->getQuery('categoria');
        $busca = Yii::app()->request->getQuery('busca');
        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Conteudos::LIMIT_SEARCH) : null;

        $array_view = array();

        $array_params = array(
            'busca' => $busca,
            'categoria' => $categoria
        );

        // Se for AJAX retorna TRUE
        $ajax = Yii::app()->request->getParam('ajax');

        $criteria = new CDbCriteria();
        $criteria->with = array('conteudoImagens', 'conteudoCategorias', 'embarcacaoMacros');
        $criteria->condition = 't.macro = "B" AND t.status = 1 AND t.data between date_sub(now(), interval 999 day) and CURDATE()';
        $criteria->limit = Conteudos::LIMIT_SEARCH - 1; // Retirando 1 resultado para encaixar no layout
        $criteria->order = 'data DESC';

        // Se for AJAX carregam 12 resultados
        if (!empty($ajax) && $ajax == true) {
            $criteria->limit = Conteudos::LIMIT_SEARCH;
        }

        // Condition e Params do Criteria
        $params = array();

        // Se existe categoria selecionada
        if ($categoria != null && $categoria != '-1') {

            $categoria = ConteudoCategorias::model()->findByAttributes(array('slug' => $categoria, 'macro' => Conteudos::$categorias_by_slug['blog']));
            if ($categoria != null) {
                $array_view['categoria'] = $categoria;
                $criteria->addCondition('t.conteudo_categorias_id = :categoria');
                $params[':categoria'] = $categoria->id;
            }
        }

        // Se existe busca digitada
        if ($busca != null) {
            $criteria->addCondition('(t.titulo LIKE :busca OR t.texto LIKE :busca)');
            $params[':busca'] = '%' . $busca . '%';
        }

        if ($offset != null) {
            $criteria->offset = $offset;
        }

        $criteria->params = $params;
        $blog = Conteudos::model()->findAll($criteria);

        // Se for AJAX exibe na tela
        if ($ajax != null && $ajax == true) {

            $html = '';

            foreach ($blog as $key => $value) {

                $data = $value->data;
                $titulo = $value->titulo;
                $macro = (isset($value->embarcacaoMacros)) ? $value->embarcacaoMacros->titulo : '';

                $html .= '<li class="category-nt">';
                $html .= '<a href="' . Conteudos::mountUrl($value, 'blog') . '">';
                $html .= Conteudos::getThumb($value, array('class' => 'bg-img-nt'), false);
                $html .= '<span class="blend"></span>';
                $html .= '<span class="table-nt">';
                $html .= '<span class="texts-nt">';
                $html .= '<span class="text-data-nt">' . $data . '</span>';
                if ($value->embarcacaoMacros != null) {
                    $html .= '<span class="text-tipo-nt">' . $macro . '</span>';
                }
                $html .= '<span class="text-barco-nt">' . $titulo . '</span>';
                $html .= '</span>';
                $html .= '</span>';
                $html .= '</a>';
                $html .= '</li>';
            }

            echo json_encode(array('html' => $html, 'count' => count($blog)));
        } else {

            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/conteudos.js', CClientScript::POS_END);

            // Breadcrumbs
            $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
            $breadcrumbs[] = array('texto' => 'Comunidade', 'link' => Yii::app()->createUrl('comunidade'));
            $breadcrumbs[] = array('texto' => 'Blog', 'link' => Yii::app()->createUrl('comunidade/blog'));

            $this->render('blog', array(
                'blog' => $blog,
                'array_params' => $array_params,
                'array_view' => $array_view,
                'breadcrumbs' => $breadcrumbs
            ));
        }
    }

    /**
     * Detalhe de Blog
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function actionBlogDetalhe($slug) {

        $blog = Conteudos::model()->findByAttributes(array('slug' => $slug));

        // Carregando mais notícias desta categoria
        $criteria = new CDbCriteria();
        $criteria->with = array('conteudoCategorias');
        $criteria->limit = 4;
        $criteria->addCondition('conteudoCategorias.id = :id_cat AND t.id != :curr_id');
        $criteria->params = array(':id_cat' => $blog->conteudoCategorias->id, ':curr_id' => $blog->id);
        $mais_blog = Conteudos::model()->findAll($criteria);

        // Breadcrumbs
        $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
        $breadcrumbs[] = array('texto' => 'Comunidade', 'link' => Yii::app()->createUrl('comunidade'));
        $breadcrumbs[] = array('texto' => 'Blog', 'link' => Yii::app()->createUrl('comunidade/blog'));
        $breadcrumbs[] = array('texto' => $blog->titulo, 'link' => Conteudos::mountUrl($blog));

        $this->setPageTitle('Blog Notícias Náuticas - ' . $blog->titulo);

        $this->render('detalhepostpadrao', array(
            'titulo' => 'Blog',
            'model' => $blog,
            'mais_desta_categoria' => $mais_blog,
            'breadcrumbs' => $breadcrumbs,
        ));
    }

    /**
     * Action que altera o Status
     * Se estiver Ativado, desativa
     * Se estiver Desativado, ativa
     * @param  [type] $id [ID do Modelo]
     * @return [type]     [description]
     */
    public function actionChangeStatus($id) {

        if (isset($_GET)) {
            $model = Conteudos::model()->findByPk($id);

            if ($model->status == 0) {
                $model->status = 1;
            } else if ($model->status == 1) {
                $model->status = 0;
            }

            if ($model->update()) {
                echo '1';
            } else {
                echo '-1';
            }
        }
    }

}
