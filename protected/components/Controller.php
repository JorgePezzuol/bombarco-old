<?php
Yii::app()->setTimeZone("America/Sao_Paulo");

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	// se for mobile e for diferente do MobileController
	// redirecionar para o index do MobileController
	protected function afterAction($action)
    {   

	    if(!Yii::app()->user->isGuest) {
	    	// tabela usuarios_classificacoes
	    	$array_classificacoes = array(8,7,9,6,5);

	    	$id_classificacao = Usuarios::model()->findByPk(Yii::app()->user->id)->usuario_classificacoes_id;

	    	if(in_array($id_classificacao, $array_classificacoes)) {

	    		$links_n_precisa = array("contabilizarView", "error", "loadTags");

	    		if(!in_array($this->getAction()->getId(), $links_n_precisa)) {

	    			$link_completo = 'https://' .Yii::app()->getRequest()->serverName . Yii::app()->getRequest()->requestUri;

		    		$sql = 'INSERT INTO log_acoes_admin (username, ipaddress, logtime, controller, action, details) VALUES (\''.Yii::app()->user->id.'\',\''.$_SERVER['REMOTE_ADDR'].'\',\''.date("Y-m-d H:i:s").'\',\''.$this->getId().'\',\''.$this->getAction()->getId().'\',\''.$link_completo.'\')';
		
		    		$command = Yii::app()->db->createCommand($sql);
		            $command->execute();
	    		}
	    	}
	    }

    	/*if(Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()) {

    		$links_n_precisa = array("contabilizarView", "error", "loadTags");

    		if(!in_array($this->getAction()->getId(), $links_n_precisa)) {

    			$link_completo = 'https://' .Yii::app()->getRequest()->serverName . Yii::app()->getRequest()->requestUri;

	    		$sql = 'INSERT INTO log_acoes_admin VALUES (\''.Yii::app()->user->id.'\',\''.$_SERVER['REMOTE_ADDR'].'\',\''.date("Y-m-d H:i:s").'\',\''.$this->getId().'\',\''.$this->getAction()->getId().'\',\''.$link_completo.'\')';

	    		$command = Yii::app()->db->createCommand($sql);
	            $command->execute();
    		}


    	}*/
    	
    }

    /*public function beforeAction($action) {
	    if( ! Yii::app()->getRequest()->isSecureConnection ) {
	      $url = 'https://www.bombarco.com.br' . Yii::app()->getRequest()->requestUri;
	      Yii::app()->request->redirect($url);
	      return false;
	    }
	}*/


	public function init() {
	    parent::init();   
	}

	public $ax_category = null;
            public $title;
	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * Executa o filtro para redirecionar páginas para HTTPS
	 * @param  [type] $filterChain [description]
	 * @return [type]              [description]
	 */
	public function filterHttps( $filterChain ) {
        $filter = new HttpsFilter;
        $filter->filter( $filterChain );
    }

    /**
     * Executa o filtro para redirecionar páginas para HTTP
     * @param  [type] $filterChain [description]
     * @return [type]              [description]
     */
    public function filterHttp( $filterChain ) {
        $filter = new HttpFilter;
        $filter->filter( $filterChain );
    }

    

    
}