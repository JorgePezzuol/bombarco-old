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
   label, input, span, textarea, td, th{
   /*font-weight: initial !important;*/
   font-size:12px !important;
   font-family: "Arial", Georgia, Serif !important;
   color: initial !important;
   }
   p {
   font-size:12px !important;
   font-family: "Arial", Georgia, Serif !important;
   color: initial !important;
   }
   .input_line, .input_line:focus {
   background: transparent;
   border: none;
   box-shadow: none;
   border-radius: 0;
   border-bottom: 1px solid #000000;
   /*border-bottom: 0.5px solid whitesmoke !important;*/
   border-bottom-width: 2px;
   }
   .transparente {
   background: transparent;
   border: none;
   box-shadow: none;
   border-radius: 0;
   }
   .textarea-td {
   background: transparent;
   border: none;
   box-shadow: none;
   border-radius: 0;
   width: 100% !important;
   word-break: break-all !important;
   height: 100% !important;
   }
   .form-control {
   /*height: 25px;*/
   /*padding-bottom: 20px;*/
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
   .textarea {
   display: block;
   width: 100%;
   height: 34px;
   padding: 6px 12px;
   line-height: 1.42857143;
   color: #555;
   background-color: #fff;
   background-image: none;
   border: 1px solid #ccc;
   border-radius: 4px;
   }
   .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control, .textarea {
   background-color: initial !important;
   }
</style>
<?php
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jSignature/jSignature.min.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.css');
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/promise/promise.min.js', CClientScript::POS_END);
   Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/html2canvas.js', CClientScript::POS_END);
   
   ?>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>-->
<!--[if lt IE 9]>
<script type="text/javascript" src="libs/flashcanvas.js"></script>
<![endif]-->
<div class="container-fluid">
       <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'contrato-form',
        'enableAjaxValidation' => false,
    ));
    ?>

   <?php if($msg != ''): ?>
      <div class="row" id="msg-sucesso">
         <div class="alert alert-success">
               <?php echo $msg; ?>
         <br/>
         </div>
         <br/>

      </div>
    <?php endif; ?>
    
   <div id="campos">
      <div class="row">
         <!--<div class="col-md-6">
            <a href="#" style="display:none;" id="anterior"><img class="pull-left img-responsive" src="/img/arrow_left_contrato.png?e=5"/></a>
            </div>-->
         <div class="col-md-12">
            <a href="#" id="proxima"><img class="pull-right img-responsive" src="/img/arrow_down.png"></a>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-md-4">
            <a href="https://www.bombarco.com.br/" target="_blank"><img src="/themes/bombarco/img/bombarco.png" class="img-responsive" alt="Bombarco"></a>
         </div>
         <div class="col-md-4">
            <div class="form-inline">
               <label class="control-label">FICHA CADASTRAL nº: </label>
               <?php echo $form->textField($model, 'num_contrato', array("class"=>"input-mini", "style"=>"width:33.33%; text-align:center;")); ?>         
            </div>
            <br>
            <div class="form-inline">
                          <?php $model->flg_renovacao = '0';?>
            <?php echo $form->radioButtonList($model, 'flg_renovacao', array('1'=>'Renovação', '0'=>'1º Contrato'), array('class'=>'radio', 'labelOptions'=>array('display: inline; margin-right: 20px;'), 'separator' =>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')); ?>        
            </div>
         </div>
         <div class="col-md-4">
            <span>e-mail: atendimento@bombarco.com.br</span><br>
            <span>Tel.: (11) 4796-4062 / 2629-2170 / 9 6839-0408</span>      
         </div>
      </div>
      <br><br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom" style="
               width: 7.999999% !important;
               ">
               <label class="control-label">Nome fantasia:</label>
            </div>
            <div class="col-md-10" style="width: 88.999999% !important">
               <!--<input type="text" class="input_line form-control" name="Contrato[nome_fantasia]">-->
               <?php echo $form->textField($model, 'nome_fantasia', array("id"=>"nome_fantasia", "class"=>"required input_line form-control")); ?>            
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom" style="
               width: 7.666667% !important;
               ">
               <label class="control-label">Razão Social:</label>
            </div>
            <div class="col-md-7">
               <?php echo $form->textField($model, 'razao_social', array("class"=>"required input_line form-control")); ?> 

            </div>
            <div class="col-md-2" style="width: 9.666667% !important;">
               <label class="control-label">Data da fundação:</label>
            </div>
            <div class="col-md-1" style="width: 20.9999997% !important;">
               <?php echo $form->textField($model, 'data_fundacao', array("class"=>"data input_line form-control")); ?>            
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2 col-md-2-custom" style="
               width: 7.666667% !important;
               ">
               <label class="control-label">com sede na:</label>
            </div>
            <div class="col-md-6">
                <?php echo $form->textField($model, 'rua', array("class"=>"input_line form-control")); ?>             
            </div>
            <div class="col-md-2" style="width: 7.666667% !important;">
               <label class="control-label">Complemento:</label>
            </div>
            <div class="col-md-2" style="width: 29.666667% !important;">
               <?php echo $form->textField($model, 'complemento', array("class"=>"input_line form-control")); ?>  
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 3.666667% !important;">
               <label class="control-label">Bairro:</label>
            </div>
            <div class="col-md-8" style="width: 80.333333% !important;"> 
               <?php echo $form->textField($model, 'bairro', array("class"=>"input_line form-control")); ?>         
            </div>
            <div class="col-md-1" style="width: 1.333333% !important;">
               <label class="control-label">Nº:</label>
            </div>
            <div class="col-md-1" style="width: 11.666667% !important;">
               <?php echo $form->textField($model, 'numero', array("class"=>"input_line form-control")); ?>  
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 5.666667% !important;">
               <label class="control-label">Cidade:</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'cidade', array("class"=>"input_line form-control")); ?>             
            </div>
            <div class="col-md-1" style="
               width: 4.333333% !important;
               ">
               <label class="control-label">estado:</label>
            </div>
            <div class="col-md-1">
                <?php echo $form->textField($model, 'estado', array("class"=>"input_line form-control")); ?>              
            </div>
            <div class="col-md-1" style="width: 3.333333% !important;">
               <label class="control-label">CEP:</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'cep', array("class"=>"cep input_line form-control")); ?>         
            </div>
            <div class="col-md-1" style="width: 3.333333% !important;">
               <label class="control-label">CNPJ:</label>
            </div>
            <div class="col-md-2" style="width: 30.666667% !important;">
               <?php echo $form->textField($model, 'cnpj', array("id"=>"cnpj", "class"=>"cnpj input_line form-control")); ?>                
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 8.666667% !important;">
               <label class="control-label">Insc. Estadual nº:</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'inscricao_estadual', array("class"=>"input_line form-control")); ?>           
            </div>
            <div class="col-md-1" style="
               width: 4.333333% !important;
               ">
               <label class="control-label">Telefone:</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'telefone', array("class"=>"tel input_line form-control")); ?>
               
            </div>
            <div class="col-md-1" style="width: 2.333333% !important;">
               <label class="control-label">Site:</label>
            </div>
            <div class="col-md-4" style="width: 49.333333%;">
               <?php echo $form->textField($model, 'site', array("class"=>"input_line form-control")); ?>
               
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-6" style="width: 26.666667% !important;">
               <label class="control-label">Neste ato representada por seu representante legal:</label>
            </div>
            <div class="col-md-6" style="width: 70.666667% !important;">
               <?php echo $form->textField($model, 'nome_representante_legal', array("class"=>"input_line form-control")); ?>
               
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-1" style="
               width: 5.333333% !important;
               ">
               <label class="control-label">Função:</label>
            </div>
            <div class="col-md-4">
               
               <?php echo $form->textField($model, 'funcao_representante_legal', array("class"=>"input_line form-control")); ?>          
            </div>
            <div class="col-md-1" style="
               width: 3.333333% !important;
               ">
               <label class="control-label">CPF nº:</label>
            </div>
            <div class="col-md-2">
               
               <?php echo $form->textField($model, 'cpf_representante_legal', array("class"=>"cpf input_line form-control")); ?>                    
            </div>
            <div class="col-md-1" style="
               width: 4.333333% !important;
               ">
               <label class="control-label">e RG nº:</label>
            </div>
            <div class="col-md-2" style="width: 34.333333%;">
               <?php echo $form->textField($model, 'rg_representante_legal', array("class"=>"input_line form-control")); ?>                    
               
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 7.666667% !important;">
               <label class="control-label">Data de nasc:</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'data_nascimento_representante_legal', array("class"=>"data input_line form-control")); ?>                    
               
            </div>
            <div class="col-md-1" style="width: 2.666667% !important;">
               <label class="control-label">Cel</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model, 'cel_representante_legal', array("class"=>"tel input_line form-control")); ?>                    
               
            </div>
            <div class="col-md-1" style="width: 4.333333% !important;">
               <label class="control-label">E-mail:</label>
            </div>
            <div class="col-md-4" style="width: 49.333333% !important;">
               <?php echo $form->textField($model, 'email_representante_legal', array("class"=>"input_line form-control")); ?>                    
               
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-3" style="
               width: 18.333333% !important;
               ">
               <label class="control-label">E-mail para receber perguntas (site):</label>
            </div>
            <div class="col-md-8 " style="width: 78.666667% !important;">
               <?php echo $form->textField($model, 'email_pergunta', array("class"=>"input_line form-control")); ?>                    
               
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 8.666667% !important;">
               <label class="control-label">Resp. Financeiro:</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'resp_financeiro_nome', array("class"=>"input_line form-control")); ?>                    
               
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">E-mail:</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'resp_financeiro_email', array("class"=>"input_line form-control")); ?>                    
               
            </div>
            <div class="col-md-1" style="width: 2.333333% !important;">
               <label class="control-label">Tel:</label>
            </div>
            <div class="col-md-2" style="width: 30.666667% !important;">
               <?php echo $form->textField($model, 'resp_financeiro_tel', array("class"=>"tel input_line form-control")); ?>                    
               
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 8.666667% !important;">
               <label class="control-label">Resp. Anúncios:</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'resp_anuncios_nome', array("class"=>"input_line form-control")); ?>                    
               
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">E-mail:</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'resp_anuncios_email', array("class"=>"input_line form-control")); ?>                    
               
            </div>
            <div class="col-md-1" style="width: 2.333333% !important;">
               <label class="control-label">Tel:</label>
            </div>
            <div class="col-md-2" style="width: 30.666667% !important;">
               <?php echo $form->textField($model, 'resp_anuncios_tel', array("class"=>"tel input_line form-control")); ?>                    
               
            </div>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 6.666667% !important;">
               <label class="control-label">Resp. Peças:</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'resp_pecas_nome', array("class"=>"input_line form-control")); ?>                    
               
            </div>
            <div class="col-md-1" style="width: 5.333333% !important;">
               <label class="control-label">E-mail:</label>
            </div>
            <div class="col-md-3">
               <?php echo $form->textField($model, 'resp_pecas_email', array("class"=>"input_line form-control")); ?>                    
               
            </div>
            <div class="col-md-1" style="width: 2.333333% !important;">
               <label class="control-label">Tel:</label>
            </div>
            <div class="col-md-2" style="width: 32.666667% !important;">
               <?php echo $form->textField($model, 'resp_pecas_tel', array("class"=>"tel input_line form-control")); ?>                    
               
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
            <div class="col-md-3" style="width: 13.666667% !important;">
               <label class="control-label">Valor Total do Contrato R$:</label>
            </div>
            <div class="col-md-3">

               <?php echo $form->textField($model,'valor_total_contrato', array("readOnly"=>true, "class"=>"moeda input_line form-control")); ?>
            </div>
            <div class="col-md-6" style="width: 60.666667% !important;">

               <?php echo $form->textField($model,'valor_total_contrato_extenso', array("readOnly"=>true, "class"=>"input_line form-control")); ?>
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div class="col-md-2" style="width: 11.666667% !important;">
               <label class="control-label">Forma de Pagamento:</label>
            </div>
            <div class="col-md-2" style="width: 15.666667% !important;">
               
               <?php echo $form->textField($model,'num_parcelas_pagamento', array("readOnly"=>true, "class"=>"input_line form-control")); ?>        
            </div>
            <div class="col-md-2" style="width: 9.666667% !important;">
               <label class="control-label">parcela (s) de R$:</label>
            </div>
            <div class="col-md-2">
               <?php echo $form->textField($model,'valor_parcelas_pagamento', array("readOnly"=>true, "class"=>"moeda input_line form-control")); ?>           
            </div>
            <div class="col-md-4" style="width: 45.666666% !important;">
              <?php echo $form->textField($model,'valor_parcelas_pagamento_extenso', array("readOnly"=>true, "class"=>"input_line form-control")); ?>          
            </div>
         </div>
      </div>
      <br/>
      <div class="row">
         <div class="col-md-3" style="width: 12.666667% !important;">
            <label class="control-label">com vencimento todo dia:</label>
         </div>
         <div class="col-md-1" style="width: 12.333333% !important;">
            <?php echo $form->textField($model,'vencimento_parcelas_pagamento', array("readOnly"=>true, "class"=>"input_line form-control")); ?>          
         </div>
         <div class="col-md-7" style="width: 28.666667% !important;">
            <label class="control-label">de cada mês, sendo primeira parcela com vencimento dia:</label>
         </div>
         <div class="col-md-1" style="width: 45.5555555% !important;">
             <?php echo $form->textField($model,'vencimento_primeira_parcela_pagamento', array("readOnly"=>true, "class"=>"input_line form-control")); ?>            
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
         <?php echo $form->textArea($model,'observacao', array("id"=>"obs", "readOnly"=>true, "rows"=>5, "style"=>"font-size: 12px; height: 150px !important;", "class"=>"textarea")); ?>
         <br/><br/>
         <label>Autorizo a(s) publicação(ções) acima descriminada(as)</label>
      </div>
      <br/>
      <div class="row">
         <div class="form-group">
            <div style="text-align:center;" class="col-md-6">
               <img src="<?php echo $model->visto_bombarco;?>"/>
               <br /><br/><br/>
               <label>Visto Bombarco</label>
            </div>
            <div style="text-align:center;" class="col-md-6">
               <?php if($model->status == 2): ?>
               <img src="<?php echo $model->visto_contratante;?>"/>
               <br /><br/><br/>
               <label>Visto Contratante</label>
               <?php else: ?>
               <div id="visto_contratante"></div>
               <label>Visto Contratante</label>
               <br/>
               <a id="btn-refazer-ass" href="#">Refazer assinatura</a>
               <?php endif; ?>
            </div>
         </div>
      </div>
      <br/><br/><br/>
   </div>
   <!--<p style="background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px;text-align:justify;">-->
   <div id="termos">
      <p style="font-weight: bolder;text-align:center;font-size:12px;">Contrato de cessão de espaço em mídia digital e impressa</p>
      <br/>
      <p style="text-align:justify;font-size:12px;">
         Pelo presente instrumento, de um lado, como CONTRATADA, Bombarco Serviços de Informação na Internet Ltda. ME, pessoa jurídica de direito privado, com sede em Mogi das Cruzes, Estado de São Paulo, na Rua Cruzeiro do Sul, nº323, Vila Oliveira, CEP 08790-170, CNPJ/MF sob nº 10.352.973/0001-43, e, de outro lado, como <b>CONTRATANTE</b>, qualificado(a) na frente da presente folha em sua Ficha Cadastral e, em conjunto, denominadas PARTES; resolvem firmar o presente Contrato, que será regido pelas seguintes condições:
         OBJETO DO CONTRATO
         CLÁUSULA 1. O presente Contrato tem como objeto a “cessão” de espaço em mídia digital e impressa, pelo Bombarco à <b>CONTRATANTE</b>, para divulgação e veiculação de conteúdo, promoções ou ações comerciais, sem exclusividade, pela forma acordada entre as partes, no espaço publicitário do website www.bombarco.com.br, www.guiadocapitao.com.br, www.zeromilhas.com.br, no Impresso ou ainda nas redes sociais do Bombarco. 
         Parágrafo Único: A contraprestação pela cessão (“preço”), prazo de vigência do contrato, planos contratados e demais condições comerciais aplicáveis ao negócio estão contidas na Ficha Cadastral, cujos termos e condições devem ser interpretados em conjunto com as condições ora previstas neste instrumento, e, só serão modificados através de aditivo contratual. 
         CLÁUSULA 1.1. O produto Impresso, trata-se tão somente de divulgação e veiculação de conteúdo informativo ou publicitário em mídia impressa.
         CLÁUSULA 1.2. Independentemente do plano e produto contratado (mídia digital ou impressa), a <b>CONTRATANTE</b> se responsabiliza pelo envio de todo material (layout, informações, logo, e demais materiais que se fizerem necessários), para o e-mail atendimento@bombarco.com.br, sendo que a arte será enviada já de acordo com as especificações do espaço contratado. 
         CLÁUSULA 1.3. A <b>CONTRATANTE</b> com a assinatura do presente contrato e envio do material a ser divulgado, autoriza expressamente a CONTRATADA o uso de seu nome, marca, sinais distintivos e demais informações contidas no material enviado para postagem no Espaço e para os fins exclusivos desse Contrato.
         OBRIGAÇÕES DA CONTRATADA
         CLÁUSULA 2. O presente instrumento de contrato começa a contar a partir da assinatura desse instrumento, por esse motivo, a CONTRATADA obriga-se:
         A) Publicar  a publicidade no “Impresso”, desde que cumpridas as obrigações da <b>CONTRATANTE</b>.
         B) Publicar os banners no site, enviar e-mail marketing e enviar banner na news, desde que cumpridas as obrigações da <b>CONTRATANTE</b>.
         C) Liberar no sistema o espaço contratado para a <b>CONTRATANTE</b> anunciar suas embarcações e/ou empresa em até 2 (dois) dias úteis da assinatura desse contrato.
         D) Publicar as embarcações novas no website zeromilhas.com.br , de acordo com as especificações fornecidas, desde que cumpridas as obrigações da <b>CONTRATANTE</b>
         E) Gravar o Raio X no local e data previamente combinado e publicá-lo desde que cumpridas as obrigações da <b>CONTRATANTE</b>. 
         F) Fazer o post na rede social do Bombarco, desde que cumpridas as obrigações da <b>CONTRATANTE</b>.
         OBRIGAÇÕES DA <b>CONTRATANTE</b>
         CLÁUSULA 3. Da assinatura do contrato, ocorre automaticamente a reserva do espaço virtual e/ou impresso, portanto, a <b>CONTRATANTE</b> obriga-se a fornecer e enviar material publicitário, estipulados, conforme o plano adquirido, sendo: 
         A) Contratando o Plano Banner na news, disparo de e-mail marketing e/ou post na rede social deverá a <b>CONTRATANTE</b> fornecer à CONTRATADA o material publicitário de acordo com as orientações enviadas pela CONTRATADA com até 07 dias corridos de antecedência da data agendada para o envio.
         B) Contratando o Plano de Classificados, Site - Guia do Capitão, Banner e/ou Zero Milhas deverá cadastrar as embarcações, empresas e/ou enviar o material publicitário tão logo  da assinatura desse contrato.
         CLÁUSULA 3.1. No Impresso, a <b>CONTRATANTE</b> enviará o material desejável, adequado e necessário via e-mail (atendimento@bombarco.com.br) até 7 (sete) dias corridos da assinatura do contrato. 
         CLÁUSULA 3.2. Contratando o Raio X o <b>CONTRATANTE</b> deverá disponibilizar o barco a ser divulgado, barco de apoio se necessário, bem como o local que será gravado o vídeo e o todas as especificações técnicas necessárias do barco. 
         CLÁUSULA 3.3. Atualizar as informações contidas no site, sempre que houver alguma alteração. 
         CLÁUSULA 3.4. Efetuar o pagamento no valor, prazo e nas condições estabelecidas na Ficha Cadastral, sob pena de aplicação de multa moratória no valor de 2% (dois por cento) e juros de 5,9% ao mês, ambos calculados sobre o valor em atraso; bem como estará sujeito a protesto e inclusão nas entidades de protesto em caso superior a 30 dias.
         CLÁUSULA 3.5. Efetuar o pagamento da ajuda de custo com alimentação, hospedagem e transporte para a gravação do Raio X de toda a equipe disponibilizada para a execução da gravação.  
         DAS CONDIÇÕES EM GERAL
         CLÁUSULA 4. A <b>CONTRATANTE</b> deverá ler, certificar-se de haver entendido e aceitar todas as condições estabelecidas neste contrato, bem como na Política de Privacidade e Termo de Uso que consta no site Bombarco, Guia do Capitão e do Zero Milhas, antes de efetivar a contratação. A aceitação das condições descritas nestes instrumentos é absolutamente indispensável para a utilização do site. 
         CLÁUSULA 5. A CONTRATADA não é proprietária, ou intermediadora de venda das embarcações comercializadas, em hipótese alguma fará a guarda, terá posse, ou realizará as ofertas de venda. Tampouco, se responsabiliza pela entrega das mesmas, ou intervirá em negociações iniciadas através do site ou Impresso.
         CLÁUSULA 6. A <b>CONTRATANTE</b> se obriga e se responsabiliza de forma exclusiva pelo conteúdo comercial das suas informações disponibilizadas no Site www.bombarco.com.br, www.guiadocapitao.com.br, www.zeromilhas.com.br ou no Impresso, por suas negociações e/ou contratações, por quaisquer defeitos ou vícios de seus produtos ou serviços, violação de direitos autorais, de imagem, de privacidade, de propriedade industrial e do consumidor, bem como, legalidade, qualidade, segurança, entrega, transporte, informação e disponibilidade em estoque, respondendo por quaisquer prejuízos que possa vir a causar à CONTRATADA ou a terceiros.  
         CLÁUSULA 7. Este contrato não implica e nem obriga as partes na intermediação de negócios, não representa joint venture ou sociedade entre as partes, ficando esclarecido que as ações ora estabelecidas serão executadas em caráter de total autonomia, sem qualquer obrigação de exclusividade, subordinação, obtenção de resultados comerciais ou não, assim como, quantitativos de negócios oriundos da presente contratação.
         CLÁUSULA 8. A <b>CONTRATANTE</b> fornecerá, bem como, se responsabiliza pelas informações contidas nos diversos canais dos sites e do Impresso, devendo, portanto, conferi-la. 
         DO PRAZO
         CLÁUSULA 9. O prazo para cadastro de embarcações, cadastro da empresa no site - guia do capitão e envio de material de Banner e/ou zero milhas deverão ser respeitados conforme Cláusula terceira e suas alíneas, estando ciente a <b>CONTRATANTE</b> que o prazo de contratação começa a contar a partir do dia seguinte da assinatura do contrato independente se o material foi enviado e se os espaços foram preenchidos.
         Parágrafo Primeiro: O prazo para enviar peças de E-mail marketing, banner na news, post da rede social e/ou para o Impresso deverá ser respeitado conforme Cláusula terceira e suas alíneas, estando ciente a <b>CONTRATANTE</b> que em caso contrário perderá o direito do envio ou publicação. No caso do e-mail marketing a CONTRATADA remarcará um novo envio, uma única vez e de acordo com a disponibilidade da agenda. Em se tratando do Raio X, caso a equipe do Bombarco for até o local da gravação e não for possível realizar a gravação por qualquer motivo, deverá a <b>CONTRATANTE</b> arcar novamente com as despesas previstas na CLÁUSULA 3.5 deste contrato. 
         Parágrafo Segundo: Caso a <b>CONTRATANTE</b> não cumpra com os prazos da Cláusula Terceira e suas alíneas, a CONTRATADA não devolverá nenhuma quantia paga, nem tampouco estenderá o prazo já previamente acordado. A <b>CONTRATANTE</b> se responsabiliza pelas consequências que poderão surgir pela falta do cumprimento. 
         RESCISÃO
         CLÁUSULA 10. O presente contrato poderá ser rescindido a qualquer momento pela <b>CONTRATANTE</b>, mediante aviso por escrito sendo que: se cancelado até 10 dias corridos da assinatura do contrato, será cobrado multa rescisória referente a 1 (uma) parcela do valor do contrato; se cancelado após o 11º dia, será cobrada multa rescisória referente a 50% do valor em aberto que falta pagar. 
         Parágrafo Primeiro: Caso o contrato seja rescindido pela CONTRATADA ambas as partes estarão isentas de qualquer multa contratual.
         Parágrafo Segundo: Havendo falta ou atraso de pagamento por mais de 10 dias, o contrato poderá ser automaticamente rescindido e a CONTRATADA não manterá a “cessão” do espaço virtual ou do Impresso, sem prejuízo de ser cobrada a multa rescisória pertinente. 
         CLÁUSULA 10.1 – Fica vedada a cessão ou transferência, total ou parcial das responsabilidades e direitos assumidos pelas partes, exceto havendo autorização expressa da CONTRATADA.
         CLÁUSULA 10.2 – A tolerância de qualquer das PARTES, com relação ao estrito cumprimento das obrigações ora previstas, não constituirá em novação, renúncia ou revogação aos direitos ou cumprimento das demais disposições e obrigações.
         DA VIGÊNCIA DO CONTRATO
         CLÁUSULA 11. O presente contrato é renovado automaticamente, por iguais e sucessivos períodos, nos casos de contratação de Classificados, Site- Guia do Capitão, Zero Milhas, e Banner o site, sendo comunicado antecipadamente via e-mail se houver alteração em relação ao preço. A <b>CONTRATANTE</b> é a única responsável pelo cancelamento do serviço, que deverá enviar um e-mail para <u>milena@bombarco.com.br</u> solicitando o cancelamento.
         Parágrafo único: Após o cancelamento, o <b>CONTRATANTE</b> perderá todas as informações, dados e arquivos inseridos no espaço disponibilizado enquanto da vigência do contrato. 
         DO FORO
         CLÁUSULA 12. Caso as dúvidas e divergências decorrentes desse Contrato não possam ser dirimidas de comum acordo entre as partes, fica eleito o Foro da Comarca de Mogi das Cruzes - SP, como competente para solucioná-las, renunciando as partes a qualquer outro, por mais privilegiado que seja. E, por estarem justos e contratados, assinam as partes o presente Contrato em 02 (duas) vias de iguais teor e forma, para que se produzam os efeitos jurídicos e legais.  
      </p>
      <br/><br/>
      <div class="row pull-right">
         <div class="form-group">
            <div class="col-md-12">
               <label class="control-label">Mogi das Cruzes, <?php echo date('d'); ?> de <?php echo Contrato::dataExtenso(date('m')); ?> de <?php echo date('Y'); ?></label>
            </div>
         </div>
      </div>
      <br/><br/><br/><br/><br/>
      <div class="row">
         <div class="form-group">
            <div style="text-align:center;" class="col-md-6">
               <!--<input id="visto_bombarco2" type="text" class="input_line form-control">-->
               <img src="<?php echo $model->visto_bombarco;?>"/>
               <br /><br /><br />
               <label>Bombarco Serviços de Informação na Internet Ltda ME</label>
            </div>
            <div style="text-align:center;" class="col-md-6">
               <!--<input id="visto_contratante2" type="text" class="input_line form-control">-->
               <?php if($model->status == 2): ?>
               <img src="<?php echo $model->segundo_visto_contratante;?>"/>
               <br /><br /><br />
               <?php if($model->razao_social != ""): ?>
               <label><?php echo $model->razao_social; ?></label>
               <?php else: ?>
               <label>Contratante</label>
               <?php endif; ?>
               <?php else: ?>
               <div id="visto_contratante2"></div>
               <br />
               <label for="input2">Contratante</label>
               <br/>
               <a id="btn-refazer-ass-2" href="#">Refazer assinatura</a>
               <?php endif; ?>
            </div>
         </div>
      </div>
      <br/><br/><br/><br/>
      <div class="row" style="text-align: center;">
         <div class="col-md-6 pull-right">
            <div class="form-check form-check-inline">
               <label style="white-space: initial !important;" class="form-check-label">
               <input checked class="check-li form-check-input" type="checkbox" id="check1"> Li, e concordo com os termos da Ficha Cadastral e do Contrato acima.
               </label>
            </div>
         </div>
         <div class="col-md-6 pull-right">
            <div class="form-check form-check-inline">
               <label style="white-space: initial !important;" class="form-check-label">
               <input class="check-li form-check-input" checked type="checkbox" id="check2"> Estou ciente que estou assinando esse contrato eletronicamente e que este terá validade jurídica.
               </label>
            </div>
         </div>
      </div>
      <br/><br/>
      <div class="row text-center">
         <div class="col-md-12"> 
            <br/>
         </div>
         <?php if($model->status != 2): ?>
         <button class="btn btn-primary btn-lg" style="margin-left: auto;margin-right: auto" id="btn-assinar">ASSINAR CONTRATO</button>
         <?php endif; ?>
      </div>
   </div>
   <?php echo $form->hiddenField($model,'visto_contratante', array("id"=>"visto_contratante_hidden")); ?>
   <?php echo $form->hiddenField($model,'segundo_visto_contratante', array("id"=>"visto_contratante_hidden2")); ?>
   <?php echo $form->hiddenField($model,'base64_contrato', array("id"=>"base64_contrato")); ?>
   <?php echo $form->hiddenField($model,'base64_termos', array("id"=>"base64_termos")); ?>
   <?php echo $form->hiddenField($model,'status', array("id"=>"status")); ?>
   <?php $this->endWidget(); ?>
