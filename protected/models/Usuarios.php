<?php

Yii::import('application.models._base.BaseUsuarios');
Yii::import('application.models.Anuncio');

class Usuarios extends BaseUsuarios {

    public $senhaConfirmada;

    public function rules() {

        $rules = parent::rules();
        $rules[] = array('email', 'email');
        $rules[] = array('senhaConfirmada, senha', 'required', 'on' => 'Update');

        return $rules;
    }

    public function relations() {

        $rel = parent::relations();
        $rel['empresases'] = array(self::HAS_ONE, 'Empresas', 'usuarios_id');
        $rel['planos'] = array(self::HAS_MANY, 'PlanoUsuarios', 'usuarios_id');

        return $rel;
    }

    // Atributo que classifica o usuário logado
    public static $grupo = array('conteudo'=>'conteudo', 'atendimento'=>'atendimento', 'seo'=>'seo', 'comercial'=>'comercial',  'user' => 'usuario', 'vendedor' => 'vendedor', 'empresa' => 'empresa', 'estaleiro' => 'estaleiro', 'admin' => 'admin');

    public static function label($n = 1) {
        return Yii::t('app', 'Usuario|Usuarios', $n);
    }

    public static function representingColumn() {
        return 'email';
    }

    // método que formata a data para salvar no banco
    public static function formatDateTimeToDb($datetime) {
        $tmp = strtotime(str_replace("/", "-", $datetime));
        return date("Y-m-d", $tmp);
    }

