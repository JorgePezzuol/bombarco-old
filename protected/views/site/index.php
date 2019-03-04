<section class="content">
<?php echo $this->renderPartial('//layouts/_busca');  ?>
<section class="advertise-home">
<div class="container">
<div class="advertise-home_banner" style="text-align:left">
<span class="title">Publicidade</span>
<?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width'=>728, 'height'=>90), true); ?>
</div>
</div>
</section>
<section class="links-categories boxes-home">
<div class="container">
<span class="title">Navegue pelas principais categorias do Bombarco</span>
<span class="sub-title">
No Bombarco você pode acompanhar os melhores <br>
anúncios de embarcações e produtos náuticos do Brasil.
</span>
<ul class="categories">
<li class="category">
<a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda') ?>" class="ax-track-event" data-ax-trackname="home navegue - barcos pesca">
<img alt="pesca" class="bg-img" id="capa" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/pesca.png"/>
<span class="table">
<span class="texts">
<h5 class="name">Barcos<br>de pesca</h5>
<span class="description">
Uma sessão inteira<br>
pra você que está planejando<br>
comprar ou trocar seu<br>
barco de pesca.
</span>
</span>
</span>
</a>
</li>
<li class="category">
<a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda/busca/tipos/cabinada') ?>" class="ax-track-event" data-ax-trackname="home navegue - lanchas cabinadas">
<img alt="cabinada" class="bg-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/cabinada.png"/>
<span class="table">
<span class="texts">
<h5 class="name">Lanchas<br>cabinadas</h5>
<span class="description">
Uma sessão inteira<br>
pra você que está planejando<br>
comprar ou trocar sua<br>
lancha cabinada.
</span>
</span>
</span>
</a>
</li>
<li class="category">
<a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda/busca/tipos/offshore') ?>" class="ax-track-event" data-ax-trackname="home navegue - lanchas offshore">
<img alt="offshore" class="bg-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/offshore.png"/>
<span class="table">
<span class="texts">
<h5 class="name">Lanchas<br>offshore</h5>
<span class="description">
Uma sessão inteira<br>
pra você que está planejando<br>
comprar ou trocar sua<br>
lancha offshore.
</span>
</span>
</span>
</a>
</li>
</ul>
</div>
</section>
<section class="links-comunidade boxes-home">
<div class="container">
<span class="title">Comunidade</span>
<span class="sub-title">
Aqui você encontra, em primeira mão, as notícias <br />
do mercado náutico e muitas dicas!
</span>
<ul class="categories">
<li class="category">
<a href="<?php echo Yii::app()->createUrl('comunidade/primeiro-barco'); ?>" class="ax-track-event" data-ax-trackname="home comunidade - primeiro barco">
<img alt="primeiro-barco" class="bg-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/primeiro-barco.jpg"/>
<span class="table">
<span class="texts">
<h4 class="name">Primeiro<br>Barco</h4>
<span class="description">
Dicas dos especialistas<br>
para os marinheiros<br>
de primeira viagem.
</span>
</span>
</span>
</a>
</li>
<li class="category col-2">
<a href="<?php echo Yii::app()->createUrl('comunidade/tabela-bombarco'); ?>" class="ax-track-event" data-ax-trackname="home comunidade - tabela bombarco">
<img alt="tabela-bombarco" class="bg-img" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/tabela-bombarco.jpg"/>
<span class="table">
<span class="texts">
<h4 class="name">Tabela BomBarco</h4>
<span class="description">
Busque para achar o preço<br>
da embarcação desejada!
</span>
</span>
</span>
</a>
</li>
</ul>
</div>
</section>
<section class="spotlight-banner">
<div class="container container-controls">
<span class="controls stop-video-too">
<a class="prev">
<i class="icon"></i>
<span class="title-next"></span>
</a>
<a class="next">
<i class="icon"></i>
<span class="title-next"></span>
</a>
</span>
</div>
<ul class="slider">
<?php foreach ($videos as $key => $value): ?>
<?php if(isset($value->conteudoImagens[0]) && $value->conteudoImagens[0] != null): ?>
<li class="slide" style="background-image:url(<?php echo Conteudos::getThumbRaioX($value, 1349, 557); ?>)">
<?php else: ?>
<li class="slide">
<?php endif ;?>
<input class="video-url" type="hidden" value="//www.youtube-nocookie.com/embed/<?php echo Utils::getYoutubeID($value->video); ?>?autoplay=1&enablejsapi=1&version=3&hd=1&playerapiid=ytplayer&autohide=1&showinfo=0" />
<div class="video-theater">
<a href="#" class="close-video">x</a>
</div>
<div class="container content-slide">
<h4 class="type">Raio X</h4>
<span class="title"><?php echo $value->titulo; ?></span>
<a class="icon-play" id="icon-video-home-1"><i class="icon"></i></a>
<a class="more-types ax-track-event" data-ax-trackname="raio x home - ver todos" href="<?php echo Yii::app()->createUrl('comunidade/teste-bombarco'); ?>">Ver todos os testes</a>
</div>
</li>
<?php endforeach ?>
</ul>
</section>
<section class="tidings">
<div class="container">
<div class="timeline">
<h6 class="title">Últimas Notícias</h6>
<a href="<?php echo Yii::app()->createUrl('comunidade/noticias'); ?>" class="more-news ax-track-event" data-ax-trackname="ultimas noticias - ver todas">Ver todas</a>
<ul class="news-list">
<?php foreach ($noticias as $key => $value): ?>
<li class="news-item">
<a href="<?php echo Conteudos::mountUrl($value); ?>">
<span class="img-post">
<?php echo Conteudos::getThumbIndex($value, array('class'=>'bg-img-nt', 'width'=>200, 'height'=>120), false); ?>
</span>
<span class="texts">
<span class="date"><?php echo $value->data; ?></span>
<span class="link-post"><?php echo $value->titulo; ?></span>
</span>
</a>
</li>
<?php endforeach ?>
</ul>
</div>
<aside class="advertise-sidebar">
<span class="title">Publicidade</span>
<?php echo Banners::loadBanner(Banners::LATERAL, null, array('width'=>200, 'height'=>446), true); ?>
</aside>
</div>
</section>
</section>