
<header class="header">
  <section class="advertise-head">
    <div class="container">
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
                    <?php echo $banner; ?>
        <?php endif?>

        <a href="#" class="close-ad">
          <i class="icon"></i>
        </a>
      </div>
    </section>
    <nav class="menu-head">
      <div class="container">
        <div class="menuDesktop">
          <ul class="head-links">
            <li class="li-dropdown">
              <h3>
                <a class="icon-after two-lines" style="line-height: 16px;">Classificados</a>
              </h3>
              <ul class="head-links_sub" style="
display: block;
">
                <li>
                  <h3>
                    <a href="/embarcacoes/lanchas-a-venda">Lanchas</a>
                  </h3>
                </li>
                <li>
                  <h3>
                    <a href="/embarcacoes/veleiros-a-venda">Veleiros</a>
                  </h3>
                </li>
                <li>
                  <h3>
                    <a href="/embarcacoes/jet-skis-a-venda">Jet SKis</a>
                  </h3>
                </li>
                <li>
                  <h3>
                    <a href="/embarcacoes/barcos-pesca-a-venda">Barcos de Pesca</a>
                  </h3>
                </li>
              </ul>
            </li>
            <li>
              <h3>
                <a href="/catalogo" style="display: inline; padding: 12px;">zero milhas</a>
              </h3>
            </li>
            <li>
              <h3>
                <a href="http://guiadocapitao.com.br/" target="_blank" style="display: inline; padding: 12px;">Guia do Capitão</a>
              </h3>
            </li>
            <li class="li-dropdown" style="margin-top: -4px;">
              <h4>
                <a class="icon-after community">Comunidade</a>
              </h4>
              <ul class="head-links_sub">
                <li>
                  <h4>
                    <a href="/comunidade/raio-x">Raio X</a>
                  </h4>
                </li>
                <li>
                  <a href="/tabela">Tabela Bombarco</a>
                </li>
                <li>
                  <h4>
                    <a href="/comunidade/noticias">Notícias</a>
                  </h4>
                </li>
                <li>
                  <h4>
                    <a href="/comunidade/primeiro-barco">Primeiro Barco</a>
                  </h4>
                </li>
                <li>
                  <h4>
                    <a href="/comunidade/blog">Blog</a>
                  </h4>
                </li>
              </ul>
            </li>
            <li class="li-dropdown">
              <h3>
                <a class="icon-after one-line about">Sobre</a>
              </h3>
              <h3>
                <ul class="head-links_sub last-drop">
                  <li>
                    <h3>
                      <a data-ancora="institucional-btn" href="/institucional" class="btn-li-inst">Institucional</a>
                    </h3>
                  </li>
                  <li>
                    <h3>
                      <a data-ancora="pq-anunciar-btn" href="/por-que-anunciar" class="btn-li-inst">Porque Anunciar</a>
                    </h3>
                  </li>
                  <li>
                    <h3>
                      <a data-ancora="como-anunciar-btn" href="/como-anunciar-site" class="btn-li-inst">Como Anunciar</a>
                    </h3>
                  </li>
                  <li>
                    <h3>
                      <a data-ancora="planos-btn" href="/planos" class="btn-li-inst">Planos</a>
                    </h3>
                  </li>
                  <li>
                    <h3>
                      <a data-ancora="bom-marinheiro-btn" href="/bom-marinheiro" class="btn-li-inst">Bom Marinheiro</a>
                    </h3>
                  </li>
                  <li>
                    <h3>
                      <a data-ancora="contato-btn" href="/contato" class="btn-li-inst">Contato</a>
                    </h3>
                  </li>
                </ul>
              </h3>
            </li>



                  <?php if (!Yii::app()->user->isGuest): ?>
                        <?php if (Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()): ?>
                            <li class="account">
                                <i class="icon"></i>
                                <ul class="sub-account">
                                    <li class="link-do-menu li-minha-conta">
                                        <a title="Minha Conta" href="<?php echo Yii::app()->createUrl('admin'); ?>">Admin</a>
                                    </li>
                                    <li class="link-do-menu li-minha-conta">
                                        <a title="Minha Conta" href="<?php echo Yii::app()->createUrl('usuarios/update/' . Yii::app()->user->Id . '?active=perfil'); ?>">Minha Conta</a>
                                    </li>
                                    <li class="link-do-menu li-minha-conta">
                                      <a title="Minha Conta" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Log out</a>
                                    </li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="account">
                              <i class="icon"></i>
                              <ul class="sub-account">
                                <li class="link-do-menu li-minha-conta">
                                  <a title="Minha Conta" href="<?php echo Yii::app()->createUrl('usuarios/update/' . Yii::app()->user->Id . '?active=perfil'); ?>">Minha Conta</a>
                                </li>
                                                                    <li class="link-do-menu li-minha-conta">
                                      <a title="Minha Conta" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Log out</a>
                                    </li>
                              </ul>
                            </li>
                        <?php endif; ?>
                  <?php else: ?>
                        <li class="account">
                          <i class="icon"></i>
                          <ul class="sub-account">
                            <li class="li-minha-conta link-do-menu">
                              <a title="Minha Conta" href="/login">Login / Cadastro</a>
                            </li>
                          </ul>
                        </li>
                  <?php endif; ?>


           <!-- <li class="account">
              <i class="icon"></i>
              <ul class="sub-account">
                <li class="li-minha-conta">
                  <a title="Minha Conta" href="/login">Login / Cadastro</a>
                </li>
              </ul>
            </li>-->













            <li class="advise">
              <a href="/anunciar" onclick="_gaq.push(['_trackEvent', 'Home', 'click', 'Anunciar-topo']);adwords_conversor('ISlSCJb7iVkQkLPC4wM');">
  Anunciar
