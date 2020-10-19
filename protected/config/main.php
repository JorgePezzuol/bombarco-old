<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../extensions/x-editable');

return array(
    'language'=>'pt-BR',
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'BomBarco',
    'theme'=>'bombarco',

    // preloading 'log' component

    'preload'=>array('log','EJSUrlManager'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.vendor.Cielo.*',
        'ext.giix-components.*', // giix components
        'ext.easyimage.EasyImage',
        'ext.yii-simple-slack.YiiSimpleSlack',
        'ext.yii-mail.YiiMailMessage',
        'ext.recaptcha.*',
        'editable.*' //easy include of editable classes
    ),

    'modules'=>array(
        // uncomment the following to enable the Gii tool

        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'bombarco',
            // lembrar de setar os IP's que podem acessar o gii
            'ipFilters'=> false,
            'class' => 'system.gii.GiiModule',
            'generatorPaths' => array(
                'ext.giix-core', // giix generators
            ),
        ),

    ),

    // application components
    'components'=>array(
        'cache' => array(
            'class' => 'system.caching.CFileCache'
        ),
        'user'=>array(
            // enable cookie-based authentication
            'class'=>'WebUser',
            'allowAutoLogin'=>true,
        ),
        'easyImage' => array(
            'class' => 'application.extensions.easyimage.EasyImage',
            //'driver' => 'GD',
            //'quality' => 100,
            //'cachePath' => '/assets/easyimage/',
            //'cacheTime' => 2592000,
            //'retinaSupport' => false,
          ),
        'editable' => array(
            'class'     => 'editable.EditableConfig',
            'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain' 
            'mode'      => 'inline',            //mode: 'popup' or 'inline'  
            'defaults'  => array(              //default settings for all editable elements
               'emptytext' => 'Click to edit'
            )
        ), 
        'booster' => array(
            'class' => 'application.extensions.yiiboster.components.Booster',
        ),


        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'caseSensitive'=>true,
            'rules'=>array(

                                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

                // Rotas de Embarcacoes - Jet Skis
                'embarcacoes' => 'embarcacoes/index',
                'embarcacoes/busca/<buscando>' => 'embarcacoes/busca',
		        'classificados' => 'embarcacoes/index',

                'motores' => 'motorAnuncio/busca',
                'motores/<marca>' => 'motorAnuncio/busca',
                'motores/<marca>/<tipo>' => 'motorAnuncio/busca',
                'motores/<marca>/<tipo>/<potencia>' => 'motorAnuncio/detalhe',
                'motores/busca' => 'motorAnuncio/busca',

                'embarcacoes/jet-skis-a-venda' => 'embarcacoes/busca/macro/1',

                'embarcacoes/jet-skis-a-venda/jet-skis-novos/<slug>' => 'embarcacoes/view',
                'embarcacoes/jet-skis-a-venda/jet-skis-usados/<slug>' => 'embarcacoes/view',

                'embarcacoes/jet-skis-a-venda/busca/*' => 'embarcacoes/busca/macro/1',
                'embarcacoes/jet-skis-a-venda/jet-skis-novos' => 'embarcacoes/busca/macro/1/condicao/N',
                'embarcacoes/jet-skis-a-venda/jet-skis-novos/busca/*' => 'embarcacoes/busca/macro/1/condicao/N',
                'embarcacoes/jet-skis-a-venda/jet-skis-usados' => 'embarcacoes/busca/macro/1/condicao/U',
                'embarcacoes/jet-skis-a-venda/jet-skis-usados/busca/*' => 'embarcacoes/busca/macro/1/condicao/U',
                'embarcacoes/jet-skis-a-venda/<fabricante>' => 'embarcacoes/busca/macro/1',
                'embarcacoes/jet-skis-a-venda/jet-skis-novos/<fabricante>' => 'embarcacoes/busca/macro/1/condicao/N',
                'embarcacoes/jet-skis-a-venda/jet-skis-usados/<fabricante>' => 'embarcacoes/busca/macro/1/condicao/U',
                'embarcacoes/jet-skis-a-venda/<fabricante>/busca/*' => 'embarcacoes/busca/macro/1',
                'embarcacoes/jet-skis-a-venda/jet-skis-novos/<fabricante>/busca/*' => 'embarcacoes/busca/macro/1/condicao/N',
                'embarcacoes/jet-skis-a-venda/jet-skis-usados/<fabricante>/busca/*' => 'embarcacoes/busca/macro/1/condicao/U',
                'embarcacoes/jet-skis-a-venda/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/1',
                'embarcacoes/jet-skis-a-venda/jet-skis-novos/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/1/condicao/N',
                'embarcacoes/jet-skis-a-venda/jet-skis-usados/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/1/condicao/U',
                'embarcacoes/jet-skis-a-venda/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/1',
                'embarcacoes/jet-skis-a-venda/jet-skis-novos/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/1/condicao/N',
                'embarcacoes/jet-skis-a-venda/jet-skis-usados/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/1/condicao/U',
                'embarcacoes/jet-skis-a-venda/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',
                'embarcacoes/jet-skis-a-venda/jet-skis-usados/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',
                'embarcacoes/jet-skis-a-venda/jet-skis-novos/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',

                // Rotas de Embarcacoes - Lanchas
                'embarcacoes/lanchas-a-venda' => 'embarcacoes/busca/macro/2',
                'embarcacoes/anunciante/<anunciante>' => 'embarcacoes/buscaAnunciante',

                'embarcacoes/lanchas-a-venda/lanchas-usadas/<slug>' => 'embarcacoes/view',
                'embarcacoes/lanchas-a-venda/lanchas-novas/<slug>' => 'embarcacoes/view',

                'embarcacoes/lanchas-a-venda/busca/*' => 'embarcacoes/busca/macro/2',
                'embarcacoes/lanchas-a-venda/lanchas-novas' => 'embarcacoes/busca/macro/2/condicao/N',
                'embarcacoes/lanchas-a-venda/lanchas-novas/busca/*' => 'embarcacoes/busca/macro/2/condicao/N',
                'embarcacoes/lanchas-a-venda/lanchas-usadas' => 'embarcacoes/busca/macro/2/condicao/U',
                'embarcacoes/lanchas-a-venda/lanchas-usadas/busca/*' => 'embarcacoes/busca/macro/2/condicao/U',
                'embarcacoes/lanchas-a-venda/<fabricante>' => 'embarcacoes/busca/macro/2',
                'embarcacoes/lanchas-a-venda/lanchas-novas/<fabricante>' => 'embarcacoes/busca/macro/2/condicao/N',
                'embarcacoes/lanchas-a-venda/lanchas-usadas/<fabricante>' => 'embarcacoes/busca/macro/2/condicao/U',
                'embarcacoes/lanchas-a-venda/<fabricante>/busca/*' => 'embarcacoes/busca/macro/2',
                'embarcacoes/lanchas-a-venda/lanchas-novas/<fabricante>/busca/*' => 'embarcacoes/busca/macro/2/condicao/N',
                'embarcacoes/lanchas-a-venda/lanchas-usadas/<fabricante>/busca/*' => 'embarcacoes/busca/macro/2/condicao/U',
                'embarcacoes/lanchas-a-venda/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/2',
                'embarcacoes/lanchas-a-venda/lanchas-novas/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/2/condicao/N',
                'embarcacoes/lanchas-a-venda/lanchas-usadas/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/2/condicao/U',
                'embarcacoes/lanchas-a-venda/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/2',
                'embarcacoes/lanchas-a-venda/lanchas-novas/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/2/condicao/N',
                'embarcacoes/lanchas-a-venda/lanchas-usadas/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/2/condicao/U',
                'embarcacoes/lanchas-a-venda/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',
                'embarcacoes/lanchas-a-venda/lanchas-usadas/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',
                'embarcacoes/lanchas-a-venda/lanchas-novas/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',



                // Rotas de Embarcacoes - Veleiros
                'embarcacoes/veleiros-a-venda' => 'embarcacoes/busca/macro/3',


                'embarcacoes/veleiros-a-venda/veleiros-usados/<slug>' => 'embarcacoes/view',
                'embarcacoes/veleiros-a-venda/veleiros-novos/<slug>' => 'embarcacoes/view',

                'embarcacoes/veleiros-a-venda/busca/*' => 'embarcacoes/busca/macro/3',
                'embarcacoes/veleiros-a-venda/veleiros-novos' => 'embarcacoes/busca/macro/3/condicao/N',
                'embarcacoes/veleiros-a-venda/veleiros-novos/busca/*' => 'embarcacoes/busca/macro/3/condicao/N',
                'embarcacoes/veleiros-a-venda/veleiros-usados' => 'embarcacoes/busca/macro/3/condicao/U',
                'embarcacoes/veleiros-a-venda/veleiros-usados/busca/*' => 'embarcacoes/busca/macro/3/condicao/U',
                'embarcacoes/veleiros-a-venda/<fabricante>' => 'embarcacoes/busca/macro/3',
                'embarcacoes/veleiros-a-venda/veleiros-novos/<fabricante>' => 'embarcacoes/busca/macro/3/condicao/N',
                'embarcacoes/veleiros-a-venda/veleiros-usados/<fabricante>' => 'embarcacoes/busca/macro/3/condicao/U',
                'embarcacoes/veleiros-a-venda/<fabricante>/busca/*' => 'embarcacoes/busca/macro/3',
                'embarcacoes/veleiros-a-venda/veleiros-novos/<fabricante>/busca/*' => 'embarcacoes/busca/macro/3/condicao/N',
                'embarcacoes/veleiros-a-venda/veleiros-usados/<fabricante>/busca/*' => 'embarcacoes/busca/macro/3/condicao/U',
                'embarcacoes/veleiros-a-venda/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/3',
                'embarcacoes/veleiros-a-venda/veleiros-novos/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/3/condicao/N',
                'embarcacoes/veleiros-a-venda/veleiros-usados/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/3/condicao/U',
                'embarcacoes/veleiros-a-venda/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/3',
                'embarcacoes/veleiros-a-venda/veleiros-novos/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/3/condicao/N',
                'embarcacoes/veleiros-a-venda/veleiros-usados/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/3/condicao/U',
                'embarcacoes/veleiros-a-venda/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',
                'embarcacoes/veleiros-a-venda/veleiros-usados/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',
                'embarcacoes/veleiros-a-venda/veleiros-novos/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',

                // Rotas de Embarcacoes - Pesca
                'embarcacoes/barcos-pesca-a-venda' => 'embarcacoes/busca/macro/4',

                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-usados/<slug>' => 'embarcacoes/view',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-novos/<slug>' => 'embarcacoes/view',

                'embarcacoes/barcos-pesca-a-venda/busca/*' => 'embarcacoes/busca/macro/4',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-novos' => 'embarcacoes/busca/macro/4/condicao/N',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-novos/busca/*' => 'embarcacoes/busca/macro/4/condicao/N',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-usados' => 'embarcacoes/busca/macro/4/condicao/U',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-usados/busca/*' => 'embarcacoes/busca/macro/4/condicao/U',
                'embarcacoes/barcos-pesca-a-venda/<fabricante>' => 'embarcacoes/busca/macro/4',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-novos/<fabricante>' => 'embarcacoes/busca/macro/4/condicao/N',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-usados/<fabricante>' => 'embarcacoes/busca/macro/4/condicao/U',
                'embarcacoes/barcos-pesca-a-venda/<fabricante>/busca/*' => 'embarcacoes/busca/macro/4',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-novos/<fabricante>/busca/*' => 'embarcacoes/busca/macro/4/condicao/N',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-usados/<fabricante>/busca/*' => 'embarcacoes/busca/macro/4/condicao/U',
                'embarcacoes/barcos-pesca-a-venda/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/4',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-novos/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/4/condicao/N',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-usados/<fabricante>/<modelo>' => 'embarcacoes/busca/macro/4/condicao/U',
                'embarcacoes/barcos-pesca-a-venda/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/4',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-novos/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/4/condicao/N',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-usados/<fabricante>/<modelo>/busca/*' => 'embarcacoes/busca/macro/4/condicao/U',
                'embarcacoes/barcos-pesca-a-venda/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-usados/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',
                'embarcacoes/barcos-pesca-a-venda/barcos-pesca-novos/<fabricante>/<modelo>/<slug>' => 'embarcacoes/view',


                'lanchas-a-venda<rest:.*>' => 'embarcacoes/busca/macro/2',
                'lanchas-novas<rest:.*>' => 'embarcacoes/busca/macro/2',
                'jet-skis-a-venda<rest:.*>' => 'embarcacoes/busca/macro/1',
                'veleiros-a-venda<rest:.*>' => 'embarcacoes/busca/macro/3',

                /*'guia-de-empresas'=>'empresas',
                'guia-de-empresas/todas'=>'empresas/empresas',
                'guia-de-empresas/busca/<termo>'=>'empresas/empresas',
                'guia-de-empresas/localizacao/<localizacao>'=>'empresas/empresas',
                'guia-de-empresas/localizacao/<localizacao>/busca/<termo>'=>'empresas/empresas',
                'guia-de-empresas/localizacao/<localizacao>/<slug>/detalhe'=>'empresas/empresadetalhe',
                'guia-de-empresas/<slug>/detalhe'=>'empresas/empresadetalhe',
                'guia-de-empresas/<categoria>'=>'empresas/empresas',
                'guia-de-empresas/<categoria>/<slug>'=>'empresas/empresadetalhe',
                'guia-de-empresas/<categoria>/busca/<termo>'=>'empresas/empresas',
                'guia-de-empresas/<categoria>/localizacao/<localizacao>'=>'empresas/empresas',
                'guia-de-empresas/<categoria>/localizacao/<localizacao>/busca/<termo>'=>'empresas/empresas',
                'guia-de-empresas/<categoria>/localizacao/<localizacao>/<slug>/detalhe'=>'empresas/empresadetalhe',
                'empresas/cadastrar-empresa'=>'empresas/create',*/

                'guia-de-empresas'=>'http://guiadocapitao.com.br/',
                'guia-de-empresas/todas'=>'empresas/empresas',
                'guia-de-empresas/busca/<termo>'=>'empresas/empresas',
                'guia-de-empresas/localizacao/<localizacao>'=>'empresas/empresas',
                'guia-de-empresas/localizacao/<localizacao>/busca/<termo>'=>'empresas/empresas',
                'guia-de-empresas/localizacao/<localizacao>/<slug>/detalhe'=>'empresas/empresadetalhe',
                'guia-de-empresas/<slug>/detalhe'=>'empresas/empresadetalhe',
                'guia-de-empresas/<categoria>'=>'empresas/empresas',
                'guia-de-empresas/<categoria>/<slug>'=>'empresas/empresadetalhe',
                'guia-de-empresas/<categoria>/busca/<termo>'=>'empresas/empresas',
                'guia-de-empresas/<categoria>/localizacao/<localizacao>'=>'empresas/empresas',
                'guia-de-empresas/<categoria>/localizacao/<localizacao>/busca/<termo>'=>'empresas/empresas',
                'guia-de-empresas/<categoria>/localizacao/<localizacao>/<slug>/detalhe'=>'empresas/empresadetalhe',
                'empresas/cadastrar-empresa'=>'empresas/create',

                'estaleiros'=>'empresas/estaleirosindex',
                //'estaleiros'=>'catalogo',
                'estaleiros/estaleiros-de-jetskis'=>'empresas/estaleirosindex/macro/1',
                'estaleiros/estaleiros-de-jetskis/<slug>'=>'empresas/estaleirosdetalhe',
                'estaleiros/estaleiros-de-jetskis/busca/<busca>'=>'empresas/estaleirosdetalhe',
                'estaleiros/estaleiros-de-lanchas'=>'empresas/estaleirosindex/macro/2',
                'estaleiros/estaleiros-de-lanchas/<slug>'=>'empresas/estaleirosdetalhe',
                'estaleiros/estaleiros-de-lanchas/busca/<busca>'=>'empresas/estaleirosdetalhe',
                'estaleiros/estaleiros-de-velerios'=>'empresas/estaleirosindex/macro/3',
                'estaleiros/estaleiros-de-velerios/<slug>'=>'empresas/estaleirosdetalhe',
                'estaleiros/estaleiros-de-velerios/busca/<busca>'=>'empresas/estaleirosdetalhe',
                'estaleiros/estaleiros-de-barcos-pesca'=>'empresas/estaleirosindex/macro/4',
                'estaleiros/estaleiros-de-barcos-pesca/<slug>'=>'empresas/estaleirosdetalhe',
                'estaleiros/estaleiros-de-barcos-pesca/busca/<busca>'=>'empresas/estaleirosdetalhe',
                'estaleiros/cadastrar-estaleiro'=>'empresas/createestaleiro',
                'estaleiros/cadastrar-estaleiro/<id_usuario:\d+>'=>'empresas/createestaleiro',
                'estaleiros/busca/<termo>'=>'empresas/estaleirosindex',
                'estaleiros/<slug>'=>'empresas/estaleirosdetalhe',
                'estaleiros/<estaleiro>/<modelo>/<slug>' => 'embarcacoes/estaleiro',

                'busca/<busca>' => 'site/busca',
                'login' => 'site/login',
                'sobre' => 'site/sobre',
                'institucional' => 'site/institucional',
                'anunciar' => 'anuncios',
                'comunidade' => 'conteudos',
                'comunidade/busca/<busca>' => 'conteudos',



                // EBOOK
                'ebook/meuprimeirobarco' => 'bombarcoshop/e-book',
                'ebook/<slug>' => 'bombarcoshop/view',
                
                'bombarcoshop/downloadEbook' => 'bombarcoshop/downloadEbook',
                'bombarcoshop/validarCupom' => 'bombarcoshop/validarCupom',
                'bombarcoshop/pagamentoCartao' => 'bombarcoshop/pagamentoCartao',
                'admin/bombarcoshop' => 'bombarcoshop/admin',
                'admin/bombarcoshop/create' => 'bombarcoshop/create',

                
                //'bombarcoshop/<slug>' => 'bombarcoshop/view',

                'shop/<slug>' => 'bombarcoshop/view',
                'e-book/<slug>' => 'bombarcoshop/view',

                //'admin' => 'site/admin',
                'admin' => 'logAcoesAdmin/admin',
                'admin/embarcacoes/validar' => 'embarcacoes/adminAnunciosParaValidar',
                'admin/embarcacoes/anuncios' => 'embarcacoes/adminGeral',
                'admin/embarcacoes/fabricantes' => 'embarcacaoFabricantes/admin',
                'admin/embarcacoes/fabricantes/criar' => 'embarcacaoFabricantes/create',
                'admin/embarcacoes/fabricantes/editar' => 'embarcacaoFabricantes/update',
                'admin/embarcacoes/modelos/criar' => 'embarcacaoModelos/create',
                'admin/embarcacoes/modelos/editar' => 'embarcacaoModelos/update',
                'admin/embarcacoes/modelos' => 'embarcacaoModelos/admin',
                'admin/embarcacoes/tipos' => 'embarcacaoTipos/admin',
                'admin/embarcacoes/tipos/criar' => 'embarcacaoTipos/create',
                'admin/embarcacoes/tipos/editar' => 'embarcacaoTipos/update',
                'admin/embarcacoes/slugs' => 'embarcacoes/adminSlugs',
                'admin/empresas' => 'empresas/admin',
                'admin/empresas/anuncios-pagos' => 'empresas/adminAnunciosPagos',
                'admin/empresas/tipos' => 'empresaCategorias/admin',
                'admin/empresas/tipos/criar' => 'empresaCategorias/create',
                'admin/empresas/tipos/editar/<id:\d+>' => 'empresaCategorias/update',
                'admin/estaleiros' => 'empresas/adminEstaleiros',
                'admin/estaleiros/cadastro' => 'empresas/createEstaleiro',
                'admin/estaleiros/embarcacoes' => 'embarcacoes/adminEstaleiros',
                'admin/comunidade' => 'conteudos/admin',
                'admin/comunidade/adicionar' => 'conteudos/create',
                'admin/comunidade/editar' => 'conteudos/update',
                'admin/comunidade/categorias' => 'conteudoCategorias/admin',
                'admin/comunidade/categorias/criar' => 'conteudoCategorias/create',
                'admin/comunidade/categorias/editar' => 'conteudoCategorias/update',
                'admin/comunidade/agendas' => 'agendas/admin',
                'admin/comunidade/agendas/criar' => 'agendas/create',
                'admin/comunidade/agendas/editar' => 'agendas/update',
                'admin/motores' => 'motorModelos/admin',
                'admin/aprovarMotores' => 'motorAnuncio/aprovarAnuncios',
                'admin/motores' => 'motorAnuncio/adminGeral',
                'admin/motores/modelos/criar' => 'motorModelos/create',
                'admin/motores/modelos/editar' => 'motorModelos/update',
                'admin/motores/fabricantes' => 'motorFabricantes/admin',
                'admin/motores/fabricantes/criar' => 'motorFabricantes/create',
                'admin/motores/fabricantes/editar' => 'motorFabricantes/update',
                'admin/motores/tipos' => 'motorTipos/admin',
                'admin/motores/tipos/criar' => 'motorTipos/create',
                'admin/motores/tipos/editar' => 'motorTipos/update',
                'admin/maillings' => 'maillings/admin',
                'admin/acessorios' => 'acessorioTipos/admin',
                'admin/acessorios/criar' => 'acessorioTipos/create',
                'admin/acessorios/editar/<id:\d+>' => 'acessorioTipos/update',
                'admin/acessorios/ver/<id:\d+>' => 'acessorioTipos/view',
                'admin/usuarios' => 'usuarios/admin',
                'admin/usuarios_comercial' => 'usuarios/adminComercial',
                'admin/usuarios/ver/<id>' => 'usuarios/view',
                'admin/banners' => 'banners/admin',
                'admin/banners/criar' => 'banners/create',
                'admin/banners/editar/<id:\d+>' => 'banners/update',
                'admin/relatorioGeralDeEmails' => 'relatorios/relatorioGeralDeEmails',
                'admin/seo' => 'seo/admin',
                'admin/seocreate' => 'seo/create',
                'admin/seoupdate' => 'seo/update',
                'admin/seodelete' => 'seo/delete',
                'admin/vendas' => 'vendasBombarco/admin',
                'admin/contrato' => 'contrato/create',
                //'admin/contrato/assinar/<id:\w+>' => 'contrato/update',
                'admin/turbinadas' => 'ordens/admin',
                'admin/compras_planos' => 'ordens/adminPlanos',
                'admin/turbinadasBoleto' => 'ordens/adminBoleto',
                'admin/compras_planos_boleto' => 'ordens/adminPlanosBoleto',
                'admin/logacoes' => 'logAcoesAdmin/admin',
                
                
                //'admin/embarcacoes/tabela' => 'tabelaEmbarcacoes/admin',
                //'admin/embarcacoes/tabela/criar' => 'tabelaEmbarcacoes/create',
                //'admin/embarcacoes/tabela/editar' => 'tabelaEmbarcacoes/update',
                'admin/tabelaEmbarcacoes' => 'tabelaEmbarcacoes/admin', 
                'admin/cadTabela' => 'tabelaEmbarcacoes/create',
                'institucional' => 'site/institucional/institucional',
                'por-que-anunciar' => 'site/porQueAnunciar',
                'como-anunciar-site' => 'site/comoAnunciarSite/como-anunciar-site',
                'planos' => 'site/planos/planos',
                'bom-marinheiro' => 'site/bomMarinheiro/bom-marinheiro',
                'contato' => 'site/contato/contato',

                'comunidade/primeiro-barco' => 'conteudos/primeirobarco',
                'comunidade/primeiro-barco/busca/<busca>' => 'conteudos/primeirobarco',
                'comunidade/primeiro-barco/busca/<busca>/<slug>' => 'conteudos/primeirobarcodetalhe',
                'comunidade/primeiro-barco/<slug>' => 'conteudos/primeirobarcodetalhe',

                'tabela' => 'tabelaEmbarcacoes/index',
                'tabela-bombarco' => 'tabelaEmbarcacoes/index',
                'tabela/<marca>/<modelo>/<ano>' => 'tabelaEmbarcacoes/index',
                'tabela/<marca>/<modelo>' => 'tabelaEmbarcacoes/index',
                'tabela/<marca>' => 'tabelaEmbarcacoes/index',
                'comunidade/tabela-bombarco' => 'tabelaEmbarcacoes/index',

                /*UPDATE TABELA AQUI @@'comunidade/tabela-bombarco' => 'tabelaembarcacoes/index',
                'comunidade/tabela-bombarco' => 'tabelaEmbarcacoes/index',
                'comunidade/tabela-bombarco/busca' => 'tabelaembarcacoes/busca',
                'comunidade/tabela-bombarco/busca' => 'tabelaEmbarcacoes/busca',
                'comunidade/tabela-bombarco/busca/<busca>/<slug>' => 'tabelaembarcacoes/view',
                'comunidade/tabela-bombarco/<slug>' => 'tabelaembarcacoes/view',*/


                /*'comunidade/teste-bombarco' => 'conteudos/testebombarco',
                'comunidade/teste-bombarco/busca/<busca>/*' => 'conteudos/testebombarco',
                'comunidade/teste-bombarco/<macro>' => 'conteudos/testebombarco',
                'comunidade/teste-bombarco/<macro>/busca/<busca>/*' => 'conteudos/testebombarco',*/

                //'comunidade/teste-bombarco' => 'conteudos/testebombarco',
                'comunidade/raio-x' => 'conteudos/testebombarco',
                'raio-x' => 'conteudos/testebombarco',
                'comunidade/teste-bombarco' => 'conteudos/testebombarco',

                /*'comunidade/agenda' => 'agendas/index',
                'comunidade/agenda/<slug>' => 'agendas/view',
                'comunidade/agenda/busca/<busca>/<slug>' => 'agendas/view',*/

                'comunidade/blog' => 'conteudos/blog',
                'comunidade/blog/busca/<busca>' => 'conteudos/blog',
                'comunidade/blog/<categoria>' => 'conteudos/blog',
                'comunidade/blog/<categoria>/busca/<busca>' => 'conteudos/blog',
                'comunidade/blog/<categoria>/<slug>' => 'conteudos/blogdetalhe',

                'comunidade/noticias' => 'conteudos/noticias',
                'comunidade/noticias/<slug>' => 'conteudos/noticiadetalhe',
                'comunidade/noticias/busca/<busca>' => 'conteudos/noticias',
                'noticias<rest:.*>' => 'conteudos/noticias',
                'materias<rest:.*>' => 'conteudos/noticias',
                'eventos<rest:.*>' => 'conteudos/noticias',
                'marinheiro_primeira_viagem<rest:.*>' => 'site/index',
                'fotos<rest:.*>' => 'conteudos/noticias',
                'agenda<rest:.*>' => 'conteudos/noticias',
                'embarcacoes/exibir<rest:.*>' => 'embarcacoes/busca/macro/2',
                'embarcacoes/filtrar<rest:.*>' => 'embarcacoes/busca/macro/2',
                'novas_embarcacoes<rest:.*>' => 'embarcacoes/busca/macro/2',

                'financiamento-lancha-veleiro-jetski' => 'site/parceiroFinanciamento',
                'financiamento' => 'site/parceiroFinanciamento',
                'consorcio' => 'site/parceiroConsorcio',
                'transporte' => 'site/parceiroTransporte',
                'transporte-de-lancha-veleiro-jetski' => 'site/parceiroTransporte',
                'consorcio-lancha-veleiro-jetski' => 'site/parceiroConsorcio',
                'preco-de-marina' => 'site/parceiroMarina',
                'plataforma-subergivel' => 'site/parceiroSubergivel',
                'subergivel' => 'site/parceiroSubergivel',
                'plataforma-submergivel-lancha' => 'site/parceiroSubergivel',
                'jetsurf' => 'site/parceiroJetsurf',
                'pranchamotorizada' => 'site/parceiroJetsurf',
                'arrais-mestre-capitao-amador' => 'site/parceiroArrais',
                'jettdeck' => 'site/parceiroJettdeck',
                'aluguel-de-lancha-barco-veleiro' => 'site/parceiroAluguel',

                //'seguro' => 'site/parceiroSeguro',
                //'seguro-nautico' => 'site/parceiroSeguro',

                'sitemap.xml'=>'sitemap/sitemapxml',
                'sitemap-estaleiros.xml'=>'sitemap/sitemap_estaleiros_xml',
                'sitemap-empresas.xml'=>'sitemap/sitemap_empresas_xml',
                'sitemap-lanchas.xml'=>'sitemap/sitemap_lanchas_xml',
                'sitemap-veleiros.xml'=>'sitemap/sitemap_veleiros_xml',
                'sitemap-jetskis.xml'=>'sitemap/sitemap_jetskis_xml',
                'sitemap-pesca.xml'=>'sitemap/sitemap_pesca_xml',
                'sitemap-images.xml'=>'sitemap/sitemap_images_xml',
                'sitemap-images-empresas.xml'=>'sitemap/sitemap_images_empresas_xml',
                'sitemap-images-conteudo.xml'=>'sitemap/sitemap_images_conteudo_xml',

                /* zeromilhas */
                'catalogo/<slug>' => 'zeromilhas/catalogo',
                'catalogo' => 'zeromilhas/index',
                'catalogo/categoria/<slug>' => 'zeromilhas/buscaCategoria',
                'catalogo/<slug_marca>/<slug_modelo>' => 'zeromilhas/detalhe',
                'dashboard' => 'zeromilhas/dashboard',
                //'planosParaMotor' => 'zeromilhas/planosParaMotor',
                //'anunciarMotor' => 'zeromilhas/anunciarMotor',
                'planosParaMotor' => 'motorAnuncio/planosParaMotor',
                'anunciarMotor' => 'motorAnuncio/anunciarMotor',
                'previewMotor' => 'motorAnuncio/previewMotor',
                /* fim zeromilhas */








                /* guia capitão */
                #'guia'=>'guiaCapitao/create',
            ),
        ),


        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType'=>'smtp',
            'logging' => true,
            'dryRun' => false,
            'transportOptions'=>array(
                //'host'=>'md-6.webhostbox.net',
                'host'=>'####################',
                'username'=>'########################',
                'password'=>'#######################',
                'port'=>'465',
                'encryption'=>'ssl'
            ),
            'viewPath' => 'application.views.maillings',
        ),


        'EJSUrlManager' => array(
           'class' => 'ext.JSUrlManager.src.EJSUrlManager'
        ),

        /*'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),*/
        // uncomment the following to use a MySQL database

        'db'=>array(
            'class'=>'CDbConnection',
            'connectionString' => '#############################',
            'emulatePrepare' => true,
            'username' => '###########################',
            //'username' => 'root',
            'password' => '###################',
            //'password' => 'super',
            'charset' => 'utf8',
            'enableParamLogging'=>true,
            'enableProfiling'=>true,
        ),

        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),

        /*'log'=>array( 
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                
                array(
                    'class'=>'CWebLogRoute',
                ),
                
            ),
        ),*/


    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'atendimento@bombarco.com.br',
        'bombarcoAtendimento'=>'atendimento@bombarco.com.br',
        'parceiroFinanciamento'=>'financiamento@bombarco.com.br',
        'parceiroConsorcio'=>'consorcio@bombarco.com.br',
    ),
);
