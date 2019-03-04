<?php

Yii::import('application.models._base.BaseTransacoes');

class Transacoes extends BaseTransacoes
{

    // Atributo que representa a mensagem de resposta do AZ Pay
    public static $_msg_response = array(
        'AUTHORIZED' => 3,
        'APPROVED' => 8,
        'GENERATED' => 12
        );

    // Atributos dos status das transacões
    public static $_status_by_id = array(
        0 => 'Escondida',
        1 => 'Criada',
        2 => 'Aguardando Pagamento/Confirmação',
        3 => 'Confirmada',
        4 => 'Cancelada',
        5 => 'Estornada',
        6 => 'Fraude',
        7 => 'Outro',
    );
    public static $_status_by_slug = array(
        'escondida'     => 0,
        'criada'        => 1,
        'aguardando'    => 2,
        'confirmada'    => 3,
        'cancelada'     => 4,
        'estornada'     => 5,
        'fraude'        => 6,
        'outro'         => 7,
    );

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    // Método que gera o número da transação do plano
    public function gerarTid() {

        $idUsuario = Yii::app()->user->getId();
        $uniqid = substr(uniqid(rand(), true), 13, 13); // 14 characters long


        //$uniqid =  substr(md5(uniqid(rand(),true)), 0, 13);
        //$this->tid = $uniqid;
        
        $this->tid = str_replace(array(".", ","), "", $uniqid); 
    }

    // Método que obtém todas as transações do plano em questão
    public static function listarPlanos() {
        $criteria = new CDbCriteria();
        $criteria->select = 'id, status, valor, tid';
        $criteria->condition = 'usuarios_id=:usuarios_id AND status=1';
        $criteria->params = array(':usuarios_id'=>Yii::app()->user->getId());
        return self::model()->findAll($criteria);
    }


    /**
     * Verifica se a Transacão existe
     * E se a transacao esta disponível
     * @return [type] [description]
     */
    public static function validarTransacao($tid) {

        // validar se o usuario logado possui uma transação com o tid passado por parâmetro
        $usuario_logado = Usuarios::model()->findByPk(Yii::app()->user->getId());
        $flgAchouTid = false;
        $transacao;

        // erro
        if($usuario_logado == null) {
            $return['error'] = 1;
            $return['msg'] = 'Usuário não esta logado';
        }

        // loop transações do usuario
        foreach($usuario_logado->transacoes as $transacao) {
            if($transacao->tid == $tid) {
                // achou transação, validação ok
                if($transacao->status == Anuncio::$_status['ATIVA']) {
                    $flgAchouTid = true;
                    break;
                }
            }
        }

        // flg achou transação ok
        if($flgAchouTid == true) {

            $return = array();
            $return['error'] = 0;
            $return['msg'] = null;
            $return['transacao'] = null;
            $transacao = self::model()->find('tid = :tid', array(':tid'=>$tid));

            if ($transacao == null) {
                $return['error'] = 1;
                $return['msg'] = 'Transacao não existe';
            }

            if ($transacao->status == 0) {
                $return['error'] = 2;
                $return['msg'] = 'Transacao não esta disponivel';
            }

            if ($transacao->status == 3) {
                $return['error'] = 3;
                $return['msg'] = 'Transacao já confirmada';
            }

            if ($transacao->status == 4) {
                $return['error'] = 4;
                $return['msg'] = 'Transacao cancelada';
            }

            $return['transacao'] = $transacao;

        } else {
            $return['error'] = 1;
            $return['msg'] = 'Transacao não existe';
        }

        return $return;

    }

