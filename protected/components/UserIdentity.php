<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate($redeSocial = null)
    {

        // query que testa o username ou email do usuário, para realizar o login
        $criteria = new CDbCriteria();
        $criteria->select = 'nome, senha, id';
        $criteria->condition = 'email=:email';
        $criteria->params = array(':email'=>$this->username);
        $record = Usuarios::model()->with('usuarioClassificacoes')->find($criteria);

        // testaremos se o usuário resolveu logar por rede social ou não, caso tenha
        // escolhido logar por rede social, não verificaremos o password
           
        // rede social
        if($redeSocial != null) {

            if($record == null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            else
            {
                $this->_id=$record->id;
                $this->setState('name', $record->nome);

                if (!Yii::app()->user->hasState('admin_id') || Yii::app()->user->getState('admin_id') == null) {
                    
                    // Se for Admin
                    if ($record->usuarioClassificacoes->alias == Usuarios::$grupo['admin']) {
                        // Seta o ID na session ADMIN_ID
                        $this->setState('admin_id', $record->id);
                        //Yii::app()->session->add('admin_id', $record->id);
                    } else {
                        // Se não, session fica null
                        //Yii::app()->session->add('admin_id', NULL);
                        $this->setState('admin_id', NULL);
                    }

                }                
                
                $this->errorCode=self::ERROR_NONE;
            }
        }

        // login normal, via plataforma
        else {

            if($record == null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            else if(!CPasswordHelper::verifyPassword($this->password,$record->senha))
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->_id=$record->id;
                $this->setState('name', $record->nome);
                
                if (!Yii::app()->user->hasState('admin_id') || Yii::app()->user->getState('admin_id') == null) {
                    
                    // Se for Admin
                    if ($record->usuarioClassificacoes->alias == Usuarios::$grupo['admin']) {
                        // Seta o ID na session ADMIN_ID
                        $this->setState('admin_id', $record->id);
                        //Yii::app()->session->add('admin_id', $record->id);
                    } else {
                        // Se não, session fica null
                        //Yii::app()->session->add('admin_id', NULL);
                        $this->setState('admin_id', NULL);
                    }

                }

                $this->errorCode=self::ERROR_NONE;
            }
        }
        
        return !$this->errorCode;
    }



    public function switchUser($id) {

        $user = Usuarios::model()->findByPk($id);

        if ($user != null) {

            $this->_id = $user->id;
            $this->setState('name', $user->nome);

            Yii::app()->user->refreshModel($user);           

        }
    }


    public function getId()
    {
        return $this->_id;
    }

}