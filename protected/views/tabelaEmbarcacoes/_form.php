

<div class="form">
    <?php $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'embarcacao-modelos-form',
        //'enableAjaxValidation' => true,
        'enableClientValidation'=>true,
        ));
    ?>

    <div class="line-admin-top">
        <div class="container">
            <p class="text2-admin-form">
                <?php echo Yii::t('app', 'Campos com '); ?> <span class="required">*</span> <?php echo Yii::t('app', 'são obrigatórios'); ?>.
            </p>
        </div>
    </div>
        <!--<div class="container"><?php echo $form->errorSummary($model); ?>-->
    <div class="line-admin-cad-mod">
        <div class="container">
            <div class="box-admin-form2">

                <div class="linha-admin-form">
                    <div class="container">

                        <div class="box-admin-form">
                        <span class="text-admin-form"><b>* Categoria</b></span>
                            <div class="embarcacao_tipos_id">
                                <?php echo $form->dropDownList($model, 'embarcacao_macros_id', GxHtml::listDataEx(EmbarcacaoMacros::model()->findAll()), array('class'=>'select-anuncio-pad', 'id'=>'macro', 'empty'=>array(''=>'Selecione'))); ?>
                            </div>
                        <?php echo $form->error($model,'embarcacao_macros_id'); ?>
                        </div><!-- row -->

                        <div class="box-admin-form">
                        <span class="text-admin-form"><b>* Fabricante</b></span>
                            <div class="embarcacao_tipos_id">
                                <?php echo $form->dropDownList($model, 'embarcacao_fabricantes_id', GxHtml::listDataEx(EmbarcacaoFabricantes::model()->findAll('status=1 ORDER BY titulo asc')), array('class'=>'select-anuncio-pad', 'id'=>'fabricante', 'empty'=>array(''=>'Selecione'))); ?>
                            </div>
                        <?php echo $form->error($model,'embarcacao_fabricantes_id'); ?>
                        </div><!-- row -->

                        <div class="box-admin-form">
                            <span class="text-admin-form"><b>* Modelo</b></span>
                                <div class="embarcacao_tipos_id">
                                    <?php echo $form->dropDownList($model, 'embarcacao_modelos_id', GxHtml::listDataEx(EmbarcacaoModelos::model()->findAll('embarcacao_fabricantes_id = :fabricante_id AND status=1 ORDER BY titulo ASC', array(':fabricante_id'=>$model->embarcacao_fabricantes_id))), array('class'=>'select-anuncio-pad', 'id'=>'modelo-embarcacao', 'empty'=>array(''=>'Selecione'))); ?>
                                </div>
                            <?php echo $form->error($model,'embarcacao_modelos_id'); ?>
                        </div><!-- row -->


                        <div class="box-admin-form">
                        <span class="text-admin-form"><b>Fabricante do motor</b></span>
                            <div class="embarcacao_tipos_id">
                                <?php echo $form->dropDownList($model, 'motor_fabricantes_id', GxHtml::listDataEx(MotorFabricantes::model()->findAll()), array('class'=>'select-anuncio-pad', 'id'=>'Motores_motor_fabricantes_id', 'empty'=>array(''=>'Selecione'))); ?>
                            </div>
                        <?php echo $form->error($model,'embarcacao_macros_id'); ?>
                        </div><!-- row -->

                        <div class="box-admin-form">
                          <span class="text-admin-form"><b>Modelo do motor</b></span>
                          <div class="embarcacao_tipos_id">
                              <?php echo $form->dropDownList($model, 'motor_modelos_id', GxHtml::listDataEx(MotorModelos::model()->findAll('motor_fabricantes_id = :motor_fabricantes_id AND status=1 ORDER BY titulo ASC', array(':motor_fabricantes_id'=>$model->motor_fabricantes_id))), array('class'=>'select-anuncio-pad', 'id'=>'Motor_modelos', 'empty'=>array(''=>'Selecione'))); ?>
                          </div>
                          <?php echo $form->error($model,'embarcacao_macros_id'); ?>
                        </div><!-- row -->
                    </div>
                </div>


                <div class="linha-admin-form">
                    <div class="container">
                        <div class="box-admin-form">
                        <span class="text-admin-form"><b>* Valor</b></span>
                        <?php echo $form->textField($model, 'valor', array('maxlength' => 100, 'class'=>'campo-admin-form')); ?>
                        <?php echo $form->error($model,'valor'); ?>
                        <div class="errorMessage" id="valor"></div>
                        </div><!-- row -->

                        <div class="box-admin-form">
                        <span class="text-admin-form"><b>* Ano</b></span>
                        <?php echo $form->textField($model, 'ano', array('maxlength' => 4, 'class'=>'campo-admin-form')); ?>
                        <?php echo $form->error($model,'ano'); ?>
                        </div><!-- row -->

                        <div class="box-admin-form">
                        <span class="text-admin-form"><b>* Pés</b></span>
                        <?php echo $form->textField($model, 'pes', array('class'=>'campo-admin-form')); ?>
                        <?php echo $form->error($model,'pes'); ?>
                        </div><!-- row -->
                    </div>
                </div>


                <div class="linha-admin-form">
                    <div class="container">
                        <div class="box-admin-form">
                        <span class="text-admin-form"><b>* Tipo do Motor</b></span>
                        <div class="embarcacao_tipos_id">
                            <?php echo $form->dropDownList($model, 'motor_tipos_id', GxHtml::listDataEx(MotorTipos::model()->findAllAttributes(null, true)), array('class'=>'select-anuncio-pad')); ?>
                            </div>
                            <?php echo $form->error($model,'motor_tipos_id'); ?>
                        </div><!-- row -->

                        <div class="box-admin-form">
                            <span class="text-admin-form"><b>* Potência</b></span>
                            <?php echo $form->textField($model, 'potenciamotor', array('maxlength' => 40, 'class'=>'campo-admin-form')); ?>
                            <?php echo $form->error($model,'potenciamotor'); ?>
                            <div class="errorMessage" id="potenciamotor"></div>
                        </div><!-- row -->

                        <div class="box-admin-form">
                        <span class="text-admin-form"><b>* Quantidade</b></span>
                        <div class="embarcacao_tipos_id">
                            <?php echo $form->dropDownList($model, 'qtdemotores', array(0, 1, 2, 3, 4, 5), array('id'=>'qnt-motores', 'class'=>'select-anuncio-pad')); ?>
                            </div>
                            <?php echo $form->error($model,'qtdemotores'); ?>
                        </div><!-- row -->


                    </div>
                </div>



                <div class="linha-admin-form">
                    <div class="container">
                        <?php /* ?>
                            <label><?php echo GxHtml::encode($model->getRelationLabel('embarcacoes')); ?></label>
                            <?php echo $form->checkBoxList($model, 'embarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>
                            <label><?php echo GxHtml::encode($model->getRelationLabel('tabelaEmbarcacoes')); ?></label>
                            <?php echo $form->checkBoxList($model, 'tabelaEmbarcacoes', GxHtml::encodeEx(GxHtml::listDataEx(TabelaEmbarcacoes::model()->findAllAttributes(null, true)), false, true)); ?>
                            <?php */
                            ?>
                        <?php
                        echo GxHtml::submitButton(Yii::t('app', 'SALVAR'), array('class'=>'botao-cad-admin', 'id'=>'cadastrar-modelo'));
                        $this->endWidget();
                        ?>
                        <br/><br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- form -->