</div>
<!-- form -->
<script>
   $(document).ready(function() {
      $(".navbar-inverse").remove();
      $(".preloader").remove();
   
   
   
      $(".textarea-td").prop("disabled", true);
      
      $("#visto_contratante").jSignature();
      $("#visto_contratante2").jSignature();
   
      $(".textarea-td, .nao-muda").on("change", function() {
         location.reload();
         return false;
      });
   
      $('.data').mask('00/00/0000');
      $('.cep').mask('99999-999');
      $('.tel').mask('(99) 99999-9999');
      $('.cpf').mask('000.000.000-00');
      $('.cnpj').mask('99.999.999/9999-99');
   
      if($("#status").val() == 2) {
         
            $(".control-label").each(function() {
               var input = $(this).parent().next().find("input");
               if(input.length) {
                  var input_val = $(this).parent().next().find("input").val();
                  var label_text = input_val;
                  $(this).append("<label style='margin-left:20px;'>"+label_text+"</label>");
                  input.val("");   

               }
               
            });
            $("input").prop("disabled", true);
      }
   
   
      $("#btn-refazer-ass").on("click", function(e) {
         e.preventDefault();
         $("#visto_contratante").jSignature("reset");
      });
   
      $("#btn-refazer-ass-2").on("click", function(e) {
         e.preventDefault();
         $("#visto_contratante2").jSignature("reset");
      });
   
   
      $("#proxima").on("click", function(e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: $(document).height() }, 1000);
            //$( ".form-check" ).pulse({times: 7, duration: 500});
   
            
      });
   
      $("#btn-assinar").on("click", function(e) {
            e.preventDefault();
   
            var tipo = $("#visto_contratante").jSignature("getData","svgbase64")[0];
            var assinatura = $("#visto_contratante").jSignature("getData","svgbase64")[1];
   
            tipo = "data:"+tipo+",";
   
            var base64_visto_contratante = tipo+assinatura;
   
            tipo = $("#visto_contratante2").jSignature("getData","svgbase64")[0];
            assinatura = $("#visto_contratante2").jSignature("getData","svgbase64")[1];
   
            tipo = "data:"+tipo+",";
   
            var base64_visto_contratante2 = tipo+assinatura;
   
            $("#visto_contratante_hidden").val(base64_visto_contratante);
            $("#visto_contratante_hidden2").val(base64_visto_contratante2);
   
            if( $("#visto_contratante").jSignature('getData', 'native').length == 0 || 
               $("#visto_contratante2").jSignature('getData', 'native').length == 0) {
                $.alert({
                    title: 'Erro',
                    content: 'Por favor de os 2 vistos no contrato',
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
   
                     $("#msg-sucesso").remove();
                     $("#btn-refazer-ass").remove();
                     $("#btn-refazer-ass-2").remove();

                     // gambiarra deixar inputs bonitos no pdf
                     $(".control-label").each(function() {
                        var input = $(this).parent().next().find("input");
                        if(input.length) {
                           input.css("display", "none");
                           input.after('<input class="input_line form-control" type="text"/>');
                           var input_val = $(this).parent().next().find("input").val();
                           var label_text = input_val;
                           $(this).append("<label style='margin-left:20px;'>"+label_text+"</label>");
                        }
                        
                     });
   
                     $("#proxima").remove();
                     $(".jconfirm-box-container").remove();
                     $("#btn-assinar").remove();
                     $(".jconfirm.jconfirm-white, .jconfirm-bg").css("background-color", "initial !important");
                     
                     $(".check-li").replaceWith("<img src='http://www.bombarco.com.br/img/x_contrato.png?e=2323'/>");

   
                     $(".radio").each(function() {
                        if($(this).is(':checked')) {
                           $(this).replaceWith("<img src='http://www.bombarco.com.br/img/x_contrato.png?e2323'/>");                           
                        }
                     });
                     
                     //var target = $('.container-fluid');
                     var campos = $("#campos");
                     var termos = $('#termos');
                     


                     var p1 = new Promise(function (resolve) {
                         html2canvas(campos, {
                             onrendered: function (canvas) {
                                 resolve(canvas.toDataURL());
                             }
                         });
                     });

                     var p2 = new Promise(function (resolve) {
                         html2canvas(termos, {
                             onrendered: function (canvas2) {
                                 resolve(canvas2.toDataURL());
                             }
                         });
                     });

                     Promise.all([p1, p2]).then(function(prints) { 
                        $("#base64_contrato").val(prints[0]);
                        $("#base64_termos").val(prints[1]);
                        $("#contrato-form").submit(); 
                     });

                     
                     
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