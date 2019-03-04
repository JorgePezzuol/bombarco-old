<?php
Yii::import('application.vendor.api-cielo.*');
require_once 'autoload.php';
use Cielo\API30\Merchant;
use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\Request\CieloRequestException;

class AnunciosController extends GxController {

    public function filters() {
        return array('accessControl');
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view', 'listarPlanosDeAnuncios', 'atualizarBoletos', 'consultarTid', 'teste'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('create', 'anunciarEmpresa', 'anuncioPagamento', 'anunciarEmbarcacao', 'anunciarEmpresaGratuito', 'anunciarEmbarcacaoAvulsa', 'pagamentoCartao', 'pagamentoBoleto', 'consultarCep'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionTeste() {

        // flgs que indicam se o usuario possui plano de empresa ou embarcacoes
        $flgPlanoAnuncio = Usuarios::hasPlanoAnuncio();
        $flgPlanoEmpresa = Usuarios::hasPlanoEmpresa();

        $linkPlanosEmpresa = array(); // array que conterá as URLs formadas dos planos de empresa
        $infoPlanosEmpresa = array(); // array que conterá os objetos de planos de empresa
        // mandar os planos de empresa para view com as URLs já formadas
        if (!$flgPlanoEmpresa) {
            $flag = 'plano_empresa';
            $planosEmpresa = Planos::model()->findAll('flag=:flag', array(':flag' => $flag));

            if (count($planosEmpresa) > 0) {
                // loop de planos
                foreach ($planosEmpresa as $plano) {
                    // monta a URL
                    $linkPlanosEmpresa[] = Yii::app()->createUrl('anuncios/anunciarEmpresa?pid=' . $plano->id . '&valor=' . $plano->valor . '&meses=' . $plano->duracaomeses);
                    // caso seja 12 meses, alterar para dar echo de '1 ano'
                    if ($plano->duracaomeses == '12') {
                        $plano->duracaomeses = '1 ano';
                    } else {
                        $plano->duracaomeses = $plano->duracaomeses . ' MESES';
                    }

                    // array contendo o objeto do plano em si
                    $infoPlanosEmpresa[] = $plano;
                }
            }
        }


        $plano = Usuarios::getPlanoCorrenteAnuncio();
        $qtdeAnunciosCadastrados = 0;

        if ($plano != null) {
            //$qtdeAnunciosCadastrados = Embarcacoes::model()->count('plano_usuarios_id=:id', array(':id'=>$plano->id));
            $qtdeAnunciosCadastrados = 0;

            // ============================
            // contabilizar quantidade de anuncios cadastrados
            if ($plano->status == Anuncio::$_status_plano['PAGO']) {
                foreach ($plano->embarcacoes as $emb) {
                    if ($emb->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"] ||
                            //$emb->status == Anuncio::$_status_anuncio["ANUNCIO_PAGO"]) {
                        $emb->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]) {
                        $qtdeAnunciosCadastrados += 1;
                    }
                }
            } else {
                $qtdeAnunciosCadastrados = count($plano->embarcacoes);
            }
        }