    // método que formata a data para exibir na view
    public static function formatDateTimeToView($datetime) {
        $tmp = strtotime($datetime);
        return date("d/m/Y", $tmp);
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeValidate() {

        //if ($this->data_nascimento != null) {
            //$this->data_nascimento = Usuarios::formatDateTimeToDb($this->data_nascimento);
        //}


        return parent::beforeValidate();
    }

    public function beforeSave() {

        if ($this->isNewRecord) {

            $this->data_nascimento = Usuarios::formatDateTimeToDb($this->data_nascimento);

            // verificar se não existe um usuário já com o username ou email cadastrado (COLOCAR NO BEFORESAVE)
            $count = (int) Usuarios::model()->count('email=:email', array(
                        ':email' => $this->email));

            $countcpf = Usuarios::model()->count('cpf=:cpf', array(
                ':cpf'=>$this->cpf));

            if($countcpf > 0) {
                $this->addError('cpf', 'CPF já existe!');
                return false;
            }

            if ($count > 0) {
                $this->addError('email', 'Usuário já existe!');
                return false;
            } else {
                $this->senha = CPasswordHelper::hashPassword($this->senha, 4);
            }
        }



        //return parent::beforeSave();
        return true;
    }

    public function afterSave() {

        if($this->isNewRecord) {
            $mailling = new Maillings();
            $mailling->email = $this->email;
            $mailling->data = date("Y-m-d h:i:s");
            $mailling->useragent = "NULL";
            $mailling->save(false);    
        }
        
    }

    public static function getUsuarioLogado() {
        return Usuarios::model()->findByPk(Yii::app()->user->getId());
    }

    // método que retorna a empresa do usuario caso tenha
    public static function getEmpresa() {

        if (!Yii::app()->user->isGuest) {

            $user = Usuarios::model()->findByPk(Yii::app()->user->id);

            if ($user != null) {
                return $user->empresases;
            }
        }

        return null;
    }

    /*
      Método que pega o plano de ANUNCIO corrente do usuário logado
     */

    public static function getPlanoCorrenteAnuncio($flgSomentePago = null) {
        $user = Usuarios::model()->findByPk(Yii::app()->user->getId());
        $flgAchouPlanoAtivo = false;

        if ($user != null) {
            if (count($user->planoUsuarioses) > 0 && $user) {
                foreach ($user->planoUsuarioses as $plano) {

                    // pegar so o plano pago
                    if ($flgSomentePago != null) {
                        if ($plano->status == Anuncio::$_status_plano['PAGO'] && !Planos::isAnuncioIndividual($plano->planos_id)) {
                            if ($plano->planos->macros->alias == 'vendedor') {
                                // achou plano de anuncios, retornar o plano
                                return $plano;
                            }
                        }
                    } else {
                        if (( ($plano->status == Anuncio::$_status_plano['CRIADO']) || ($plano->status == Anuncio::$_status_plano['PAGO']) ) && (!Planos::isAnuncioIndividual($plano->planos_id))) {
                            if ($plano->planos->macros->alias == 'vendedor') {
                                // achou plano de anuncios, retornar o plano
                                return $plano;
                            }
                        }
                    }
                }
                // possui planos, mas não de anuncios, retornar null
                return null;
            } else {
                // não possui plano nenhum
                return null;
            }
        }
    }

    /*
      Método que retorna o plano de ESTALEIRO corrente do usuário logado
     */

    public static function getPlanoCorrenteEstaleiro() {
        $user = Usuarios::model()->findByPk(Yii::app()->user->getId());

        if ($user != null) {
            if (count($user->planoUsuarioses) > 0 && $user) {
                foreach ($user->planoUsuarioses as $plano) {
                    if (($plano->status == Anuncio::$_status_plano['PAGO']) && (!Planos::isAnuncioIndividual($plano->planos_id))) {
                        if ($plano->planos->macros->alias == 'estaleiro') {
                            // achou plano de estaleiro, retornar o plano
                            return $plano;
                        }
                    }
                }
            }
        }
        return null;
    }

    // método que verifica se usuario possui plano de empresa
    public static function hasPlanoEmpresa() {
        $user = Usuarios::model()->findByPk(Yii::app()->user->getId());
        $flgAchouPlanoEmpresa = false;

        // se o usuário está logado
        if ($user != null) {
            if (count($user->planoUsuarioses) > 0) {
                foreach ($user->planoUsuarioses as $plano) {
                  
                    if (($plano->status == Anuncio::$_status_plano['CRIADO']) || ($plano->status == Anuncio::$_status_plano['PAGO'])) {
                        if ($plano->planos->macros->alias == 'empresa' || $plano->planos->macros->alias == 'estaleiro') {
                            $flgAchouPlanoEmpresa = true;
                            break;
                        }
                    }
                }
            }
        }



        return $flgAchouPlanoEmpresa;
    }

    // método que verifica se usuario possui plano de anúncio de embarcações
    public static function temPlanoClassificado() {
        $user = Usuarios::model()->findByPk(Yii::app()->user->getId());
        $flgAchouPlanoAnuncio = false;

        // se o usuario está logado
        if ($user != null) {
            if (!empty($user->planoUsuarioses) && count($user->planoUsuarioses) > 0) {
                foreach ($user->planoUsuarioses as $plano) {

                    if ( ($plano->planos->flag == 'plano_embarcacao' || $plano->planos->flag == 'anuncio_individual') /*&& ($plano->status == Anuncio::$_status_plano['CRIADO'] || $plano->status == Anuncio::$_status_plano['PAGO'])*/ ) {
                        $flgAchouPlanoAnuncio = true;
                    }
                }
            }
        }



        return $flgAchouPlanoAnuncio;
    }

    // método que verifica se usuario possui plano de anúncio de embarcações
    public static function hasPlanoAnuncio() {
        $user = Usuarios::model()->findByPk(Yii::app()->user->getId());
        $flgAchouPlanoAnuncio = false;

        // se o usuario está logado
        if ($user != null) {
            if (count($user->planoUsuarioses) > 0) {
                foreach ($user->planoUsuarioses as $plano) {
                    // procurar um plano que esteja criado, ou pago, e que seja do tipo 'vendedor'
                    if (( ($plano->status == Anuncio::$_status_plano['CRIADO']) || ($plano->status == Anuncio::$_status_plano['PAGO']) ) && (!Planos::isAnuncioIndividual($plano->planos_id))) {
                        if ($plano->planos->macros->alias == 'vendedor') {
                            $flgAchouPlanoAnuncio = true;
                            break;
                        }
                    }
                }
            }
        }



        return $flgAchouPlanoAnuncio;
    }

    // método que verifica se usuario possui plano de anúncio de embarcações ATIVO (ou seja, pago)
    public static function hasPlanoAnuncioAtivo() {
        $user = Usuarios::model()->findByPk(Yii::app()->user->getId());
        $flgAchouPlanoAnuncio = false;

        if ($user != null) {
            if (count($user->planoUsuarioses) > 0) {
                foreach ($user->planoUsuarioses as $plano) {
                    if ($plano->status == Anuncio::$_status_plano['PAGO']) {
                        if ($plano->planos->macros->alias == 'vendedor') {
                            $flgAchouPlanoAnuncio = true;
                            break;
                        }
                    }
                }
            }
        }

        return $flgAchouPlanoAnuncio;
    }

    // método que verifica se o usuario passado por parâmetro possui um plano ATIVO
    // do tipo 'estaleiro'
    // true => indica que sim
    // false => não tem plano de estaleiro
    public static function hasPlanoEstaleiroAtivo(Usuarios $user) {

        if ($user != null) {

            if (count($user->planoUsuarioses) > 0) {

                foreach ($user->planoUsuarioses as $plano) {

                    if ($plano->status == Anuncio::$_status_plano['PAGO']) {

                        if ($plano->planos->macros->alias == 'estaleiro') {

                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    // método que lista as ordens do usuario com status 1 (criado) e 2 (paga)
    public static function getOrdens() {

        $ordens = Ordens::model()->findAll('(usuarios_id=:usuarios_id) AND (status = 1 OR status = 2) AND (valor <> 0.00) ORDER BY id DESC', array(':usuarios_id' => Yii::app()->user->getId()));

        if (count($ordens) > 0) {
            return $ordens;
        } else {
            return null;
        }
    }

    public static function getTransacao($id_ordens) {


        $id_usuario = (int) Yii::app()->user->getId();

        // gerar transacao de ordens especificas
        if(count($id_ordens) > 0 ) {    

            $criteria = new CDbCriteria();
            $criteria->addCondition("usuarios_id = ". Yii::app()->user->id . " AND status = 1");
            $criteria->addInCondition("id", $id_ordens);
            $ordens = Ordens::model()->findAll($criteria);
            
        }   

        // gerar transacao de todas as ordens do usuario
        else {
            $ordens = Ordens::model()->findAll('usuarios_id=:usuarios_id AND status=1', array(':usuarios_id' => $id_usuario));
        }

        // guarda o valor totalizado das ordens de pedido
        $valorTotal = 0;

        // totalizar valor das ordens
        if (count($ordens) > 0) {
            // loop ordens 
            foreach ($ordens as $ordem) {
                $valorTotal += $ordem->valor;
            }
        }

        // não possui ordens de pedido - retornar null
        else {
            return null;
        }

        // model de transacao
        $transacao = new Transacoes;
        $transacao->usuarios_id = Yii::app()->user->getId();
        $transacao->gerarTid();
        $transacao->valor = $valorTotal;
        $transacao->data_criacao = date("Y-m-d H:i:s");
        $transacao->status = Anuncio::$_status_transacao['CRIADA'];
        //$transacao->descricao = '#Ordem ' . $transacao->tid . ' Valor: R$ ' . Utils::formataValorView($transacao->valor);
        $transacao->descricao = 'Total: R$ ' . Utils::formataValorView($transacao->valor);

        // salvar
        if (!$transacao->save()) {
            // erro
            return null;
        }

        // ao salvar a transação. pegamos o seu ID gerado e damos update
        // nas ordens listadas
        else {
            foreach ($ordens as $ordem) {
                $ordem->transacoes_id = $transacao->primaryKey;
                $ordem->update();
            }

            // tudo ok, retorna a transacao
            return $transacao;
        }

        return null;
    }

    // método que calcula a somatória das ordens de pedido com status 1
    public static function somarOrdens() {
        $id_usuario = (int) Yii::app()->user->getId();
        // listar todas as ordens com status 1 (status de criada) do usuario logado
        $ordens = Ordens::model()->findAll('usuarios_id=:usuarios_id AND status=1', array(':usuarios_id' => $id_usuario));


        // guarda o valor totalizado das ordens de pedido
        $valorTotal = 0;

        // totalizar valor das ordens
        if (count($ordens) > 0) {
            // loop ordens 
            foreach ($ordens as $ordem) {
                // se n for boleto gerado contabiliza
                if(!Transacoes::segundaViaBoleto($ordem)) {
                    $valorTotal += $ordem->valor;    
                }
                
            }

            return $valorTotal;
        } else {
            return null;
        }
    }

    /**
     * Retorna as embarcações favoritadas pelo Usuário
     * @return [type] [description]
     */
    public static function favoritos() {

        $favoritas = EmbarcacoesFavoritasUsuario::model()->findAll('usuarios_id = :user_id', array(':user_id' => Yii::app()->user->id));

        return $favoritas;
    }

    public static function possuiClassificadosVendidos() {

        $criteria = new CDbCriteria;
        $criteria->with = array('usuariosEmbarcacoes');
        $criteria->together = true;
        $criteria->condition = 'usuariosEmbarcacoes.usuarios_id = :user AND t.status = :status AND t.macros_id != 3';
        $criteria->params = array(':user' => Yii::app()->user->id, ':status' => 4);
        $embarcacoes = Embarcacoes::model()->findAll($criteria);

        if(count($embarcacoes) > 0) {
            return true;
        }

        return false;
    }

    // devolve o obj usuario buscado pelo email da embarc (usado no grid de admin de validar anuncio)
    public static function buscarDonoEmbarc($id_embarc) {
        
        $usuarios_emb = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:emb", array(":emb"=>$id_embarc));

        if($usuarios_emb != null) {

            return Usuarios::model()->findByPk($usuarios_emb->usuarios_id);
        }

        return null;
    }  


    // devolve o obj usuario buscado pelo email da embarc (usado no grid de admin de validar anuncio)
    public static function buscarNomeDonoEmbarc($id_embarc) {
        
        $usuarios_emb = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:emb", array(":emb"=>$id_embarc));
        $usuario = Usuarios::model()->findByPk($usuarios_emb->usuarios_id);

        if($usuario->pessoa == 'J') {
            return $usuario->nomefantasia;
        }

        if($usuario->sobrenome != "") {
            return $usuario->nome . " ". $usuario->sobrenome;
        }
        
        return $usuario->nome;
    }    

}
