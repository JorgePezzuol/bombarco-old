<style>
   /*input[type="text"],
   select.form-control {
   background: transparent;
   border: none;
   border-bottom: 1px solid #000000;
   -webkit-box-shadow: none;
   box-shadow: none;
   border-radius: 0;
   }
   input[type="text"]:focus,
   select.form-control:focus {
   -webkit-box-shadow: none;
   box-shadow: none;
   }*/
   .input_line, .input_line:focus {
   background: transparent;
   border: none;
   box-shadow: none;
   border-radius: 0;
   border-bottom: 1px solid #000000;
   }
   .textarea-td {
   background: transparent;
   border: none;
   box-shadow: none;
   border-radius: 0;
   width: 100% !important;
   height: 100% !important;
   }
   .form-control {
   height: 16px !important;
   }
   .col-md-2 {
   /*width: 10.666667% !important;*/
   }
   .col-md-1 {
   /*width: 2.333333% !important;*/
   }
   .col-md-2-custom {
   width: 10.66666667% !important;
   }
   label {
   white-space: nowrap;
   }
   pre {
   overflow: auto;
   -ms-word-wrap: normal;
   word-wrap: normal;
   overflow-wrap: normal;
   white-space: pre;
   max-height: 540px;
   }
</style>
<?php
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jSignature/jSignature.min.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.css');
   
?>

