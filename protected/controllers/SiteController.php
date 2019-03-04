<?php

class SiteController extends GxController {

    public function beforeAction($action) {

        /*if (Utils::isMobileBrowser()) {
            Yii::app()->theme = 'mobile';
        }*/
        return parent::beforeAction($action);
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {

        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

        public function accessRules() {
            return array(
                array('allow',
                    'actions' => array('comoAnunciarSite',  'index', 'comoAnunciar', 'anunciarEmbarcacoes', 'anunciarEstaleiros', 'anunciarEmpresas', 'sucessoGratis', 'sucesso', 'error', 'home', 'institucional', 'testeBombarco', 'noticias', 'primeiroBarco', 'url', 'urlguia', 'urlestaleiros', 'busca', 'urlconteudos', 'esqeceuSenha', 'parceiroFinanciamento', 'parceiroConsorcio', 'parceiroSeguro', 'sucessoBoleto', 'parceiroTransporte', 'parceiroSubergivel', 'parceiroJetsurf', 'parceiroArrais'),
                    'users' => array('*'),
                ),
                array('allow',
                    'actions' => array('pagamentoBoleto','correcao', 'admin'),
                    'users' => array('@'),
                ),
                array('allow',
                    'actions' => array('admin'),
                    'expression' => '$user->isAdmin()'
                ),
                array('deny',
                    'users' => array('*'),
                ),
            );
        }

    //mobile pages institucionais
    public function actionComoAnunciar() {

        $this->render('comofunciona');
    }

    public function actionAnunciarEmbarcacoes() {

        $this->render('anunciarembarcacoes');
    }

    public function actionAnunciarEstaleiros() {

        $this->render('anunciarestaleiros');
    }

    public function actionAnunciarEmpresas() {

        $this->render('anunciarempresas');
    }

    public function actionAnunciarBanners() {

        $this->render('anunciarbanners');
    }

    public function actionParceiroFinanciamento() {

        $this->redirect(array("site/index"));
        die();
        /*$data = array(
            'type' => 'F',
            'partner' => 'Alfa Financeira',
            'logo' => 'logo-alfa.png',
            'banner1' => 'banner-finan1.png',
            'banner2' => 'banner-finan2.png',
            'title' => 'Financiamento',
            'texto_botao' => 'Solicitar Atendimento',
            'texto_form' => 'A compra da sua embarcação está mais perto do que você imagina.',
            'placeholder_preco' => 'Preço',
            'subtitle' => 'Financiar é uma das maneiras mais rápidas para obter a embarcação que você quer, de uma maneira muito rápida.',
            'text' => 'Você tem controle total sobre quanto tempo irá pagar as parcelas. Planos flexíveis, de acordo com as suas necessidades. Tenha crédito para adquirir seu bem no momento em que você mais precisa.',
        );
        $this->render('parceiros', $data);*/
    }


    public function actionParceiroConsorcio() {

        $data = array(
            'type' => 'C',
            'partner' => 'Unifisa',
            'logo' => 'logo-unifisa-novo.png',
            'banner1' => 'banner-cons1-novo.png',
            'banner2' => 'banner-cons2.png',
            'title' => 'Consórcio',
            'texto_botao' => 'Contatar Especialista',
            'texto_form' => ' Preencha seus dados que um de nossos consultores financeiros entrará em contato.',
            'placeholder_preco' => 'Valor de embarcação/parcela',
            'subtitle' => 'Produtos náuticos, novos ou usados, em até 100 parcelas, sem juros.',
            'text' => 'O consórcio Náutico é uma ótima opção financeira para planejar com segurança a compra ou troca da sua lancha, 
                        do seu veleiro, do seu jet ski ou até de um equipamento náutico novo ou usado.<br/><br/>Preencha os campos ao lado para receber informações dos especialistas da Unifisa.<br/><br/>E cresce cada vez mais! Atualmente são mais de 7 milhões de consorciados ativos no país e por mês o site Bombarco recebe aproximadamente 150 contatos de interessados no consórcio náutico.<br/><br/>Assista os vídeos onde Marcio Ishihara explica o assunto.<br/><br/>Capítulo 01 – Planeje a compra ou troca da sua embarcação<br/><br/><iframe width="475" height="315" src="https://www.youtube.com/embed/GH30JHITzqE"></iframe><br/><br/>Capítulo 02 – E depois que eu for contemplado?<br/><br/><iframe width="475" height="315" src="https://www.youtube.com/embed/88wNuK9AZos"></iframe>',
        );
        $this->render('parceiros_unifisa', $data);


    }

    public function actionParceiroAluguel() {

        $data = array(
            'type' => 'ALU',
            'partner' => 'Aluguel de lancha, veleiro ou barco',
            'logo' => '',
            'banner1' => 'banner-passeio-lancha.png?e=23',
            'banner2' => '',
            'title' => 'Aluguel de lancha, veleiro ou barco',
            'texto_botao' => 'Contatar Especialista',
            'texto_form' => 'Contatar Especialista',
            'placeholder_preco' => 'Valor de embarcação/parcela',
            'subtitle' => 'Preencha as informações iniciais ao lado que te ajudaremos a encontrar a lancha ideal.',
            'text' => 'Aluguel de lancha <br/>Se você estiver pensando em comprar um barco, presentear alguém que gosta ou passar um final de semana diferente com amigos e familiares, ALUGUE UMA LANCHA.<br/>Experimente, teste e se aproxime do mar em locais paradisíacos que só chega por água.<br/>
                        Preencha as informações iniciais ao lado que te ajudaremos a encontrar a lancha ideal.',
        );
        $this->render('parceiros_aluguel', $data);
    }


    public function actionParceiroMarina() {

        $data = array(
            'type' => 'M',
            'partner' => 'Marina',
            'logo' => '',
            'banner1' => 'banner-passeio-lancha.png',
            'banner2' => '',
            'title' => 'Marina',
            'texto_botao' => 'Contatar Especialista',
            'texto_form' => 'Nós te ajudamos a encontrar uma marina',
            'placeholder_preco' => 'Valor de embarcação/parcela',
            'subtitle' => 'Veja o preço para deixar o seu barco em uma marina',
            'text' => 'O preço de uma vaga numa marina ou num iate clube depende de diversos fatores, desde a demanda/oferta de vagas na região e localização da marina até os serviços oferecidos e infraestrutura. A média brasileira é de R$ 60,00 por pé por mês. O preço varia entre R$ 40,00 a R$ 120,00 por pé por mês.',
        );
        $this->render('parceiros_marina', $data);
    }

    public function actionParceiroSubergivel() {


        $this->redirect(array("site/index"));
        die();

        /*$data = array(
            'type' => 'SUB',
            'partner' => 'Submergivel',
            'logo' => 'logo_ocean_blue.PNG?e=2333',
            'banner1' => 'banner_ocean_blue.jpg?e=2323',
            'banner2' => '',
            'title' => 'Plataforma Submergível',
            'texto_botao' => 'Contatar Especialista',
            'texto_form' => 'Plataforma submergível com rapidez e peças de reposição',
            'subtitle' => 'Para seus melhores momentos, as melhores soluções',
            'text' => 'Plataforma hidráulica para barcos a partir de 29´com motorização centro/rabeta, IPS ou pé de galinha e para barcos a partir de 38´<br/>com motorização IPS ou pé de galinha.<br/><br/>Contamos com produção e assistência técnica nacional, nossa plataforma possui superestrutura altamente reforçada em inox, com central eletrônica e botões de comando em IP65.<br/><br/>Cilindros hidráulicos com vedação especial resistente à intempéries.<br/>Preencha o formulário ao lado e descubra como colocar uma plataforma submersível em sua embarcação.'
        );
        $this->render('parceiros_subergivel', $data);*/
    }

    public function actionParceiroJetsurf() {

        $data = array(
            'type' => 'SURF',
            'partner' => 'Jet Surf',
            'logo' => 'logo_jetsurf.jpg',
            'banner1' => 'banner_jetsurf.jpg',
            'banner2' => '',
            'title' => 'JetSurf - Tecnologia da Fórmula-1',
            'texto_botao' => 'Contatar Especialista',
            'texto_form' => 'Quer saber mais sobre a prancha motorizada? Então preencha os dados abaixo:',
            'subtitle' => 'JetSurf - Tecnologia da Fórmula-1',
            'text' => 'Equipamento super tecnológico, inovador, feito em FIBRA DE CARBONO e kevlar. Em formato de prancha, contém um motor único e exclusivo, possui turbina com propulsão hidroJato e é capaz de atingir até 60 km/h e pesar menos de 19kg. É a tecnologia AEROESPACIAL (NASA) somada a Tecnologia da FÓRMULA-1.'
        );
        $this->render('parceiros_jetsurf', $data);
    }

    public function actionParceiroArrais() {

        $data = array(
            'type' => 'ARR',
            'partner' => 'Arrais',
            'logo' => '',
            'banner1' => 'banner_arrais.png',
            'banner2' => '',
            'title' => 'Tire seu Arrais amador, Mestre ou Capitão com boas escolas.',
            'texto_botao' => 'Contatar Especialista',
            'texto_form' => 'Nós te ajudamos a se habilitar com qualidade!',
            'subtitle' => 'Arrais amador, Mestre ou Capitão',
            'text' => 'Todas as atividades de pilotagem no mar são muito sérias.<br/>
                        Quem está no comando é o responsável pela embarcação e por todas as vidas a bordo.<br/>
                        Sendo assim, é fundamental que você tenha plena consciência e as noções básicas antes de começar a pilotar uma lancha, veleiro ou jetski.<br/>
                        Muito além da Habilitação Náutica, é extremamente importante aprender a navegar de VERDADE.<br/>
                        Por isso, faça cursos com empresas qualificadas. Nós te ajudamos.<br/>
                        Preencha os campos ao lado para receber indicações de boas escolas náuticas.'
        );
        $this->render('parceiros_arrais', $data);
    }


    public function actionParceiroSeguro() {

        $data = array(
            'type' => 'S',
            'partner' => 'Top Four',
            'logo' => 'logo-seguro.png',
            'banner1' => 'banner-cons1-novo.png',
            'banner2' => 'banner-cons2.png',
            'title' => 'Precisando de seguro?',
            'texto_botao' => 'Contatar Especialista',
            'texto_form' => 'Seu barco com seguro Top Four.',
            'placeholder_preco' => 'Valor de embarcação/parcela',
            'subtitle' => 'A Top Four Seguros Naúticos é especializada no assunto, conheça os produtos de quem entende e solicite sua cotação.',
            'text' => 'Consulte os especialistas da Top Four e encontre um plano perfeito pra você.',
        );
        $this->render('parceiros', $data);
    }

    public function actionParceiroTransporte() {

        $data = array(
            'type' => 'T',
            'partner' => 'Transporte',
            'logo' => 'LOGO_CSC.jpg',
            'banner1' => 'banner_transporte2.png?e=233',
            'banner2' => '',
            'title' => 'Transporte',
            'texto_botao' => 'Contatar especialista',
            'texto_form' => 'Nós te ajudamos a transportar o seu barco',
            'placeholder_preco' => 'Preço',
            'subtitle' => 'Leve a sua embarcação com segurança e eficiência',
            'text' => 'Comprar ou vender uma embarcação também demanda se preparar para o transporte dela e, consequentemente, os seus custos. Para isso, é necessário uma transportadora especialista no assunto. Ser preparada, bem equipada e de acordo com as regras e legislações vigentes, faz dessa escolha a mais segura e eficiente. Precisa de ajuda? Preencha os campos ao lado.',
        );
        $this->render('parceiros_transporte', $data);
    }

    public function actionParceiroJettdeck() {

        $data = array(
            'type' => 'JET',
            'partner' => 'Jett Deck',
            'logo' => 'LOGO_JETTDECK.jpg',
            'banner1' => '',
            'banner2' => '',
            'title' => 'Jett Deck - piso náutico',
            'texto_botao' => 'Contatar especialista',
            'texto_form' => 'Quer saber mais sobre o piso náutico. Então preencha os dados abaixo:',
            'placeholder_preco' => 'Preço',
            'subtitle' => 'Jett Deck - piso náutico',
            'text' => 'Se você deseja uma grande transformação no visual e segurança de seu barco, o piso em EVA JETTDECK é uma ótima opção.
                        Para obter um orçamento ou tirar dúvidas sobre JETTDECK, preencha os dados ao lado que nossa equipe entrará em contato.',
        );
        $this->render('parceiros_jetdeck', $data);
    }


    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {

        /*if (!isset($_SERVER['HTTPS'])) {
            $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header("Location: $redirect_url");
            exit();
        }*/

        $noticias = Conteudos::model()->with('conteudoImagens')->findAllByAttributes(array('status' => 1), array('condition'=>"macro <> 'T'", 'order' => 't.data DESC, t.id DESC', 'limit' => 3));
        $videos = Conteudos::model()->with('conteudoImagens')->findAllByAttributes(array('macro' => 'T', 'status' => 1), array('order' => 't.data DESC, t.id DESC', 'limit' => 3));

        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/home.js?e='.microtime(), CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/_busca.js?e='.microtime(), CClientScript::POS_END);

        $this->setPageTitle("Lanchas, Veleiros e Jet Skis. Bombarco - Líder em classificados Náuticos!");
        Yii::app()->clientScript->registerMetaTag('Compre, venda e anuncie suas Lanchas, Veleiros e Jet Skis. O Bombarco é Líder em classificados Náuticos! Acesse nosso Portal e veja como é Fácil.', 'description', null, array(), 'bombarco_description');

        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index', array('noticias' => $noticias, 'videos' => $videos));
    }

    public function actionSobre() {
        $this->setPageTitle("Bom Barco - Sobre");
        Yii::app()->clientScript->registerMetaTag('', 'description');
        $this->render('sobre');
    }

    // método que redireciona o usuário a pagina de alterar senha e dispara um email
    public function actionEsqeceuSenha() {

        $email = $_POST['email'];

        // validar email no banco
        $usuario = Usuarios::model()->find('email=:email', array(':email' => $email));

        // email existe no banco
        if ($usuario != null) {

            // prosseguir com recuperacao da senha
            $id_usuario = $usuario->id;

            // método que envia email de rec de senha
            if (UsuariosRecuperacaoSenha::enviarEmailDeRecuperacao($usuario)) {
                echo '1';
            }

            // erro
            else {
                echo '-1';
            }
        }

        // não achou usuario
        else {
            echo '-1';
        }
    }

    public function actionHome() {

        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/_busca.js', CClientScript::POS_END);
        $this->render('home');
    }

    // link do menu SOBRE
    public function actionInstitucional() {
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sobreee.js', CClientScript::POS_END);
        //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js', CClientScript::POS_END);
        $this->render('institucional');
    }
    
    // link do menu SOBRE
    public function actionPorQueAnunciar() {
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sobreee.js', CClientScript::POS_END);
        //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js', CClientScript::POS_END);
        $this->render('por-que-anunciar');
    }
    
     // link do menu SOBRE
    public function actionComoAnunciarSite() {
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sobreee.js', CClientScript::POS_END);
        //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js', CClientScript::POS_END);
        $this->render('como-anunciar-site');
    }
    
      // link do menu SOBRE
    public function actionPlanos() {
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sobreee.js', CClientScript::POS_END);
        //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js', CClientScript::POS_END);
        $this->render('planos');
    }
    
      // link do menu SOBRE
    public function actionBomMarinheiro() {
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sobreee.js', CClientScript::POS_END);
        //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js', CClientScript::POS_END);
        $this->render('bom-marinheiro');
    }
    
      // link do menu SOBRE
    public function actionContato() {
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/sobreee.js', CClientScript::POS_END);
        //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js', CClientScript::POS_END);
        $this->render('contato');
    }

    // link do menu COMUNIDADE -> TESTE BOMBARCO
    public function actionTesteBombarco() {

        $this->render('teste_bombarco');
    }

    // link do menu COMUNIDADE -> NOTICIAS
    public function actionNoticias() {

        $this->render('noticias');
    }

    // link do menu COMUNIDADE -> PRIMEIRO BARCO
    public function actionPrimeiroBarco() {
        $this->render('primeiro_barco');
    }

    /**
     * Montando URL de embarcacões
     * @return [type] [description]
     */
    public function actionUrl() {

        // Recuperando querystring
        $macro = Yii::app()->request->getQuery('macro');
        $condicao = Yii::app()->request->getQuery('condicao');
        $marca = Yii::app()->request->getQuery('marca');
        $modelo = Yii::app()->request->getQuery('modelo');
        $uf = Yii::app()->request->getQuery('uf');
        $preco_min = Yii::app()->request->getQuery('preco-min');
        $preco_max = Yii::app()->request->getQuery('preco-max');
        $pes_min = Yii::app()->request->getQuery('pes-min');
        $pes_max = Yii::app()->request->getQuery('pes-max');
        $busca = Yii::app()->request->getQuery('buscando');
        $tipos = Yii::app()->request->getQuery('tipos');
        $ordem = Yii::app()->request->getQuery('ordem');


        // Valores das macros para montar URL
        $macros = array(
            1 => array('slug' => 'jet-skis', 'condition' => array(0 => 'novos', 1 => 'usados')),
            2 => array('slug' => 'lanchas', 'condition' => array(0 => 'novas', 1 => 'usadas')),
            3 => array('slug' => 'veleiros', 'condition' => array(0 => 'novos', 1 => 'usados')),
            4 => array('slug' => 'barcos-pesca', 'condition' => array(0 => 'novos', 1 => 'usados')),
        );

        // base da URL
        $url = Yii::app()->createUrl("embarcacoes") . '/';

        // Se existir Macro
        if ($macro != null) {

            // Novo ou Usado
            $url .= $macros[$macro]['slug'] . '-a-venda/';

            // URL da Macro
            if ($condicao != null && $condicao != '-1')
                $url .= $macros[$macro]['slug'] . '-' . $macros[$macro]['condition'][$condicao] . '/';
        }

        // URL do Fabricante
        if ($marca != null && $marca != "0") {
            $fabricante = EmbarcacaoFabricantes::model()->findByPk($marca);
            if (!empty($fabricante))
                $url .= $fabricante->slug . '/';
        }

        // URL do Modelo
        if ($modelo != null && intval($modelo) >= 0) {
            $modelo = EmbarcacaoModelos::model()->findByPk($modelo);
            if (!empty($modelo))
                $url .= $modelo->slug . '/';
        }


        // Inicia o filtro da busca
        $filtro_flag = false; // False não insere '/busca' na URL
        $filtro = ''; // URL de filtro


        // ordem de busca
        if ($uf != null && intval($uf) > -1) {
            $uf = Estados::model()->findByPk($uf);
            if (!empty($uf)) {
                $filtro .= '/local/' . $uf->slug;
                $filtro_flag = true;
            }
        }

        // Preço mínimo
        if ($preco_min != null && intval($preco_min) > 0) {
            $filtro .= '/preco-min/' . $preco_min;
            $filtro_flag = true;
        }

        // Preço máximo
        if ($preco_max != null && floatval(str_replace('.','',$preco_max)) < 2000000) {
            $filtro .= '/preco-max/' . $preco_max;
            $filtro_flag = true;
        }

        // se for mobile nao precisa testar se o modelo é -1 (plugin noob faz os modelos do select ficar com value -1 no desktop)
        if (Yii::app()->theme->name != 'mobile') {

            // Se o modelo não foi selecionado e existem pés
            if ((empty($modelo) || $modelo == '-1') && $macro != EmbarcacaoMacros::$macro_by_slug['jetski']) {

                // Pés mínimo
                if ($pes_min != null && intval($pes_min) > 0) {
                    $filtro .= '/pes-min/' . $pes_min;
                    $filtro_flag = true;
                }

                // Preço máximo
                if ($pes_max != null && intval($pes_max) < 200) {
                    $filtro .= '/pes-max/' . $pes_max;
                    $filtro_flag = true;
                }
            }

        } else {

            // Se o modelo não foi selecionado e existem pés
            if ($modelo != null && $macro != EmbarcacaoMacros::$macro_by_slug['jetski']) {
                $filtro .= '/pes-min/' . $pes_min;
                $filtro .= '/pes-max/' . $pes_max;
                $filtro_flag = true;
            }

        }

        // Busca digitada
        if ($busca != null) {
            $filtro .= '/buscando/' . $busca;
            $filtro_flag = true;
        }

        if (Yii::app()->theme->name == 'mobile') {

            // Se o modelo não foi selecionado e existem tipos
            if ($modelo == "-1" && count($tipos) > 1) {
                $filtro_flag = true;

                $filtro .= '/tipos/';
                foreach ($tipos as $key => $value) {
                    $filtro .= $value;

                    // se existirem mais de 1 tipo selecionado
                    if ((count($tipos) - 1) > $key) {
                        // concatena com "&"
                        $filtro .= '&';
                    }
                }
            }

        } else {

            // Se o modelo não foi selecionado e existem tipos
            if ($modelo != null && ($modelo == '-1' || $modelo == "") && $tipos != null) {
                $filtro_flag = true;

                $filtro .= '/tipos/';
                foreach ($tipos as $key => $value) {
                    $filtro .= $value;

                    // se existirem mais de 1 tipo selecionado
                    if ((count($tipos) - 1) > $key) {
                        // concatena com "&"
                        $filtro .= '&';
                    }
                }

            }

        }

        // ordem de busca
        if (!empty($ordem)) {
            $filtro .= '/ordem/' . $ordem;
            $filtro_flag = true;
        }

        // Aplicando filtro na URL, se necessário
        $url = ($filtro_flag) ? $url . 'busca' . $filtro : $url;

        // retirar o '/' do final (SEO)
        $url = preg_replace('/\/$/', '', $url);

        $this->redirect($url);
        //$this->redirect(substr($url, 0, '-1'));
    }

    /**
     * Montando URL de Guia
     * @return [type] [description]
     */
    public function actionUrlGuia() {

        $categoria = Yii::app()->request->getQuery('categoria');
        $uf = Yii::app()->request->getQuery('uf');
        $busca = Yii::app()->request->getQuery('termo');

        $url = Yii::app()->createUrl("guia-de-empresas");

        if ($categoria != null && $categoria != '-1' && $categoria != '0') {
            $categoria = EmpresaCategorias::model()->findByPk(Yii::app()->request->getQuery('categoria'));
            $url .= '/' . $categoria->slug;
        }

        if ($uf != null && $uf != '-1' && $uf != '0') {
            $estado = Estados::model()->findByPk(Yii::app()->request->getQuery('uf'));
            $url .= '/localizacao/' . $estado->slug;
        }

        if ($busca != null) {
            $url .= '/busca/' . $busca;
        }

        if (($categoria == null || $categoria == '-1' || $categoria == '0') && ($uf == null || $uf == '-1' || $uf == '0') && empty($busca)) {
            $url .= '/todas';
        }

        $this->redirect($url);
    }

    /**
     * Montando URL de Estaleiros
     * @return [type] [description]
     */
    public function actionUrlEstaleiro() {

        $categoria = Yii::app()->request->getQuery('categoria');
        $localizacao = Yii::app()->request->getQuery('localizacao');
        $busca = Yii::app()->request->getQuery('termo');

        $url = Yii::app()->createUrl("estaleiros") . '/';

        if ($categoria != null && $categoria != '-1' && $categoria != '0') {
            $categoria = EmpresaCategorias::model()->findByPk(Yii::app()->request->getQuery('categoria'));
            $url .= 'categoria/' . $categoria->slug . '/';
        }

        if ($localizacao != null && $localizacao != '-1' && $localizacao != '0') {
            $estado = Estados::model()->findByPk(Yii::app()->request->getQuery('localizacao'));
            $url .= 'localizacao/' . $estado->slug . '/';
        }

        if ($busca != null) {
            $url .= 'busca/' . $busca;
        }

        $this->redirect($url);
    }

    /**
     * Montando URL de Estaleiros
     * @return [type] [description]
     */
    public function actionUrlConteudos() {

        $url = Yii::app()->request->getQuery('url');
        $categoria = Yii::app()->request->getQuery('categoria');
        $macro = Yii::app()->request->getQuery('macro');
        $embarcacao_macros = Yii::app()->request->getQuery('macro');
        $busca = Yii::app()->request->getQuery('busca');

        $url = Yii::app()->createUrl("comunidade/" . $url) . '/';

        if ($categoria != null && $categoria != '-1' && $categoria != '0') {
            $categoria = ConteudoCategorias::model()->findByPk(Yii::app()->request->getQuery('categoria'));
            $url .= $categoria->slug . '/';
        }

        if ($embarcacao_macros != null && !empty($embarcacao_macros)) {
            $url .= $embarcacao_macros . '/';
        }

        if ($busca != null && $busca != '-1') {
            $url .= 'busca/' . $busca . '/';
        }

        $this->redirect($url);
    }

    public function actionSucessoGratis() {

        $this->render('sucesso-gratis');
    }

    /**
     * Página de resultados da busca digitada
     * aparecem 3 resultados de cada Macro
     * @return [type]
     */
    public function actionBusca() {

        $busca = Yii::app()->request->getQuery('busca');

        // Se não foi digitado nada, retorna uma busca vazia
        // sem consultar o banco
        $busca = preg_replace('/[^A-ù0-9]/', " ", $busca);

        if ($busca == null) {

            $busca = " ";

        } 

        $log = new LogBuscas;
              $log->data = date("Y-m-d H:i:s");
              $log->usuario = Yii::app()->user->id;
              $log->busca = $busca;
              $log->ip = $_SERVER['REMOTE_ADDR'];


        // Buscando embarcações
        $criteria_embarcacoes = new CDbCriteria();
        //$criteria_embarcacoes->together = true;
        $criteria_embarcacoes->with = array('embarcacaoModelos', 'embarcacaoImagens', 'embarcacaoFabricantes', 'planoUsuarios'=>array('with'=>'usuarios'));
        $criteria_embarcacoes->condition = 't.status = 2 AND planoUsuarios.status = 2 AND t.macros_id != 3';
        $criteria_embarcacoes->limit = 12;
        $criteria_embarcacoes->order = 't.dataregistro DESC';

        $criteria_zeromilhas = new CDbCriteria();
        //$criteria_embarcacoes->together = true;
        $criteria_zeromilhas->with = array('embarcacaoModelos', 'embarcacaoImagens', 'embarcacaoFabricantes', 'planoUsuarios'=>array('with'=>'usuarios'));
        $criteria_zeromilhas->condition = 't.status = 2 AND planoUsuarios.status = 2 AND t.macros_id = 3';
        $criteria_zeromilhas->limit = 3;
        $criteria_zeromilhas->order = 't.dataregistro DESC';

        $busca = strtolower($busca);

        // gambiarras
        if ($busca == 'schaefer') {
            $busca = 'schaefer yachts';
        } elseif ($busca == 'yachts') {
            $busca = 'schaefer yachts';
        } elseif ($busca == 'triton') {
            $busca = 'triton boats';
        } elseif ($busca == 'real') {
            $busca = 'Real Powerboats';
        } else {

        }

        $busca = preg_replace("/\s/", "%", $busca);
        $criteria_embarcacoes->addCondition("(t.titulo LIKE :busca
                                        OR t.slug LIKE :busca
                                        OR t.descricao LIKE :busca
                                        OR embarcacaoModelos.titulo LIKE :busca
                                        OR usuarios.nome LIKE :busca
                                        OR embarcacaoFabricantes.titulo LIKE :busca
                                        OR embarcacaoFabricantes.slug LIKE :busca
                                        OR embarcacaoModelos.slug LIKE :busca)");

                $criteria_zeromilhas->addCondition("(t.titulo LIKE :busca
                                        OR t.slug LIKE :busca
                                        OR t.descricao LIKE :busca
                                        OR embarcacaoModelos.titulo LIKE :busca
                                        OR usuarios.nome LIKE :busca
                                        OR embarcacaoFabricantes.titulo LIKE :busca
                                        OR embarcacaoFabricantes.slug LIKE :busca
                                        OR embarcacaoModelos.slug LIKE :busca)");


        //$params = array(':macro_estaleiros'=>Macros::$macro_by_slug['estaleiro'], ':status'=>Embarcacoes::ACTIVE, ':busca'=>$busca);
        $params = array(':busca' => '%' . $busca . '%');
        $criteria_embarcacoes->params = $params;
        $criteria_zeromilhas->params = $params;
        $embarcacoes = Embarcacoes::model()->findAll($criteria_embarcacoes);
        $zeromilhas = Embarcacoes::model()->findAll($criteria_zeromilhas);

        $busca = strtr($busca, array('%' => ' '));


        // separar as embarcações buscadas por macro
        $jetskis = array();
        $lanchas = array();
        $veleiros = array();
        $pesca = array();
        $sem_macro = array();

        if (count($embarcacoes) > 0) {

            foreach ($embarcacoes as $embarc) {

                $macro_id = $embarc->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;

                if ($macro_id == Anuncio::$_categoria_embarcacao['JETSKI']) {

                    if (count($jetskis) < 3)
                        $jetskis[] = $embarc;

                } elseif ($macro_id == Anuncio::$_categoria_embarcacao['LANCHA']) {

                    if (count($lanchas) < 3)
                        $lanchas[] = $embarc;

                } elseif ($macro_id == Anuncio::$_categoria_embarcacao['PESCA']) {

                    if (count($pesca) < 3)
                        $pesca[] = $embarc;

                } elseif ($macro_id == Anuncio::$_categoria_embarcacao['VELEIRO']) {

                    if (count($veleiros) < 3)
                        $veleiros[] = $embarc;

                } else {

                    if (count($sem_macro) < 3)
                        $sem_macro[] = $embarc;

                }

            }

        }

        // embaralhar resultado
        shuffle($jetskis);
        shuffle($lanchas);
        shuffle($veleiros);
        shuffle($pesca);

        // Buscando empresas
        $criteria_empresa = new CDbCriteria();
        $criteria_empresa->with = array('empresaImagens');
        $criteria_empresa->limit = 3;
        $criteria_empresa->condition = 't.macros_id = :macro AND t.status = :status AND t.razao LIKE :busca';
        $criteria_empresa->params = array(':macro' => Macros::$macro_by_slug['empresa'], ':status' => Empresas::ACTIVE, ':busca' => '%' . $busca . '%');
        $empresas = Empresas::model()->findAll($criteria_empresa);

        // Buscando estaleiros
        $criteria_empresa->params = array(':macro' => Macros::$macro_by_slug['estaleiro'], ':status' => Empresas::ACTIVE, ':busca' => '%' . $busca . '%');
        $criteria_empresa->addCondition('logo is not null');
        $estaleiros = Empresas::model()->findAll($criteria_empresa);

        // Buscando comunidades
        /* $criteria_comunidades = new CDbCriteria();
          $criteria_comunidades->with = array('conteudoImagens', 'conteudoCategorias');
          $criteria_comunidades->limit = 3;
          $criteria_comunidades->condition = 't.status = 1 AND t.macro != :macro_not AND (t.titulo LIKE :busca OR t.texto LIKE :busca OR conteudoCategorias.titulo LIKE :busca)';
          $criteria_comunidades->params = array(':macro_not'=>Conteudos::$categorias_by_slug['teste'], ':busca'=>'%'.$busca.'%');
          $comunidades = Conteudos::model()->findAll($criteria_comunidades); */

        // Buscando notícias
        $criteria_noticias = new CDbCriteria();
        $criteria_noticias->with = array('conteudoImagens', 'conteudoCategorias');
        $criteria_noticias->limit = 3;
        $criteria_noticias->condition = 't.status = 1 AND t.macro = "N" AND (t.titulo LIKE :busca OR t.texto LIKE :busca OR conteudoCategorias.titulo LIKE :busca)';
        $criteria_noticias->params = array(':busca' => '%' . $busca . '%');
        $noticias = Conteudos::model()->findAll($criteria_noticias);

        // Buscando primeiro barco
        $criteria_primeiro_barco = new CDbCriteria();
        $criteria_primeiro_barco->with = array('conteudoImagens', 'conteudoCategorias');
        $criteria_primeiro_barco->limit = 3;
        $criteria_primeiro_barco->condition = 't.status = 1 AND t.macro = "P" AND (t.titulo LIKE :busca OR t.texto LIKE :busca OR conteudoCategorias.titulo LIKE :busca)';
        $criteria_primeiro_barco->params = array(':busca' => '%' . $busca . '%');
        $primeiro_barco = Conteudos::model()->findAll($criteria_primeiro_barco);

        // Buscando Blog
        $criteria_blog = new CDbCriteria();
        $criteria_blog->with = array('conteudoImagens', 'conteudoCategorias');
        $criteria_blog->limit = 3;
        $criteria_blog->condition = 't.status = 1 AND t.macro = "B" AND (t.titulo LIKE :busca OR t.texto LIKE :busca OR conteudoCategorias.titulo LIKE :busca)';
        $criteria_blog->params = array(':busca' => '%' . $busca . '%');
        $blog = Conteudos::model()->findAll($criteria_blog);

        // buscando motores
        $criteria_motores = new CDbCriteria();
        $criteria_motores->with = array('planoUsuarios'=>array("with"=>"usuarios"), 'motorFabricantes', 'motorTipos');
        $criteria_motores->limit = 3;
        $criteria_motores->condition = 't.status = 2 AND planoUsuarios.status = 2';
        $criteria_motores->addCondition('(t.slug LIKE :busca
        OR usuarios.nome LIKE :busca
        OR usuarios.razaosocial LIKE :busca
        OR t.descricao LIKE :busca
        OR motorTipos.slug LIKE :busca
        OR motorFabricantes.slug LIKE :busca)');
        $criteria_motores->params = array(':busca' => '%' . $busca . '%');
        $motores = MotorAnuncio::model()->findAll($criteria_motores);

        /* ==========  Breadcrumbs  ========== */
        $breadcrumbs[] = array('texto' => 'Home', 'link' => Yii::app()->homeUrl);
        $breadcrumbs[] = array('texto' => 'Resultados da busca', 'link' => Yii::app()->createUrl('site/busca/' . $busca));

        $this->setPageTitle(Yii::app()->name . ' - Resultados da busca');

        $this->render('busca', array(
            //'embarcacoes' => $embarcacoes,
            'lanchas' => $lanchas,
            'jetskis' => $jetskis,
            'veleiros' => $veleiros,
            'pesca' => $pesca,
            'empresas' => $empresas,
            'estaleiros' => $estaleiros,
            'zeromilhas' => $zeromilhas,
            'motores'=> $motores,
            //'comunidades' => $comunidades,
            'blog' => $blog,
            'noticias' => $noticias,
            'primeiro_barco' => $primeiro_barco,
            'busca' => $busca,
            'breadcrumbs' => $breadcrumbs,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $error = Yii::app()->errorHandler->error;
        if (Yii::app()->request->isAjaxRequest)
            echo $error['message'];
        else
            $this->render('error', $error);
    }

    public function actionSucesso() {

        $this->render('sucesso');
    }

        /**
         * Displays the login page
         */
        public function actionAdmin() {

          if(Yii::app()->user->isAdmin()) {
                $this->render('admin');  
          }

          else {
            $this->redirect(Yii::app()->homeUrl);
          }

          
        }
        /**
         * Displays the login page
         */
        public function actionLogin() {

            //$model=new LoginForm;
            // verificar se já não está logado
            if (!Yii::app()->user->isGuest) {
                $this->redirect(Yii::app()->homeUrl);
                exit;
            }
            // collect user input data
            if (isset($_POST['login'])) {

                $identity = new UserIdentity($_POST['username'], $_POST['senha']);
                if ($identity->authenticate()) {
                    Yii::app()->user->setFlash('general_alert', "Login realizado com sucesso!");
                    $user = Yii::app()->user;
                    $user->login($identity);

                    // log
                    $log = new LogLogins;
                    $log->usuarios_id = Yii::app()->user->id;
                    $log->date = date('Y-m-d H:i:s');
                    $log->ip = $_SERVER["REMOTE_ADDR"];
                    $log->save();


                    // cookie
                    $email = Yii::app()->request->cookies->contains('email') ? Yii::app()->request->cookies['email']->value : "";
                    if($email == "") {
                            $cookie_email = new CHttpCookie('email', $_POST['username']);
                            $cookie_email->expire = time()+60*60*24*365; 
                            Yii::app()->request->cookies['email'] = $cookie_email;
                    }

                    $celular = Yii::app()->request->cookies->contains('celular') ? Yii::app()->request->cookies['celular']->value : "";
                    if($celular == "") {
                            // recuperar telefone celular
                            $celular = Usuarios::model()->findByPk(Yii::app()->user->id)->celular;
                            $cookie_celular = new CHttpCookie('celular', $celular);
                            $cookie_celular->expire = time()+60*60*24*365; 
                            Yii::app()->request->cookies['celular'] = $cookie_celular;
                    }

                    $nome = Yii::app()->request->cookies->contains('nome') ? Yii::app()->request->cookies['nome']->value : "";
                    if($nome == "") {
                            // recuperar telefone celular
                            $nome = Usuarios::model()->findByPk(Yii::app()->user->id)->nome;
                            $cookie_nome = new CHttpCookie('nome', $nome);
                            $cookie_nome->expire = time()+60*60*24*365; 
                            Yii::app()->request->cookies['nome'] = $cookie_nome;
                    }


                    if(Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()){
                        $this->redirect("https://www.bombarco.com.br/admin");
                    }
                    elseif(Yii::app()->user->isConteudo()) {
                        $this->redirect("https://www.bombarco.com.br/admin/comunidade");
                    }
                    elseif(Yii::app()->user->isSeo()) {
                        $this->redirect("https://www.bombarco.com.br/admin/seo");
                    }
                    elseif(Yii::app()->user->isComercial()) {
                        $this->redirect("https://www.bombarco.com.br/admin/usuarios_comercial");
                    }
                    else {

                    }
                    // ver se clicou em favoritar alguma embarc e n tava logado, redirecionar para  a embarc
                    if (isset($_POST['url_favorito'])) {
                        $this->redirect($_POST['url_favorito'] . '?url_favorito=1');
                        exit;
                    }

                    // ver se caiu aqui pela tabela bombarco (não tava logado e clicou em buscar)
                    // veio da tabela bombarco, vamos voltar ele pra la
                    if (isset($_POST['tabela_bb'])) {

                        /*$url = Yii::app()->createUrl('comunidade/tabela-bombarco');
                        if (isset($_POST['fabricante_tabela_bb'])) {
                            $url .= '?fabricante=' . $_POST['fabricante_tabela_bb'];
                        }
                        if (isset($_POST['modelo_tabela_bb'])) {
                            $url .= '&modelo=' . $_POST['modelo_tabela_bb'];
                        }
                        if (isset($_POST['ano_tabela_bb'])) {
                            $url .= '&ano=' . $_POST['ano_tabela_bb'];
                        }
                        $this->redirect($url);
                        */

                        $marca = Yii::app()->request->getParam("fabricante_tabela_bb");
                        //$modelo = $marca."-".Yii::app()->request->getParam("modelo_tabela_bb");
                        $modelo = Yii::app()->request->getParam("modelo_tabela_bb");
                        $ano = Yii::app()->request->getParam("ano_tabela_bb");

                        $this->redirect(array("tabela/".$marca."/".$modelo."/".$ano));

                    } else {
                        if (Yii::app()->homeUrl == $user->returnUrl && Yii::app()->theme->name != 'mobile') {
                            // minha conta
                            if(PlanoUsuarios::verificarSePossuiPacoteEmpresa2(Yii::app()->user->id) != null) {
                            	//$this->redirect(array('embarcacoes/lista?v=0&e=anuncios'));
                                $this->redirect('https://www.bombarco.com.br/usuarios/update/'.Yii::app()->user->id.'?active=perfil');   
                                
                            } 
                            else {
                                $this->redirect('https://www.bombarco.com.br/usuarios/update/'.Yii::app()->user->id.'?active=perfil');	
                            }
                            
                        } else {

                            if (preg_match("/\?/", Yii::app()->user->returnUrl)) {
                                $this->redirect(Yii::app()->user->returnUrl . '&logintrue');
                            } else {
                                $this->redirect(Yii::app()->user->returnUrl . '?logintrue');
                            }

                        }
                    }
                }

                // erro de autenticação
                else {
                    Yii::app()->user->setFlash('erro-login', 'Login ou senha inválidos');
                }
            }

            // scrips
            //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/facebook.js', CClientScript::POS_END);
            //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/googleplus.js', CClientScript::POS_END);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/site_login.js', CClientScript::POS_END);

            // display the login form
            $this->render('login');
        }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Pagamento com Boleto
     * @return [type] [description]
     */
    public function actionPagamentoBoleto() {

        $validacao = Transacoes::validarTransacao(Yii::app()->getRequest()->getPost('tid'));
        $return = array('error' => 0, 'msg' => null);

        // Se houver erro na trasacão
        // Retorna o erro
        if ($validacao['error'] != 0) {
            $return['error'] = $validacao['error'];
            $return['msg'] = $validacao['msg'];
            echo json_encode($return);
            exit();
        }

        // Seta a variavel como objeto transacao
        $transacao = $validacao['transacao'];

        Yii::import('application.extensions.yii-azpay.*');

        $az_pay = new YiiAzPay('1', 'd41d8cd98f00b204e9800998ecf8427e');
        $az_pay->config_order['reference'] = str_pad(Yii::app()->getRequest()->getPost('reference'), 9, STR_PAD_LEFT);
        $az_pay->config_order['totalAmount'] = $transacao->valor;

        // Se a transacao já estiver finalizada
        // Executa a consulta dela no AZPay
        // E só atualiza os dados
        if ($transacao->status == 3 && !empty($transacao->tid_externo)) {

            $az_pay->report($transacao->tid_externo);
        } else {

            $az_pay->config_order['reference'] = Yii::app()->getRequest()->getPost('reference');
            $az_pay->config_order['totalAmount'] = Yii::app()->getRequest()->getPost('amount');

            $az_pay->config_boleto['amount'] = Yii::app()->getRequest()->getPost('amount');
            $az_pay->config_boleto['expire'] = date('Y-m-d', strtotime('today + 10 day'));
            $az_pay->config_boleto['nrDocument'] = Yii::app()->getRequest()->getPost('reference');
            $az_pay->config_boleto['instructions'] = 'Não aceitar pagamento em cheques. \n Percentual Juros Dia: 1%. Percentual Multa: 1%.';

            $az_pay->boleto();
        }

        // Se houver erro ao executar o CURL
        // ou não retornar 200
        if ($az_pay->error == true) {
            $return['error'] = 3;
            $return['msg'] = 'Erro ao executar transacão';
            echo json_encode($return);
            exit();
        }

        $res = $az_pay->response();

        if ($res->status == Transacoes::$_msg_response['GENERATED']) {

            try {

                $transaction = Yii::app()->db->beginTransaction();

                $transacao->tid_externo = $res->transactionId;
                $transacao->formapagamento = 'boleto';
                $transacao->detalhes = json_encode($res);
                $transacao->save();

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollback();
                $return['error'] = 3;
                $return['msg'] = 'Erro ao atualizar dados';
            }
        } else {
            $return['error'] = 4;
            $return['msg'] = 'Erro na transacao';
        }

        echo json_encode($return);
        exit();
    }


    public function actionCorrecao() {

        $model = EmbarcacaoModelos::model()->findAll('slug RLIKE "\-$"');

        foreach ($model as $key => $value) {
                $value->slug = '';
                $value->save();

        }

    }

    public function actionSucessoBoleto() {

        $this->render("sucesso_boleto");
    }

}
?>