<?php
 
// this file must be stored in:
// protected/components/WebUser.php
 
class WebUser extends CWebUser {
 
  // Store model to not repeat query.
  private $_model;
 
  // Return username.
  // access it by Yii::app()->user->first_name
  function getUsername(){
    $user = $this->loadUser(Yii::app()->user->id);
    //return $user->username;
    return $user->email;
  }
 
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  public function isAdmin(){

    if (Yii::app()->user->hasState('admin_id') && Yii::app()->user->getState('admin_id') != null) {

      return true;

      /*$user = $this->loadUser(Yii::app()->user->getState('admin_id'));
      return ($user != null && $user->usuarioClassificacoes->alias == Usuarios::$grupo['admin']);*/

    }

    return false;    
  }


  public function isAtendimento(){

      $user = $this->loadUser(Yii::app()->user->id);
      return ($user && $user->usuarioClassificacoes->alias == Usuarios::$grupo['atendimento']);  
  }

  public function isSeo(){

      $user = $this->loadUser(Yii::app()->user->id);
      return ($user && $user->usuarioClassificacoes->alias == Usuarios::$grupo['seo']);  
  }

  public function isComercial(){

      $user = $this->loadUser(Yii::app()->user->id);
      return ($user && $user->usuarioClassificacoes->alias == Usuarios::$grupo['comercial']);  
  }


  public function isConteudo(){

      $user = $this->loadUser(Yii::app()->user->id);
      return ($user && $user->usuarioClassificacoes->alias == Usuarios::$grupo['conteudo']);  
  }
  
  /**
   * Verifica se o usuário logado for Vendedor
   * @return boolean [description]
   */
  public function isSeller(){
    $user = $this->loadUser(Yii::app()->user->id);
    return ($user && $user->usuarioClassificacoes->alias == Usuarios::$grupo['vendedor']);
  }

  /**
   * Verifica se o usuário logado for Empresa
   * @return boolean [description]
   */
  public function isBusiness(){
    $user = $this->loadUser(Yii::app()->user->id);
    return ($user && $user->usuarioClassificacoes->alias == Usuarios::$grupo['empresa']);
  }

  /**
   * Verifica se o usuário logado for Estaleiro
   * @return boolean [description]
   */
  public function isShipyard(){
    $user = $this->loadUser(Yii::app()->user->id);
    return ($user && $user->usuarioClassificacoes->alias == Usuarios::$grupo['estaleiro']);
  }

  /**
   * Verifica se o usuário logado for User
   * @return boolean [description]
   */
  public function isUser() {
    $user = $this->loadUser(Yii::app()->user->id);
    return ($user && $user->usuarioClassificacoes->alias == Usuarios::$grupo['usuario']); 
  }

  /**
   * Retorna o Grupo que o usuário faz parte
   * @return [type] [description]
   */
  public function getGroup() {
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->usuarioClassificacoes->alias;
  }

  /**
   * Recarrega o model do user
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function refreshModel($model) {
    $this->_model = $model;
    return $this->_model;
  }
 
  // Load user model.
  protected function loadUser($id=null)
  {
      if($this->_model === null)
      {
        $this->_model = Usuarios::model()->findByPk(Yii::app()->user->id);
          /*if($id !== null)
              $this->_model = Usuarios::model()->findByPk(Yii::app()->user->id);*/
      }
      return $this->_model;
  }

}
?>