<!--[if lt IE 9]>
<script type="text/javascript" src="libs/flashcanvas.js"></script>
<![endif]-->
<div class="container">
    <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'contrato-form',
        'enableAjaxValidation' => false,
    ));
    ?>

   <div class="row">
      <div class="col-md-6">
         <a href="#" style="display:none;" id="anterior"><img class="pull-left img-responsive" src="/img/arrow_left_contrato.png?e=5"/></a>
      </div>
      <div class="col-md-6">
         <a href="#" id="proxima"><img class="pull-right img-responsive" src="/img/arrow_right_contrato.png"/></a>
      </div>
   </div>
   <br/>
   <div class="row">
      <div class="col-md-4">
         <img src="/themes/bombarco/img/bombarco.png" class="img-responsive" alt="Bombarco">     
      </div>
      <div class="col-md-4">
         <div class="form-inline">
            <label class="control-label">FICHA CADASTRAL nº</label>
            <?php echo $form->textField($model, 'num_contrato', array("value"=>Contrato::calcularNumContrato(), "class"=>"input-mini", "style"=>"width:33.33%; text-align:center;")); ?>
         </div>
         <br/>
         <div class="form-inline">

            <?php $model->flg_renovacao = '0';?>
            <?php echo $form->radioButtonList($model, 'flg_renovacao', array('1'=>'Renovação', '0'=>'1º Contrato'), array('labelOptions'=>array('display: inline; margin-right: 20px;'), 'separator' =>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')); ?>
         </div>
      </div>
      <div class="col-md-4">
         <span>e-mail: atendimento@bombarco.com.br</span><br/>
         <span>Tel.: (11) 4796-4062 / 2629-2170 / 9 6839-0408</span>      </div>
   </div>

   <br/><br/>
   <div id="campos">
      <div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom">
               <label class="control-label">Nome fantasia</label>
            </div>
            <div class="col-md-10" style="width: 87.666667% !important">
               <!--<input type="text" class="input_line form-control" name="Contrato[nome_fantasia]">-->
               <?php echo $form->textField($model, 'nome_fantasia', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom">
               <label class="control-label">Razão Social</label>
            </div>
            <div class="col-md-5">
               <?php echo $form->textField($model, 'razao_social', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-2" style="width: 13.66666667% !important;">
               <label class="control-label">Data da fundação</label>
            </div>
            <div class="col-md-3" style="width: 32.666667% !important;">
               <?php echo $form->textField($model, 'data_fundacao', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom">
               <label class="control-label">com sede na</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'rua', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1">
               <label class="control-label">número</label>
            </div>
            <div class="col-md-1">
               <?php echo $form->textField($model, 'numero', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 11.333333% !important;">
               <label class="control-label">Complemento</label>
            </div>
            <div class="col-md-1">
               <?php echo $form->textField($model, 'complemento', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">Bairro</label>
            </div>
            <div class="col-md-2" style="width: 21.666667% !important;">
               <?php echo $form->textField($model, 'bairro', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 5.666667% !important;">
               <label class="control-label">Cidade</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'cidade', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1">
               <label class="control-label">estado</label>
            </div>
            <div class="col-md-1">
               <?php echo $form->textField($model, 'estado', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">CEP</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'cep', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">CNPJ</label>
            </div>
            <div class="col-md-2" style="width: 24.666667% !important;">
               <?php echo $form->textField($model, 'cnpj', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 12.666667% !important;">
               <label class="control-label">Insc. Estadual nº</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'inscricao_estadual', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1">
               <label class="control-label">Telefone</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'telefone', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 4.333333% !important;">
               <label class="control-label">Site</label>
            </div>
            <div class="col-md-4" style="width: 40.333333%;">
               <?php echo $form->textField($model, 'site', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-6" style="width: 37.666667% !important;">
               <label class="control-label">Neste ato representada por seu representante legal</label>
            </div>
            <div class="col-md-6" style="width: 61.666667% !important;">
               <?php echo $form->textField($model, 'nome_representante_legal', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-1">
               <label class="control-label">Função</label>
            </div>
            <div class="col-md-4">
               <?php echo $form->textField($model, 'funcao_representante_legal', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1">
               <label class="control-label">CPF nº</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'cpf_representante_legal', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1">
               <label class="control-label">e RG nº</label>
            </div>
            <div class="col-md-2" style="width: 24.333333%;">
               <?php echo $form->textField($model, 'rg_representante_legal', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 10.666667% !important;">
               <label class="control-label">Data de nasc</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model,'data_nascimento_representante_legal', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 4.666667% !important;">
               <label class="control-label">Cel</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model,'cel_representante_legal', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 6.333333% !important;">
               <label class="control-label">E-mail</label>
            </div>
            <div class="col-md-4" style="width: 44.333333% !important;">
               <?php echo $form->textField($model,'email_representante_legal', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-3">
               <label class="control-label">E-mail para receber perguntas (site)</label>
            </div>
            <div class="col-md-8 " style="width: 74.666667% !important;">
               <?php echo $form->textField($model,'email_pergunta', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 14.666667% !important;">
               <label class="control-label">Resp. Financeiro</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model,'resp_financeiro_nome', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">E-mail</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model,'resp_financeiro_email', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 2.333333% !important;">
               <label class="control-label">Tel</label>
            </div>
            <div class="col-md-2" style="width: 26.666667% !important;">
               <?php echo $form->textField($model,'resp_financeiro_tel', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 14.666667% !important;">
               <label class="control-label">Resp. Anúncios</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model,'resp_anuncios_nome', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">E-mail</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model,'resp_anuncios_email', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 2.333333% !important;">
               <label class="control-label">Tel</label>
            </div>
            <div class="col-md-2" style="width: 26.666667% !important;">
               <?php echo $form->textField($model,'resp_anuncios_tel', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 14.666667% !important;">
               <label class="control-label">Resp. Peças</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model,'resp_pecas_nome', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">E-mail</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model,'resp_pecas_email', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 2.333333% !important;">
               <label class="control-label">Tel</label>
            </div>
            <div class="col-md-2" style="width: 26.666667% !important;">
               <?php echo $form->textField($model,'resp_pecas_tel', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/><br/>
      <div class="table-responsive">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>PLANO</th>
                  <th>DESCRIÇÃO</th>
                  <th>PERÍODO DE VEICULAÇÃO</th>
                  <th>VALOR MENSAL R$</th>
                  <th>SUB TOTAL R$ </th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Classificados</td>
                  <td><?php echo $form->textArea($model,'plano_classificados_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_classificados_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_classificado_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_classificados_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
               <tr>
                  <td>Banner no site Bombarco</td>
                  <td><?php echo $form->textArea($model,'plano_banner_site_bb_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_site_bb_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_site_bb_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_site_bb_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
               <tr>
                  <td>Banner na News</td>
                  <td><?php echo $form->textArea($model,'plano_banner_news_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_news_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_news_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_news_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
               <tr>
                  <td>E-mail Marketing</td>
                  <td><?php echo $form->textArea($model,'plano_emkt_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_emkt_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_emkt_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_emkt_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
               <tr>
                  <td>Zero Milhas</td>
                  <td><?php echo $form->textArea($model,'plano_zeromilhas_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_zeromilhas_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_zeromilhas_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_zeromilhas_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
               <tr>
                  <td>Impresso - Guia do Capitão</td>
                  <td><?php echo $form->textArea($model,'plano_impresso_guia_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_impresso_guia_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_impresso_guia_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_impresso_guia_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
               <tr>
                  <td>Site - Guia do Capitão</td>
                  <td><?php echo $form->textArea($model,'plano_site_guia_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_site_guia_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_site_guia_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_site_guia_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
               <tr>
                  <td>Raio X</td>
                  <td><?php echo $form->textArea($model,'plano_raiox_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_raiox_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_raiox_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_raiox_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
               <tr>
                  <td>Outros</td>
                  <td><?php echo $form->textArea($model,'plano_outros_desc', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_outros_periodo', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_outros_valor', array("class"=>"textarea-td")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_outros_subtotal', array("class"=>"textarea-td")); ?></td>
               </tr>
            </tbody>
         </table>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-3" style="width: 19.666667% !important;">
               <label class="control-label">Valor Total do Contrato R$</label>
            </div>
            <div class="col-md-9" style="width:  79.999997% !important;">
               <?php echo $form->textField($model,'valor_total_contrato', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2">
               <label class="control-label">Forma de Pagamento</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model,'num_parcelas_pagamento', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-2" style="width: 12.666667% !important;">
               <label class="control-label">parcela (s) de R$</label>
            </div>
            <div class="col-md-6" style="width: 53.666667% !important;">
               <?php echo $form->textField($model,'valor_parcelas_pagamento', array("class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
            <div class="col-md-3" style="width: 18.666667% !important;">
               <label class="control-label">com vencimento todo dia</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model,'vencimento_parcelas_pagamento', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-6" style="width: 42.666667% !important;">
               <label class="control-label">de cada mês, sendo primeira parcela com vencimento dia</label>
            </div>
            <div class="col-md-1" style="width: 21.5555555% !important;">
               <?php echo $form->textField($model,'vencimento_primeira_parcela_pagamento', array("class"=>"input_line form-control")); ?>
            </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-4">
               <label class="control-label">em forma de boleto bancário.</label>
            </div>
         </div>
      </div>
      <br/><br/>
      <div class="form-group">
         <label for="comment">Obs</label>
         
         <?php echo $form->textArea($model,'observacao', array("rows"=>5, "style"=>"height: auto !important;", "class"=>"form-control")); ?>
         <br/><br/>
         <label>Autorizo a(s) publicação(ções) acima descriminada(as)</label>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 11.666667% !important;position: relative;
               top: 45px;">
               <label class="control-label">Visto Bombarco</label>
            </div>
            <div class="col-md-4">
               <div id="visto_bombarco"></div>
               <!-- <input type="text" class="input_line form-control" name="Contrato[razao_social]">-->
            </div>
            <div class="col-md-2" style="width : 13.666667% !important;position: relative;
               top: 45px;">
               <label class="control-label">Visto Contratante</label>
            </div>
            <div class="col-md-4">
               <div id="visto_contratante"></div>
               <!--<input type="text" class="input_line form-control" name="Contrato[razao_social]">-->              
            </div>
         </div>
      </div>
   </div>
   <div class="row" id="texto-contrato" style="display:none;">
      <p style="background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;text-align:justify;">
         Pelo presente instrumento, de um lado, como CONTRATADA, Bombarco Serviços de Informação na Internet Ltda. ME, pessoa jurídica de direito privado, com sede em Mogi das Cruzes, Estado de São Paulo, na Rua Cruzeiro do Sul, nº323, Vila Oliveira, CEP 08790-170, CNPJ/MF sob nº 10.352.973/0001-43, e, de outro lado, como CONTRATANTE, qualificado(a) na frente da presente folha em sua Ficha Cadastral e, em conjunto, denominadas PARTES; resolvem firmar o presente Contrato, que será regido pelas seguintes condições:
         OBJETO DO CONTRATO
         CLÁUSULA 1. O presente Contrato tem como objeto a “cessão” de espaço em mídia digital e impressa, pelo Bombarco à CONTRATANTE, para divulgação e veiculação de conteúdo, promoções ou ações comerciais, sem exclusividade, pela forma acordada entre as partes, no espaço publicitário do website www.bombarco.com.br, www.guiadocapitao.com.br, www.zeromilhas.com.br, no Impresso ou ainda nas redes sociais do Bombarco. 
         Parágrafo Único: A contraprestação pela cessão (“preço”), prazo de vigência do contrato, planos contratados e demais condições comerciais aplicáveis ao negócio estão contidas na Ficha Cadastral, cujos termos e condições devem ser interpretados em conjunto com as condições ora previstas neste instrumento, e, só serão modificados através de aditivo contratual. 
         CLÁUSULA 1.1. O produto Impresso, trata-se tão somente de divulgação e veiculação de conteúdo informativo ou publicitário em mídia impressa.
         CLÁUSULA 1.2. Independentemente do plano e produto contratado (mídia digital ou impressa), a CONTRATANTE se responsabiliza pelo envio de todo material (layout, informações, logo, e demais materiais que se fizerem necessários), para o e-mail atendimento@bombarco.com.br, sendo que a arte será enviada já de acordo com as especificações do espaço contratado. 
         CLÁUSULA 1.3. A CONTRATANTE com a assinatura do presente contrato e envio do material a ser divulgado, autoriza expressamente a CONTRATADA o uso de seu nome, marca, sinais distintivos e demais informações contidas no material enviado para postagem no Espaço e para os fins exclusivos desse Contrato.
         OBRIGAÇÕES DA CONTRATADA
         CLÁUSULA 2. O presente instrumento de contrato começa a contar a partir da assinatura desse instrumento, por esse motivo, a CONTRATADA obriga-se:
         A) Publicar  a publicidade no “Impresso”, desde que cumpridas as obrigações da CONTRATANTE.
         B) Publicar os banners no site, enviar e-mail marketing e enviar banner na news, desde que cumpridas as obrigações da CONTRATANTE.
         C) Liberar no sistema o espaço contratado para a CONTRATANTE anunciar suas embarcações e/ou empresa em até 2 (dois) dias úteis da assinatura desse contrato.
         D) Publicar as embarcações novas no website zeromilhas.com.br , de acordo com as especificações fornecidas, desde que cumpridas as obrigações da CONTRATANTE
         E) Gravar o Raio X no local e data previamente combinado e publicá-lo desde que cumpridas as obrigações da CONTRATANTE. 
         F) Fazer o post na rede social do Bombarco, desde que cumpridas as obrigações da CONTRATANTE.
         OBRIGAÇÕES DA CONTRATANTE
         CLÁUSULA 3. Da assinatura do contrato, ocorre automaticamente a reserva do espaço virtual e/ou impresso, portanto, a CONTRATANTE obriga-se a fornecer e enviar material publicitário, estipulados, conforme o plano adquirido, sendo: 
         A) Contratando o Plano Banner na news, disparo de e-mail marketing e/ou post na rede social deverá a CONTRATANTE fornecer à CONTRATADA o material publicitário de acordo com as orientações enviadas pela CONTRATADA com até 07 dias corridos de antecedência da data agendada para o envio.
         B) Contratando o Plano de Classificados, Site - Guia do Capitão, Banner e/ou Zero Milhas deverá cadastrar as embarcações, empresas e/ou enviar o material publicitário tão logo  da assinatura desse contrato.
         CLÁUSULA 3.1. No Impresso, a CONTRATANTE enviará o material desejável, adequado e necessário via e-mail (atendimento@bombarco.com.br) até 7 (sete) dias corridos da assinatura do contrato. 
         CLÁUSULA 3.2. Contratando o Raio X o CONTRATANTE deverá disponibilizar o barco a ser divulgado, barco de apoio se necessário, bem como o local que será gravado o vídeo e o todas as especificações técnicas necessárias do barco. 
         CLÁUSULA 3.3. Atualizar as informações contidas no site, sempre que houver alguma alteração. 
         CLÁUSULA 3.4. Efetuar o pagamento no valor, prazo e nas condições estabelecidas na Ficha Cadastral, sob pena de aplicação de multa moratória no valor de 2% (dois por cento) e juros de 5,9% ao mês, ambos calculados sobre o valor em atraso; bem como estará sujeito a protesto e inclusão nas entidades de protesto em caso superior a 30 dias.
         CLÁUSULA 3.5. Efetuar o pagamento da ajuda de custo com alimentação, hospedagem e transporte para a gravação do Raio X de toda a equipe disponibilizada para a execução da gravação.  
         DAS CONDIÇÕES EM GERAL
         CLÁUSULA 4. A CONTRATANTE deverá ler, certificar-se de haver entendido e aceitar todas as condições estabelecidas neste contrato, bem como na Política de Privacidade e Termo de Uso que consta no site Bombarco, Guia do Capitão e do Zero Milhas, antes de efetivar a contratação. A aceitação das condições descritas nestes instrumentos é absolutamente indispensável para a utilização do site. 
         CLÁUSULA 5. A CONTRATADA não é proprietária, ou intermediadora de venda das embarcações comercializadas, em hipótese alguma fará a guarda, terá posse, ou realizará as ofertas de venda. Tampouco, se responsabiliza pela entrega das mesmas, ou intervirá em negociações iniciadas através do site ou Impresso.
         CLÁUSULA 6. A CONTRATANTE se obriga e se responsabiliza de forma exclusiva pelo conteúdo comercial das suas informações disponibilizadas no Site www.bombarco.com.br, www.guiadocapitao.com.br, www.zeromilhas.com.br ou no Impresso, por suas negociações e/ou contratações, por quaisquer defeitos ou vícios de seus produtos ou serviços, violação de direitos autorais, de imagem, de privacidade, de propriedade industrial e do consumidor, bem como, legalidade, qualidade, segurança, entrega, transporte, informação e disponibilidade em estoque, respondendo por quaisquer prejuízos que possa vir a causar à CONTRATADA ou a terceiros.  
         CLÁUSULA 7. Este contrato não implica e nem obriga as partes na intermediação de negócios, não representa joint venture ou sociedade entre as partes, ficando esclarecido que as ações ora estabelecidas serão executadas em caráter de total autonomia, sem qualquer obrigação de exclusividade, subordinação, obtenção de resultados comerciais ou não, assim como, quantitativos de negócios oriundos da presente contratação.
         CLÁUSULA 8. A CONTRATANTE fornecerá, bem como, se responsabiliza pelas informações contidas nos diversos canais dos sites e do Impresso, devendo, portanto, conferi-la. 
         DO PRAZO
         CLÁUSULA 9. O prazo para cadastro de embarcações, cadastro da empresa no site - guia do capitão e envio de material de Banner e/ou zero milhas deverão ser respeitados conforme Cláusula terceira e suas alíneas, estando ciente a CONTRATANTE que o prazo de contratação começa a contar a partir do dia seguinte da assinatura do contrato independente se o material foi enviado e se os espaços foram preenchidos.
         Parágrafo Primeiro: O prazo para enviar peças de E-mail marketing, banner na news, post da rede social e/ou para o Impresso deverá ser respeitado conforme Cláusula terceira e suas alíneas, estando ciente a CONTRATANTE que em caso contrário perderá o direito do envio ou publicação. No caso do e-mail marketing a CONTRATADA remarcará um novo envio, uma única vez e de acordo com a disponibilidade da agenda. Em se tratando do Raio X, caso a equipe do Bombarco for até o local da gravação e não for possível realizar a gravação por qualquer motivo, deverá a CONTRATANTE arcar novamente com as despesas previstas na CLÁUSULA 3.5 deste contrato. 
         Parágrafo Segundo: Caso a CONTRATANTE não cumpra com os prazos da Cláusula Terceira e suas alíneas, a CONTRATADA não devolverá nenhuma quantia paga, nem tampouco estenderá o prazo já previamente acordado. A CONTRATANTE se responsabiliza pelas consequências que poderão surgir pela falta do cumprimento. 
         RESCISÃO
         CLÁUSULA 10. O presente contrato poderá ser rescindido a qualquer momento pela CONTRATANTE, mediante aviso por escrito sendo que: se cancelado até 10 dias corridos da assinatura do contrato, será cobrado multa rescisória referente a 1 (uma) parcela do valor do contrato; se cancelado após o 11º dia, será cobrada multa rescisória referente a 50% do valor em aberto que falta pagar. 
         Parágrafo Primeiro: Caso o contrato seja rescindido pela CONTRATADA ambas as partes estarão isentas de qualquer multa contratual.
         Parágrafo Segundo: Havendo falta ou atraso de pagamento por mais de 10 dias, o contrato poderá ser automaticamente rescindido e a CONTRATADA não manterá a “cessão” do espaço virtual ou do Impresso, sem prejuízo de ser cobrada a multa rescisória pertinente. 
         CLÁUSULA 10.1 – Fica vedada a cessão ou transferência, total ou parcial das responsabilidades e direitos assumidos pelas partes, exceto havendo autorização expressa da CONTRATADA.
         CLÁUSULA 10.2 – A tolerância de qualquer das PARTES, com relação ao estrito cumprimento das obrigações ora previstas, não constituirá em novação, renúncia ou revogação aos direitos ou cumprimento das demais disposições e obrigações.
         DA VIGÊNCIA DO CONTRATO
         CLÁUSULA 11. O presente contrato é renovado automaticamente, por iguais e sucessivos períodos, nos casos de contratação de Classificados, Site- Guia do Capitão, Zero Milhas, e Banner o site, sendo comunicado antecipadamente via e-mail se houver alteração em relação ao preço. A CONTRATANTE é a única responsável pelo cancelamento do serviço, que deverá enviar um e-mail para milena@bombarco.com.br solicitando o cancelamento.
         Parágrafo único: Após o cancelamento, o CONTRATANTE perderá todas as informações, dados e arquivos inseridos no espaço disponibilizado enquanto da vigência do contrato. 
         DO FORO
         CLÁUSULA 12. Caso as dúvidas e divergências decorrentes desse Contrato não possam ser dirimidas de comum acordo entre as partes, fica eleito o Foro da Comarca de Mogi das Cruzes - SP, como competente para solucioná-las, renunciando as partes a qualquer outro, por mais privilegiado que seja. E, por estarem justos e contratados, assinam as partes o presente Contrato em 02 (duas) vias de iguais teor e forma, para que se produzam os efeitos jurídicos e legais.  
      </p>
      <br/><br/>
      <div class="row">
            <div class="form-group">
               <div class="col-md-2" style="width: 12.666667% !important;">
                  <label class="control-label">Mogi das Cruzes,</label>
               </div>
               <div class="col-md-1">
                  <input value="<?php echo date('d'); ?>" type="text" class="input_line form-control">
               </div>
               <div class="col-md-1" style="width: 2.333333% !important;">
                  <label class="control-label">de</label>
               </div>
               <div class="col-md-3">
                  <input style="text-align:center;" value="<?php echo Contrato::dataExtenso(date('m')); ?>" type="text" class="input_line form-control">
               </div>
               <div class="col-md-1" style="width: 2.333333% !important;">
                  <label class="control-label">de</label>
               </div>
               <div class="col-md-1">
                  <input value="<?php echo date('YYYY'); ?>" type="text" class="input_line form-control">
               </div>
           </div>
      </div>
      <br/><br/><br/>
      <div class="row">
         <div class="form-group">
            <div class="pull-left col-md-6">
                <input id="visto_bombarco2" type="text" class="input_line form-control">
                <br />
                <label for="decimal_input">Bombarco Serviços de Informação na Internet Ltda ME</label>
            </div>
            <div class="col-md-6">
                <input id="visto_contratante2" type="text" class="input_line form-control">
                <br />
                <label for="input2">CONTRATANTE</label>
            </div>
        </div>
      </div>
      <br/><br/>
      <div class="row">
         <div class="col-md-6 pull-left">
                <div class="form-check form-check-inline">
                 <label style="white-space: initial !important;" class="form-check-label">
                   <input checked class="form-check-input" type="checkbox" id="check1"> Li, e concordo com os termos da Ficha Cadastral e do Contrato acima.
                 </label>
               </div>
         </div>
         <div class="col-md-6 pull-right">
               <div class="form-check form-check-inline">
                 <label style="white-space: initial !important;" class="form-check-label">
                   <input class="form-check-input" checked type="checkbox" id="check2"> Estou ciente que estou assinando esse contrato eletronicamente e que este terá validade jurídica.
                 </label>
               </div>
         </div>
      </div>
      <br/><br/>
      <div class="row text-center">
            <div class="col-md-12"> 
                <!--<button id="btn-assinar" class="btn btn-success">ASSINAR</button> -->
                <a id="btn-assinar" href="#"><img alt="Assinar Contrato" style=" display: block;
    margin-left: auto;
    margin-right: auto;" class="img-responsive img-center" src="/img/assinar1.png"/></a>
            </div>
      </div>
   </div>
   <?php echo $form->hiddenField($model,'visto_bombarco', array("id"=>"visto_bombarco_hidden")); ?>
   <?php echo $form->hiddenField($model,'visto_contratante', array("id"=>"visto_contratante_hidden")); ?>

   <!-- SLUG !! AQUI EH IMPORTANTE PQ GERA O LINK -->
   <?php echo $form->hiddenField($model,'slug', array("value"=>hexdec(uniqid()))); ?>
   
   <?php $this->endWidget(); ?>
</div>
<!-- form -->
<script>
   $(document).ready(function() {
      $(".navbar-inverse").remove();
      
      if($(".mostraLink").length) {
          //$("html, body").animate({ scrollTop: 0 }, "slow");@@
          $(".mostraLink").pulse({times: 7, duration: 500});
      }

      $("#visto_bombarco").jSignature();
      $("#visto_contratante").jSignature();

      $("#proxima").on("click", function(e) {
            e.preventDefault();
            $("#campos").hide("slow");
            $("#texto-contrato").show("slow");     
            $(this).hide();
            $("#anterior").show();
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);

             $( ".form-check" ).pulse({times: 7, duration: 500});
      });

      $("#anterior").on("click", function(e) {
         e.preventDefault();
            $("#texto-contrato").hide("slow");
            $("#campos").show("slow");
            $(this).hide();
            $("#proxima").show();
      });

      $("#btn-assinar").on("click", function(e) {
            e.preventDefault();

            var tipo = $("#visto_bombarco").jSignature("getData","svgbase64")[0];
            var assinatura = $("#visto_bombarco").jSignature("getData","svgbase64")[1];

            tipo = "data:"+tipo+",";

            var base64_visto_bombarco = tipo+assinatura;

            tipo = $("#visto_contratante").jSignature("getData","svgbase64")[0];
            assinatura = $("#visto_contratante").jSignature("getData","svgbase64")[1];

            tipo = "data:"+tipo+",";

            var base64_visto_contratante = tipo+assinatura;

            $("#visto_bombarco_hidden").val(base64_visto_bombarco);
            $("#visto_contratante_hidden").val(base64_visto_contratante);


            $.confirm({
                 confirmButtonClass: 'btn-success',
                 cancelButtonClass: 'btn-danger',
                 icon: 'fa fa-warning',
                 title: 'Contrato online',
                 content: 'Deseja confirmar o preenchimento do contrato?',
                 confirmButton: 'SIM',
                 cancelButton: 'NÃO',
                 confirm: function() {
                     $("#contrato-form").submit(); 
                 },
                 cancel: function() {

                 }
            });
             
      });
   });

   $.fn.pulse = function(options) {
    
       var options = $.extend({
           times: 3,
           duration: 1000
       }, options);
       
       var period = function(callback) {
           $(this).animate({opacity: 0}, options.duration, function() {
               $(this).animate({opacity: 1}, options.duration, callback);
           });
       };
       return this.each(function() {
           var i = +options.times, self = this,
           repeat = function() { --i && period.call(self, repeat) };
           period.call(this, repeat);
       });
   };
</script>