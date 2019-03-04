<?php if (strpos($_SERVER["REQUEST_URI"], "/admin") === false) {?>
<!--Start header-->
<header class="header">
<?php }?>
    <!--Start AD-->


        <?php
$macro = null;

// Fazendo verificação da Macro
// a partir da URL
$url = Yii::app()->request->url;
if (strpos($url, "lancha") !== false) { // Se tiver "lancha" na URL
    $macro = EmbarcacaoMacros::$macro_by_slug['lancha'];
} else if (strpos($url, "veleiro") !== false) { // Se tiver "veleiro" na URL
    $macro = EmbarcacaoMacros::$macro_by_slug['veleiro'];
} else if (strpos($url, "jet-ski") !== false) { // Se tiver "jet-ski" na URL
    $macro = EmbarcacaoMacros::$macro_by_slug['jetski'];
} else if (strpos($url, "barcos-pesca") !== false) { // Se tiver "jet-ski" na URL
    $macro = EmbarcacaoMacros::$macro_by_slug['barcos-pesca'];
}

$banner = Banners::loadBanner(Banners::TOPO, $macro, array('width' => 1024, 'height' => 70), true);
?>

        <?php if (!empty($banner) && strpos($_SERVER["REQUEST_URI"], "/admin") === false): ?>
            <section class="advertise-head" style="position:relative;">
                <div class="container">
                    <?php echo $banner; ?>
                </div>
            </section>
        <?php endif?>


    <!--End AD-->
    <?php if (strpos($_SERVER["REQUEST_URI"], "/admin") === false) {?>
    <nav class="menu-head">
        <div class="container">

          <div class="menuDesktop">

          <!--Start do Menu-->
          <ul class="head-links">
              <li class="li-dropdown">
                  <h3><a class="icon-after two-lines" style="line-height:16px">Classificados</a></h3>
                  <ul class="head-links_sub" >
                      <li><h3><a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda'); ?>">Lanchas</a></h3></li>
                      <li><h3><a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda'); ?>">Veleiros</a></h3></li>
                      <li><h3><a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda'); ?>">Jet SKis</a></h3></li>
                      <li><h3><a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda'); ?>">Barcos de Pesca</a></h3></li>
                      <li><h3><a href="<?php echo Yii::app()->createUrl('motores'); ?>">Motores</a></h3></li>
                  </ul>
              </li>
              <li>
                  <h3><a href="<?php echo Yii::app()->createUrl('catalogo'); ?>" style="display: inline; padding: 12px;">zero milhas</a></h3>
              </li>
              <li>
                  <h3><a href="http://guiadocapitao.com.br/" target="_blank" style="display: inline; padding: 12px;">Guia do Capitão</a></h3>
              </li>
              <li class="li-dropdown" style="margin-top:-4px">
                  <h4><a class="icon-after community">Comunidade</a></h4>
                  <ul class="head-links_sub" >
                      <li><h4><a href="<?php echo Yii::app()->createUrl('comunidade/raio-x'); ?>">Raio X</a></h4></li>

                      <li><a href="<?php echo Yii::app()->createUrl('tabela'); ?>">Tabela Bombarco</a></li>

                      <li><h4><a href="<?php echo Yii::app()->createUrl('comunidade/noticias'); ?>">Notícias</a></h4></li>
                      <li><h4><a href="<?php echo Yii::app()->createUrl('comunidade/primeiro-barco'); ?>">Primeiro Barco</a></h4></li>
                      <li><h4><a href="<?php echo Yii::app()->createUrl('comunidade/blog'); ?>">Blog</a></h4></li>
                      <?php /* ?><li><h4><a href="<?php echo Yii::app()->createUrl('comunidade/agenda'); ?>">Agenda</a></h4></li><?php */?>
                  </ul>
              </li>
              <li class="li-dropdown">
                  <h3><a class="icon-after one-line about" >Sobre</a><h3>
                  <ul class="head-links_sub last-drop">
                      <li><h3><a class="btn-li-inst" data-ancora="institucional-btn" href="<?php echo Yii::app()->createUrl('institucional'); ?>">Institucional</a></h3></li>
                      <li><h3><a class="btn-li-inst" data-ancora="pq-anunciar-btn" href="<?php echo Yii::app()->createUrl('por-que-anunciar'); ?>">Porque Anunciar</a></h3></li>
                      <li><h3><a class="btn-li-inst" data-ancora="como-anunciar-btn" href="<?php echo Yii::app()->createUrl('como-anunciar-site'); ?>">Como Anunciar</a></h3></li>
                      <!--<li><h3><a class="btn-li-inst" data-ancora="planos-btn" href="<?php //echo Yii::app()->createUrl('planos'); ?>">Planos</a></h3></li>-->
                      <li><h3><a class="btn-li-inst" data-ancora="bom-marinheiro-btn" href="<?php echo Yii::app()->createUrl('bom-marinheiro'); ?>">Bom Marinheiro</a></h3></li>
                      <li><h3><a class="btn-li-inst" data-ancora="contato-btn" href="<?php echo Yii::app()->createUrl('contato'); ?>">Contato</a></h3></li>
                  </ul>
              </li>
              <li class="account">

                  <?php if (!Yii::app()->user->isGuest): ?>
                  <i class="icon"></i>
                  <ul class="sub-account">
                      <?php if (Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()): ?>
                        <li class="li-minha-conta"><a data-link="perfil" title="Admin" href="<?php echo Yii::app()->createUrl('admin'); ?>">Admin</a></li>
                        <li class="li-minha-conta"><a data-link="perfil" title="Minha Conta" href="<?php echo Yii::app()->createUrl('usuarios/update/' . Yii::app()->user->Id . '?active=perfil'); ?>">Minha Conta</a></li>
                      <?php else: ?>
                      <li class="li-minha-conta"><a data-link="perfil" title="Minha Conta" href="<?php echo Yii::app()->createUrl('usuarios/update/' . Yii::app()->user->Id . '?active=perfil'); ?>">Minha Conta</a></li>
                      <?php endif;?>
                      <li class="li-minha-conta"><a title="Minha Conta" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Log out</a></li>
                  </ul>
                  <?php else: ?>
                      <!-- <a title="Minha Conta" href="<?php echo Yii::app()->createUrl('login'); ?>"><i class="icon"></i></a> -->
                      <i class="icon"></i>
                      <ul class="sub-account">
                          <li class="li-minha-conta"><a title="Minha Conta" href="<?php echo Yii::app()->createUrl('login'); ?>">Login / Cadastro</a></li>
                          <!-- <li class="li-minha-conta"><a title="Minha Conta" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Log out</a></li> -->
                      </ul>
                  <?php endif;?>
              </li>
              <li class="advise">

                  <a href="<?php echo Yii::app()->createUrl('anunciar'); ?>" onclick="_gaq.push(['_trackEvent', 'Home', 'click', 'Anunciar-topo']);adwords_conversor('ISlSCJb7iVkQkLPC4wM');">
                      Anunciar
                  </a>
              </li>
          </ul>
          <!--End Menu-->
          </div>
            <!--Start Logo-->
            <div class="bombarco">
                <a href="<?php echo Yii::app()->homeUrl; ?>" alt="BomBarco" title="Bombarco" rel="home">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/bombarco.png" height="37px" width="231px" alt="Bombarco">
                </a>
            </div>
            <!--End Logo-->
          <div class="menuMobile">
            <a href="#" class="fa fa-bars"></a>
            <ul>
              <li class="li-dropdown">
                <a class="icon-after two-lines" style="line-height:16px">Classificados</a>
                <ul class="head-links_sub">
                  <li><a href="/embarcacoes/lanchas-a-venda">Lanchas</a></li>
                  <li><a href="/embarcacoes/veleiros-a-venda">Veleiros</a></li>
                  <li><a href="/embarcacoes/jet-skis-a-venda">Jet Skis</a></li>
                  <li><a href="/embarcacoes/barcos-pesca-a-venda">Barcos de Pesca</a></li>
                  <li><a href="/motores">Motores</a></li>
                </ul>
              </li>
              <li>
                <a href="/catalogo" style="display: inline; padding: 12px;">Zeromilhas</a>
              </li>
              <li>
                <a href="http://guiadocapitao.com.br/" target="_blank" style="display: inline; padding: 12px;">Guia do Capitão</a>
              </li>
              <li class="li-dropdown" style="margin-top:-4px">
                <a class="icon-after community">Comunidade</a>
                <ul class="head-links_sub">
                  <li><a href="/comunidade/raio-x">Raio X</a></li>
                  <li><a href="/tabela">Tabela Bombarco</a></li>
                  <li><a href="/comunidade/noticias">Notícias</a></li>
                  <li><a href="/comunidade/primeiro-barco">Primeiro Barco</a></li>
                  <li><a href="/comunidade/blog">Blog</a></li>
                </ul>
              </li>
              <li class="li-dropdown">
                <a class="icon-after one-line about">Sobre</a>
                <ul class="head-links_sub last-drop">
                  <li><a class="btn-li-inst" data-ancora="institucional-btn" href="/institucional">Institucional</a></li>
                  <li><a class="btn-li-inst" data-ancora="pq-anunciar-btn" href="/por-que-anunciar">Porque Anunciar</a></li>
                  <li><a class="btn-li-inst" data-ancora="como-anunciar-btn" href="/como-anunciar-site">Como Anunciar</a></li>
                  <!--<li><a class="btn-li-inst" data-ancora="planos-btn" href="/planos">Planos</a></li>-->
                  <li><a class="btn-li-inst" data-ancora="bom-marinheiro-btn" href="/bom-marinheiro">Bom Marinheiro</a></li>
                  <li><a class="btn-li-inst" data-ancora="contato-btn" href="/contato">Contato</a></li>
                </ul>
              </li>
              <?php if (!Yii::app()->user->isGuest): ?>
                <?php if (Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()): ?>
                <li class="li-minha-conta"><a data-link="perfil" title="Admin" href="<?php echo Yii::app()->createUrl('admin'); ?>">Admin</a></li>
                <li class="li-minha-conta"><a data-link="perfil" title="Minha Conta" href="<?php echo Yii::app()->createUrl('usuarios/update/' . Yii::app()->user->Id . '?active=perfil'); ?>">Minha Conta</a></li>
                <?php else: ?>
                <li class="li-minha-conta"><a data-link="perfil" title="Minha Conta" href="<?php echo Yii::app()->createUrl('usuarios/update/' . Yii::app()->user->Id . '?active=perfil'); ?>">Minha Conta</a></li>
                <?php endif;?>
                <li class="li-minha-conta"><a title="Minha Conta" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Log out</a></li>
              <?php else: ?>
                <!-- <a title="Minha Conta" href="<?php echo Yii::app()->createUrl('login'); ?>"><i class="icon"></i></a> -->
                <li class="li-minha-conta"><a title="Minha Conta" href="<?php echo Yii::app()->createUrl('login'); ?>">Login</a></li>
              <?php endif;?>
            </ul>
          </div>
        </div>
    </nav>

  </header>
  <?php } else {?>

    <?php if(Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()): ?>
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a href="#" class="fa fa-bars openMenu" data-toggle="collapse" data-target=".navbar-ex1-collapse"></a>

                               <span class="navbar-text" style="float:right !important;">
    Olá, <?php echo Yii::app()->user->name; ?>
  </span>
        </div>
       <!-- <ul class="nav navbar-right top-nav">
          <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i></b></a>
          </li>
        </ul>-->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#compras">
                Compras com cartão <i class="fa fa-fw fa-caret-down"></i>
              </a>
            <ul id="compras" class="collapse">
            <li>
                <a href="<?php echo Yii::app()->createUrl('admin/turbinadas'); ?>">
                  Compras de turbinadas
                </a>
              </li>
              <li>
                <a href="<?php echo Yii::app()->createUrl('admin/compras_planos'); ?>">
                  Compras de planos
                </a>
              </li>

            </ul>

            <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#compra-boleto">
                Compras com boleto <i class="fa fa-fw fa-caret-down"></i>
              </a>
            <ul id="compra-boleto" class="collapse">
            <li>
                <a href="<?php echo Yii::app()->createUrl('admin/turbinadasBoleto'); ?>">
                  Compras de turbinadas
                </a>
              </li>
              <li>
                <a href="<?php echo Yii::app()->createUrl('admin/compras_planos_boleto'); ?>">
                  Compras de planos
                </a>
              </li>

            </ul>

            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#embarcacao">
                Embarcações <i class="fa fa-fw fa-caret-down"></i>
              </a>
              <ul id="embarcacao" class="collapse">
                <li>
                  <a href="<?php echo Yii::app()->createUrl('embarcacoes/adminAnunciosParaValidar'); ?>">
                    Anúncios Para Validar
                  </a>
                </li>
                <li>
                  <a href="<?php echo Yii::app()->createUrl('embarcacoes/adminGeral'); ?>">
                    Todos os Anúncios
                  </a>
                </li>
                <li>
                  <a href="<?php echo Yii::app()->createUrl('embarcacaoFabricantes/admin'); ?>">
                    <span>Fabricantes</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo Yii::app()->createUrl('embarcacaoModelos/admin'); ?>">
                    <span>Modelos</span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo Yii::app()->createUrl('embarcacaoTipos/admin'); ?>">
                    <span>Tipos de Embarcações</span>
                  </a>
                </li>
                <li class="last">
                  <a href="<?php echo Yii::app()->createUrl('tabelaEmbarcacoes/admin'); ?>">
                    <span>Tabela Bombarco</span>
                  </a>
                </li>
              </ul>
            </li>
            <!--<li>
              <a href="javascript:;" data-toggle="collapse" data-target="#empresas">
                Empresas <i class="fa fa-fw fa-caret-down"></i>
              </a>
              <ul id="empresas" class="collapse">
                <li><a href="<?php //echo Yii::app()->createUrl('empresas/admin'); ?>"><span>Todos os Anúncios</span></a></li>
                <li><a href="<?php //echo Yii::app()->createUrl('admin/empresas/anuncios-pagos'); ?>"><span>Anúncios Pagos</span></a></li>
                <li class="last"><a href="<?php //echo Yii::app()->createUrl('admin/empresas/tipos') ?>"><span>Categorias</span></a></li>
              </ul>
            </li>-->
            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#estaleiros">
                Marcas <i class="fa fa-fw fa-caret-down"></i>
              </a>
              <ul id="estaleiros" class="collapse">
                <li><a href="<?php echo Yii::app()->createUrl('admin/estaleiros'); ?>"><span>Gerenciar Marcas</span></a></li>
                <li><a href="<?php echo Yii::app()->createUrl('empresas/createEstaleiro'); ?>"><span>Cadastrar Marca</span></a></li>
                <li class="last"><a href="<?php echo Yii::app()->createUrl('admin/estaleiros/embarcacoes'); ?>"><span>Embarcações</span></a></li>
              </ul>
            </li>
            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#comunidade" aria-expanded="false">
                Comunidade <i class="fa fa-fw fa-caret-down"></i>
              </a>
              <ul id="comunidade" class="collapse">
                <li><a href="<?php echo Yii::app()->createUrl('admin/comunidade'); ?>"><span>Gerenciar</span></a></li>
                <!--<li><a href="<?php //echo Yii::app()->createUrl('admin/comunidade/categorias'); ?>"><span>Categorias</span></a></li>
                <li class="last"><a href="<?php //echo Yii::app()->createUrl('admin/comunidade/agendas'); ?>"><span>Agendas</span></a></li>-->
              </ul>
            </li>
            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#motores" aria-expanded="false">
                Motores <i class="fa fa-fw fa-caret-down"></i>
              </a>
              <ul id="motores" class="collapse">
                <li><a href="https://www.bombarco.com.br/admin/motores"><span>Todos os anúncios</span></a></li>
                <li><a href="https://www.bombarco.com.br/admin/aprovarMotores"><span>Aprovar anúncios</span></a></li>
                <li><a href="<?php echo Yii::app()->createUrl('admin/motores'); ?>"><span>Modelos</span></a></li>
                <li><a href="<?php echo Yii::app()->createUrl('admin/motores/fabricantes'); ?>"><span>Fabricantes</span></a></li>
                <li class="last"><a href="/admin/motores/tipos"><span>Tipos</span></a></li>
              </ul>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('admin/relatorioGeralDeEmails'); ?>"><span>Relatório de Emails</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('admin/vendas'); ?>"><span>Relatório de Vendas</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('admin'); ?>"><span>Log de acessos</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('admin/seo'); ?>"><span>Ferramenta SEO</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('admin/bombarcoshop'); ?>"><span>Bombarcoshop</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('admin/acessorios'); ?>"><span>Acessórios</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('admin/usuarios'); ?>"><span>Usuários</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('admin/banners'); ?> "><span>Banners</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('site/index'); ?>"><span>Ver site</span></a>
            </li>
            <li>
              <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>"><span>Logout</span></a>
            </li>
          </ul>
        </div><!-- mainmenu -->
      </nav>
    <?php endif;?>
    
  <?php }?>