        // renderiza pagina indicando as flags de plano
        $this->render('planos_teste', array('flgPlanoAnuncio' => $flgPlanoAnuncio,
            'flgPlanoEmpresa' => $flgPlanoEmpresa,
            'linkPlanosEmpresa' => $linkPlanosEmpresa,
            'infoPlanosEmpresa' => $infoPlanosEmpresa,
            'plano' => Usuarios::getPlanoCorrenteAnuncio(),
            'qtdeAnunciosCadastrados' => $qtdeAnunciosCadastrados,
                )
        );
    }

    public function actionIndex() {

        // flgs que indicam se o usuario possui plano de empresa ou embarcacoes
        $flgPlanoAnuncio = Usuarios::hasPlanoAnuncio();
        $flgPlanoEmpresa = Usuarios::hasPlanoEmpresa();

        $linkPlanosEmpresa = array(); // array que conterá as URLs formadas dos planos de empresa
        $infoPlanosEmpresa = array(); // array que conterá os objetos de planos de empresa
        // mandar os planos de empresa para view com as URLs já formadas
        if (!$flgPlanoEmpresa) {
            $flag = 'plano_empresa';
            $planosEmpresa = Planos::model()->findAll('flag=:flag', array(':flag' => $flag));

            if (count($planosEmpresa) > 0) {
                // loop de planos
                foreach ($planosEmpresa as $plano) {
                    // monta a URL
                    $linkPlanosEmpresa[] = Yii::app()->createUrl('anuncios/anunciarEmpresa?pid=' . $plano->id . '&valor=' . $plano->valor . '&meses=' . $plano->duracaomeses);
                    // caso seja 12 meses, alterar para dar echo de '1 ano'
                    if ($plano->duracaomeses == '12') {
                        $plano->duracaomeses = '1 ano';
                    } else {
                        $plano->duracaomeses = $plano->duracaomeses . ' MESES';
                    }

                    // array contendo o objeto do plano em si
                    $infoPlanosEmpresa[] = $plano;
                }
            }
        }


        $plano = Usuarios::getPlanoCorrenteAnuncio();
        $qtdeAnunciosCadastrados = 0;

        if ($plano != null) {
            //$qtdeAnunciosCadastrados = Embarcacoes::model()->count('plano_usuarios_id=:id', array(':id'=>$plano->id));
            $qtdeAnunciosCadastrados = 0;

            // ============================
            // contabilizar quantidade de anuncios cadastrados
            if ($plano->status == Anuncio::$_status_plano['PAGO']) {
                foreach ($plano->embarcacoes as $emb) {
                    if ($emb->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"] ||
                            //$emb->status == Anuncio::$_status_anuncio["ANUNCIO_PAGO"]) {
                        $emb->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]) {
                        $qtdeAnunciosCadastrados += 1;
                    }
                }
            } else {
                $qtdeAnunciosCadastrados = count($plano->embarcacoes);
            }
        }


        // renderiza pagina indicando as flags de plano
        //$this->render('index', array('flgPlanoAnuncio' => $flgPlanoAnuncio,
        $this->render('planos_teste', array('flgPlanoAnuncio' => $flgPlanoAnuncio,
            'flgPlanoEmpresa' => $flgPlanoEmpresa,
            'linkPlanosEmpresa' => $linkPlanosEmpresa,
            'infoPlanosEmpresa' => $infoPlanosEmpresa,
            'plano' => Usuarios::getPlanoCorrenteAnuncio(),
            'qtdeAnunciosCadastrados' => $qtdeAnunciosCadastrados,
                )
        );
    }

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

    /* TRATAR MELHOR OS ERROS APÓS OS SAVES() E LEMBRAR DE VERIFICAR SE O ANUNCIO DA EMPRESA VENCEU */
    public function actionAnunciarEmpresa() {

        // se não veio plano na URL, redirecionar para o index
        if (!isset($_GET['pid'])) {
            $this->redirect('index');
            exit;
        }

        // se não veio plano na URL, redirecionar para o index
        if (!isset($_GET['meses'])) {
            $this->redirect('index');
            exit;
        }

        $empresa = new Empresas;

        // duração de meses do anuncio
        $meses = $_GET['meses'];

        // id do usuário
        $id_usuario = Yii::app()->user->getId();

        // verificar se o usuário já não possui uma empresa, se tiver, vamos redirecioná-lo
        $possuiEmpresa = Usuarios::getEmpresa();


        // qer dizer que já existe uma emrpesa cadastrada, vamos redirecioanr então
        if ($possuiEmpresa != null) {
            // pegar todas as ordens do usuario e redirecionar para página de pagamento
            $ordens = Usuarios::getOrdens();
            // renderizar para pag de pagamento
            $this->redirect('anuncioPagamento', array('ordens' => $ordens, 'somaOrdens' => Usuarios::somarOrdens()));
            exit;
        }

        if (isset($_POST['Empresas'])) {

            // qer dizer que já existe uma emrpesa cadastrada, vamos redirecioanr então
            if ($possuiEmpresa != null) {
                // pegar todas as ordens do usuario e redirecionar para página de pagamento
                $ordens = Usuarios::getOrdens();
                // renderizar para pag de pagamento
                $this->redirect('anuncioPagamento', array('ordens' => $ordens));
                exit;
            }


            $transaction = Yii::app()->db->beginTransaction();

            try {
                // setar atributos
                $empresa->setAttributes($_POST['Empresas']);


                if ($empresa->cidades_id == "empty") {
                    $empresa->cidades_id = null;
                    $empresa->estados_id = null;
                }

                $empresa->usuarios_id = $id_usuario;
                $empresa->status = Anuncio::$_status['INATIVA'];
                $empresa->macros_id = Anuncio::$_macros['GUIA_EMPRESAS'];
                $empresa->destaque = 1;

                // primeiro vamos obter as imagens de logo e capa da empresa (testar se nao está null)
                if (CUploadedFile::getInstance($empresa, 'capa') != null) {
                    //$empresa->capa = CUploadedFile::getInstance($empresa,'capa');

                    $capa = CUploadedFile::getInstance($empresa, 'capa');

                    if ($capa != null) {
                        $empresa->capa = Utils::genImageName($capa);
                    }

                    // salvar imagem de capa no servidor
                    if (!$capa->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $empresa->capa)) {
                        //Yii::app()->user->setFlash('erro-capa', "Erro ao salvar a capa");
                    }
                }

                if (CUploadedFile::getInstance($empresa, 'logo') != null) {

                    //$empresa->logo = CUploadedFile::getInstance($empresa,'logo');

                    $logo = CUploadedFile::getInstance($empresa, 'logo');

                    if ($logo != null) {
                        $empresa->logo = Utils::genImageName($logo);
                    }

                    if (!$logo->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $empresa->logo)) {
                        //Yii::app()->user->setFlash('erro-capa', "Erro ao salvar o logo");
                    }
                }


                // salvar empresa
                if (!$empresa->save()) {

                    Yii::app()->user->setFlash('erro-empresa', "Erro ao salvar a empresa!");
                    $empresa->addError('razao', 'Razão ou email já existe!');

                } else {
                    // dar update no usuário da empresa (dizer que é pessoa jurídica)
                    $usuarioEmpresa = Usuarios::model()->findByPk($id_usuario);
                    $usuarioEmpresa->usuario_classificacoes_id = Anuncio::$_classificacoes_de_usuario['EMPRESA'];
                    $usuarioEmpresa->pessoa = Anuncio::$_pessoa['JURIDICA'];
                    $usuarioEmpresa->update();

                    $planos_id = Yii::app()->request->getParam('pid');

                    // método que traz as informações do plano (valor, duracaomeses, etc)
                    // com base no ID do plano passado. Caso nao ache, retorna null
                    $planoAnuncio = Planos::validarPlanoDeEmpresa($planos_id);

                    // verificar se o plano ID é realmente um plano de empresa (pode haver alteração na URL)
                    // lembrar de por constante
                    if ($planoAnuncio == null) {
                        $transaction->rollback();
                        $this->redirect('index');
                    }

                    $plano = new PlanoUsuarios;
                    $plano->valor = (float) $planoAnuncio->valor;
                    $plano->status = Anuncio::$_status_plano['CRIADO'];
                    $plano->planos_id = $planoAnuncio->id;
                    $plano->qntpermitida = 0; // plano de empresa não tem embarcação !! logo a qntpermitida é 0
                    $plano->usuarios_id = $id_usuario;


                    // vincular a coluna de plano da tabela de empresas
                    if ($plano->save()) {
                        $emp = Empresas::model()->findByPk($empresa->id);
                        $emp->plano_usuarios_id = $plano->id;
                        $emp->update();
                    }


                    // criar ordem de plano
                    $ordem = new Ordens;
                    $ordem->usuarios_id = Yii::app()->user->getId();
                    $ordem->valor = (float) $planoAnuncio->valor;
                    $ordem->data_criacao = date("Y-m-d H:i:s");
                    // lembrar de por como constante (ID 3 da tabela ordens_tipo é PLANO DE EMPRESA)
                    $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['PLANO_EMPRESA'];
                    $ordem->descricao = 'Plano - Guia de Empresa';
                    $ordem->status = Anuncio::$_status_ordem['CRIADA'];
                    // FK do item da ordem (aqui no caso é o plano)
                    $ordem->id_item = (int) $plano->primaryKey;
                    $ordem->save();


                    // verificar se marcou turbinado
                    if (isset($_POST['Empresas']['recursos_adicionais'])) {
                        // loop para verificar os recursos adicionais escolhidos
                        foreach ($_POST['Empresas']['recursos_adicionais'] as $idTurbinado) {
                            // para cada turbinado escolhido criar o objeto que relaciona os turbinados a empresa
                            $empresaRecs = new EmpresasHasEmpresaRecursosAdicionais;
                            $empresaRecs->empresas_id = $empresa->id;
                            $empresaRecs->empresa_recursos_adicionais_id = $idTurbinado;
                            $empresaRecs->save();

                            // criar ordem de plano
                            $ordem = new Ordens;
                            $ordem->usuarios_id = Yii::app()->user->getId();
                            $ordem->valor = EmpresaRecursosAdicionais::getPrecoPorId($idTurbinado);

                            // verificar se optou pelo turbinado de +6 imagens (id = 4)
                            if ($idTurbinado == Anuncio::$_turbinados_empresa['FOTOS']) {

                                // loop para salvar as imagens turbinadas no banco (são 6)
                                for ($i = 0; $i < Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMPRESA']; $i++) {
                                    if (CUploadedFile::getInstanceByName('Empresas[foto-turbinada][' . $i . ']') != null) {
                                        // objeto relacionado as empresas que possuem fotos turbinadas
                                        $imagemTurbinadaEmpresa = new EmpresaImagens;
                                        $imagemTurbinadaEmpresa->status = 0;
                                        $imagemTurbinadaEmpresa->empresas_id = $empresa->primaryKey;
                                        $imagemTurbinadaEmpresa->imagem = CUploadedFile::getInstanceByName('Empresas[foto-turbinada][' . $i . ']');
                                        if ($imagemTurbinadaEmpresa->imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $imagemTurbinadaEmpresa->imagem)) {
                                            $imagemTurbinadaEmpresa->save();
                                        }

                                        // erro ao salvar imagem turbinada no servidor
                                        else {
                                            Yii::app()->user->setFlash('erro-img', "Erro ao salvar a imagem!");
                                        }
                                    }
                                }
                            } // if marcou turbinado +10 fotos
                            // marcou video
                            if ($idTurbinado == Anuncio::$_turbinados_empresa['VIDEO']) {
                                if (isset($_POST['Empresas']['video'])) {
                                    $empresa->video = $_POST['Empresas']['video'];
                                }
                            }

                            // marcou cpm
                            if ($idTurbinado == Anuncio::$_turbinados_empresa['CPM']) {

                                $ordem->valor = $_POST['hidden-valor-cpm'];
                                $empresaImpressao = new EmpresasImpressoes;
                                $limitedate = $_POST['EmpresasImpressoes']['limitdate'];
                                // calcular o termino do cpm
                                $empresaImpressao->limitdate = date('Y-m-d H:i:s', strtotime('today + ' . $limitedate . ' month'));
                                $empresaImpressao->limitviews = $_POST['EmpresasImpressoes']['limitviews'];
                                $empresaImpressao->empresas_id = $empresa->primaryKey;
                                $empresaImpressao->save();
                            }

                            // marcou telefone
                            if ($idTurbinado == Anuncio::$_turbinados_empresa['TELEFONE_EMPRESA']) {
                                if (isset($_POST['Empresas']['telefone'])) {
                                    $empresa->telefone = $_POST['Empresas']['telefone'];
                                }
                            }

                            // marcou descrição
                            if ($idTurbinado == Anuncio::$_turbinados_empresa['DESCRICAO']) {
                                if (isset($_POST['Empresas']['descricao'])) {
                                    $empresa->descricao = $_POST['Empresas']['descricao'];
                                }
                            }

                            // criar ordem de turbo
                            $ordem->data_criacao = date("Y-m-d H:i:s");
                            // lembrar de por como constante (ID 5 da tabela ordens_tipo é RECURSO ADICIONAL EMPRESA)
                            $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['ADICIONAL_EMPRESA'];
                            $ordem->descricao = 'Turbinada anúncio de empresa - ' . EmpresaRecursosAdicionais::getTituloTurbinado($idTurbinado);
                            $ordem->status = Anuncio::$_status_ordem['CRIADA'];
                            // FK do item da ordem (aqui no caso é o ID do turbinado)
                            $ordem->id_item = (int) $empresaRecs->id;
                            $ordem->save();
                        } // loop turbinados
                    } // if marcou turbinado
                }


                // comitar os saves
                if (!Yii::app()->user->getFlashes()) {
                    $transaction->commit();
                    // pegar todas as ordens do usuario e redirecionar para página de pagamento
                    $ordens = Usuarios::getOrdens();
                    // renderizar para pag de pagamento
                    $this->redirect('anuncioPagamento', array('ordens' => $ordens, 'somaOrdens' => Usuarios::somarOrdens()));
                    exit;
                }
            } catch (Exception $e) {

                Yii::app()->user->setFlash('erro-critico', $e->getMessage());
                $transaction->rollback();

                // salvar log de erro
                $logErro = new Logs;
                $logErro->chave = 'Erro Anuncio Empresa';
                $logErro->valor = $e->getMessage();
                $logErro->save();
            }
        }

        // scripts
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/anunciar_empresa.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
        // renderizar form de cadastro de empresa
        $this->render('anuncio_empresa', array('empresa' => $empresa,
            'meses' => $meses,
            'email' => Usuarios::getUsuarioLogado()->email,
            'recursosAdicionais' => EmpresaRecursosAdicionais::model()->listarRecursosAdicionais(), 'flgEstaleiro' => false));
    }

