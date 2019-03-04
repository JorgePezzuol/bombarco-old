<?php

class ZeromilhasController extends GxController
{

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'catalogo', 'filtros', 'buscarModelos', 'listarTipos', 'listarMarcas', 'carregarMais', 'detalhe', 'pagamento', 'planosParaMotor'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('dashboard', 'perfil', 'perfilAlterar', 'planos', 'mensagens', 'abrirConversa', 'enviarMsg', 'criarPlanoMotor', 'anunciarMotor', 'teste'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionTeste() {

    	// plano => 13067
    	// user => 3108
    	// empresas_id => 767

    	// 6314

    	// 2437

    	$usuarios_embarcs = UsuariosEmbarcacoes::model()->findAll("usuarios_id = 3108");

    	foreach($usuarios_embarcs as $ue) {

    		$emb = Embarcacoes::model()->findByPk($ue->embarcacoes_id);

    		if($emb->macros_id != 3) continue;

    		if(strtolower($emb->slug[0]) == "a") {
    			$ue->empresas_id = 1605;
    			$ue->usuarios_id = 6314;
    			$emb->plano_usuarios_id = 10948;
    		}
    		else {
    			$ue->empresas_id = 96;
    			$ue->usuarios_id = 2437;
    			$emb->plano_usuarios_id = 6140;
    		}

    		$emb->update();
    		$ue->update();
    	}


    }

    public function actionPagamento() {

        Yii::app()->theme = "";

        $ordens = Usuarios::getOrdens();
        $somaOrdens = Usuarios::somarOrdens();
        if($somaOrdens == null) {
            $somaOrdens = 'R$ 0,00';
        }
        else {
            $somaOrdens = 'R$ '. Utils::formataValorView($somaOrdens);
        }
                                

        $this->render('pagamento', array('ordens' => $ordens, 'somaOrdens' => $somaOrdens));
    }

    public function actionEnviarMsg() {

        $id_embarcacao = $_POST["id_embarcacao"];
        $id_usuario_dest = $_POST["id_usuario_dest"];
        $msg = $_POST["msg"];
        $id_msg_cima = $_POST["id_msg_cima"];

        if ($id_usuario_dest == Yii::app()->user->id) {
            echo '0';
            exit;
        }

        $usuario_rem = Usuarios::model()->findByPk(Yii::app()->user->id);
        $embarcacao = Embarcacoes::model()->findByPk($id_embarcacao);
        $usuario_dest = Usuarios::model()->findByPk($id_usuario_dest);

        $contato = new Contatos;
        $contato->email_rem = $usuario_rem->email;
        $contato->nome_rem = $usuario_rem->nome;
        $contato->mensagem = $msg;
        $contato->data = date('Y-m-d H:i:s');
        $contato->usuarios_id_rem = $usuario_rem->id;
        $contato->usuarios_id_dest = $id_usuario_dest;
        $contato->telefone_rem = $usuario_rem->celular;
        $contato->embarcacoes_id = $id_embarcacao;
        $contato->data_do_titulo = date('Y-m-d H:i:s');
        $contato->titulo_mensagem = $msg;
        $contato->email_dest = $usuario_dest->email;
        $contato->status = 1;
        if ($embarcacao->macros_id != 3) {
            // tipo de contato classificado
            $contato->tipo = Anuncio::$_tipo_contato['EMBARCACAO_CLASSIFICADO'];
        } else {
            // tipo de contato estaleiro
            $contato->tipo = Anuncio::$_tipo_contato['EMBARCACAO_CATALOGO'];
        }

        if ($contato->save()) {

            $message = new YiiMailMessage;
            $message->addTo($usuario_dest->email);
            //$message->addTo("jorge_pezzuol@hotmail.com");
            $message->view = "mail_anunciante_resposta";

            if ($embarcacao->macros_id == 3) {
                $message->subject = 'Contato Embarcação de Estaleiro - ' . $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarcacao->embarcacaoModelos->titulo;
            } else {
                $message->subject = 'Contato Embarcação Classificado - ' . $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarcacao->embarcacaoModelos->titulo;
                $message->addBcc("bombarcoadm@gmail.com");
            }

            $parser = new CHtmlPurifier();

            $message->setBody(
                array(
                    'nome_destinatario' => $usuario_dest->nome,
                    'nome_rem' => $usuario_rem->nome,
                    'email_rem' => $usuario_rem->email,
                    'mensagem' => $msg,
                    'id_contato' => $contato->id,
                    'marca' => $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo,
                    'telefone' => $usuario_rem->celular,
                    'modelo' => $embarcacao->embarcacaoModelos->titulo,
                    'id_customer' => UsuariosEmbarcacoes::model()->find("embarcacoes_id=:id", array(":id"=>$embarcacao->id))->usuarios_id,
                    'link' => Embarcacoes::mountAbsoluteUrl($embarcacao)
                ),
                'text/html'
            );

            $message->from = Yii::app()->params['bombarcoAtendimento'];

            if($usuario_dest->email != "atendimento@bombarco.com.br") {
                $message->addBcc("atendimento@bombarco.com.br");    
            }
            
            $message->setReplyTo($parser->purify($usuario_rem->email));

            if (Yii::app()->mail->send($message)) {

                echo "1";
                exit;
            }
        }

        echo "0";
        exit;


                                    
    }

    public function actionAbrirConversa() {

        $embarcacoes_id = $_GET["embarcacoes_id"];
        $usuarios_id_rem = $_GET["usuarios_id_rem"];
        $msg_id = $_GET["msg_id"];

        $msg = Contatos::model()->findByPk($msg_id);
        if($msg != null && (Yii::app()->user->id != $msg->usuarios_id_rem)) {
            $msg->status = 0;
            $msg->update();
        }

        $msgs_rem = Contatos::model()->findAll(array(
          'condition' => 'embarcacoes_id = :embarcacoes_id AND usuarios_id_dest = :usuarios_id_dest AND usuarios_id_rem = :usuarios_id_rem',
          'params' => array(':embarcacoes_id' => $embarcacoes_id, ":usuarios_id_rem"=>Yii::app()->user->id, ":usuarios_id_dest"=>$usuarios_id_rem)
        )); 

        $msgs_dest = Contatos::model()->findAll(array(
          'condition' => 'embarcacoes_id = :embarcacoes_id AND usuarios_id_dest = :usuarios_id_dest AND usuarios_id_rem = :usuarios_id_rem',
          'params' => array(':embarcacoes_id' => $embarcacoes_id, ":usuarios_id_rem"=>$usuarios_id_rem, ":usuarios_id_dest"=>Yii::app()->user->id)
        )); 

        //select * from contatos where embarcacoes_id = 27 and usuarios_id_dest = 6 and usuarios_id_rem = 4251
        //$msgs = Yii::app()->db->createCommand("select * from contatos where embarcacoes_id = 27 and usuarios_id_dest = 4251 and usuarios_id_rem = 6")->queryAll();
        $msgs = array_merge($msgs_rem, $msgs_dest);

        $length = count($msgs);
        for($i = 0; $i < $length - 1; $i++) {
            for($j = ($i+1); $j < $length; $j++) {
                if(strtotime($msgs[$j]->data) > strtotime($msgs[$i]->data)) {
                    $temp = $msgs[$i];
                    $msgs[$i] = $msgs[$j];
                    $msgs[$j] = $temp;
                }
            }
        }

        echo CJSON::encode($msgs);
    }

    public function actionMensagens() {


        Yii::app()->theme = "";

        $sql = " select m.*";
        $sql .= " from contatos m";
        $sql .= " where (m.usuarios_id_dest = ".Yii::app()->user->id. " OR m.usuarios_id_rem = ".Yii::app()->user->id.")";
        $sql .= " and (m.tipo = 'S' OR m.tipo = 'X')";
        $sql .= " and m.id in (select max(m.id) as max_id from contatos m group by least(m.usuarios_id_rem, m.usuarios_id_dest), greatest(m.usuarios_id_rem, m.usuarios_id_dest))";
        $sql .= " order by data desc";
        $sql .= " limit 50";

        $msgs = Yii::app()->db->createCommand($sql)->queryAll();

        $novas = Contatos::model()->findAll("usuarios_id_dest = :id and status = 1 and usuarios_id_dest <> :id", array(":id"=>Yii::app()->user->id)); 

        $this->render("mensagens", array("msgs"=>$msgs, "count_novas"=>count($novas)));
    }

    public function actionPlanos() {

        Yii::app()->theme = "";

        $with = array(
                'planos' => array(
                    'condition' => 'flag != "plano_empresa"'
                )
        );

        $criteria = new CDbCriteria;
        $criteria->with = $with;
        $criteria->condition = 'usuarios_id=:usuarios_id and (t.status = 2 or t.status = 1)';
        $criteria->limit = 5;
        $criteria->order = "t.dataregistro desc";
        $criteria->params = array(":usuarios_id"=>Yii::app()->user->id);
        $planos = PlanoUsuarios::model()->findAll($criteria);

        $criteria = new CDbCriteria;
        $criteria->condition = 'macros_id=:macros_id AND status = 2';
        $criteria->order = "nomefantasia asc";
        $criteria->params = array(":macros_id"=>Macros::$macro_by_slug['estaleiro']);
        $marcas = Empresas::model()->findAll($criteria);

        $this->render("planos", array("planos"=>$planos, "marcas"=>$marcas));

    }

    public function actionPerfil($id) {

        Yii::app()->theme = "";

        $model = $this->loadModel($id, 'Usuarios');

        if ($model->id != Yii::app()->user->id && !Yii::app()->user->isAdmin()) {
            $this->redirect("/site/index");
            exit;
        }

        $this->render("perfil", array("model"=>$model));

    }

    public function actionPerfilAlterar($id) {

        Yii::app()->theme = "";

        $model = $this->loadModel($id, 'Usuarios');

        if ($model->id != Yii::app()->user->id && !Yii::app()->user->isAdmin()) {
            $this->redirect("/site/index");
            exit;
        }

        $this->render("perfil_alterar", array("model"=>$model));

    }

    public function actionDashboard() {

        Yii::app()->theme = "";

        $condition = "data between NOW() - INTERVAL 30 DAY AND NOW()";

        if(isset($_GET["periodo"])) {
            $periodo = $_GET["periodo"];
            $condition = "data between NOW() - INTERVAL ".$periodo." DAY AND NOW()";
        }
        if(isset($_GET["de"])) {
            $data_de = $_GET["de"];
            $data_ate = $_GET["ate"];
            $condition = "data between '".$data_de."' AND '".$data_ate."'";   
        }
        
        // rank dos estaleiros com mais views
        $criteria = new CDbCriteria;
        $criteria->select = "t.id_empresa, COUNT(*) as total";
        $criteria->condition = $condition;
        $criteria->order = "total desc";
        $criteria->group = "id_empresa";
        $criteria->limit = 10;
        $rank_marcas = ZeromilhasViewsEmpresas::model()->findAll($criteria);

        // rank dos modelos mais clicados
        $criteria = new CDbCriteria;
        $criteria->select = "t.id_modelo, COUNT(*) as total";
        $criteria->condition = $condition;
        $criteria->order = "total desc";
        $criteria->group = "id_modelo";
        $criteria->limit = 20;
        $rank_modelos = ZeromilhasViewsModelos::model()->findAll($criteria);

        // Enviar mensagem e clicks dos modelos do cara logado na dashboard
        $criteria = new CDbCriteria;
        $criteria->with = array('usuariosEmbarcacoes' => array('condition' => 'usuarios_id = ' . Yii::app()->user->id));
        $criteria->condition = 'macros_id= 3 AND status = 2';
        $meus_modelos = Embarcacoes::model()->findAll($criteria);

        $this->render("dashboard", array("rank_marcas"=>$rank_marcas, "rank_modelos"=>$rank_modelos, "meus_modelos"=>$meus_modelos));
    }

    public function actionCarregarMais() {

        $condicao = $_POST["condicao"];
        $offset = $_POST["offset"];
        $buscaPorMarca = $_POST["with"];
        $slug = $_POST["slug"];

        $with = array('embarcacaoModelos', 'embarcacaoFabricantes');

        if($buscaPorMarca == 1) {

            $id_empresa = Empresas::model()->find("slug=:slug", array(":slug"=>$slug))->id;
            $with = array(
                'usuariosEmbarcacoes' => array(
                    'condition' => 'empresas_id = ' . $id_empresa
                ), 
                'embarcacaoModelos',
                'embarcacaoFabricantes'
            );
        }

        $criteria = new CDbCriteria;
        $criteria->with = $with;
        $criteria->together = true;
        $criteria->select = "t.id, t.slug, t.email, t.valor, t.data_ativacao, t.cidades_id, t.estado, embarcacaoModelos.titulo as embarcacao_modelos_id, embarcacaoFabricantes.titulo as embarcacao_fabricantes_id";
        $criteria->condition = "t.macros_id = 3 AND t.status = 2".$condicao;
        $criteria->offset = $_POST["offset"];
        $criteria->limit = 25;
        $modelos = Embarcacoes::model()->findAll($criteria);  

        foreach($modelos as $m) {
            //$img = EmbarcacaoImagens::obterImgPrincipalAbs($m->id);
            $m->imagemprincipal = EmbarcacaoImagens::obterImgPrincipalAbs($m->id);
            $m->destaque_zeromilhas = 0;

            // gambs
            $m->titulo = Zeromilhas::mountUrlTabela($m);
            $m->data_ativacao = Zeromilhas::mountUrlOfertas($m); 
            $m->ano = Zeromilhas::gerarLinkDetalhe($m->id, $m->slug); 

            $usuarioDonoEmbarc = UsuariosEmbarcacoes::model()->find('embarcacoes_id = :embarcacoes_id', array(':embarcacoes_id' => $m->id));
            $user = Usuarios::model()->findByPk($usuarioDonoEmbarc->usuarios_id);
            $idUsuarioDonoEmbarc = $usuarioDonoEmbarc->usuarios_id;
            $emp = Empresas::model()->find("usuarios_id=:usuarios_id", array(":usuarios_id"=>$idUsuarioDonoEmbarc));

            if($emp != null) {
                if($emp->destaque == 1) $m->destaque_zeromilhas = 1;
            }
            $nome_destinatario = ($user->pessoa == 'J') ? $user->nomefantasia : $user->nome;
            $email_dest = $user->email;
            if($nome_destinatario == "") {
                if($emp != null) {
                    $nome_destinatario = $emp->nomefantasia;
                }
            }

            $m->cidades_id = $idUsuarioDonoEmbarc;
            $m->estado = $nome_destinatario;       
                                              
        }

        //ZeromilhasViewsEmpresas::salvar($modelos);

        shuffle($modelos);

        echo CJSON::encode($modelos);
    }

    public function actionListarMarcas() {

        $marcas = Zeromilhas::listarMarcas();
        echo CJSON::encode($marcas);
    }

    public function actionListarTipos() {

        $tipos = Zeromilhas::listarTipos();
        echo CJSON::encode($tipos);
    }

    public function actionBuscarModelos() {
        
        if(isset($_GET)) {

            $slug = array_keys($_GET)[0];

            $id_estaleiro = Empresas::model()->find("slug=:slug", array(":slug"=>$slug))->id;

            $array_with = array(
                'usuariosEmbarcacoes' => array(
                    'condition' => 'empresas_id = ' . $id_estaleiro
                ),
                'embarcacaoModelos'
            );

            $modelos = Embarcacoes::model()->with($array_with)->together()->findAllByAttributes(array('status' => 2, 'macros_id' => 3), array('order' => 'embarcacaoModelos.slug DESC'));


            foreach($modelos as $m) {
                $m->titulo = Embarcacoes::getAlt($m);
            }
            echo CJSON::encode($modelos);
        }
    }

    public function actionDetalhe($slug_marca, $slug_modelo) {

        Yii::app()->theme = "";

        $criteria = new CDbCriteria;
        $criteria->with = array('embarcacaoImagens', 'embarcacaoFabricantes', 'embarcacaoModelos');
        $criteria->together = true;
        $criteria->condition = 't.slug = :slug and t.macros_id = 3 and t.status = 2';
        $criteria->params = array(':slug' => $slug_modelo);
        $modelo = Embarcacoes::model()->find($criteria);

        if($modelo == null) {

            $this->redirect(array("zeromilhas/catalogo", 'slug'=>$slug_marca));
            die();
        }

        $materiasRelacionadas = Zeromilhas::materiasRelacionadas($modelo);
        $semelhantes = Zeromilhas::embarcsSemelhantes($modelo);

        $view = new ZeromilhasViewsModelos();
        $view->id_modelo = $modelo->id;
        $view->data = date('Y-m-d H:i:s');
        $view->save();

        
        $emp = Empresas::retornarPorEmbarc($modelo->id);
        if($emp != null) {
            $view_empresas = new ZeromilhasViewsEmpresas();
            $view_empresas->id_empresa = $emp->id;  
            $view_empresas->data = date('Y-m-d H:i:s');  
            $view_empresas->save();
        }
        
        


        $this->render("detalhe", array("modelo"=>$modelo, "semelhantes"=>$semelhantes, "materiasRelacionadas"=>$materiasRelacionadas));
        
    }


    public function actionIndex() {

        Yii::app()->theme = "";

        if(count($_GET) > 0) {

            $conditionPreco = "";
            $conditionTamanho = "";
            $conditionCategoria = "";
            $conditionQtdepassdia = "";
            $conditionQtdepassnoite = "";

            $breadcrumb = "";

            if(isset($_GET["preco"])) {

                $preco = explode("-", $_GET["preco"]);
                $conditionPreco = " AND t.valor BETWEEN ".$preco[0]." AND ".$preco[1];
                $breadcrumb .= " preço entre R$ ".Utils::formataValorView((double)$preco[0]). " e R$ ".Utils::formataValorView((double)$preco[1]);
            }
            if(isset($_GET["tamanho"])) {

                $tamanho = explode("-", $_GET["tamanho"]);
                $conditionTamanho = " AND embarcacaoModelos.tamanho BETWEEN ".$tamanho[0]." AND ".$tamanho[1];
                $breadcrumb .= " tamanho entre ".$tamanho[0]. " e ".$tamanho[1]." pés";
            }
            if(isset($_GET["categoria"])) {

                $slug_categoria = $_GET["categoria"];
                $conditionCategoria = " AND embarcacaoModelos.embarcacao_tipos_id = ".Zeromilhas::devolverCategoria($slug_categoria);
                $breadcrumb .= " ".$_GET["categoria"];
            }
            if(isset($_GET["qtdepassdia"])) {

                $qtdepassdia = explode("-", $_GET["qtdepassdia"]);
                $conditionQtdepassdia = " AND embarcacaoModelos.passageiros BETWEEN ".$qtdepassdia[0]." AND ".$qtdepassdia[1];
                $breadcrumb .= " ".$qtdepassdia[0]. " a ".$qtdepassdia[1]." passageiros/dia";
            }
            if(isset($_GET["qtdepassnoite"])) {

                $qtdepassnoite = explode("-", $_GET["qtdepassnoite"]);
                $conditionQtdepassnoite = " AND embarcacaoModelos.acomodacoes BETWEEN ".$qtdepassnoite[0]." AND ".$qtdepassnoite[1];
                $breadcrumb .= " ".$qtdepassnoite[0]. " a ".$qtdepassnoite[1]." passageiros/noite";
            }

            $with = array('embarcacaoModelos');

            $condicao = $conditionPreco.$conditionTamanho.$conditionCategoria.$conditionQtdepassdia.$conditionQtdepassnoite;

            $criteria = new CDbCriteria;
            $criteria->with = $with;
            $criteria->together = true;
            $criteria->condition = "t.macros_id = 3 AND t.status = 2".$condicao;
            $count = Embarcacoes::model()->count($criteria);
            $criteria->offset = 0;
            $criteria->order = "t.destaque_zeromilhas desc";
            $criteria->limit = 50;
            $resultado = Embarcacoes::model()->findAll($criteria);  
            //ZeromilhasViewsEmpresas::salvar($resultado);

            $modelos = Zeromilhas::separarDestaque($resultado);
            $destaques = $modelos["destaques"];
            $normais = $modelos["normais"];

            shuffle($destaques);
            shuffle($normais);

            $breadcrumb = str_replace("-", " ", $breadcrumb);

            $this->render("listagem", array("destaques"=>$destaques, "normais"=>$normais, "count"=>$count, "condicao"=>$condicao, "breadcrumb"=>$breadcrumb, "with"=>0, "slug"=>""));
            exit;
        }

        $destaques = Empresas::model()->findAll("macros_id=:macros_id AND status = 2 AND logo IS NOT NULL AND destaque = 1", array(":macros_id"=>Macros::$macro_by_slug['estaleiro']));
        //$estaleiros = Empresas::model()->findAll("macros_id=:macros_id AND status = 2 AND logo IS NOT NULL AND destaque = 0", array(":macros_id"=>Macros::$macro_by_slug['estaleiro']));

        $criteria = new CDbCriteria;
        $criteria->condition = 'macros_id=:macros_id AND status = 2';
        $criteria->order = "nomefantasia asc";
        $criteria->params = array(":macros_id"=>Macros::$macro_by_slug['estaleiro']);
        $marcas = Empresas::model()->findAll($criteria);
        

        $this->render("index", array("destaques"=>$destaques,
                                    "marcas"=>$marcas));
        
    }

    public function actionCatalogo($slug) {

        Yii::app()->theme = "";


        $conditionPreco = "";
        $conditionTamanho = "";
        $conditionCategoria = "";
        $conditionQtdepassdia = "";
        $conditionQtdepassnoite = "";

        $breadcrumb = "";

        if(isset($_GET["preco"])) {

            $preco = explode("-", $_GET["preco"]);
            $conditionPreco = " AND t.valor BETWEEN ".$preco[0]." AND ".$preco[1];
            $breadcrumb .= " preço entre R$ ".Utils::formataValorView((double)$preco[0]). " e R$ ".Utils::formataValorView((double)$preco[1]);
        }
        if(isset($_GET["tamanho"])) {

            $tamanho = explode("-", $_GET["tamanho"]);
            $conditionTamanho = " AND embarcacaoModelos.tamanho BETWEEN ".$tamanho[0]." AND ".$tamanho[1];
            $breadcrumb .= " tamanho entre ".$tamanho[0]. " e ".$tamanho[1];
        }

        if(isset($_GET["categoria"])) {

            $slug_categoria = $_GET["categoria"];
            $conditionCategoria = " AND embarcacaoModelos.embarcacao_tipos_id = ".Zeromilhas::devolverCategoria($slug_categoria);
            $breadcrumb .= " ".$_GET["categoria"];
        }
        if(isset($_GET["qtdepassdia"])) {

            $qtdepassdia = explode("-", $_GET["qtdepassdia"]);
            $conditionQtdepassdia = " AND embarcacaoModelos.passageiros BETWEEN ".$qtdepassdia[0]." AND ".$qtdepassdia[1];
            $breadcrumb .= " ".$qtdepassdia[0]. " a ".$qtdepassdia[1]." passageiros/dia";
        }
        if(isset($_GET["qtdepassnoite"])) {

            $qtdepassnoite = explode("-", $_GET["qtdepassnoite"]);
            $conditionQtdepassnoite = " AND embarcacaoModelos.acomodacoes BETWEEN ".$qtdepassnoite[0]." AND ".$qtdepassnoite[1];
            $breadcrumb .= " ".$qtdepassnoite[0]. " a ".$qtdepassnoite[1]." passageiros/noite";
        }

        $gambWith = 0;
        $gambSlug = "";

        $with = array('embarcacaoModelos');

        if($slug != "") {

            $gambWith = 1;
            $gambSlug = $slug;

            $id_empresa = Empresas::model()->find("slug=:slug", array(":slug"=>$slug))->id;
            $with = array(
                'usuariosEmbarcacoes' => array(
                    'condition' => 'empresas_id = ' . $id_empresa
                ), 
                'embarcacaoModelos'
            );
            $breadcrumb = $slug;

        }

        $condicao = $conditionPreco.$conditionTamanho.$conditionCategoria.$conditionQtdepassdia.$conditionQtdepassnoite;

        $criteria = new CDbCriteria;
        $criteria->with = $with;
        $criteria->together = true;
        $criteria->condition = "t.macros_id = 3 AND t.status = 2".$condicao;
        $count = Embarcacoes::model()->count($criteria);
        $criteria->offset = 0;
        $criteria->order = "t.destaque_zeromilhas desc";
        $criteria->limit = 50;
        $resultado = Embarcacoes::model()->findAll($criteria);  

        //ZeromilhasViewsEmpresas::salvar($resultado);

        $modelos = Zeromilhas::separarDestaque($resultado);
        $destaques = $modelos["destaques"];
        $normais = $modelos["normais"];

        shuffle($destaques);
        shuffle($normais);

        $breadcrumb = str_replace("-", " ", $breadcrumb);

        
        $this->render("listagem", array("destaques"=>$destaques, "normais"=>$normais, "count"=>$count, "condicao"=>$condicao, "breadcrumb"=>$breadcrumb, "with"=>$gambWith, "slug"=>$gambSlug));
    }

} // fim classe
