<?php

Yii::import('application.models._base.BaseContatos');

class Contatos extends BaseContatos {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        $rules = array();

        $rules[] = array('nome_rem, email_rem, email_dest, empresas_id, tipo, usuarios_id_rem, usuarios_id_dest, telefone_rem, mensagem, data, motor_anuncio_id, embarcacoes_id', 'safe', 'on' => 'search');

        return parent::rules();
    }

    /* únicos emails de estaleiros que recebem msg diretamente, o resto vai para atendimento@bombarco...
      Beneteau - contato@sailing.com.br
      Cimitarra - marcal@universonautico.com.br
      FS Yachts - renato@fsyachts.com.br
      Império Yachts - comercial@imperioyachts.com.br
      Mestra - alexsilva@mestraboats.com.br
     */

    public static $emails_estaleiros = array(
        'contato@sailing.com.br',
        'marcal@universonautico.com.br',
        'renato@fsyachts.com.br',
        'comercial@imperioyachts.com.br',
        'alexsilva@mestraboats.com.br',
        'marcioe@beneteau.com.br',
        'cimitarra@cimitarra.com.br'
    );

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->condition = 'usuarios_id_dest =:user and status <> 3';
        $criteria->params = array(':user' => Yii::app()->user->getId());

        if ($this->mensagem != "") {
            $criteria->condition .= ' and palavras_chaves like :termos';
            $criteria->params[':termos'] = '%'.$this->mensagem.'%';
        } 

        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('id', $this->id, true);
        $criteria->compare('nome_rem', $this->nome_rem, true);
        $criteria->compare('email_rem', $this->email_rem, true);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('email_dest', $this->email_dest, true);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('telefone_rem', $this->telefone_rem, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('usuarios_id_dest', $this->usuarios_id_dest);
        $criteria->compare('data_do_titulo', $this->data_do_titulo, true);
        /*$criteria->compare('titulo_mensagem', $this->mensagem, true);
        $criteria->compare('usuarios_id_rem', $this->usuarios_id_rem);
        $criteria->compare('embarcacoes_id', $this->embarcacoes_id);
        $criteria->compare('empresas_id', $this->empresas_id); */

        $criteria->group = 'embarcacoes_id, email_rem, empresas_id';
        $criteria->order = 'data_do_titulo desc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
