<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<section id="estatisticas">
    <div class="estatisticas-line">
        <div class="container">
            <span class="estatisticas-title">Catálogo</span>
        </div>
    </div>
</section>

<section id="minha-conta-tabela">


    <section id="estatisticas">

        <div class="estatisticas-line">
            <div class="container">
                <span class="estatisticas-title">Minhas embarcações</span><br/>
                <a href="<?php echo Yii::app()->createUrl('anuncios/anunciarEmbarcacao?tipo_anuncio=estaleiro'); ?>" class="bt-action">Adicionar</a>
            </div>
        </div>
    </section>

    <div class="container">

      <?php
      $this->widget('zii.widgets.grid.CGridView', array(
          'id' => 'grid-minha-conta',
          'dataProvider' => $model->searchMinhasEmbarcsEstaleiro(),
          'filter' => $model,
          'columns' => array(
              'id',
              array(
                  'name' => 'embarcacao_macros_id',
                  'value' => '$data->embarcacaoModelos->embarcacaoFabricantes->embarcacaoMacros->titulo',
                  'filter' => GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true, 'id != 0')),
              ),
              array(
                  'header' => 'Marca',
                  'name' => 'embarcacao_fabricantes_id',
                  'value' => 'GxHtml::valueEx($data->embarcacaoFabricantes)',
                  'filter' => GxHtml::listDataEx(EmbarcacaoFabricantes::filtrarPelosMeusFabricantes(Yii::app()->user->id, 'anuncio')),
              ),
              array(
                  'name' => 'embarcacao_modelos_id',
                  'value' => 'GxHtml::valueEx($data->embarcacaoModelos)',
                  //'filter'=>GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true)),
                  'filter' => GxHtml::listDataEx(EmbarcacaoModelos::filtrarPelosMeusModelos(Yii::app()->user->id, 'anuncio')),
              ),
              array(
                  'name' => 'valor',
                  'value' => '($data->valor == "0.00") ? "Não informado" : "R$ ".Utils::formataValorView($data->valor)',
                  'filter' => CHtml::dropDownList('Embarcacoes[valor]', '', array(-1 => '', 0 => 'Ordenar por maior preço', 1 => 'Ordenar por menor preço')),
              ),
              array(
                  'header' => 'Cliques',
                  'name' => 'views',
                  'value' => '($data->views == 0) ? "Nenhuma visualização" : $data->views',
                  'filter' => CHtml::dropDownList('Embarcacoes[views]', '', array(-1 => '', 0 => 'Mais clicados', 1 => 'Menos clicados')),
              ),
              array(
                  'name' => 'status',
                  // 'htmlOptions' => '',
                  // 'value' => 'Anuncio::$_status_anuncio_by_number[$data->status]',
                  'value' => function($_status_anuncio_by_number) {
                      switch ($_status_anuncio_by_number->status) {
                          case 0:
                              echo '<span style="color:#999">Aguardando Pagamento</span>';
                              break;
                          case 1:
                              echo '<span style="color:#000">Aguardando Ativação</span>';
                              break;
                          case 2:
                              echo '<span style="color:#00918e">Ativado</span>';
                              break;
                          case 4:
                              echo '<span style="color:red">Vendido</span>';
                              break;
                          case 5:
                              echo '<span style="color:#fc0">Pausado</span>';
                              break;

                          default:
                              echo '<span style="color:red">Expirado</span>';
                              break;
                      }
                  },
                  'filter' => array(0 => 'Aguardando Pagamento', 1 => 'Aguardando Ativação', 2 => 'Ativado', 4 => 'Vendido', 5 => 'Pausado', 6 => 'Expirado'),
              ),
              array(
                  'class' => 'CButtonColumn',
                  'template' => '{view}{update}{vendido}  {pausar}  {despausar}',
                  'buttons' => array(
                      'view' => array(
                          //'url' => 'Empresas::mountUrl($data, Macros::$macro_by_slug["estaleiro"])',
                        'url' => 'Embarcacoes::mountUrl($data, Empresas::retornarNomePorEmbarc($data->id))',
                        
                      ),
                      'vendido' => array(
                          'visible' => '$data->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]',
                          'label' => "",
                          'url' => 'Yii::app()->createUrl("Embarcacoes/desativarOuPausarAnuncio", array("id"=>$data->id))',
                          'options' => array('id' => 'btn-ativar'),
                          'click' => "function() {
            if(!confirm('" . Yii::t('warnings', 'Ao clicar em desativar, significa que você não quer mais que seu anúncio apareça nas listas de buscas do BomBarco. Confirmar?') . "')) return false;
              $.ajax({
              type:'GET',
              url:$(this).attr('href'),
                success:function(resp) {

                  if(resp != '-1') {
                    alert('Sucesso ao realizar a operação');
                    location.reload();
                  }
                  else {
                    alert('Falha ao indicar que o anúncio foi vendido. Tente mais tarde.');
                  }
                }
              });
              return false;
            }",
                      ),
                      'pausar' => array(
                          'visible' => '$data->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]',
                          'label' => "",
                          'url' => 'Yii::app()->createUrl("Embarcacoes/desativarOuPausarAnuncio", array("id"=>$data->id))',
                          'options' => array('id' => 'btn-ativar'),
                          'click' => "function() {
            if(!confirm('" . Yii::t('warnings', 'Ao clicar em pausar, seu anúncio não aparecerá mais nos resultados de busca, mas é possível voltar a ativar o anúncio. Confirmar?') . "')) return false;
              $.ajax({
              type:'GET',
              data: {
                pausar: 1
              },
              url:$(this).attr('href'),
                success:function(resp) {


                  if(resp != '-1') {
                    alert('Sucesso ao realizar a operação');
                    location.reload();
                  }
                  else {
                    alert('Falha ao indicar que o anúncio foi vendido. Tente mais tarde.');
                  }
                }
              });
              return false;
            }",
                      ),
                      'despausar' => array(
                          'visible' => '$data->status == Anuncio::$_status_anuncio["ANUNCIO_PAUSADO"]',
                          'label' => " ",
                          'url' => 'Yii::app()->createUrl("Embarcacoes/desativarOuPausarAnuncio", array("id"=>$data->id))',
                          'options' => array('id' => 'btn-ativar'),
                          'click' => "function() {
            if(!confirm('" . Yii::t('warnings', 'Confirmar operação?') . "')) return false;
              $.ajax({
              type:'GET',
              data: {
                pausar: 2
              },
              url:$(this).attr('href'),
                success:function(resp) {

                  if(resp != '-1') {
                    alert('Sucesso ao realizar a operação');
                    location.reload();
                  }
                  else {
                    alert('Falha ao indicar que o anúncio foi vendido. Tente mais tarde.');
                  }
                }
              });
              return false;
            }",
                      ),
                      'update' => array(
                          'visible' => '$data->status != Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"] && $data->status != Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"]',
                      ),
                  ),
              ),
          ),
      ));
      ?>


</div>

<?php /* echo CHtml::resetButton('Resetar', array('id'=>'form-reset-button')); */ ?>
</section>

<script>
$(document).ready(function () {
$('#form-reset-button').click(function ()
{
    var id = 'grid-minha-conta';
    var inputSelector = '#' + id + ' .filters input, ' + '#' + id + ' .filters select';
    $(inputSelector).each(function (i, o) {
        $(o).val('');
    });
    var data = $.param($(inputSelector));
    $.fn.yiiGridView.update(id, {data: data});
    return false;
});
});
</script>