    public static function atualizarBoleto($t) {

        // carrega api do itaushop
        Yii::import('application.vendor.itaushop.*');
        $cripto = new Itaucripto();
        $codEmp = "J0103529730001430000019348";
        $chave = "857239AZBDEF0M75";
        $formato = "1";
        $pedido = $t->tid_externo;

        $cripto = new Itaucripto();
        //Realiza a criptografia dos dados
        $dados = $cripto->geraConsulta($codEmp, $pedido, $formato, $chave);

        $arquivo_xml = simplexml_load_file('https://shopline.itau.com.br/shopline/consulta.aspx?DC='.$dados);

        /*
            VER DOC ITAUSHOPONLINE
            Numérico com 02 posições:
            - 00 para pagamento efetuado
            - 01 para situação de pagamento não finalizada
            (tente novamente)
            - 02 para erro no processamento da consulta
            (tente novamente)
            - 03 para pagamento não localizado (consulta
            fora de prazo ou pedido não registrado no
            banco)
            - 04 para Boleto emitido com sucesso
            - 05 para pagamento efetuado, aguardando
            compensação
            - 06 para pagamento não compensado
        */
        // boleto foi pago
        if($arquivo_xml->PARAMETER->PARAM[4]["VALUE"] == "00") {

            // se for turbinada vamos armazenar o link do anuncio
            $link_anuncios_turbinada = array();

            try {

                // após atualizar a transação, vamos ativar as ordens de pedido que compõem a mesma
                foreach ($t->ordens as $ordem) {

                    // id da ordem corrente para utilizar nos updates
                    $id = (int) $ordem->id_item;

                    // carregar usuario dono da transacao
                    $usuario_logado = Usuarios::model()->findByPk($t->usuarios_id);

                    // atualizar ordem para status de paga
                    $ordem->status = Anuncio::$_status_ordem['PAGA']; 
                    $ordem->data_ativacao = date('Y-m-d H:i:s');
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
                            return false;

                        // loop para embarcação
                        foreach ($plano_usuario->embarcacoes as $embarc) {
                            $embarc->status = Anuncio::$_status['ATIVA'];
                            if(!$embarc->update())
                                return false;

                            // ativar imagens não turbo da embarcação
                            foreach ($embarc->embarcacaoImagens as $embarcImagem) {
                                if ($embarcImagem->turbo == Anuncio::$_img_turbo['NAO_TURBO']) {
                                    $embarcImagem->status = Anuncio::$_status['ATIVA'];
                                    if(!$embarcImagem->update())
                                        return false;
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
                            return false;

                        // ativar empresa
                        $usuario_logado->empresases->status = Anuncio::$_status['ATIVA'];
                        if(!$usuario_logado->empresases->update())
                            return false;


                    // ordem tipo rec adicional embarcacao
                    } elseif ($ordem->ordemTipos->alias == 'adicional_embarcacao') {

                        $embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                        $embarcRecAdicionais->status = Anuncio::$_status['ATIVA'];

                        // vamos salvar os links das embarcs dessa turbinada (p envio de email)
                        $embarcacao = $embarcRecAdicionais->embarcacoes;
                        $link_anuncios_turbinada[] = Embarcacoes::mountAbsoluteUrl($embarcacao)."|".Embarcacoes::getAlt($embarcacao);
                        
                        if(!$embarcRecAdicionais->update())
                            return false;

                        if ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'fotos') {

                            foreach ($embarcRecAdicionais->embarcacoes->embarcacaoImagens as $embarcImg) {
                                if ($embarcImg->turbo == Anuncio::$_img_turbo['TURBO']) {
                                    $embarcImg->status = Anuncio::$_status['ATIVA'];
                                    if(!$embarcImg->update())
                                        return false;
                                }
                            }

                        } elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'destaque_busca') {

                            //$embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                            $embarcRecAdicionais->embarcacoes->destaque = Anuncio::$_status_destaque_embarcacao['PAGO'];
                            if(!$embarcRecAdicionais->embarcacoes->update())
                                throw new Exception('Erro ao ativar Destaque na Busca', 1);

                        } elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'cpm') {

                             // atualizar cpm na tabela de embarcacao impressoes
                            $idEmbarcImpressoes = $embarcRecAdicionais->embarcacoes->embarcacaoImpressoes[0]->id;
                            $embarcImpressao = EmbarcacaoImpressoes::model()->findByPk($idEmbarcImpressoes);
                            $embarcImpressao->status = Anuncio::$_status['ATIVA'];

                            if(!$embarcImpressao->update())
                                return false;
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
                                    return false;
                            }

                        } else if ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'cpm') {

                            // atualizar cpm na tabela de empresas impressoes
                            $idEmpresaImpressoes = $empresaRecAdicionais->empresas->empresasImpressoes[0]->id;
                            if( !EmpresasImpressoes::model()->updateByPk($idEmpresaImpressoes, array('status' => Anuncio::$_status['ATIVA'])) )
                                return false;

                        }
                        else {
                            
                        }

                    }

                    // atualizar transação
                    Transacoes::model()->updateByPk($t->id, array('status' => Anuncio::$_status_transacao['PAGA']));

                    // enviar email avisando o cliente q o pagamento foi realizado com sucesso
                    // ver se eh pagamento de turbinada, se for, mandar um email diferente do email de pagto de anuncio
                    $body = array();
                    $body["email"] = $usuario_logado->nome;

                    $message = new YiiMailMessage;
                    $message->view = "mail_pagou";

                    if(Ordens::isTurbinada($t->ordens)) {

                        $message->view = "mail_pagou_turbinada";
                        $body["link_anuncios"] = $link_anuncios_turbinada;
                    }

                    $message->subject = 'BomBarco - Pagamento Realizado com Sucesso!';
                    $message->setBody($body, 'text/html');
                    $message->addTo($usuario_logado->email);
                    $message->from = Yii::app()->params['bombarcoAtendimento'];

                    // enviar email para o email cadastrado na embarcação, para informar que o anuncio foi validado ok
                    if (!Yii::app()->mail->send($message))
                        return false;
                }

            } catch(Exception $e) {

                var_dump($e->getMessage());
                return false;
            }
             
            
        }

        else {
            return false;
        }

        return true;

    }

    public static function segundaViaBoleto($ordem) {

        if(count($ordem->transacoes) > 0) {

            if($ordem->transacoes->codigo_itau != NULL) {

                $data_vencimento_boleto = $ordem->transacoes->data_vencimento_boleto;
                $hoje = date('Y-m-d H:i:s');

                if($hoje <= $data_vencimento_boleto) {
                    return true;
                }
            }
        }

        return false;

    }
}