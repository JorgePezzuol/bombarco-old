<?php

Yii::import('application.models._base.BasePlanoUsuarios');

class PlanoUsuarios extends BasePlanoUsuarios {

    // Status
    public static $_status_plano = array(
        'FINALIZADO'    => 0,
        'CRIADO'        => 1,
        'PAGO'          => 2
    );

    // Status por ID
    public static $_status_plano_id = array(
        0 => 'Vencido',
        1 => 'Aguardando Pagamento',
        2 => 'Ativo'
    );

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {

        if (!empty($this->inicio) && preg_match('/\//', $this->inicio) == 1) {
            $inicio = DateTime::createFromFormat('d/m/Y', $this->inicio);
            $this->inicio = $inicio->format('Y-m-d');
        }

        if (!empty($this->fim) && preg_match('/\//', $this->fim) == 1) {
            $fim = DateTime::createFromFormat('d/m/Y', $this->fim);
            $this->fim = $fim->format('Y-m-d');
        }

        return parent::beforeSave();
    }


    // funcao usada no embarcacoes/admin_geral
    public static function checarSeEhGratuito($data) {

        if(isset($data->planoUsuarios)) {
            if($data->planoUsuarios->gratuito == 1) {
                return "Sim";
            }
            else {
                return "Não";
            }
        }

        return "";
    }


    public function afterFind() {

        if (!empty($this->inicio) && preg_match('/-/', $this->inicio) == 1) {
            $inicio = new DateTime($this->inicio);
            $this->inicio = $inicio->format('d/m/Y');
        }

        if (!empty($this->fim) && preg_match('/-/', $this->fim) == 1) {
            $fim = new DateTime($this->fim);
            $this->fim = $fim->format('d/m/Y');
        }

        return parent::afterFind();
    }