// anunciar empresa

    public function actionAnunciarEmbarcacao() {
        // aqui chamamos o método que traz, caso exista (se ñ existir é null)
        // algum plano de anuncio de embarcacao que o usuario tenha e que esteja ativo ou
        // aguardando pagamento
        //$plano = Usuarios::getPlanoCorrenteAnuncio();
        // obter ID do plano que está na URL (verificaremos se o plano foi alterado e validaremos)
        if (isset($_GET['pid'])) {
            $planos_id = Yii::app()->request->getParam('pid');

            // valida o plano
            $planoAnuncio = Planos::validarPlanoDeAnuncio($planos_id);

            // erro ao validar o plano
            if ($planoAnuncio == null) {
                $this->redirect('index');
                exit;
            }
        }


        $plano = null;    // vai receber o plano do usuario
        $flgEstaleiro = false;  // indica se é uma embarcacao de um estaleiro ou não

        if (isset($_GET['tipo_anuncio'])) {

            // verificar se é um plano de anuncio ou estaleiro
            $tipo_anuncio = $_GET['tipo_anuncio'];

            if ($tipo_anuncio == 'plano') {
                $flgEstaleiro = false;
                $plano = Usuarios::getPlanoCorrenteAnuncio();
            } elseif ($tipo_anuncio == 'estaleiro') {
                $flgEstaleiro = true;
                $plano = Usuarios::getPlanoCorrenteEstaleiro();
            } else {
                $this->redirect('index');
                exit;
            }
        }

        if(isset($_GET["id_plano"])) {
            $plano = PlanoUsuarios::model()->findByPk($_GET["id_plano"]);
        }


        // enviar email para o campo
        $email = Usuarios::getUsuarioLogado()->email;

        // flg que indica se tem achou plano ou nao
        $flgTemPlano = false;

        // flg que indica se é plano individual
        $flgPlanoIndividual = false;

        // indicar se marcou que nao achou fabricante
        $flgNaoAchouFabricante = false;

        // variaveis que vao guardar a duracao de meses do plano do usuario
        // e a quantidade permitida de anuncios
        $qntPermitida;
        $meses;
        $statusEmbarcacao = Anuncio::$_status['INATIVA'];

        // aqui é o caso onde o usuario entrou pela tela de escolha de planos de anuncio
        // ou seja, é a primeira vez a anunciar uma embarcação, logo temos que pegar os parâemtros da URL
        $qntPermitida = Yii::app()->request->getParam('qnt');
        $meses = Yii::app()->request->getParam('meses');
        $qntAnunciosCadastrados = 0;

        // se o usuario caiu aqui, já possuindo um plano (testamos também se é um plano de embarcações)

        if ($plano != null) {

            // plano ativo (status 2)
            if ($plano->status == Anuncio::$_status_plano['PAGO']) {
                // indicar que ja possui plano ativo, portanto as embarcações devem ter o status 1 ao
                // serem cadastradas
                $statusEmbarcacao = Anuncio::$_status_anuncio['ANUNCIO_PAGO'];
            }

            // indicar que tem plano
            $flgTemPlano = true;

            $planoAnuncio = $plano->planos;

            // pegar a qntde de anuncios ja cadastrados, qtde permitida e duracao de meses do plano
            //$qntAnunciosCadastrados = count($plano->embarcacoes);
            // ============================
            // contabilizar quantidade de anuncios cadastrados
            if ($plano->status == Anuncio::$_status_plano['PAGO']) {

                foreach ($plano->embarcacoes as $emb) {
                    if ($emb->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"] ||
                            $emb->status == Anuncio::$_status_anuncio["ANUNCIO_PAGO"]) {
                        $qntAnunciosCadastrados += 1;
                    }
                }
            } else {
                $qntAnunciosCadastrados = count($plano->embarcacoes);
            }
            // ========================================

            $qntPermitida = $plano->qntpermitida;
            $meses = $plano->planos->duracaomeses;


            // verificar se a qtde cadastrada bate com a qtde permitida
            if ($qntAnunciosCadastrados >= $plano->qntpermitida) {

                $this->redirect('index');
            }
        }

        // listar turbinados
        $recursosAdicionais = EmbarcacaoRecursosAdicionais::model()->listarRecursosAdicionais();

        // listar todos os tipos de acessórios passando o ID das macros de embarcação (jetski, lancha, veleiro)
        $acessoriosJetSki = AcessorioModelos::listarAcessoriosJetSki();
        $acessoriosLancha = AcessorioModelos::listarAcessoriosLancha();
        $acessoriosVeleiro = AcessorioModelos::listarAcessoriosVeleiro();
        $acessoriosPesca = AcessorioModelos::listarAcessoriosPesca();

        // model de embarcação
        $model = new Embarcacoes;
        $fabricante = new EmbarcacaoFabricantes;
        $motorFabricante = new MotorFabricantes;
        $motorModelo = new MotorModelos;
        $modeloEditavel = new EmbarcacaoModelosEditavel;

        // flags que indicam se o usuario clicou em 'nao achei fabricante do motor ou modelo'
        $flgNaoAchouFabricanteMotor = false;
        $flgNaoAchouModeloMotor = false;

        // submitou formulario
        if (isset($_POST['Embarcacoes'])) {


            $post = Yii::app()->request->getPost('Embarcacoes');

            // transaction
            $transaction = Yii::app()->db->beginTransaction();

            try {

                // verificar se marcou que não achou marca de motor
                // e se não marcou Não Possui Motor
                if (isset($_POST['n-encontrou-marca-motor']) && !isset($_POST['cad'])) {

                    $motorFabricante->setAttributes($_POST['MotorFabricantes']);
                    //$motorFabricante->status = Anuncio::$_status['INATIVA'];
                    $motorFabricante->status = Anuncio::$_status['ATIVA'];

                    // indicar que editou o anuncio
                    $model->editado = 1;
                                        

                    if ($motorFabricante->save()) {

                        $flgNaoAchouFabricanteMotor = true;

                        $motorModelo->setAttributes($_POST['MotorModelos']);
                        $motorModelo->motor_fabricantes_id = $motorFabricante->primaryKey;
                        $motorModelo->embarcacao_macros_id = (int) $_POST['Embarcacoes']['embarcacao_macros_id'];
                        //$motorModelo->status = Anuncio::$_status['INATIVA'];
                        $motorModelo->status = Anuncio::$_status['ATIVA'];

                        if ($motorModelo->save()) {
                            $flgNaoAchouModeloMotor = true;
                        } else {
                            Yii::app()->user->setFlash('erro-motor-modelo', "Erro ao salvar o modelo do motor");
                        }
                    } else {

                        Yii::app()->user->setFlash('erro-motor-fabricante', "Erro ao salvar o fabricante do motor");
                    }
                }

                // verificar se marcou que não achou o modelo de motor
                // e se não marcou Não Possui Motor
                if (isset($_POST['n-encontrou-modelo-motor']) && !isset($_POST['n-encontrou-marca-motor']) && !isset($_POST['cad'])) {

                    $motorModelo->setAttributes($_POST['MotorModelos']);
                    $motorModelo->motor_fabricantes_id = (int) $_POST['Embarcacoes']['motor_marca'];
                    $motorModelo->embarcacao_macros_id = (int) $_POST['Embarcacoes']['embarcacao_macros_id'];
                    $motorModelo->potencia = $_POST['Embarcacoes']['motor_potencia'];
                    //$motorModelo->status = Anuncio::$_status['INATIVA'];
                    $motorModelo->status = Anuncio::$_status['ATIVA'];

                    // indicar que editou o anuncio
                    $model->editado = 1;
                    

                    if ($motorModelo->save()) {

                        $flgNaoAchouModeloMotor = true;
                    } else {

                        // erro
                        Yii::app()->user->setFlash('erro-motor-modelo', "Erro ao salvar o modelo do motor");
                    }
                }


                // verificar se marcou que não achou o fabricante da embarcação
                if (isset($_POST['fabricante-nao-tinha'])) {

                    $flgNaoAchouFabricante = true;
                    $fabricante->setAttributes($_POST['EmbarcacaoFabricantes']);
                    $fabricante->embarcacao_macros_id = (int) $_POST['Embarcacoes']['embarcacao_macros_id'];
                    $fabricante->status = Anuncio::$_status['INATIVA'];

                    // indicar que editou o anuncio
                    $model->editado = 1;
                    

                    if (!$fabricante->save()) {
                        Yii::app()->user->setFlash('erro-fabricante', "Erro ao salvar o fabricante");
                    }
                }

                // verificar se marcou que não achou o modelo da embarcação
                if (isset($_POST['Embarcacoes']['modelo-nao-tinha'])) {

                    // indicar que editou o anuncio
                    $model->editado = 1;
                    

                    // cadastrar um novo modelo de embarcação, porém com status 0
                    // para que o admin ative depois
                    $embarcModelos = new EmbarcacaoModelos;
                    if ($flgNaoAchouFabricante == true) {
                        $embarcModelos->embarcacao_fabricantes_id = $fabricante->primaryKey;
                    } else {
                        if (isset($_POST['Embarcacoes']['embarc_fab'])) {
                            $embarcModelos->embarcacao_fabricantes_id = (int) $_POST['Embarcacoes']['embarc_fab'];
                        }
                    }

                    if (isset($_POST['Embarcacoes']['embarcacao_macros_id'])) {
                        $embarcModelos->embarcacao_macros_id = (int) $_POST['Embarcacoes']['embarcacao_macros_id'];
                    }
                    if (isset($_POST['Embarcacoes']['tipo'])) {
                        $embarcModelos->embarcacao_tipos_id = (int) $_POST['Embarcacoes']['tipo'];
                    }
                    if (isset($_POST['Embarcacoes']['dia'])) {
                        $embarcModelos->passageiros = (int) $_POST['Embarcacoes']['dia'];
                    }
                    if (isset($_POST['Embarcacoes']['noite'])) {
                        $embarcModelos->acomodacoes = (int) $_POST['Embarcacoes']['noite'];
                    }
                    if (isset($_POST['Embarcacoes']['tamanho'])) {
                        $embarcModelos->tamanho = (int) $_POST['Embarcacoes']['tamanho'];
                    }
                    if (isset($_POST['Embarcacoes']['modelo-nao-tinha'])) {
                        $embarcModelos->titulo = $_POST['Embarcacoes']['modelo-nao-tinha'];
                    }
                    if (isset($_POST['Embarcacoes']['motor_de_fabrica'])) {
                        $embarcModelos->motor_de_fabrica = $_POST['Embarcacoes']['motor_de_fabrica'];
                    }


                    // campos estaleiro
                    if ($flgEstaleiro) {
                        if (isset($_POST['Embarcacoes']['boca'])) {
                            $embarcModelos->boca = $_POST['Embarcacoes']['boca'];
                        }
                        if (isset($_POST['Embarcacoes']['calado'])) {
                            $embarcModelos->calado = $_POST['Embarcacoes']['calado'];
                        }
                        if (isset($_POST['Embarcacoes']['pedireito'])) {
                            $embarcModelos->pedireito = $_POST['Embarcacoes']['pedireito'];
                        }
                        if (isset($_POST['Embarcacoes']['tanqueagua'])) {
                            $embarcModelos->tanqueagua = $_POST['Embarcacoes']['tanqueagua'];
                        }
                        if (isset($_POST['Embarcacoes']['tanquecombustivel'])) {
                            $embarcModelos->tanquecombustivel = $_POST['Embarcacoes']['tanquecombustivel'];
                        }
                        if (isset($_POST['Embarcacoes']['ncamarotes'])) {
                            $embarcModelos->ncamarotes = $_POST['Embarcacoes']['ncamarotes'];
                        }
                        if (isset($_POST['Embarcacoes']['nbanheiros'])) {
                            $embarcModelos->nbanheiros = $_POST['Embarcacoes']['nbanheiros'];
                        }
                        if (isset($_POST['Embarcacoes']['pesocasco'])) {
                            $embarcModelos->pesocasco = $_POST['Embarcacoes']['pesocasco'];
                        }
                    }


                    $embarcModelos->status = Anuncio::$_status['INATIVA'];
                    $embarcModelos->slug = Utils::slugify($embarcModelos->titulo);
                    $embarcModelos->save();

                    // flg que indica se o usuario teve de cadastrar o modelo da embarcação
                    $flgNaoTinhaModelo = true;
                }


                // marcou 'editar dados' então devemos criar um modelo temporário
                // para o admin validar as informações depois
                if (isset($_POST['check-editar-dados'])) {

                    // indicar que editou o anuncio
                    $model->editado = 1;
                    $modeloEditavel->setAttributes($_POST['EmbarcacaoModelosEditavel']);
                    $modeloEditavel->status = Anuncio::$_status['INATIVA'];
                    $modeloEditavel->embarcacao_macros_id = (int) $_POST['Embarcacoes']['embarcacao_macros_id'];
                    if (isset($flgNaoTinhaModelo)) {
                        $modeloEditavel->embarcacao_modelos_id = (int) $embarcModelos->primaryKey;
                        $modeloEditavel->titulo = $embarcModelos->titulo;
                    } else {
                        if (isset($_POST['Embarcacoes']['embarcacao_modelos_id'])) {
                            $modeloEditavel->embarcacao_modelos_id = (int) $_POST['Embarcacoes']['embarcacao_modelos_id'];
                        }
                        $modeloEditavel->titulo = EmbarcacaoModelos::model()->findByPk($_POST['Embarcacoes']['embarcacao_modelos_id'])->titulo;
                    }
                    if ($flgNaoAchouFabricante == true) {
                        $modeloEditavel->embarcacao_fabricantes_id = $fabricante->primaryKey;
                    } else {
                        if (isset($_POST['Embarcacoes']['embarc_fab'])) {
                            $modeloEditavel->embarcacao_fabricantes_id = (int) $_POST['Embarcacoes']['embarc_fab'];
                        }
                    }

                    $modeloEditavel->slug = Utils::slugify($modeloEditavel->titulo);
                    $modeloEditavel->save();
                }


                // verifica se o plano é um plano de anuncio individual
                if (isset($_GET['pid']) && $planoAnuncio->flag == 'anuncio_individual') {

                    $flgPlanoIndividual = true;
                    $statusEmbarcacao = Anuncio::$_status_anuncio['ANUNCIO_CRIADO'];
                    $limitepreco = $planoAnuncio->limitepreco;

                    if (isset($_POST['Embarcacoes']['valor']) && Utils::formataValor($_POST['Embarcacoes']['valor']) > $limitepreco && $limitepreco != 0.00) {
                        Yii::app()->user->setFlash('limite-preco', "O limite de preço foi atingido");
                    }

                    // zerar variavel que vai receber o plano individual do usuario
                    $plano = new PlanoUsuarios;
                    $plano->planos_id = $planoAnuncio->id;
                    $plano->usuarios_id = Yii::app()->user->getId();
                    $plano->status = Anuncio::$_status_plano["CRIADO"];

                    $flgPlanoGrats = true;

                    // verifica se tem plano grats
                    if(!PlanoUsuarios::verificarSePossuiPlanoGrats(Yii::app()->user->id)) {
                        // ID do plano gratuito individual

                        $plano->gratuito = 1;
                        $plano->status = Anuncio::$_status_plano['PAGO'];
                        $plano->planos_id = Planos::model()->find("gratuito=:gratuito AND flag=:flag", array(":gratuito"=>1, ":flag"=>"anuncio_individual"))->id;
                        $flgTemPlanoGrats = false;
                        // inicio e fim tanto faz p plano gratuito, ´e infinito mesmo
                        $plano->inicio = date('Y-m-d H:i:s');
                        $plano->fim = date('Y-m-d H:i:s', strtotime('today + ' . $plano->planos->duracaomeses . ' month'));     
                        $statusEmbarcacao = Anuncio::$_status_anuncio['ANUNCIO_PAGO'];
                    }

                    $plano->valor = $planoAnuncio->valor;
                    $plano->qntpermitida = $planoAnuncio->qntpermitida;

                    // salvar e verificar se deu erro
                    $plano->save();


                    // criar ordem de plano se nao é o plano grats (1a vez)
                    if($flgPlanoGrats) {
                        $ordem = new Ordens;
                        $ordem->usuarios_id = Yii::app()->user->getId();
                        $ordem->valor = (float) $planoAnuncio->valor;
                        $ordem->data_criacao = date("Y-m-d H:i:s");
                        $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['PLANO_ANUNCIO'];
                        $ordem->descricao = 'Anúncio Individual';
                        $ordem->status = Anuncio::$_status_ordem['CRIADA'];
                        // FK do item da ordem (aqui no caso é o plano)
                        $ordem->id_item = (int) $plano->primaryKey;
                        $ordem->save();   
                    }

                }

                // é um plano de anuncio (não individual)
                else {
                    // flg que testa se há planos deu false, não tem plano...
                    if ($flgTemPlano == false) {

                        // zerar variavel que vai receber o plano do usuario

                        // houve alteração na URL e no ID do plano (falha de validação do plano)
                        if ($planoAnuncio->flag != "plano_embarcacao") {
                            $transaction->rollback();
                            $this->redirect('index');
                            exit;
                        }

                        // criar novo plano pois é a primeria vez que o usuario anuncia
                        $plano = new PlanoUsuarios;
                        $plano->planos_id = $planoAnuncio->id;
                        $plano->usuarios_id = Yii::app()->user->getId();
                        // status de plano criado
                        $plano->status = Anuncio::$_status_plano['CRIADO'];
                        $plano->valor = $planoAnuncio->valor;
                        $plano->qntpermitida = $planoAnuncio->qntpermitida;
                        // salvar e verificar se deu erro
                        $plano->save();


                        // criar ordem de plano
                        $ordem = new Ordens;
                        $ordem->usuarios_id = Yii::app()->user->getId();
                        $ordem->valor = (float) $planoAnuncio->valor;
                        $ordem->data_criacao = date("Y-m-d H:i:s");
                        $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['PLANO_ANUNCIO'];
                        $ordem->descricao = 'Plano - Anúncio de Embarcações - ' . $planoAnuncio->qntpermitida . ' por ' . $planoAnuncio->duracaomeses . ' meses';
                        $ordem->status = Anuncio::$_status_ordem['CRIADA'];
                        // FK do item da ordem (aqui no caso é o plano)
                        $ordem->id_item = (int) $plano->primaryKey;
                        $ordem->save();
                    }
                }
                // verificar se a embarcação é de plano de estaleiro ou anuncio
                if (Planos::isPlanoEstaleiro($plano->planos->id)) {

                    $model->macros_id = Macros::$macro_by_slug['estaleiro'];
                    $model->email = $email;
                    //$model->email = Usuarios::model()->findByPk(Yii::app()->user->getId();)->email;@@
                }
                // anuncio
                else {
                    $model->macros_id = Macros::$macro_by_slug['vendedor'];
                }
                    $model->plano_usuarios_id = $plano->id;
            

                // setar atributos da embarcação
                $model->setAttributes($_POST['Embarcacoes']);
                $model->valor = Utils::formataValor($model->valor);
                $model->views = 0;
                $model->status = $statusEmbarcacao;
                $model->slug = Utils::slugify($model->titulo);

                if ($flgEstaleiro) {
                    $model->estado = 'N';
                    //$model->status = Anuncio::$_status_anuncio['ANUNCIO_ATIVADO'];
                    $model->status = 1;
                }


                if (isset($flgNaoTinhaModelo)) {
                    $model->embarcacao_modelos_id = (int) $embarcModelos->primaryKey;
                } else {
                    if (isset($_POST['Embarcacoes']['embarcacao_modelos_id'])) {
                        $model->embarcacao_modelos_id = (int) $_POST['Embarcacoes']['embarcacao_modelos_id'];
                    }
                }


                // quantidade de motores
                if (!isset($_POST['Embarcacoes']['qntmotores']))
                    $model->qntmotores = 0;
                else
                    $model->qntmotores = (int) $_POST['Embarcacoes']['qntmotores'] + 1;


                // se for jetski nao tem este tipo de motor, e sim somente o motor de fabrica
                if ($model->embarcacao_macros_id == 1) {

                    $model->qntmotores = 0;
                }

                // ver se checou o turbinado de vídeo
                if (isset($_POST['Embarcacoes']['recursos_adicionais']) && in_array(Anuncio::$_turbinados_embarcacao['VIDEO'], $_POST['Embarcacoes']['recursos_adicionais'])) {
                    if ($_POST['Embarcacoes']['video'] == "") {
                        $model->video = 'video';
                    } else {
                        $model->video = $_POST['Embarcacoes']['video'];
                    }
                }

                // ver se tem o turbinado de destaque
                if (isset($_POST['Embarcacoes']['recursos_adicionais']) && in_array(Anuncio::$_turbinados_embarcacao['DESTAQUE_BUSCA'], $_POST['Embarcacoes']['recursos_adicionais'])) {
                    $model->destaque = Anuncio::$_status_destaque_embarcacao['PENDENTE'];
                }

                // ver se tem o turbinado de destaque
                if (isset($_POST['Embarcacoes']['recursos_adicionais']) && in_array(Anuncio::$_turbinados_embarcacao['TITULO'], $_POST['Embarcacoes']['recursos_adicionais'])) {

                    if ($_POST['Embarcacoes']['titulo'] == "") {
                        $model->titulo = 'titulo';
                    } else {
                        $model->titulo = $_POST['Embarcacoes']['titulo'];
                    }
                }

                // embarcacao_fabricante id
                $model->embarcacao_fabricantes_id = $model->embarcacaoModelos->embarcacaoFabricantes->id;
                $model->primaryKey = $_POST["id_anuncio"];

                // salvar
                if (!$model->save() || !$model->validate())
                    //Yii::app()->user->setFlash('erro-embarcacao', $model->getErrors());
                    Yii::app()->user->setFlash('erro-embarcacao', "Erro ao salvar a embarcação");
                    

                if(!$flgEstaleiro && isset($ordem)) {
                    $descricaoOrdem = Ordens::model()->findByPk($ordem->primaryKey)->descricao;
                    Ordens::model()->updateByPk($ordem->primaryKey, array("descricao"=>$descricaoOrdem." | pedido: ".$model->primaryKey));    
                }
                
                // gambiarra para salvar as imagens, primeiramente salvamos as imagens com um ID qualqer de embarcacao,
                // dps q o form eh submetido e entao temos o ID real da embarc, fazemos um update nas imagens com o id certo
                /*$img_embarc = EmbarcacaoImagens::model()->findAll("embarcacoes_id=9258");
                foreach($img_embarc as $img) {
                    $img->embarcacoes_id = $model->primaryKey;
                    $img->update();
                    if($img->principal == 1) {
                        Embarcacoes::model()->updateByPk($model->primaryKey, array("imagemprincipal"=>$img->imagem));
                    }
                }
                // apaga as imagens da embarc utilizada
                $sql = "DELETE FROM embarcacao_imagens WHERE embarcacoes_id = 9258";
                Yii::app()->db->createCommand($sql)->execute();*/
                // fim gambs

                // caso editou dados
                if($flgNaoAchouFabricante == true) {
                    $editou_fab = new EmbarcacoesEditadas;
                    $editou_fab->tipo_dado = "MARCA";
                    $editou_fab->embarcacoes_id = $model->primaryKey;
                    $editou_fab->plano_usuariosid = $model->plano_usuarios_id;
                    $editou_fab->save();
                }
                if(isset($flgNaoTinhaModelo)) {
                    $editou_modelo = new EmbarcacoesEditadas;
                    $editou_modelo->tipo_dado = "MODELO";
                    $editou_modelo->embarcacoes_id = $model->primaryKey;
                    $editou_modelo->plano_usuariosid = $model->plano_usuarios_id;
                    $editou_modelo->save();
                }
                if($flgNaoAchouFabricanteMotor == true) {
                    $editou_motor_marca = new EmbarcacoesEditadas;
                    $editou_motor_marca->tipo_dado = "MOTOR_MARCA";
                    $editou_motor_marca->embarcacoes_id = $model->primaryKey;
                    $editou_motor_marca->plano_usuariosid = $model->plano_usuarios_id;
                    $editou_motor_marca->save();
                }
                if($flgNaoAchouModeloMotor == true) {
                    $editou_motor_modelo = new EmbarcacoesEditadas;
                    $editou_motor_modelo->tipo_dado = "MOTOR_MODELO";
                    $editou_motor_modelo->embarcacoes_id = $model->primaryKey;
                    $editou_motor_modelo->plano_usuariosid = $model->plano_usuarios_id;
                    $editou_motor_modelo->save();
                }


                // verificar qual tipo de acessorio escolheu
                if (isset($_POST['Embarcacoes']['acessorios']['jetski']) && $_POST['Embarcacoes']['acessorios']['jetski'] != "")
                    $macro = 'jetski';
                elseif (isset($_POST['Embarcacoes']['acessorios']['lancha']) && $_POST['Embarcacoes']['acessorios']['lancha'] != "")
                    $macro = 'lancha';
                elseif (isset($_POST['Embarcacoes']['acessorios']['veleiro']) && $_POST['Embarcacoes']['acessorios']['veleiro'] != "")
                    $macro = 'veleiro';
                elseif (isset($_POST['Embarcacoes']['acessorios']['pesca']) && $_POST['Embarcacoes']['acessorios']['pesca'] != "")
                    $macro = 'pesca';
                else
                // deselecionou todos os acessorios
                    $macro = '';

                if ($macro != '') {
                    foreach ($_POST['Embarcacoes']['acessorios'][$macro] as $id_acessorio) {
                        // foreach dos acessorios para salvar
                        // mas antes, verificar se já não marcou o acessorio em questão
                        $embarcAcessorios = new EmbarcacaoAcessorios;
                        $embarcAcessorios->embarcacoes_id = $model->primaryKey;
                        $embarcAcessorios->acessorios_id = (int) $id_acessorio;
                        $embarcAcessorios->save();
                    }
                }

                // motores
                if ($model->qntmotores > 0) {

                    for ($i = 0; $i < $model->qntmotores; $i++) {
                        $motor = new Motores;
                        $motor->embarcacoes_id = $model->primaryKey;

                        $motor->horas = (int) $_POST['Embarcacoes']['motor_horas'];
                        $motor->status = Anuncio::$_status['ATIVA'];
                        $motor->titulo = 'precisa de titulo';

                        // verificar se marcou que nao tinha achado o modelo
                        if ($flgNaoAchouModeloMotor) {

                            $motor->motor_modelos_id = $motorModelo->primaryKey;
                        } else {

                            if (isset($_POST['Embarcacoes']['motor_modelo'])) {
                                $motor->motor_modelos_id = (int) $_POST['Embarcacoes']['motor_modelo'];
                            }
                        }

                        $motor->motor_fabricantes_id = $motor->motorModelos->motor_fabricantes_id;
                        $motor->save();
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

                        // se for CPM, o calculo do valor é diferente...
                        $ordem->valor = EmbarcacaoRecursosAdicionais::getPrecoPorId($idTurbinado);
                        $ordem->data_criacao = date("Y-m-d H:i:s");
                        // lembrar de por como constante (ID 5 da tabela ordens_tipo é RECURSO ADICIONAL EMBARCACAO)
                        $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['ADICIONAL_EMBARCACAO'];
                        $ordem->descricao = 'Turbinada anúncio ' . ($qntAnunciosCadastrados + 1) . ' - ' . EmbarcacaoRecursosAdicionais::getTituloTurbinado($idTurbinado);
                        $ordem->status = Anuncio::$_status_ordem['CRIADA'];
                        // FK do item da ordem (aqui no caso é o ID do turbinado)
                        $ordem->id_item = (int) $embarcRecs->id;

                        if ($idTurbinado == Anuncio::$_turbinados_embarcacao['CPM']) {

                            $ordem->valor = $_POST['hidden-valor-cpm'];
                            $embarcacaoImpressao = new EmbarcacaoImpressoes;
                            //$limitedate = $_POST['EmbarcacaoImpressoes']['limitdate'];
                            // calcular o termino do cpm
                            //$embarcacaoImpressao->limitdate = date('Y-m-d H:i:s', strtotime('today + ' . $limitedate . ' month'));
                            $embarcacaoImpressao->limitviews = $_POST['EmbarcacaoImpressoes']['limitviews'];
                            $embarcacaoImpressao->embarcacoes_id = $model->primaryKey;
                            $embarcacaoImpressao->save();
                        }

                        // salvar a ordem
                        $ordem->save();

                        $descricaoOrdem = Ordens::model()->findByPk($ordem->primaryKey)->descricao;
                        Ordens::model()->updateByPk($ordem->primaryKey, array("descricao"=>$descricaoOrdem." | pedido: ".$model->primaryKey));
                    } // loop turbinados
                } // if marcou turbinado
                // tabela que relaciona usuarios, embarcacoes e empresas
                // mas primeiro vamos ver se o usuário está atrelado a uma empresa
                $usuariosEmbarcacoes = new UsuariosEmbarcacoes;

                $empresa = Empresas::model()->find('usuarios_id=:usuarios_id', array(':usuarios_id'=>Yii::app()->user->id));

                if($empresa != null) {
                    $usuariosEmbarcacoes->empresas_id = (int) $empresa->id;
                }

                $usuariosEmbarcacoes->embarcacoes_id = $model->primaryKey;
                $usuariosEmbarcacoes->usuarios_id = Yii::app()->user->getId();
                $usuariosEmbarcacoes->save();

                // Sem nenhum erro, commitar os saves e adicionar mais 1 a quantidade de anuncios cadastrados
                // do usuario
                if (!Yii::app()->user->getFlashes()) {

                    $transaction->commit();

                    // zerar embarcacao para proximo anuncio
                    //$model->unsetAttributes();
                    $model->unsetAttributes(array('valor'));
                    $model->unsetAttributes(array('ano'));

                    // se for plano individual, redirecionar para o pagamento
                    if ($flgPlanoIndividual) {

                        if (Usuarios::somarOrdens() > 0) {
                            // pegar todas as ordens do usuario e redirecionar para página de pagamento
                            $ordens = Usuarios::getOrdens();
                            // renderizar para pag de pagamento
                            $this->redirect('anuncioPagamento?minha_conta=1', array('qntAnunciosCadastrados' => $qntAnunciosCadastrados,
                                'qntpermitida' => $plano->qntpermitida,
                                'somaOrdens' => Usuarios::somarOrdens(),
                                'ordens' => $ordens));
                            //$this->redirect(array('/zeromilhas/pagamento'));
                        } else {

                            //$this->redirect(array('/zeromilhas/planos'));
                            $this->redirect(array('/embarcacoes/lista?v=0&e=anuncios'));
                        }
                    }

                    $qntAnunciosCadastrados++;

                    Yii::app()->user->setFlash('sucesso', "Seu anúncio foi salvo com sucesso!");

                    // se execeder a quantidade
                    if ($qntAnunciosCadastrados >= $plano->qntpermitida) {

                        if (Usuarios::somarOrdens() > 0) {
                            // pegar todas as ordens do usuario e redirecionar para página de pagamento
                            $ordens = Usuarios::getOrdens();
                            // renderizar para pag de pagamento
                            $this->redirect('anuncioPagamento?minha_conta=1', array('qntAnunciosCadastrados' => $qntAnunciosCadastrados,
                                'qntpermitida' => $plano->qntpermitida,
                                'somaOrdens' => Usuarios::somarOrdens(),
                                'ordens' => $ordens));
                                //$this->redirect(array('/zeromilhas/pagamento'));
                        } else {

                            //$this->redirect(array('/zeromilhas/planos'));
                            $this->redirect(array('/embarcacoes/lista?v=0&e=anuncios'));
                        }
                    }


                    if (!isset($_POST['outro-anuncio'])) {

                        if ($flgEstaleiro) {
                            if (Yii::app()->user->isAdmin()) {
                                $this->redirect('/embarcacoes/adminGeral');
                            } else {
                                //$this->redirect(array('/zeromilhas/planos'));
                                $this->redirect(array('/embarcacoes/lista?v=0&e=anuncios'));
                            }
                            //exit;
                        }

                        // pegar todas as ordens do usuario e redirecionar para página de pagamento
                        $ordens = Usuarios::getOrdens();

                        // renderizar para pag de pagamento
                        if (count($ordens) > 0 && (Usuarios::somarOrdens() > 0)) {
                            $this->redirect('anuncioPagamento?minha_conta=1', array('qntAnunciosCadastrados' => $qntAnunciosCadastrados,
                                'qntpermitida' => $plano->qntpermitida,
                                'somaOrdens' => Usuarios::somarOrdens(),
                                'ordens' => $ordens));
                            exit;
                            //$this->redirect(array('/zeromilhas/pagamento'));
                            //exit;
                        }

                        // não possue ordens, redirecionar pag de sucesso
                        else {
                            
                            $this->redirect(Yii::app()->createUrl("site/sucesso"));
                            exit;
                        }
                    }
                }
            } catch (Exception $e) {
                $transaction->rollback();
                //$erro = "Erro ao realizar o cadastro de embarcação. Por favor verifique os campos.";
                Yii::app()->user->setFlash('erro-banco', 'Ocorreu um erro inesperado, favor contate o administrador do site.');
                //Yii::app()->user->setFlash('erro-banco', $e->getMessage());
                // salvar log de erro
                $logErro = new Logs;
                if ($model->macros_id != 3) {
                    $logErro->chave = 'Erro Anuncio';
                } else {
                    $logErro->chave = 'Erro Embarc de Estaleiro';
                }
                $logErro->valor = $e->getMessage();
                $logErro->save();
            }
        } // POST Embarcacoes

        $this->render('anuncio_embarcacao', array('model' => $model,
            'fabricante' => $fabricante,
            'recursosAdicionais' => $recursosAdicionais,
            'acessoriosJetSki' => $acessoriosJetSki,
            'acessoriosLancha' => $acessoriosLancha,
            'acessoriosVeleiro' => $acessoriosVeleiro,
            'acessoriosPesca' => $acessoriosPesca,
            'qntPermitida' => $qntPermitida,
            'meses' => $meses,
            'qntAnunciosCadastrados' => $qntAnunciosCadastrados,
            'maxprice' => $planoAnuncio->limitepreco,
            'flgEstaleiro' => $flgEstaleiro,
            'motorFabricante' => $motorFabricante,
            'motorModelo' => $motorModelo,
            'email' => $email, 'valorPlano' => $planoAnuncio->valor
            )
        );
    }

    // metodo de anuncio de guia com plano gratuito
    public function actionAnunciarEmpresaGratuito() {

        $empresa = new Empresas;

        // verificar se o usuário já não possui uma empresa, se tiver, vamos redirecioná-lo
        $possuiEmpresa = Usuarios::getEmpresa();

        // qer dizer que já existe uma emrpesa cadastrada, vamos redirecioanr então
        if ($possuiEmpresa != null) {
            $this->redirect(Yii::app()->homeUrl);
            exit;
        }

        if (isset($_POST['Empresas'])) {


            // setar atributos
            $empresa->setAttributes($_POST['Empresas']);

            $empresa->usuarios_id = Yii::app()->user->id;
            $empresa->status = 1;
            $empresa->macros_id = Anuncio::$_macros['GUIA_EMPRESAS'];
            $empresa->destaque = 0;

            // primeiro vamos obter as imagens de logo e capa da empresa (testar se nao está null)
            if (CUploadedFile::getInstance($empresa, 'logo') != null) {
                //$empresa->capa = CUploadedFile::getInstance($empresa,'capa');

                $logo = CUploadedFile::getInstance($empresa, 'logo');
                $size = $logo->size / 1024;
                $flgTamanhoPermitido = true;
                $flgFormatoPermitido = true;

                // se for mais que 1000 kb, informar erro
                if ($size > 1020 || $size < 20) {
                    $empresa->addError('logo', 'Tamanho não permitido!');
                    $flgTamanhoPermitido = false;
                }

                if ($logo->type != Anuncio::$_extensoes_permitidas['JPEG'] && $logo->type != Anuncio::$_extensoes_permitidas['JPG'] && $logo->type != Anuncio::$_extensoes_permitidas['PNG']) {
                    $empresa->addError('logo', 'Formato não permitido!');
                    $flgFormatoPermitido = false;
                }

                if ($flgFormatoPermitido && $flgTamanhoPermitido) {
                    $empresa->logo = Utils::genImageName($logo);
                    // salvar imagem de capa no servidor
                    if (!$logo->saveAs(Yii::getPathOfAlias('webroot') . '/public/empresas/' . $empresa->logo)) {
                        $empresa->addError('logo', 'Erro ao salvar o logo!');
                    }
                }
            }


            if ($empresa->getErrors() == null) {

                // salvar empresa
                if ($empresa->save()) {

                    $plano = new PlanoUsuarios;
                    $plano->status = 2;
                    $plano->planos_id = Planos::model()->find('gratuito=1 and flag="plano_empresa"')->id;
                    $plano->qntpermitida = 0; // plano de empresa não tem embarcação !! logo a qntpermitida é 0
                    $plano->usuarios_id = Yii::app()->user->id;
                    $plano->inicio = date('Y-m-d H:i:s');

                    // vincular a coluna de plano da tabela de empresas
                    if ($plano->save()) {
                        $emp = Empresas::model()->findByPk($empresa->id);
                        $emp->plano_usuarios_id = $plano->id;
                        $emp->update();

                        // redirecionar pagina da empresa
                        $this->redirect(array('site/sucesso'));
                        exit;
                    }
                }
            }
        }


        // scripts
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/anunciar_empresa.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
        // renderizar form de cadastro de empresa
        $this->render('anuncio_empresa_gratuito', array('empresa' => $empresa,
            'flgEstaleiro' => false));
    }

