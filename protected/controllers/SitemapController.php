<?php
class SitemapController extends GxController
{

	/**
	 * Declares class-based actions.
	 */
	public function actions() {

    // Empresas
    $sitemap_empresas = array(
      array('baseModel'=>'EmpresaCategorias',
            'route'=>'/guia-de-empresas',
            'params'=>array('slug'),
            'scopeName'=>'sitemap',
            'priority'=>0.5,
            'frequency' => 'monthly'
          ),
      array('baseModel'=>'Empresas',
            'route'=>'/guia-de-empresas',
            'params'=>array('categoria_slug', 'slug'),
            'scopeName'=>'sitemap_empresas',
            'priority'=>0.5,
            'frequency' => 'monthly'
          ),
    );

    // Estaleiros
    $sitemap_estaleiros = array(
      array('baseModel'=>'Empresas',
            'route'=>'/estaleiros',
            'params'=>array('slug'),
            'scopeName'=>'sitemap_estaleiros',
            'priority'=>0.5,
            'frequency' => 'monthly'
      ),
    );

    // Lanchas
    $sitemap_lanchas = array(
      array('baseModel'=>'Embarcacoes',
            'route'=>'/embarcacoes/lanchas-a-venda',
            'params'=>array('macro_estado', 'fabricante_slug', 'modelo_slug', 'embarcacao_slug'),
            'scopeName'=>'sitemap_lanchas',
            'priority'=>0.5,
            'frequency' => 'daily'
          ),
    );

    // Veleiros
    $sitemap_veleiros = array(
      array('baseModel'=>'Embarcacoes',
            'route'=>'/embarcacoes/veleiros-a-venda',
            'params'=>array('macro_estado', 'fabricante_slug', 'modelo_slug', 'embarcacao_slug'),
            'scopeName'=>'sitemap_veleiros',
            'priority'=>0.5,
            'frequency' => 'daily'
          ),
    );

    // JetSkis
    $sitemap_jetskis = array(
      array('baseModel'=>'Embarcacoes',
            'route'=>'/embarcacoes/jet-skis-a-venda',
            'params'=>array('macro_estado', 'fabricante_slug', 'modelo_slug', 'embarcacao_slug'),
            'scopeName'=>'sitemap_jetskis',
            'priority'=>0.5,
            'frequency' => 'daily'
          ),
    );

    // Pesca
    $sitemap_pesca = array(
      array('baseModel'=>'Embarcacoes',
            'route'=>'/embarcacoes/barcos-pesca-a-venda',
            'params'=>array('macro_estado', 'fabricante_slug', 'modelo_slug', 'embarcacao_slug'),
            'scopeName'=>'sitemap_pesca',
            'priority'=>0.5,
            'frequency' => 'daily'
          ),
    );


    // Imagens
    $sitemap_images = array(
      array('baseModel'=>'EmbarcacaoImagens',
            'route'=>'/public/embarcacoes',
            'params'=>array('imagem'),
            'scopeName'=>'sitemap_images',
            'priority'=>0.8,
            'frequency' => 'weekly'
          ),
    );

    $sitemap_images_empresas = array(
      array('baseModel'=>'EmpresaImagens',
            'route'=>'/public/empresas',
            'params'=>array('imagem'),
            'scopeName'=>'sitemap_images',
            'priority'=>0.8,
            'frequency' => 'weekly'
          ),
    );

    $sitemap_images_conteudo = array(
      array('baseModel'=>'ConteudoImagens',
            'route'=>'/public/conteudos',
            'params'=>array('imagem'),
            'scopeName'=>'sitemap_images',
            'priority'=>0.8,
            'frequency' => 'weekly'
          ),
    );

		$classConfig = array(

			/*==========  Conteúdos  ==========*/
      array('baseModel'=>'Conteudos',
            'route'=>'/comunidade/primeiro-barco',
            'params'=>array('slug'),
            'scopeName'=>'sitemap_primeiro_barco',
            'priority'=>0.5,
            'frequency' => 'monthly'
          ),
      array('baseModel'=>'Conteudos',
            'route'=>'/comunidade/noticias',
            'params'=>array('slug'),
            'scopeName'=>'sitemap_noticias',
            'priority'=>0.5,
            'frequency' => 'monthly'
          ),
      array('baseModel'=>'Conteudos',
            'route'=>'/comunidade/blog',
            'params'=>array('slug_categoria','slug'),
            'scopeName'=>'sitemap_blog',
            'priority'=>0.5,
            'frequency' => 'monthly'
          ),
      array('baseModel'=>'ConteudoCategorias',
          'route'=>'/comunidade/blog',
          'params'=>array('slug'),
          'scopeName'=>'sitemap',
          'priority'=>0.5,
            'frequency' => 'monthly'
      	),

			/*==========  Agendas  ==========*/
			/*array('baseModel'=>'Agendas',
            'route'=>'/comunidade/agenda',
            'params'=>array('slug'),
            'scopeName'=>'sitemap',
            'priority'=>0.5,
            'frequency' => 'monthly'
          ),*/


			/*==========  Fabricantes  ==========*/
			array('baseModel'=>'EmbarcacaoFabricantes',
            'route'=>'/embarcacoes',
            'params'=>array('macro_slug_url', 'slug'),
            'scopeName'=>'sitemap',
            'priority'=>0.5,
            'frequency' => 'monthly'
          ),

      /*==========  Modelos  ==========*/      
			array('baseModel'=>'EmbarcacaoModelos',
            'route'=>'/embarcacoes',
            'params'=>array('macro_slug_url', 'fabricante_slug', 'slug'),
            'scopeName'=>'sitemap',
            'priority'=>0.5,
            'frequency' => 'monthly'
          ),

      // estaleiros

      array('baseModel'=>'Empresas',
            'route'=>'/estaleiros',
            'params'=>array('slug'),
            'scopeName'=>'sitemap_estaleiros',
            'priority'=>0.5,
            'frequency' => 'monthly'
      ),


    // Lanchas

      array('baseModel'=>'Embarcacoes',
            'route'=>'/embarcacoes/lanchas-a-venda',
            'params'=>array('macro_estado', 'fabricante_slug', 'modelo_slug', 'embarcacao_slug'),
            'scopeName'=>'sitemap_lanchas',
            'priority'=>0.5,
            'frequency' => 'daily'
          ),


    // Veleiros
      array('baseModel'=>'Embarcacoes',
            'route'=>'/embarcacoes/veleiros-a-venda',
            'params'=>array('macro_estado', 'fabricante_slug', 'modelo_slug', 'embarcacao_slug'),
            'scopeName'=>'sitemap_veleiros',
            'priority'=>0.5,
            'frequency' => 'daily'
          ),


    // JetSkis

      array('baseModel'=>'Embarcacoes',
            'route'=>'/embarcacoes/jet-skis-a-venda',
            'params'=>array('macro_estado', 'fabricante_slug', 'modelo_slug', 'embarcacao_slug'),
            'scopeName'=>'sitemap_jetskis',
            'priority'=>0.5,
            'frequency' => 'daily'
          ),


    // Pesca

      array('baseModel'=>'Embarcacoes',
            'route'=>'/embarcacoes/barcos-pesca-a-venda',
            'params'=>array('macro_estado', 'fabricante_slug', 'modelo_slug', 'embarcacao_slug'),
            'scopeName'=>'sitemap_pesca',
            'priority'=>0.5,
            'frequency' => 'daily'
          ),


		);

		return array(

  			'sitemap'=>array(
            'class'=>'ext.sitemap.ESitemapAction',
            'importListMethod'=>'getBaseSitePageList',
            'classConfig'=>$classConfig,
        ),

        'sitemapxml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$classConfig,
            'importListMethod'=>'getBaseSitePageList',
        ),

        'sitemap_estaleiros_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_estaleiros
        ),

        'sitemap_empresas_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_empresas
        ),

        'sitemap_lanchas_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_lanchas
        ),

        'sitemap_veleiros_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_veleiros
        ),

        'sitemap_jetskis_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_jetskis
        ),

        'sitemap_pesca_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_pesca
        ),

        'sitemap_images_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_images
        ),

        'sitemap_images_empresas_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_images_empresas
        ),

        'sitemap_images_conteudo_xml'=>array(
            'class'=>'ext.sitemap.ESitemapXMLAction',
            'classConfig'=>$sitemap_images_conteudo
        ),
		);

	}


	/**
     * Provide the static site pages which are not database generated
     *
     * Each array element represents a page and should be an array of
     * 'loc', 'frequency' and 'priority' keys
     *
     * @return array[]
     */
    public function getBaseSitePageList(){
      return Sitemap::model()->getSitemap();
    }


    /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}
?>