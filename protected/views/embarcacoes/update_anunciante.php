
<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'embarcacoes-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableClientValidation'=>true,
));
?>

    
<div class="line-admin-top2">
    <div class="container">
        <h1 class="title-admin-form">Alteração de dados - Embarcações</h1>
        <div class="sucessmsg">
        <?php
            echo $erro;
        ?>
        </div>
    </div>
</div>


<div class="line-admin-cad-mod">
    <div class="container">
        <div class="box-admin-form2">
        
            <div class="box-admin-form">
                <label class="text-admin-form2">Tipo da Embarcação:<label> 
                <label class="text-admin-form2" style="margin-top:-6px"><d><?php echo $model->embarcacaoMacros->titulo; ?></d></label>
            </div>


            <div id="div-estado-cidade">
                <div class="box-admin-form">
                    <span class="text-admin-form2">Estado / Cidade:</span>
                    <label class="text-admin-form2"><d><?php echo $model->estados->uf . ' / '. $model->cidades->nome; ?></d></label>
                    <div class="div-cb-admin-up4">
                         <span id="alterar-estado-cidade" class="alterar alterar-upd">Alterar</span>
                    </div>
                </div>
            </div>
        
              
            <div id="div-estado-cidade-alterar" style="display:none;">
                <div class="box-admin-form">
                    <span class="text-admin-form2">Estado</span>
                    <?php Estados::getModelDropDown($form, $model,'Embarcacoes_cidades_id'); ?>
                    <span id="cancelar-estado-cidade" class="alterar-upd">Cancelar</span>
                </div>
                <div class="box-admin-form">
                    <span class="text-admin-form2">Cidade</span>
                    
                        <?php echo $form->dropDownList($model,'cidades_id', array(''=>'selecione')); ?>
                </div>     
            </div>

                  
            <div class="box-admin-form">
                <span class="text-admin-form2">Email:</span>
                 <label class="text-admin-form2" data-valor="<?php echo $model->email;?>" id="email"><?php echo $model->email; ?></label>
                   <div class="div-cb-admin-up4">
                     <span id="alterar-email" class="alterar alterar-upd">Alterar</span>
                </div>  
            </div>

            <div class="box-admin-form">
              <label class="text-admin-form2" style="margin-right:80px">Ano:</label><label data-valor="<?php echo $model->ano;?>" id="ano" class="text-admin-form2"><?php echo $model->ano;?></label>
              <div class="div-cb-admin-up4">
                <span id="alterar-ano" class="alterar alterar-upd">Alterar</span>
              </div>
            </div>

           <div class="box-admin-form">
              <label class="text-admin-form6">Valor R$:</label> <label data-valor="<?php echo $model->valor;?>" id="valor" class="text-admin-form2"><?php echo Utils::formataValorView($model->valor);?></label>
              <div class="div-cb-admin-up4">
               <span id="alterar-valor" class="alterar alterar-upd">Alterar</span>
              </div>
            </div>

            <div class="box-admin-form">
              <label class="text-admin-form6">Novo/Usado:</label> <label data-valor="<?php echo $model->estado;?>" id="novo" class="text-admin-form2"><?php echo $model->estado == 'U' ? 'Usado' : 'Novo';?></label>
              <div class="div-cb-admin-up4">
               <span id="alterar-novo" class="alterar alterar-upd">Alterar</span>
              </div>
            </div>


            

            <div class="box-admin-form" id="hidden-depende-macro" style="display:none;">
                <label class="text-admin-form2">Fabricante</label>

                <select id="fabricante-embarcacao" name="Embarcacoes[fabricante]" class="select-admin-pad"></select>

                <div class="div-cb-admin-up4">
                    <span id="cancelar-fabricante-modelo" class="alterar alterar-upd">Cancelar</span>
              </div>
            </div>



            <div class="box-admin-form" style="display:none;" id="hidden-depende-fabricante">
                <span class="text-admin-form2">Modelos</span>
 
                <select id="modelo-embarcacao" name="Embarcacoes[embarcacao_modelos_id]" class="select-admin-pad"></select>



            </div>

            <div class="box-admin-form" id="div-alterar-fabricante">
                <span class="text-admin-form2">Fabricante / Modelo:</span>
                <?php echo '<label class="text-admin-form2" ><d>'.$model->embarcacaoFabricantes->titulo.' / '.$model->embarcacaoModelos->titulo.'</d></label>'; ?>
                    <!--<div class="div-cb-admin-up4">
                        <span id="alterar-fabricante-modelo" class="alterar alterar-upd">Alterar</span>
                    </div> -->
            </div>

                <div class="box-admin-form" id="div-alterar-fabricante">
                <span class="text-admin-form2">Dados do Modelo:</span>

                <!-- se for jetski, exibiremos campos do modelo de embarc de jetski -->
                <?php if($model->embarcacao_macros_id == Anuncio::$_categoria_embarcacao['JETSKI']): ?> 

                <label class="text-admin-form2">
                    
                    <?php if($model->embarcacaoModelos->motor_de_fabrica != null):?>   
                        <d id="motor-modelo">Motor: <?php echo $model->embarcacaoModelos->motor_de_fabrica == null ? 'Não informado' : $model->embarcacaoModelos->motor_de_fabrica; ?></d><br/>
                        <d id="tipo-modelo">Tipo: <?php echo $model->embarcacaoModelos->embarcacaoTipos == null ? 'Não informado' : $model->embarcacaoModelos->embarcacaoTipos->titulo; ?></d><br/>
                    <?php endif;?>
                </label>

                <!-- não é jetski -->
                <?php else:?>

                <label class="text-admin-form2">
                    <d id="tipo-modelo">Tipo: <?php echo $model->embarcacaoModelos->embarcacaoTipos == null ? 'Não informado' : $model->embarcacaoModelos->embarcacaoTipos->titulo; ?></d><br/>
                    <d id="tamanho-modelo">Tamanho: <?php echo $model->embarcacaoModelos->tamanho == null ? 'Não informado' : number_format($model->embarcacaoModelos->tamanho, 0, '.', '').' pés'; ?></d><br/>
                    <d id="pass-dia-modelo">Pass Dia: <?php echo $model->embarcacaoModelos->passageiros; ?></d><br/> 
                    <d id="pass-noite-modelo">Pass Noite: <?php echo $model->embarcacaoModelos->acomodacoes; ?></d><br/>
                </label>
                <?php endif;?>
                
            </div>

            <!-- listagem das info do(s) motor(es) -->
            <div class="box-admin-form11" style="margin-top:15px;">
                
                    <?php
                    echo '<span id="alterar-acessorios" class="alterar alterar-upd">Alterar/Adicionar Acessórios</span>';
                        if(count($model->embarcacaoAcessorioses) > 0) {

                            $array_acessorios = array();

                                echo '<div>

                                    <div>';
                                    
                                        echo '<span class="text-l2-bloco-deemb">';

                                        foreach($model->embarcacaoAcessorioses as $acessorio) {                                       
                                                $array_acessorios[] = $acessorio->acessorios->titulo;
                                        }

                                        echo implode(' / ', $array_acessorios);
                                         
                                        echo '</span>';

                                    echo '</div>
                                </div>';

                                
                        }

                       
                        ?>
                <br/><br/>
            </div>
   


     
            <div class="box-admin-form2">   
                <div id="acessorios-jetski" style="display:none";>
                    <div id="equipamentos-jetski">
                         <span class="text-admin-form5">Acessórios e Equipamentos</span>
                        <?php

                            foreach($acessoriosJetSki as $acessorio) {
                 
                                print '<br/>';
                                if(in_array($acessorio->id, $acessoriosJatem)) {

                                    print '<input disabled class="check-acessorio" type="checkbox" checked value="'.$acessorio->id.'" name="Embarcacoes[acessorios][jetski][]"/>';    
                                } 
                                else {
                                    print '<input disabled class="check-acessorio" type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][jetski][]"/>';    
                                }
                                print '<div class="text-admin-acs">';
                                print $acessorio->titulo;
                                print '</div>';
                            }
                        ?>
                    </div>
                </div>
                <!-- fim acessorios jetski -->

                <!-- div de acessorios de lancha -->
                
                <div id="acessorios-lancha" style="display:none;">

                    <div class="box-admin-form7 box-acessorios">
                        <div id="equipamentos-lancha" style="float:left;">
                            <span class="text-admin-form5">Acessórios e Equipamentos</span>
                            <?php
                                foreach($acessoriosLancha as $acessorio) {
                                    if($acessorio->acessorio_tipos_id == 1) {
                                        print '<br/>';
                                       if(in_array($acessorio->id, $acessoriosJatem)) {

                                            print '<input disabled class="check-acessorio" type="checkbox" checked value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';    
                                        } 
                                        else {
                                            print '<input disabled class="check-acessorio" type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';    
                                        }
                                        print '<div class="text-admin-acs">';
                                        print $acessorio->titulo;
                                        print '</div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>

                    <div class="box-admin-form7 box-acessorios">
                        <div id="navegacao-lancha" style="float:left;">
                            <span class="text-admin-form5">Comunicação e Navegação</span>
                            <?php
                                foreach($acessoriosLancha as $acessorio) {
                                    if($acessorio->acessorio_tipos_id == 2) {
                                        print '<br/>';
                                       if(in_array($acessorio->id, $acessoriosJatem)) {

                                            print '<input disabled class="check-acessorio" type="checkbox" checked value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';    
                                        } 
                                        else {
                                            print '<input disabled class="check-acessorio" type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';    
                                        }
                                        print '<div class="text-admin-acs">';
                                        print $acessorio->titulo;
                                        print '</div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="box-admin-form7 box-acessorios">    
                        <div id="eletronicos-lancha" style="float:left;">
                            <span class="text-admin-form5">Eletrônicos</span>
                            <?php
                                foreach($acessoriosLancha as $acessorio) {
                                    if($acessorio->acessorio_tipos_id == 3) {
                                        print '<br/>';
                                        if(in_array($acessorio->id, $acessoriosJatem)) {

                                            print '<input disabled class="check-acessorio" type="checkbox" checked value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';    
                                        } 
                                        else {
                                            print '<input disabled class="check-acessorio" type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';    
                                        }
                                        print '<div class="text-admin-acs">';
                                        print $acessorio->titulo;
                                        print '</div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>

                  
                </div>
                <!-- fim acessorios lancha -->

                <div id="acessorios-veleiro" style="display:none;">
                    
                    <div class="box-admin-form7 box-acessorios">    
                        <div id="eletronicos-lancha" style="float:left;">
                            <span class="text-admin-form5">Vela Genoa</span>
                            <?php
                                foreach($acessoriosVeleiro as $acessorio) {
                                    if($acessorio->acessorio_tipos_id == 4) {
                                        print '<br/>';
                                        if(in_array($acessorio->id, $acessoriosJatem)) {

                                            print '<input disabled class="check-acessorio" type="checkbox" checked value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';    
                                        } 
                                        else {
                                            print '<input disabled class="check-acessorio" type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';    
                                        }
                                        print '<div class="text-admin-acs">';
                                        print $acessorio->titulo;
                                        print '</div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>

                      <div class="box-admin-form7 box-acessorios">    
                        <div id="eletronicos-lancha" style="float:left;">
                            <span class="text-admin-form5">Vela Mestra</span>
                            <?php
                                foreach($acessoriosVeleiro as $acessorio) {
                                    if($acessorio->acessorio_tipos_id == 5) {
                                        print '<br/>';
                                        if(in_array($acessorio->id, $acessoriosJatem)) {

                                            print '<input disabled class="check-acessorio" type="checkbox" checked value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';    
                                        } 
                                        else {
                                            print '<input disabled class="check-acessorio" type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';    
                                        }
                                        print '<div class="text-admin-acs">';
                                        print $acessorio->titulo;
                                        print '</div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- fim div acessorios -->

           
            <!-- motores -->         
            <?php

                // verificar se é jetski, jetski possui um motor diferente das demais embarcs
                if($model->embarcacao_macros_id != Anuncio::$_categoria_embarcacao['JETSKI']) {
                    echo '<div class="box-admin-form">';
                    echo '<label class="text-admin-form2">Motor(es)</label>'; 
                    echo '<span class="text-admin-form2">Quantidade: <d>'.count($model->motores).'</d></span>';
                    echo '  <div class="div-cb-admin-up4" style="margin-top:20px">
                            <input type="checkbox" id="alterar-motor" name="alterar-motor"/>
                            </div>
                             <span class="text-admin-form2" ><c style="top: -34px;">Alterar/Adicionar Motor(es)</c></span>
                             </div>';
                }


                if(count($model->motores) > 0) {
                    echo '<div class="box-admin-form">';         
                    echo '<span class="text-admin-form2">Marca: <d>'.@$model->motores[0]->motorModelos->motorFabricantes->titulo.'</d></span>';
                    echo '</div>';

                    echo '<div class="box-admin-form">';
                    echo '<span class="text-admin-form2">Modelo: <d>'.@$model->motores[0]->motorModelos->titulo.'</d></span>';
                    echo '</div>';

                    echo '<div class="box-admin-form">';
                    echo '<span class="text-admin-form2">Potência: <d>'.@$model->motores[0]->motorModelos->potencia.'</d></span>';
                    echo '</div>';

                    echo '<div class="box-admin-form">';
                    echo '<span class="text-admin-form2">Tipo: <d>'.@$model->motores[0]->motorModelos->motorTipos->titulo.'</d></span>';
                    echo '</div>';


                    echo '<div class="box-admin-form">';
                    echo '<span class="text-admin-form2">Horas: <d>'.@$model->motores[0]->horas.'</d></span>';
                    echo '</div>';
                }

             
            ?>
           

            <!-- div motor (veleiro e lanche) -->
             <div id="div-motor" style="display:none;">
                <div class="box-admin-form">
                    <label class="text-admin-form2">Sem motor</label>
                    <div class="div-cb-admin-up4">   
                     <input type="checkbox" name="check-nao-tem-motor" id="check-nao-tem-motor"/>
                    </div>
                </div>
                <div class="box-admin-form">
                    <span class="text-admin-form2">Quantidade</span>
                    <div class="opa">
                    <?php echo CHtml::dropDownList('Embarcacoes[qntmotores]', '', array(1, 2, 3, 4, 5), array('id'=>'qnt-motores')); ?>
                    </div>
                </div>
                <div class="box-admin-form">
                    <span class="text-admin-form2">Marcas</span>
                    <div class="opa">
                        <?php echo CHtml::dropDownList('Embarcacoes[motor_marca]', '',
                            GxHtml::listDataEx(MotorFabricantes::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status'=>1))),  
                            array('prompt'=>'Selecione', 'id'=>'Embarcacoes_motor_marca', 'class'=>'motor_fabricante')); ?>
                </div>
                </div>
                <div class="box-admin-form">
                        <span class="text-admin-form2">Modelos</span> 
                        <?php echo CHtml::dropDownList('Embarcacoes[motor_modelo]','', array(), array('prompt'=>'Selecione', 'class'=>'modelo-motor opa')); ?>
                </div>
                <div class="box-admin-form">
                       <span class="text-admin-form2">Tipo de Motor</span>
                        <?php echo CHtml::dropDownList('Embarcacoes[motor_tipo]','', array(), array('prompt'=>'Selecione', 'class'=>'motor_tipo opa')); ?>
                </div>
                <div class="box-admin-form">
                    <span class="text-admin-form2">Potencia do Motor</span>
                    <?php echo CHtml::dropDownList('Embarcacoes[motor_potencia]','', array(), array('prompt'=>'Selecione', 'class'=>'motor-potencia opa')); ?>
                </div>
                <div class="box-admin-form">
                    <span class="text-admin-form2">Horas de uso / Motor</span>
                    <?php echo CHtml::textField('Embarcacoes[motor_horas]','',array('maxlength' => 45, 'class'=>'campo-admin-form opa')); ?>
                </div>
            </div> 
            <!-- fim div motor -->

            <!-- div motor (jetski) -->
              <div class="box-admin-form" id="div-motor-jetski" style="display:none;">
                    <span class="text-admin-form2">Motor</span>
                    <?php echo CHtml::textField('Embarcacoes[motordefabrica]','',array('maxlength' => 45, 'class'=>'campo-admin-form opa')); ?>
                </div>
            <!-- fim div motor -->


            <div class="box-admin-form8">
   
                    <span class="text-admin-form2">Descrição</span>
                    <?php echo $form->textArea($model, 'descricao', array('maxlength' => 4000, 'class'=>'campo-admin-form2')); ?>
                    <?php echo $form->error($model,'descricao'); ?>
    
            </div><!-- row -->

            <?php if(Embarcacoes::checkTurbo($model, 'titulo') == true):?>

                <div class="box-admin-form" >
                    <span class="text-admin-form2">Título</span>
                    <?php echo $form->textField($model, 'titulo', array('class'=>'campo-admin-form5')); ?>
                    <?php echo $form->error($model,'titulo'); ?>
                </div>    

            <?php endif;?>

              <?php if(Embarcacoes::checkTurbo($model, 'video') == true):?>

                <div class="box-admin-form" >
                    <span class="text-admin-form2">Vídeo</span>
                    <?php echo $form->textField($model, 'video', array('class'=>'campo-admin-form5')); ?>
                    <?php echo $form->error($model,'video'); ?>
                </div>    

            <?php endif;?>

            <!-- fim motores -->

            <div class="box-admin-form2">
                        <div class="box-admin-form9">
                            <span class="text-admin-form2">Adicionar fotos</span>
                        </div>  
                         <div style="float:left; max-width: 900px;" id="foto">
                             <!-- listar imagens da embarcação -->
                                <?php
                                    // contador de imagens turbo e imagens nao turbo
                                    $contadorImgsNormais = 0;
                                    $contadorImgsTurbo = 0;
                                    foreach($model->embarcacaoImagens as $embImg) {
                                        if($embImg->turbo == 0) 
                                            $contadorImgsNormais++;
                                        else
                                            $contadorImgsTurbo++;
                                    }

                                    // preencheu imagens normais
                                    if($contadorImgsNormais > 0) {

                                        // verificar se preencheu todas as imagens normais
                                        for($i = 0; $i < count($model->embarcacaoImagens); $i++) {
                                            if($model->embarcacaoImagens[$i]->turbo == 0) {
                                                echo '<div class="box-imagem">';
                                                echo '<a id="'.$i.'" style="color:red;" class="deletar-foto">X</a>';
                                                echo CHtml::image(Yii::app()->request->baseUrl.'/public/embarcacoes/'.$model->embarcacaoImagens[$i]->imagem,
                                                                      "alt", array('id'=>'image-'.$i, 'data-id' => $model->embarcacaoImagens[$i]->id, 'class'=>'img-upload-embarc', 'width' => '100px', 'height' => '100px'));
                                                echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc', 'id'=>'file-'.$i));
                                                echo '</div>';
                                            }
                                        }

                                        // verificar se ñ preencheu todos os slots e gerar a diferença
                                        if($contadorImgsNormais < Anuncio::$_max_fotos['MAX_FOTOS_EMBARCACAO']) {
                                            for($i = $contadorImgsNormais; $i < (Anuncio::$_max_fotos['MAX_FOTOS_EMBARCACAO'] - $contadorImgsNormais) + $contadorImgsNormais; $i++) {
                                                echo '<div class="box-imagem">';
                                                echo CHtml::image(Yii::app()->request->baseUrl.'/img/addfoto.png',
                                                                      "alt", array('data-id' => 0, 'class'=>'img-upload-embarc'));
                                                echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc'));
                                                echo '</div>';
                                            }
                                        }   
                                    }

                                    // não preencheu, vamos gerar os slots para preencher com imagens
                                    else {
                                        // gerar campos de seleção de imagem
                                        for($i = 0; $i < Anuncio::$_max_fotos['MAX_FOTOS_EMBARCACAO']; $i++) {

                                            echo CHtml::image(Yii::app()->request->baseUrl.'/img/addfoto.png',
                                                                      "alt", array('data-id' => 0, 'class'=>'img-upload-embarc', 'width' => '100px', 'height' => '100px'));
                                            echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc'));
                                        }
                                    }

                                ?>
                         </div>
            </div>

             
           <div class="box-admin-form2" id="turbinadas">

                <?php

                // array q contem as flags dos recs adicionais q o usuario ja tem
                $recAdicionaisJaTem = array();
               
                foreach($model->embarcacaoRecursosAdicionaises as $embRecAdicional) {
                    $recAdicionaisJaTem[] = $embRecAdicional->flag;
                }

                // loop pelos recs adicionais (listar os que ele ñ tem)
                foreach($recursosAdicionais as $embRecAdicional) {
                   
                    // rec adicional de fotos
                    if($embRecAdicional->flag == 'fotos' && Embarcacoes::checkTurbo($model, 'fotos') == true) {
                        // já tinha marcado rec adicional de fotos
                        if(in_array('fotos', $recAdicionaisJaTem)) {

                            // preencheu imagens
                            if($contadorImgsTurbo > 0) {

                                // echo '<br/><br/>';
                                echo '<div id="div-alterar-fotos">';

                                // verificar se preencheu todas as imagens normais
                                for($i = 0; $i < count($model->embarcacaoImagens); $i++) {
                                    if($model->embarcacaoImagens[$i]->turbo == Anuncio::$_img_turbo['TURBO']) {
                                        echo '<div class="box-imagem">';
                                        echo '<a id="'.$i.'" style="color:red;" class="deletar-foto">X</a>';
                                        echo CHtml::image(Yii::app()->request->baseUrl.'/public/embarcacoes/'.$model->embarcacaoImagens[$i]->imagem,
                                                          "alt", array('id'=>'image-'.$i,'data-id' => $model->embarcacaoImagens[$i]->id, 'class'=>'img-turbinada img-upload-embarc', 'width' => '100px', 'height' => '100px'));
                                        echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc'));
                                        echo '</div>';
                                    }
                                }

                                // verificar se ñ preencheu todos os slots e gerar a diferença
                                if($contadorImgsNormais < Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMBARCACAO']) {
                                    for($i = $contadorImgsTurbo; $i < (Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMBARCACAO'] - $contadorImgsTurbo) + $contadorImgsTurbo; $i++) {
                                        echo '<div class="box-imagem">';
                                        echo CHtml::image(Yii::app()->request->baseUrl.'/img/addfoto.png',
                                                          "alt", array('data-id' => 0, 'class'=>'img-turbinada img-upload-embarc', 'width' => '100px', 'height' => '100px'));
                                        echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc'));
                                        echo '</div>';
                                    }
                                }   
                            }

                            // não preencheu, vamos gerar os slots para preencher com imagens
                            else {
                                // gerar campos de seleção de imagem
                                for($i = 0; $i < Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMBARCACAO']; $i++) {
                                    echo CHtml::image(Yii::app()->request->baseUrl.'/img/addfoto.png',
                                                          "alt", array('data-id' => 0, 'class'=>'img-turbinada img-upload-embarc', 'width' => '100px', 'height' => '100px'));
                                    echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc'));
                                }
                            }

                            echo '</div>';
                        }
                    }
                  

                    // verifica se tem 
                }

                ?>

             </div>
             <br/><br/>

             <div class="box-admin-form2" style="margin-top:50px;">    
                <div class="box-admin-form">

                        <?php
                        echo GxHtml::submitButton(Yii::t('app', 'ALTERAR'),array('class'=>'botao-cad-admin'));
                        echo '<br/>';


                        $this->endWidget();
                        ?>
                 </div> 
            </div>
        </div>    



<input type="hidden" value="<?php echo $model->embarcacaoMacros->id;?>" id="macro-embarc-hidden"/>
<input type="hidden" value="<?php echo $model->embarcacaoModelos->embarcacaoFabricantes->id?>" id="fabricante-embarc-hidden"/>