    /**
     * Retorna os planos ativos
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public static function getPlans($user_id = null, $macros_id = null) {

        $user_id = (empty($user_id)) ? Yii::app()->user->getId() : $user_id;

        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->with = array('planos');
        // status = 5 (escondido)
        $criteria->condition = 't.usuarios_id = :user_id AND t.status <> 5';
        
        if (!empty($macros_id))
            $criteria->addCondition('planos.macros_id = ' . $macros_id);

        $criteria->params = array(
            ':user_id' => $user_id
        );

        return PlanoUsuarios::model()->findAll($criteria);

    }

    // Método que lista a qntpermitida e o id da tabela de planos_usuarios
    // afim de saber se existe algum plano de embarcações vinculado ao usuário
    public static function hasPlanosAtivos($user_id = null) {

        $user_id = (empty($user_id)) ? Yii::app()->user->getId() : $user_id;

        $criteria = new CDbCriteria();
        $criteria->select = 'qntpermitida, id';
        $criteria->condition = 'usuarios_id=:usuarios_id AND status=1 AND planos_id != 25 AND planos_id != 26';
        $criteria->params = array(':usuarios_id' => $user_id);
        return PlanoUsuarios::model()->find($criteria);
    }

    // Método que retorna o número de embarcações cadastradas no plano em questão do usuário
    public static function calcNumEmbarcacoesNoPlano($idPlano) {
        $criteria = new CDbCriteria();
        $criteria->select = 'id';
        $criteria->condition = 'plano_usuarios_id=:plano_usuarios_id AND status=1';
        $criteria->params = array(':plano_usuarios_id' => $idPlano);
        $resultado = Embarcacoes::model()->findAll($criteria);
        return count($resultado);
    }

    // método que verifica se o usuário possui um plano ATIVO de empresa
    public static function verificarSePossuiPlanoEmpresa($user_id = null) {

        $user_id = (empty($user_id)) ? Yii::app()->user->getId() : $user_id;

        $criteria = new CDbCriteria();
        $criteria->select = 'id';
        $criteria->condition = 'usuarios_id=:usuarios_id AND status=1 AND planos_id = 25 OR planos_id = 26';
        $criteria->params = array(':usuarios_id' => $user_id);

        $plano = PlanoUsuarios::model()->find($criteria);

        if ($plano != null)
            return true;
        else
            return false;
    }

    // "pacotes para empresa ou anuncio_embarcacao (flag no banco)" - planos de embarcaç~ao nao individuais
    public static function verificarSePossuiPacoteEmpresa($user_id = null) {

        $user_id = (empty($user_id)) ? Yii::app()->user->getId() : $user_id;

        // planos ativos do user
        $planos_ativos = PlanoUsuarios::model()->findAll("usuarios_id=:usuarios_id AND (status = 1 OR status = 2)", array(":usuarios_id"=>$user_id));

        $flg = false;

        foreach($planos_ativos as $p) {

            if($p->planos->flag == "plano_embarcacao") {
                $flg = true;
                break;
            }
        }

        return $flg;

    }

    public static function verificarSePossuiPacoteEmpresa2($user_id = null) {

        $user_id = (empty($user_id)) ? Yii::app()->user->getId() : $user_id;

        // planos ativos do user
        $planos_ativos = PlanoUsuarios::model()->findAll("usuarios_id=:usuarios_id AND (status = 1 OR status = 2)", array(":usuarios_id"=>$user_id));

        $flg = false;

        foreach($planos_ativos as $p) {

            if($p->planos->flag == "plano_embarcacao" || $p->planos->flag == "anuncio_individual") {
                $flg = true;
                break;
            }
        }

        return $flg;

    }

    // método que verifica se o usuário possui um plano ATIVO de anuncio de embarcações
    public static function verificarSePossuiPlanoAnuncios($user_id = null) {

        $user_id = (empty($user_id)) ? Yii::app()->user->getId() : $user_id;

        $criteria = new CDbCriteria();
        $criteria->select = 'id';
        $criteria->condition = 'usuarios_id=:usuarios_id AND (status=1 OR status=0) AND (planos_id != 25) AND (planos_id != 26)';
        $criteria->params = array(':usuarios_id' => $user_id);

        $plano = PlanoUsuarios::model()->find($criteria);

        if ($plano != null)
            return true;
        else
            return false;
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'inicio' => Yii::t('app', 'Inicio'),
            'fim' => Yii::t('app', 'Data do Fim do Plano'),
            'qntpermitida' => Yii::t('app', 'Quantidade de Anúncios Permitida'),
            'valor' => Yii::t('app', 'Valor'),
            'status' => Yii::t('app', 'Status'),
            'planos_id' => Yii::t('app', 'Título do Plano'),
            'usuarios_id' => null,
            'embarcacoes' => null,
            'planos' => null,
            'usuarios' => null,
        );
    }

    /**
     * [renovarPlano description]
     * @param  [type] $id_plano_usuarios_atual [ID do plano atual do usuário (PlanoUsuarios)]
     * @param  [$id_plano_renovado] [ID do plano (Planos) que será renovado]
     * @return [type]     [true => ok / false => erro]
     */
    public static function renovarPlano($id_plano_usuarios_atual, $id_plano_renovado) {

        $planoAtual = PlanoUsuarios::model()->findByPk($id_plano_usuarios_atual);

        $objPlanoRenovado = Planos::model()->findByPk($id_plano_renovado);

        // obter a duração de meses do plano atual e somar no plano renovado
        $dataFimPlanoRenovado = $objPlanoRenovado->duracaomeses;

        // criar um plano igual ao plano atual do usuário e copiar os dados
        // a unica diferença é a data de fim
        $planoRenovado = new PlanoUsuarios;
        $planoRenovado->usuarios_id = $planoAtual->usuarios_id;
        $planoRenovado->planos_id = $id_plano_renovado;
        $planoRenovado->status = Anuncio::$_status_plano["CRIADO"];
        if ($objPlanoRenovado->qntpermitida == null) {
            $objPlanoRenovado->qntpermitida = 0;
        }
        $planoRenovado->qntpermitida = $objPlanoRenovado->qntpermitida;
        $planoRenovado->inicio = $planoAtual->inicio;
        $planoRenovado->fim = strftime('%Y-%m-%d %H:%M:%S', strtotime('+ ' . $dataFimPlanoRenovado . ' month'));

        if (!PlanosUsuariosRenovados::model()->exists('plano_usuarios_id_atual =:patual and plano_usuarios_id_renovado =:prenovado', array(':patual' => $planoAtual->id, ':prenovado' => $planoRenovado->id))) {

            // salvar o plano renovado
            if ($planoRenovado->save()) {

                // jogar na tabela que relacioan o plano atual e oq será renovado
                $planoAtualRenovado = new PlanosUsuariosRenovados;
                $planoAtualRenovado->plano_usuarios_id_atual = $planoAtual->id;
                $planoAtualRenovado->plano_usuarios_id_renovado = $planoRenovado->id;
                $planoAtualRenovado->status = Anuncio::$_status_plano["RENOVACAO_CRIADA"];
                $planoAtualRenovado->dataregistro = date('Y-m-d H:i:s');
                $planoAtualRenovado->save();

                if ($planoAtualRenovado->save()) {

                    // criar ordem de plano
                    $ordem = new Ordens;
                    $ordem->usuarios_id = Yii::app()->user->getId();
                    $ordem->valor = (float) $planoRenovado->planos->valor;
                    $ordem->data_criacao = date("Y-m-d H:i:s");
                    $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['RENOVAR_PLANO'];
                    $ordem->descricao = 'Renovação de Plano - Anúncio de Embarcações - ' . $planoRenovado->qntpermitida . ' por ' . $planoRenovado->planos->duracaomeses . ' meses';
                    $ordem->status = Anuncio::$_status_ordem['CRIADA'];
                    
                    // FK do item da ordem (aqui no caso é o plano)
                    $ordem->id_item = (int) $planoAtualRenovado->primaryKey;

                    if (!$ordem->save())
                        return false;
                }

            }

        }

        return true;
    }