</a>
            </li>
          </ul>
        </div>
        <div class="bombarco">
          <a href="/" alt="BomBarco" title="Bombarco" rel="home">
            <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/logo_bombarco.png'?>" height="37px" width="231px" alt="Bombarco">
            </a>
          </div>
          <div class="menuMobile">
            <a href="#" class="fa fa-bars"></a>
            <ul>
              <li class="li-dropdown">
                <a class="icon-after two-lines" style="line-height: 16px;">Classificados</a>
                <ul class="head-links_sub">
                  <li>
                    <a href="/embarcacoes/lanchas-a-venda">Lanchas</a>
                  </li>
                  <li>
                    <a href="/embarcacoes/veleiros-a-venda">Veleiros</a>
                  </li>
                  <li>
                    <a href="/embarcacoes/jet-skis-a-venda">Jet Skis</a>
                  </li>
                  <li>
                    <a href="/embarcacoes/barcos-pesca-a-venda">Barcos de Pesca</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="/catalogo" style="display: inline; padding: 12px;">Catálogo</a>
              </li>
              <li>
                <a href="http://guiadocapitao.com.br/" target="_blank" style="display: inline; padding: 12px;">Guia do Capitão</a>
              </li>
              <li class="li-dropdown" style="margin-top: -4px;">
                <a class="icon-after community">Comunidade</a>
                <ul class="head-links_sub">
                  <li>
                    <a href="/comunidade/raio-x">Raio X</a>
                  </li>
                  <li>
                    <a href="/tabela">Tabela Bombarco</a>
                  </li>
                  <li>
                    <a href="/comunidade/noticias">Notícias</a>
                  </li>
                  <li>
                    <a href="/comunidade/primeiro-barco">Primeiro Barco</a>
                  </li>
                  <li>
                    <a href="/comunidade/blog">Blog</a>
                  </li>
                </ul>
              </li>
              <li class="li-dropdown">
                <a class="icon-after one-line about">Sobre</a>
                <ul class="head-links_sub last-drop">
                  <li>
                    <a data-ancora="institucional-btn" href="/institucional" class="btn-li-inst">Institucional</a>
                  </li>
                  <li>
                    <a data-ancora="pq-anunciar-btn" href="/por-que-anunciar" class="btn-li-inst">Porque Anunciar</a>
                  </li>
                  <li>
                    <a data-ancora="como-anunciar-btn" href="/como-anunciar-site" class="btn-li-inst">Como Anunciar</a>
                  </li>
                  <li>
                    <a data-ancora="planos-btn" href="/planos" class="btn-li-inst">Planos</a>
                  </li>
                  <li>
                    <a data-ancora="bom-marinheiro-btn" href="/bom-marinheiro" class="btn-li-inst">Bom Marinheiro</a>
                  </li>
                  <li>
                    <a data-ancora="contato-btn" href="/contato" class="btn-li-inst">Contato</a>
                  </li>
                </ul>
              </li>
              <li class="li-minha-conta">
                <a title="Minha Conta" href="/login">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
