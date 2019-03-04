
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
        <h1 class="title-admin-form">Alteração de dados - Estaleiros</h1>
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
                <label class="text-admin-form2"><d><?php echo $model->embarcacaoMacros->titulo; ?></d></label>
            </div>


            <?php if($model->estados != null): ?>
            <div id="div-estado-cidade">
                <div class="box-admin-form">
                    <span class="text-admin-form2">Estado / Cidade:</span>
                    <label class="text-admin-form2"><d><?php echo $model->estados->uf . ' / '. $model->cidades->nome; ?></d></label>
                    <div class="div-cb-admin-up4">
                         <a href="#" id="alterar-estado-cidade" class="alterar-upd">Alterar</a>
                    </div>
                </div>
             </div>
            <?php else:?>
            <div id="div-estado-cidade">
                <div class="box-admin-form">
                    <span class="text-admin-form2">Estado / Cidade:</span>
                    <div class="div-cb-admin-up4">
                         <a href="#" id="alterar-estado-cidade" class="alterar-upd">Adicionar</a>
                    </div>
                </div>
             </div>
            <?php endif;?>

        
              
            <div id="div-estado-cidade-alterar" style="display:none;">
                <div class="box-admin-form">
                    <span class="text-admin-form2">Estado</span>
                    <?php Estados::getModelDropDown($form, $model,'Embarcacoes_cidades_id'); ?>
                    <a href="#" id="cancelar-estado-cidade" class="alterar-upd">Cancelar</a>
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
                     <a href="#" id="alterar-email" class="alterar-upd">Alterar</a>
                </div>  
            </div>

            <div class="box-admin-form">
              <label class="text-admin-form2">Ano:</label> <label data-valor="<?php echo $model->ano;?>" id="ano" class="text-admin-form2"><?php echo $model->ano;?></label>
              <div class="div-cb-admin-up4">
                <a href="#" id="alterar-ano" class="alterar-upd">Alterar</a>
              </div>
            </div>


            

            <div class="box-admin-form" id="hidden-depende-macro" style="display:none;">
                <label class="text-admin-form2">Fabricante</label>
                <!-- select populado com os fabricantes de embarc via ajax -->
                <select id="fabricante-embarcacao" name="Embarcacoes[fabricante]" class="select-admin-pad"></select>

                <div class="div-cb-admin-up4">
                    <a href="#" id="cancelar-fabricante-modelo" class="alterar-upd">Cancelar</a>
              </div>
            </div>



            <div class="box-admin-form" style="display:none;" id="hidden-depende-fabricante">
                <span class="text-admin-form2">Modelos</span>
                <!-- select populado com os modelos de embarc via ajax (baseado no id do fabricante) -->
                <select id="modelo-embarcacao" name="Embarcacoes[embarcacao_modelos_id]" class="select-admin-pad"></select>
            </div>

            <div class="box-admin-form" id="div-alterar-fabricante">
                <span class="text-admin-form2">Fabricante / Modelo:</span>
                <?php echo '<label class="text-admin-form2" ><d>'.$model->embarcacaoModelos->embarcacaoFabricantes->titulo.' / '.$model->embarcacaoModelos->titulo.'</d></label>'; ?>

                    <div class="div-cb-admin-up4">
                        <a href="#" id="alterar-fabricante-modelo" class="alterar-upd">Alterar</a>
                    </div>
                
            </div>




            <div class="box-admin-form8" >
                <div class="box-admin-form" style="border-bottom: 0px;">
                    <span class="text-admin-form2">Descrição</span>
                    <?php echo $form->textArea($model, 'descricao', array('maxlength' => 1000, 'class'=>'campo-admin-form2')); ?>
                    <?php echo $form->error($model,'descricao'); ?>
                </div>    
            </div><!-- row -->

               
                        
                        <?php
                       if($model->qntmotores > 0) {
                            echo '<div class="box-admin-form">';
                            echo '<label class="text-admin-form2">Motor(es)</label>'; 
                            echo '<span class="text-admin-form2">Quantidade: <d>'.count($model->motores).'</d></span>';
                            echo '  <div class="div-cb-admin-up4" style="margin-top:20px">
                                    <input type="checkbox" id="alterar-motor" name="alterar-motor"/>
                                    </div>
                                     <span class="text-admin-form2" ><c style="top: -34px;">Alterar/Adicionar Motor(es)</c></span>

                                     </div>';

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

                         } 

                         else {
                               echo '<div class="box-admin-form">';
                            echo '<label class="text-admin-form2">Motor(es)</label>'; 
                            echo '<span class="text-admin-form2">Quantidade: <d>'.count($model->motores).'</d></span>';
                            echo '  <div class="div-cb-admin-up4" style="margin-top:20px">
                                    <input type="checkbox" id="alterar-motor" name="alterar-motor"/>
                                    </div>
                                     <span class="text-admin-form2" ><c style="top: -34px;">Alterar/Adicionar Motor(es)</c></span>

                                     </div>';
                         }
                        ?>
           

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
               
            </div> 





            <div class="box-admin-form2">
                        <div class="box-admin-form9">
                            <span class="text-admin-form2">Adicionar fotos</span>
                        </div>  
                         <div style="float:left; width:900px !important; margin-bottom: -35px;" id="foto">
                             <!-- listar imagens da embarcação -->
                                <?php
                                    // contador de imagens turbo e imagens nao turbo
                                    $contadorImgsNormais = 0;
                                    foreach($model->embarcacaoImagens as $embImg) {
                                        if($embImg->turbo == 0) 
                                            $contadorImgsNormais++;
                                    }

                                    // preencheu imagens normais
                                    if($contadorImgsNormais > 0) {

                                        // verificar se preencheu todas as imagens normais
                                        for($i = 0; $i < count($model->embarcacaoImagens); $i++) {
                                            if($model->embarcacaoImagens[$i]->turbo == 0) {
                                                echo CHtml::image(Yii::app()->request->baseUrl.'/public/embarcacoes/'.$model->embarcacaoImagens[$i]->imagem,
                                                                      "alt", array('data-id' => $model->embarcacaoImagens[$i]->id, 'class'=>'img-upload-embarc', 'width' => '100px', 'height' => '100px'));
                                                echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc'));
                                            }
                                        }

                                        // verificar se ñ preencheu todos os slots e gerar a diferença
                                        if($contadorImgsNormais < Anuncio::$_max_fotos['MAX_FOTOS_ESTALEIRO']) {
                                            for($i = $contadorImgsNormais; $i < (Anuncio::$_max_fotos['MAX_FOTOS_ESTALEIRO'] - $contadorImgsNormais) + $contadorImgsNormais; $i++) {
                                                echo CHtml::image(Yii::app()->request->baseUrl.'/img/addfoto.png',
                                                                      "alt", array('data-id' => 0, 'class'=>'img-upload-embarc', 'width' => '100px', 'height' => '100px'));
                                                echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc'));
                                            }
                                        }   
                                    }

                                    // não preencheu, vamos gerar os slots para preencher com imagens
                                    else {
                                        // gerar campos de seleção de imagem
                                        for($i = 0; $i < Anuncio::$_max_fotos['MAX_FOTOS_ESTALEIRO']; $i++) {
                                            echo CHtml::image(Yii::app()->request->baseUrl.'/img/addfoto.png',
                                                                      "alt", array('data-id' => 0, 'class'=>'img-upload-embarc', 'width' => '100px', 'height' => '100px'));
                                            echo CHtml::fileField('Embarcacoes[foto][]', null, array('class' => 'file-upload-embarc'));
                                        }
                                    }

                                ?>
                         </div>
            </div>




            <div style="clear:both;"></div>

       
             <br/><br/>

             <div class="box-admin-form2">    
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