    public function search() {

        $criteria = new CDbCriteria;

        //$criteria->condition = 't.status = :teste';
        //$criteria->params = array(':teste'=>2);

        $criteria->compare('id', $this->id);
        $criteria->compare('inicio', $this->inicio, true);
        $criteria->compare('fim', $this->fim, true);
        $criteria->compare('qntpermitida', $this->qntpermitida);
        $criteria->compare('valor', $this->valor, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('planos_id', $this->planos_id);
        $criteria->compare('usuarios_id', $this->usuarios_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
    }


    /*
        Retorna o status do Plano para View
     */
    public static function showStatus(PlanoUsuarios $plan) {

        if (empty($plan->inicio) || empty($plan->fim))
            return 'Datas inválidas';
        
        $hoje = new DateTime('now');
        $inicio = DateTime::createFromFormat('d/m/Y', $plan->inicio);
        $fim = DateTime::createFromFormat('d/m/Y', $plan->fim);
        $errors = DateTime::getLastErrors();
        
        if ($errors['warning_count'] > 0) 
            return 'Aguardando pagamento';

        //$intervalo = $fim->diff($hoje);

        if ($plan->status == Anuncio::$_status_plano['PAGO']) {
            return 'Status: Pago | Vencimento: ' . $plan->fim;
        } else if ($plan->status == Anuncio::$_status_plano['CRIADO']) {
            return 'Status: Aguardando Ativação | Vencimento: ' . $plan->fim;
        } else if ($plan->status == Anuncio::$_status_plano['FINALIZADO']) {
            return 'Status: Finalizado | Vencimento: ' . $plan->fim;
        }

    }


    /**
     * Verifica vencimento do plano
     * @param  PlanoUsuarios $plan [description]
     * @return boolean             [description]
     */
    public static function isOverdue(PlanoUsuarios $plan) {

        $today = new DateTime('now');
        $end = DateTime::createFromFormat('d/m/Y', $plan->fim);
        $errors = DateTime::getLastErrors();

        if ($errors['warning_count'] > 0) 
            return null; 

        // Se hoje passou da data final, volta TRUE (Vencido)
        if ($today > $end)
            return true;
        
        return false;
    }



    /**
     * Verifica se um User possui algum plano
     * em qualquer status
     * @param  [type]  $user_id   [ID do usuário, ou pega da Session]
     * @param  [type]  $macro     [ID da Macro que segmenta o Plano]
     * @return boolean            
     */
    public static function hasPlan($user_id = null, $macro = null) {

        $user_id = (empty($user_id)) ? Yii::app()->user->getId() : $user_id;

        if ($macro = null) {
            
            $plan = (int) PlanoUsuarios::model()->countByAttributes(array('usuarios_id' => $user_id));

        } else {

            $plan = (int) PlanoUsuarios::model()->with('planos')->count('t.usuarios_id = :user_id AND planos.macros_id = :macro', array(':user_id'=>$user_id,':macro'=>$macro));

        }

        return ($plan > 0) ? true : false;
    }


    /**
     * Verifica se o plano é gratuito
     * @param  [type]  $plan [description]
     * @return boolean       [description]
     */
    public static function isFree($plan) {

        if (!empty($plan) && $plan->planos->gratuito == 1)
            return true;
        
        return false;
    }

    public static function getPlanosGratis() {


          $sql = "SELECT usuarios.email,  usuarios.nome, DATE(plano_usuarios.inicio) AS dias, plano_usuarios.id as plano_usuarios_id";
          $sql .= " FROM plano_usuarios";
          $sql .= " INNER JOIN usuarios ON plano_usuarios.usuarios_id = usuarios.id";
          $sql .= " WHERE plano_usuarios.status = 2";
          $sql .= " AND plano_usuarios.gratuito = 1";

          $planos_gratis = Yii::app()->db->createCommand($sql)->queryAll();

          return $planos_gratis;
    }

    // retorna true se ja tiver um plano gratuito associado a conta
    // retorn false se não tiver
    public static function verificarSePossuiPlanoGrats($usuarios_id) {

        $planoUsuarios = PlanoUsuarios::model()->findAll("usuarios_id=:usuarios_id", array(":usuarios_id"=>$usuarios_id));

        if(count($planoUsuarios) > 0) {

            foreach($planoUsuarios as $p) {

                if($p->gratuito == 1) {

                    return true;
                }
            }

            return false;
        }
    }

    public static function emailPlanoGratisSeteDias($planos_gratis) {

        $hoje = date("Y-m-d");

        foreach($planos_gratis as $plano_gratis) {

            $data = date("Y-m-d", strtotime("+7 days", strtotime($plano_gratis["dias"])));

            if($data == $hoje) {

                $embarc = Embarcacoes::buscarEmbarcPeloPlano($plano_gratis["plano_usuarios_id"]);

                if($embarc != null && $embarc->status == 2) {

                    $nome_usuario = $plano_gratis["nome"];
                    $email_usuario = $plano_gratis["email"];

                    // enviar email
                    $message = new YiiMailMessage;
                    $message->view = "mail_plano_gratuito_deu_sete_dias";
                    $message->subject = 'BomBarco - Quanto mais completo seu anúncio for, mais negócios podem aparecer';
                    $message->setBody(array('nome_usuario' => $nome_usuario, 'id_embarcacao' => $embarc->id), 'text/html');
                    $message->addTo($email_usuario);
                    $message->from = Yii::app()->params['bombarcoAtendimento'];

                    Yii::app()->mail->send($message);
                }
            }


        }
    }

    public static function verSePodeRenovar($plano_usuarios) {

        $renovacao = PlanosUsuariosRenovados::consultar($plano_usuarios->id);

        if($plano_usuarios->planos->gratuito == "1" || $plano_usuarios->fim == null) {
            $fim = DateTime::createFromFormat('d/m/Y', "07/12/2099");
        }
        else {
            $fim = DateTime::createFromFormat('d/m/Y', $plano_usuarios->fim);
        }
        $hoje = new DateTime('now');
        @$dias = $hoje->diff($fim)->format('%a');
        @$dias = ($hoje > $fim) ? $dias * -1 : $dias;

        if ( ($dias <= 7 || $dias < 0) && $renovacao == null ) {

            return true;
        }

        return false;
    }


    public static function qtdeAnunciosCadastrados($plano_usuarios) {

        $qtdeAnunciosCadastrados = 0;

        // contabilizar quantidade de anuncios cadastrados
        if ($plano_usuarios->status == Anuncio::$_status_plano['PAGO']) {
            foreach ($plano_usuarios->embarcacoes as $emb) {
                if ($emb->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"] ||
                    $emb->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]) {
                    $qtdeAnunciosCadastrados += 1;
                }
            }
        } else {
            $qtdeAnunciosCadastrados = count($plano_usuarios->embarcacoes);
        }

        return $qtdeAnunciosCadastrados;
    }



}