// fim anunciar embarcação
    // redireciona para página de transações realizadas
    // $minha_conta => se for diferente de null, renderizamos a view de pagamento do minha conta,
    // caso contrário é a view de pagamento do fluxo de anúncio
    public function actionAnuncioPagamento($minha_conta = null) {

        // pegar todas as ordens do usuario e redirecionar para página de pagamento
        $ordens = Usuarios::getOrdens();

        $somaOrdens = Usuarios::somarOrdens();

        if (count($ordens) > 0) {

            $view = 'anuncio_pagamento';

            if ($minha_conta != null) {
                $view = 'pagamento_minha_conta';
            }

            $this->render($view, array('ordens' => $ordens, 'somaOrdens' => $somaOrdens));
        } else {

            $this->redirect(Yii::app()->createUrl('usuarios/update', array('id' => Yii::app()->user->id)));
        }

        exit;
    }

    // método executado via ajax que devolve um json com todos os planos (individuais e ñ indivudiais)
    public function actionListarPlanosDeAnuncios() {

        if (isset($_POST)) {

            echo CJSON::encode(Planos::model()->listarPlanosDeAnuncios());
        }
    }



    // métodos de pagamento
    /**
     * Pagamento com Cartão de Crédito
     * @return [type] [description]
     */
    public function actionPagamentoCartao() {

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

        // Configure o ambiente
        //$environment = $environment = Environment::sandbox();
        $environment = $environment = Environment::production();

        // Configure seu merchant
        //$merchant = new Merchant('64bd4b99-1872-4a61-8a01-41f3e11701a6', 'UHOFVFNOKNNICIMLWKCNEBRGLBZAGBRTTSWRSFRY');
        $merchant = new Merchant('fbf440a7-a143-4eb9-91d7-8c56d6ba5e64', 'UQpF3lAPVdsaiUkRAZGnD22kQgmPfrIYHsRtRMr9');

        // Crie uma instância de Sale informando o ID do pagamento
        $id_pagamento = str_pad(Yii::app()->getRequest()->getPost('reference'), 9, STR_PAD_LEFT);
        $sale = new Sale($id_pagamento);
        $valor = number_format($transacao->valor, 2,'','');

        // Crie uma instância de Customer informando o nome do cliente
        $customer = $sale->customer(Usuarios::getUsuarioLogado()->nome);

        // Crie uma instância de Payment informando o valor do pagamento
        $payment = $sale->payment($valor);

        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $cvv = Yii::app()->getRequest()->getPost('card_cvv');
        $bandeira = Yii::app()->getRequest()->getPost('card_flag');
        $data_validade = Yii::app()->getRequest()->getPost('card_validate_month') . "/". Yii::app()->getRequest()->getPost('card_validate_year');
        $numero_cartao = Yii::app()->getRequest()->getPost('card_number');
        $nome_cartao = Yii::app()->getRequest()->getPost('card_name');

        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
                ->creditCard($cvv, $bandeira)
                ->setExpirationDate($data_validade)
                ->setCardNumber($numero_cartao)
                ->setHolder($nome_cartao);


        // Crie o pagamento na Cielo
        try {


            // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

            // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
            // dados retornados pela Cielo
            $paymentId = $sale->getPayment()->getPaymentId();
            $paymentTid = $sale->getPayment()->getTid();

            // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
            $sale = (new CieloEcommerce($merchant, $environment))->captureSale($paymentId, $valor, 0);

            if($paymentId != "") {

                // CRIAR UM LOG
                $log = new Logs;
                $log->chave = 'Cielo Log';
                $log->id_item = $transacao->id;
                $log->valor = "Pagamento com cartao ok";
                $log->data = new CDbExpression('NOW()');
                $log->save();

                $transaction = Yii::app()->db->beginTransaction();

                // atualizar transação com data de confirmação, tid externo, etc
                $transacao = Transacoes::model()->find('tid=:tid', array(':tid' => Yii::app()->getRequest()->getPost('tid')));
                $transacao->tid_externo = $paymentTid;
                $transacao->status = Anuncio::$_status_transacao['PAGA'];
                $transacao->data_confirmacao = date('Y-m-d H:i:s');
                $transacao->formapagamento = 'cartao-' . Yii::app()->getRequest()->getPost('card_flag');
                $transacao->detalhes = "Pagamento com cartao";
                if (!$transacao->update())
                    throw new Exception('Erro ao atualizar Transação', 1);

                // carregar usuario logado
                $usuario_logado = Usuarios::model()->findByPk(Yii::app()->user->getId());

                // se for turbinada vamos armazenar o link do anuncio
                $link_anuncios_turbinada = array();

                // após atualizar a transação, vamos ativar as ordens de pedido que compõem a mesma
                foreach ($transacao->ordens as $ordem) {

                    // id da ordem corrente para utilizar nos updates
                    $id = (int) $ordem->id_item;

                    // atualizar ordem para status de paga
                    $ordem->status = Anuncio::$_status_ordem['PAGA'];
                    $ordem->update();

                    

                    // verificar o tipo da ordem
                    if ($ordem->ordemTipos->alias == 'plano_anuncio') {

                        // carregar o planoUsuarios pelo ID que está no id_item da ordem
                        $plano_usuario = PlanoUsuarios::model()->findByPk($id);

                        // tipo de ordem é de plano de anuncio (mudar status pra 1 de todas as embarcações do plano)
                        $duracao = $plano_usuario->planos->duracaomeses;
                        $plano_usuario->inicio = date('Y-m-d H:i:s');
                        $plano_usuario->fim = date('Y-m-d H:i:s', strtotime('today + ' . $duracao . ' month'));
                        $plano_usuario->status = Anuncio::$_status_plano['PAGO'];
                        if(!$plano_usuario->update())
                            throw new Exception('Erro ao atualizar Plano', 1);

                        // loop para embarcação
                        foreach ($plano_usuario->embarcacoes as $embarc) {
                            $embarc->status = Anuncio::$_status['ATIVA'];
                            if(!$embarc->update())
                                throw new Exception('Erro ao ativar anúncios', 1);

                            // ativar imagens não turbo da embarcação
                            foreach ($embarc->embarcacaoImagens as $embarcImagem) {
                                if ($embarcImagem->turbo == Anuncio::$_img_turbo['NAO_TURBO']) {
                                    $embarcImagem->status = Anuncio::$_status['ATIVA'];
                                    if(!$embarcImagem->update())
                                        throw new Exception('Erro ao ativar imagens do anúncio', 1);
                                }
                            }

                        }

                    // ordem tipo renovação de plano
                    } 
                    elseif ($ordem->ordemTipos->alias == 'plano_motor') {

                                                // carregar o planoUsuarios pelo ID que está no id_item da ordem
                        $plano_usuario = PlanoUsuarios::model()->findByPk($id);

                        // tipo de ordem é de plano de anuncio (mudar status pra 1 de todas as embarcações do plano)
                        $duracao = $plano_usuario->planos->duracaomeses;
                        $plano_usuario->inicio = date('Y-m-d H:i:s');
                        $plano_usuario->fim = date('Y-m-d H:i:s', strtotime('today + ' . $duracao . ' month'));
                        //$plano_usuario->status = Anuncio::$_status_plano['PAGO'];
                        $plano_usuario->status = 2;
                        if(!$plano_usuario->update())
                            throw new Exception('Erro ao atualizar Plano', 1);

                        // loop para embarcação
                        foreach ($plano_usuario->motores as $motor) {
                            //$motor->status = Anuncio::$_status['ATIVA'];
                            $motor->status = 2;
                            if(!$motor->update())
                                throw new Exception('Erro ao ativar anúncios', 1);

                            // ativar imagens não turbo da embarcação
                            /*foreach ($motor->motorImagens as $embarcImagem) {
                                if ($embarcImagem->turbo == Anuncio::$_img_turbo['NAO_TURBO']) {
                                    $embarcImagem->status = Anuncio::$_status['ATIVA'];
                                    if(!$embarcImagem->update())
                                        throw new Exception('Erro ao ativar imagens do anúncio', 1);
                                }
                            }*/

                        }
                    }
                    elseif ($ordem->ordemTipos->alias == 'renovar_plano') {

                        // dar o status de ativo para o registro que guarda a relação do plano atual
                        // e o plano que será renovado
                        try {

                            $plano_usuario_renovado = PlanosUsuariosRenovados::model()->findByPk($id);
                            $plano_usuario_renovado->status = Anuncio::$_status_plano["RENOVACAO_PAGA"];
                            
                            // ver se esta renovando apos o plano ter vencido
                            $plano_velho_id = $plano_usuario_renovado->plano_usuarios_id_atual;
                            $plano_velho = PlanoUsuarios::model()->findByPk($plano_velho_id);

                            $data_vencimento_plano = $plano_velho->fim;
                            $hoje = date("Y-m-d H:i:s");

                            // se pagou apos o plano ter vencido, ja renovamos logo em seguida, nao precisa
                            // esperar o plano vencer pra renovar
                            if($hoje > $data_vencimento_plano) {

                                // existe um plano a ser renovado, vamos atualizar o ID do plano renovado
                                // e transferir para a embarcação em questão
                                $planoNovo = PlanoUsuarios::model()->findByPk($plano_usuario_renovado->plano_usuarios_id_renovado);
                                $planoNovo->status = Anuncio::$_status_plano["PAGO"];

                                if ($planoNovo->update()) {

                                    // mudar status para finalizado o plano antigo (para n mostrar mais pra renovar, visto q ele esta sendo renovado agora)
                                    PlanoUsuarios::model()->updateByPk($plano_velho_id, array("status"=>Anuncio::$_status_plano["FINALIZADO"]));

                                    // passar embarcacoes que estavam no plano antigo, para esse novo
                                    $embarcacoes = Embarcacoes::model()->findAll("plano_usuarios_id=:plano_id", array(":plano_id"=>$plano_velho_id));

                                    foreach($embarcacoes as $emb) {
                                        $emb->plano_usuarios_id = $planoNovo->id;
                                        $emb->status = 2;
                                        $emb->update();
                                    }    

                                    $plano_usuario_renovado->status = Anuncio::$_status_plano["RENOVACAO_CONCLUIDA"];
                                    $plano_usuario_renovado->update();
                                }
                            }

                            $plano_usuario_renovado->update();

                        } catch(Exception $ex) {
                            throw new Exception($ex->getMessage(), 1);
                        }

                    // ordem tipo plano de empresa
                    } 
                    elseif ($ordem->ordemTipos->alias == 'plano_empresa') {


                        // carregar o planoUsuarios pelo ID que está no id_item da ordem
                        $plano_usuario = PlanoUsuarios::model()->findByPk($id);

                        // ativar plano
                        $duracao = $plano_usuario->planos->duracaomeses;
                        $plano_usuario->inicio = date('Y-m-d H:i:s');
                        $plano_usuario->fim = date('Y-m-d H:i:s', strtotime('today + ' . $duracao . ' month'));
                        $plano_usuario->status = Anuncio::$_status_plano['PAGO'];
                        if(!$plano_usuario->update())
                            throw new Exception('Erro ao ativar Plano Empresa', 1);

                        // ativar empresa
                        $usuario_logado->empresases->status = Anuncio::$_status['ATIVA'];
                        if(!$usuario_logado->empresases->update())
                            throw new Exception('Erro ao ativar Empresa', 1);


                    // ordem tipo rec adicional embarcacao
                    } elseif ($ordem->ordemTipos->alias == 'adicional_embarcacao') {


                        $embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                        $embarcRecAdicionais->status = Anuncio::$_status['ATIVA'];

                        // vamos salvar os links das embarcs dessa turbinada (p envio de email)
                        $embarcacao = $embarcRecAdicionais->embarcacoes;
                        $link_anuncios_turbinada[] = Embarcacoes::mountAbsoluteUrl($embarcacao)."|".Embarcacoes::getAlt($embarcacao);

                        if(!$embarcRecAdicionais->update())
                            throw new Exception('Erro ao ativar Turbinada', 1);

                        if ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'fotos') {

                            foreach ($embarcRecAdicionais->embarcacoes->embarcacaoImagens as $embarcImg) {
                                if ($embarcImg->turbo == Anuncio::$_img_turbo['TURBO']) {
                                    $embarcImg->status = Anuncio::$_status['ATIVA'];
                                    if(!$embarcImg->update())
                                        throw new Exception('Erro ao ativar Imagens turbinadas', 1);
                                }
                            }

                        } elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'destaque_busca') {

                            $embarcRecAdicionais->embarcacoes->destaque = Anuncio::$_status_destaque_embarcacao['PAGO'];
                            if(!$embarcRecAdicionais->embarcacoes->update())
                                throw new Exception('Erro ao ativar Destaque na Busca', 1);

                        } elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'cpm') {

                            // atualizar cpm na tabela de embarcacao impressoes
                            $idEmbarcImpressoes = $embarcRecAdicionais->embarcacoes->embarcacaoImpressoes[0]->id;

                            $embarcImpressao = EmbarcacaoImpressoes::model()->findByPk($idEmbarcImpressoes);
                            $embarcImpressao->status = Anuncio::$_status['ATIVA'];

                             if(!$embarcImpressao->update())
                                throw new Exception('Erro ao ativar Impressões', 1);
                        }
                    // ordem tipo rec adicional empresa
                    } elseif ($ordem->ordemTipos->alias == 'adicional_empresa') {

                        $empresaRecAdicionais = EmpresasHasEmpresaRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                        $empresaRecAdicionais->status = Anuncio::$_status['ATIVA'];
                        if(!$empresaRecAdicionais->update())
                            throw new Exception('Erro ao ativar Turbinadas de Empresa', 1);

                        // verificar se é um rec adicional de imagem (caso for, temos q ativar as imagens)
                        if ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'fotos') {

                            // obter empresa
                            $empresa = Usuarios::getEmpresa();

                            // loop para ativar as fotos da empresa
                            foreach ($empresa->empresaImagens as $imagem) {
                                $imagem->status = Anuncio::$_status['ATIVA'];
                                if(!$imagem->update())
                                    throw new Exception('Erro ao ativar imagens da Empresa', 1);
                            }

                        } else if ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'cpm') {

                            // atualizar cpm na tabela de empresas impressoes
                            $idEmpresaImpressoes = $empresaRecAdicionais->empresas->empresasImpressoes[0]->id;
                            if( !EmpresasImpressoes::model()->updateByPk($idEmpresaImpressoes, array('status' => Anuncio::$_status['ATIVA'])) )
                                throw new Exception('Erro ao ativar impressões de Empresa', 1);

                        }

                    }

                }

                // enviar email avisando o cliente q o pagamento foi realizado com sucesso
                // ver se eh pagamento de turbinada, se for, mandar um email diferente do email de pagto de anuncio
                $body = array();
                $body["email"] = Usuarios::getUsuarioLogado()->nome;

                $message = new YiiMailMessage;
                $message->view = "mail_pagou";

                if(Ordens::isTurbinada($transacao->ordens)) {

                    $message->view = "mail_pagou_turbinada";
                    $body["link_anuncios"] = $link_anuncios_turbinada;
                }

                $message->subject = 'BomBarco - Pagamento Realizado com Sucesso!';
                $message->setBody($body, 'text/html');
                $message->addTo(Usuarios::getUsuarioLogado()->email);
                $message->from = Yii::app()->params['bombarcoAtendimento'];

                // enviar email para o email cadastrado na embarcação, para informar que o anuncio foi validado ok
                if (!Yii::app()->mail->send($message))
                    throw new Exception("Erro ao enviar o email", 5);

                // commitar os demais saves/updates
                $transaction->commit();

            } // aqui

            // E também podemos fazer seu cancelamento, se for o caso
            //$sale = (new CieloEcommerce($merchant, $environment))->cancelSale($paymentId, 1.00);
        } catch (CieloRequestException $e) {
            // Em caso de erros de integração, podemos tratar o erro aqui.
            // os códigos de erro estão todos disponíveis no manual de integração.
            //$error = $e->getCieloError();
            $return['error'] = $e->getCieloError()->getCode();
            $return['msg'] = $e->getCieloError()->getMessage();

            // salvar log de erro
            $logErro = new Logs;
            $logErro->chave = 'Erro pagamento cartao cielo';
            $logErro->valor = $e->getCieloError()->getMessage();
            $logErro->save();
        }

        // fim cielo

        echo json_encode($return);
        exit();
    }


    public function actionPagamentoBoleto() {

               // carrega api do itaushop
        Yii::import('application.vendor.itaushop.*');

        $cripto = new Itaucripto();
    
        $codEmp = "J0103529730001430000019348";
        $chave = "857239AZBDEF0M75";

        $validacao = Transacoes::validarTransacao(Yii::app()->getRequest()->getPost('tid'));

        $return = array('error' => 0, 'msg' => null);

        // Se houver erro na trasacão
        // Retorna o erro
        if ($validacao['error'] != 0) {
            $return['error'] = $validacao['error'];
            $return['msg'] = $validacao['msg'];
            $return['tid'] = Yii::app()->getRequest()->getPost('tid');

            echo json_encode($return);
            exit();
        }

        // Seta a variavel como objeto transacao
        $transacao = $validacao['transacao'];

        // cnpj ou cpf pra gerar o boleto (tem q ser um valido)
        $identidade = Usuarios::getUsuarioLogado()->cpf;
        $identidade = str_replace($identidade, ".","");
        $codigoInscricao = "01";    // Código de Inscrição: 01->CPF, 02->CNPJ
        if($identidade == null) {
            // pegar cnpj, pode ser empresa
            $identidade = Usuarios::getUsuarioLogado()->cnpj;
            $identidade = str_replace($identidade, ".","");
            $identidade = str_replace($identidade, "/","");
            $codigoInscricao = "02";
        }

        $codigoInscricao = "02";
        $identidade = "10352973000143";
        $nome = "Bom Barco";


        //$nome = Usuarios::getUsuarioLogado()->nome;
        if($nome == null) {
            $nome = Usuarios::getUsuarioLogado()->nomefantasia;
        }

        // numero aleatorio do boleto
        $nrDocument = mt_rand(0, 99999999);
        $nrDocument = str_pad($nrDocument, 6, '0', STR_PAD_LEFT); 

        // 5 dias p vencer o boleto
        $dt =  date('d-m-Y', strtotime("+5 days"));
        $datastr = explode("-",$dt);
        $datastr = $datastr[0].$datastr[1].$datastr[2];

        $pedido = $nrDocument;
        $valor = number_format($transacao->valor, 2,',','');
        $observacao = "";
        $nomeSacado = $nome;
        $numeroInscricao = "10352973000143";
        $enderecoSacado = "Rua Cruzeiro do Sul, 323";
        $bairroSacado = "Vila Oliveira";
        $cepSacado = "08790170";
        $cidadeSacado = "Mogi das Cruzes";
        $estadoSacado = "SP";
        $dataVencimento = $datastr;
        $urlRetorna = "/site/sucessoboleto";
        $obsAd1 = "";
        $obsAd2 = "";
        $obsAd3 = "";
        
        $dados = $cripto->geraDados($codEmp,$pedido,$valor,$observacao,$chave,$nomeSacado,$codigoInscricao,$numeroInscricao,$enderecoSacado,$bairroSacado,$cepSacado,$cidadeSacado,$estadoSacado,$dataVencimento,$urlRetorna,$obsAd1,$obsAd2,$obsAd3);
        
        $return['cript_itau'] = $dados;
        $return["num_boleto"] = $nrDocument;

        // atualizar transação com data de confirmação, tid externo, etc
        $transacao->tid_externo = $nrDocument;
        $transacao->status = Anuncio::$_status_transacao['AGUARDANDO_PAGAMENTO'];
        $transacao->data_confirmacao = date('Y-m-d H:i:s');
        $transacao->formapagamento = 'boleto';
        $transacao->detalhes = "Pagamento em boleto";
        $transacao->codigo_itau = $dados;
        $transacao->data_vencimento_boleto = date('Y-m-d H:i:s', strtotime('today +5 days'));
        if (!$transacao->saveAttributes(array('tid_externo', 'status', 'data_confirmacao', 'formapagamento', 'detalhes', 'codigo_itau', 'data_vencimento_boleto'))) {
            
            $return['error'] = "1";
            $return['msg'] = "Ocorreu um erro. Favor contatar o admin do sistema.";
            $return['tid'] = Yii::app()->getRequest()->getPost('tid');
            echo json_encode($return);
        }

        echo json_encode($return);

    } // fim metodo


    public function actionConsultarTid() {

        $tid = $_GET["tid"];

        Yii::import('application.extensions.yii-azpay.*');
        $az_pay = new YiiAzPay(Anuncio::$_az_pay['ID'], Anuncio::$_az_pay['KEY']);

        $az_pay->report($tid);
        $xml = $az_pay->response();

        var_dump($xml->status);
    }

    public function actionAtualizarBoletos() {

        $transacoes = Transacoes::model()->findAll("status=:status AND formapagamento='boleto' AND DATEDIFF(NOW(), data_criacao) < 10", array(":status"=>Anuncio::$_status_transacao['AGUARDANDO_PAGAMENTO']));

        foreach($transacoes as $t) {

            if(VerificacoesTransacoesBoleto::verificacaoHorario($t) == false) {
                Transacoes::atualizarBoleto($t);
            }
            
        }

        echo "1";
    }
}

// fim do controller
