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
   hr {
        height: 1px;
  width:100%;
  display:block; /* for use on default inline elements like span */
  margin: 9px 0;
  overflow: hidden;
  background-color: #e5e5e5;
   }
      label {
      font-weight: initial !important;
   }
   .label-required {
      font-weight: bolder !important;
   }

</style>
<?php
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jSignature/jSignature.min.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.css');
   



   
?>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>-->


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

    <?php if($mostraLink): ?>
      <div class="row mostraLink">
         <div class="alert alert-success">
               <!--Successo! Link do contrato para enviar para o cliente: <strong>http://www.bombarco.com.br/admin/contrato/assinar/<?php //echo $model->slug;?></strong>-->
               Successo! Link do contrato para enviar para o cliente: <strong>http://www.bombarco.com.br/contrato/assinar/<?php echo $model->slug;?></strong>
         <br/>
         </div>
         <br/>

      </div>
    <?php endif; ?>
    
   <div class="row">
      <div class="col-md-6">
         <a href="#" style="display:none;" id="anterior"><img class="pull-left img-responsive" src="/img/arrow_left_contrato.png?e=5"/></a>
      </div>
      <!--<div class="col-md-6">
         <a href="#" id="proxima"><img class="pull-right img-responsive" src="/img/arrow_right_contrato.png"/></a>
      </div>-->
   </div>
   <br/>
   <div class="row">
      <div class="col-md-4">
         <a href="https://www.bombarco.com.br/" target="_blank"><img src="/themes/bombarco/img/bombarco.png" class="img-responsive" alt="Bombarco"></a>
      </div>
      <div class="col-md-4">
         <div class="form-inline">
            <label class="control-label">FICHA CADASTRAL nº</label>
            <?php if($mostraLink): ?>
            	<?php echo $form->textField($model, 'num_contrato', array("class"=>"input-mini", "style"=>"width:33.33%; text-align:center;")); ?>
            <?php else: ?>
            	<?php echo $form->textField($model, 'num_contrato', array("value"=>Contrato::calcularNumContrato(), "class"=>"input-mini", "style"=>"width:33.33%; text-align:center;")); ?>
            <?php endif; ?>
            
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

   <br/>
   <div id="campos">
           <div class="form-group">
           <label class="label-required" for="email">E-mail do executivo da conta</label>
           <?php echo $form->textField($model, 'email_vendedor', array("id"=>"email_vendedor", "class"=>"obrigatorio input_line form-control")); ?>
  </div>


      <br/><br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom">
               <label class="control-label label-required">Nome fantasia</label>
            </div>
            <div class="col-md-10" style="width: 88.999999% !important">
               <!--<input type="text" class="input_line form-control" name="Contrato[nome_fantasia]">-->
               <?php echo $form->textField($model, 'nome_fantasia', array("id"=>"nome_fantasia", 'required' => true, "class"=>"obrigatorio input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom">
               <label class="control-label">Razão Social</label>
            </div>
            <div class="col-md-7">
               <?php echo $form->textField($model, 'razao_social', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-2" style="width: 13.66666667% !important;">
               <label class="control-label">Data da fundação</label>
            </div>
            <div class="col-md-1" style="width: 16.666667% !important;">
               <?php echo $form->textField($model, 'data_fundacao', array("class"=>"data input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
     
<div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom">
               <label class="control-label">com sede na</label>
            </div>
            <div class="col-md-6">
               <input class="input_line form-control" name="Contrato[rua]" id="Contrato_rua" type="text">            
            </div>
            <div class="col-md-2" style="width: 10.666667% !important;">
               <label class="control-label">Complemento</label>
            </div>
            <div class="col-md-2" style="width: 26.666667% !important;">
               <input class="input_line form-control" name="Contrato[complemento]" id="Contrato_complemento" type="text" autocomplete="off" style="width: 107.666667% !important;"> 
            </div>
         </div>
      </div>
      <br/>
       <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 5.666667% !important;">
               <label class="control-label">Bairro</label>
            </div>
            <div class="col-md-8" style="width: 80.333333% !important;">
               <?php echo $form->textField($model, 'bairro', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 2.333333% !important;">
               <label class="control-label">Nº</label>
            </div>
            <div class="col-md-1" style="width: 10.666667% !important;">
               <input class="input_line form-control" name="Contrato[numero]" id="Contrato_numero" type="text">
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
               <?php echo $form->textField($model, 'cep', array("class"=>"cep input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label label-required">CNPJ</label>
            </div>
            <div class="col-md-2" style="width: 24.666667% !important;">
               <?php echo $form->textField($model, 'cnpj', array("id"=>"cnpj", "class"=>"obrigatorio cnpj input_line form-control")); ?>
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
               <?php echo $form->textField($model, 'telefone', array("class"=>"tel input_line form-control")); ?>
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
               <label class="label-required control-label">CPF nº</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'cpf_representante_legal', array("class"=>"cpf input_line form-control")); ?>
            </div>
            <div class="col-md-1">
               <label class="control-label">e RG nº</label>
            </div>
            <div class="col-md-2" style="width: 24.333333%;">
               <?php echo $form->textField($model, 'rg_representante_legal', array("class"=>"rg input_line form-control")); ?>
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
               <?php echo $form->textField($model,'data_nascimento_representante_legal', array("class"=>"data input_line form-control")); ?>
            </div>
            <div class="col-md-1" style="width: 4.666667% !important;">
               <label class="control-label">Cel</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model,'cel_representante_legal', array("class"=>"tel input_line form-control")); ?>
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
               <label class="control-label label-required">E-mail para receber perguntas (site)</label>
            </div>
            <div class="col-md-8 " style="width: 74.666667% !important;">
               <?php echo $form->textField($model,'email_pergunta', array("id"=>"email_pergunta", "class"=>"obrigatorio input_line form-control")); ?>
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
               <?php echo $form->textField($model,'resp_financeiro_tel', array("class"=>"tel input_line form-control")); ?>
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
               <?php echo $form->textField($model,'resp_anuncios_tel', array("class"=>"tel input_line form-control")); ?>
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
               <?php echo $form->textField($model,'resp_pecas_tel', array("class"=>"tel input_line form-control")); ?>
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
                  <td><?php echo $form->textArea($model,'plano_classificados_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_classificados_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_classificado_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_classificados_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
               </tr>
               <tr>
                  <td>Banner no site Bombarco</td>
                  <td><?php echo $form->textArea($model,'plano_banner_site_bb_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_site_bb_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_site_bb_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_site_bb_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
               </tr>
               <tr>
                  <td>Banner na News</td>
                  <td><?php echo $form->textArea($model,'plano_banner_news_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_news_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_news_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_banner_news_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
               </tr>
               <tr>
                  <td>E-mail Marketing</td>
                  <td><?php echo $form->textArea($model,'plano_emkt_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_emkt_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_emkt_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_emkt_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
               </tr>
               <tr>
                  <td>Zero Milhas</td>
                  <td><?php echo $form->textArea($model,'plano_zeromilhas_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_zeromilhas_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_zeromilhas_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_zeromilhas_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
               </tr>
               <tr>
                  <td>Impresso - Guia do Capitão</td>
                  <td><?php echo $form->textArea($model,'plano_impresso_guia_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_impresso_guia_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_impresso_guia_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_impresso_guia_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
               </tr>
               <tr>
                  <td>Site - Guia do Capitão</td>
                  <td><?php echo $form->textArea($model,'plano_site_guia_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_site_guia_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_site_guia_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_site_guia_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
               </tr>
               <tr>
                  <td>Raio X</td>
                  <td><?php echo $form->textArea($model,'plano_raiox_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_raiox_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_raiox_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_raiox_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
               </tr>
               <tr>
                  <td>Outros</td>
                  <td><?php echo $form->textArea($model,'plano_outros_desc', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_outros_periodo', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_outros_valor', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
                  <td><?php echo $form->textArea($model,'plano_outros_subtotal', array("rows"=>6, "style"=>"height: auto !important;", "class"=>"textarea-td form-control")); ?></td>
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
            <div class="col-md-3">
               <?php echo $form->textField($model,'valor_total_contrato', array("class"=>"moeda input_line form-control")); ?>
            </div>
            <div class="col-md-6" style="width: 54.666667% !important;">
               <?php echo $form->textField($model,'valor_total_contrato_extenso', array("value"=>"(Valor do total por extenso)", "class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 15.666667% !important;">
               <label class="control-label">Forma de Pagamento</label>
            </div>
            <div class="col-md-2" style="width: 15.666667% !important;">
               <?php echo $form->textField($model,'num_parcelas_pagamento', array("class"=>"input_line form-control")); ?>
            </div>
            <div class="col-md-2" style="width: 12.666667% !important;">
               <label class="control-label">parcela (s) de R$</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model,'valor_parcelas_pagamento', array("class"=>"moeda input_line form-control")); ?>
            </div>
            <div class="col-md-4" style="width: 38.666666% !important;">
               <?php echo $form->textField($model,'valor_parcelas_pagamento_extenso', array("value"=> "(Valor da parcela por extenso)", "class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
<div class="row">
            <div class="col-md-3" style="width: 18.666667% !important;">
               <label class="control-label">com vencimento todo dia</label>
            </div>
            <div class="col-md-1" style="
    width: 12.333333% !important;
">
               <input class="input_line form-control" name="Contrato[vencimento_parcelas_pagamento]" id="Contrato_vencimento_parcelas_pagamento" type="text">            </div>
            <div class="col-md-7" style="width: 40.666667% !important;">
               <label class="control-label">de cada mês, sendo primeira parcela com vencimento dia</label>
            </div>
            <div class="col-md-1" style="width: 27.5555555% !important;">
               <input class="data input_line form-control" name="Contrato[vencimento_primeira_parcela_pagamento]" id="Contrato_vencimento_primeira_parcela_pagamento"ype="text" autocomplete="off">            </div>
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
         <!--<label>Autorizo a(s) publicação(ções) acima descriminada(as)</label>-->
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div style="text-align:center;" class="col-md-12">
                <!--<input id="visto_bombarco2" type="text" class="input_line form-control">-->
                <div id="visto_bombarco"></div>
                <label for="decimal_input">Visto Bombarco</label>
                <br/><br/>
                <a id="btn-refazer-ass" href="#">Refazer assinatura</a>
            </div>
            <!--<div style="text-align:center;" class="col-md-6">
                <div id="visto_contratante2"></div>
                <br />
                <label for="input2">CONTRATANTE</label>
            </div>-->
        </div>
      </div>
   </div>
  
      <br/><br/>
      <div class="row text-center">
            <div class="col-md-12"> 
                <!--<button id="btn-assinar" class="btn btn-success">ASSINAR</button> -->
                <!--<a id="btn-assinar" href="#"><img alt="Assinar Contrato" style=" display: block;
    margin-left: auto;
    margin-right: auto;" class="img-responsive img-center" src="/img/assinar1.png"/></a>-->
                <button id="btn-assinar" class="btn btn-primary btn-lg">Gerar link de contrato</button>
                <br/><br/>
            </div>
      </div>
   </div>
   <?php echo $form->hiddenField($model,'visto_bombarco', array("id"=>"visto_bombarco_hidden")); ?>
   <!-- SLUG !! AQUI EH IMPORTANTE PQ GERA O LINK -->
   <?php echo $form->hiddenField($model,'slug', array("value"=>hexdec(uniqid()))); ?>
   <input type="hidden" id="img_val" name="imagem_contrato"/>
   <?php $this->endWidget(); ?>
</div>
<!-- form -->
<script>
   $(document).ready(function() {
      $(".navbar-inverse").remove();

      $('.data').mask('00/00/0000');
      $('.cep').mask('99999-999');
      $('.tel').mask('(99) 99999-9999');
      $('.cpf').mask('000.000.000-00');
      $('.cnpj').mask('99.999.999/9999-99');
      //$('.rg').mask('99.999.999-9');
    
      $('.moeda').priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.',
        clearPrefix: true
      });
      
      if($(".mostraLink").length) {
          $("#btn-assinar").remove();
      }

      $("#visto_bombarco").jSignature();
      $("#visto_bombarco2").jSignature();

     $("#texto-contrato").hide();

      $("#proxima").on("click", function(e) {
            e.preventDefault();
            $("#campos").hide("slow");
            $("#texto-contrato").show("slow");     
            $(this).hide();
            $("#anterior").show();
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);

            $( ".form-check" ).pulse({times: 7, duration: 500});
      });

      $("#btn-refazer-ass").on("click", function(e) {
         e.preventDefault();
         $("#visto_bombarco").jSignature("reset");
      });


      $("#btn-assinar").on("click", function(e) {
            e.preventDefault();

            $("body").on("click", ".btn-default", function() {
               $("html, body").animate({ scrollTop: 0 }, "slow");
            });

            // pegar as assinaturas e vistos e colocar os valores em variaveis
            var tipo = $("#visto_bombarco").jSignature("getData","svgbase64")[0];
            var assinatura = $("#visto_bombarco").jSignature("getData","svgbase64")[1];
            tipo = "data:"+tipo+",";
            var base64_visto_bombarco = tipo+assinatura;

            $("#visto_bombarco_hidden").val(base64_visto_bombarco);

            var flgok = true;
            $(".obrigatorio").each(function() {
               if($(this).val() == "") {
                  $(this).css("border-color", "red");
               }
            });


            if(!validateEmail($("#email_vendedor").val())) {
               $.alert({
                    title: 'Erro',
                    content: 'Por favor preencha o e-mail do vendedor'
                });

                return false;
            }

            if($("#Contrato_cpf_representante_legal").val() == "" && $("#cnpj").val() == "") {
               $.alert({
                    title: 'Erro',
                    content: 'Por favor preencha com um CPF ou CNPJ válido'
                });

                return false;
            }

            if($("#email_pergunta").val() == "" || $("#nome_fantasia").val() == "") {
               $.alert({
                    title: 'Erro',
                    content: 'Por favor preencha o nome fantasia e o e-mail de pergunta'
                });

                return false;
            }

            if($("#visto_bombarco").jSignature('getData', 'native').length == 0) {
                $.alert({
                    title: 'Erro',
                    content: 'Por favor de o visto no contrato antes de enviar para o cliente',
                });
                
                return false;
            }




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

   function validateEmail(email) {
      if(email == "") return false;
       var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       return re.test(email);
   }

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