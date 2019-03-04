<div id="info-anuncio">
    <div style="font-weight:bolder; font-style:italic;float:left;">
        <?php
        print ($qntPermitida == 0) ? 'Ilimitadas' : $qntPermitida;
        print ' embarcações por ';
        print $meses;
        print ' meses';
        ?>
    </div>
    <div style="float:left;margin-left:20px;" id="separador">===></div>
    <div style="font-weight:bolder; font-style:italic;float:left;margin-left:20px;">
        <?php
        print 'Cadastro do anúncio ';
        print $qntAnunciosCadastrados + 1;
        print ($qntPermitida != 0) ? '/' . $qntPermitida : '';
        ?>
    </div>
</div>

<div style="clear:both;"></div>
<br/><br/><br/>

<div class="form">


    <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'embarcacoes-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'enableClientValidation' => true,
    ));
    ?>

    <div style="font-weight:bolder; color:red; font-style:italic;">
        <?php
        echo $erro;
        ?>
    </div>

    <?php echo CHtml::link('Pagamento', array('anuncioPagamento')); ?>

    <br/><br/><br/>
    <label>Localização</label>
    <div class="pure-g">
        <div class="pure-u-1-3">
            <?php echo $form->labelEx($model, 'uf'); ?>
            <?php Estados::getDropDown('Embarcacoes[estados_id]', 'Embarcacoes_cidades_id'); ?>
            <?php echo $form->error($model, 'uf'); ?>
        </div>
        <div class="pure-u-1-3">
            <?php echo $form->labelEx($model, 'cidade'); ?>
            <?php echo CHtml::dropDownList('Embarcacoes[cidades_id]', '', array(), array('prompt' => 'Cidades')); ?>
            <?php echo $form->error($model, 'cidade'); ?>
        </div>
    </div>

    <br/>
    <div class="row">
        <table>
            <tr>
                <?php
                echo $form->radioButtonList(
                        $model, 'embarcacaoMacros', array('1'=>'Jetski', '2'=>'Lancha', '3'=>'Veleiro', '4'=>'Barcos de Pesca'), array('template' => "
                             <td>
                                 {input}
                            </td>
                            <td>
                                 {label}
                           </td>", 'class' => 'Embarcacao-macros-id', 'name' => 'Embarcacoes[embarcacao_macros_id]'));
                ?>
            </tr>
        </table>
    </div>
    <br/>
    <div class="pure-g">
        <div class="pure-u-1-3">
<?php echo $form->labelEx($model, 'estado'); ?>
            <?php echo $form->radioButtonList($model, 'estado', array('N' => 'Novo', 'U' => 'Usado')); ?>
            <?php echo $form->error($model, 'estado'); ?>
        </div>
        <div class="pure-u-1-3">
<?php echo $form->labelEx($model, 'ano'); ?>
            <?php echo $form->textField($model, 'ano'); ?>
            <?php echo $form->error($model, 'ano'); ?>
        </div>
        <div class="pure-u-1-3">
<?php echo $form->labelEx($model, 'valor'); ?>
            <?php echo 'R$' . $form->textField($model, 'valor', array('maxlength' => 20, 'data-maxprice' => $maxprice)); ?>
            <?php echo $form->error($model, 'valor'); ?>
        </div>
    </div>
    <br/>
    <div class="pure-g">
        <div class="pure-u-1-3" id="hidden-depende-macro" style="display:none;">
<?php echo CHtml::label('Fabricante', ''); ?>
            <!-- select populado com os fabricantes de embarc via ajax -->
            <select id="fabricante-embarcacao" name="Embarcacoes[fabricante]"></select>
        </div>
        <div class="pure-u-1-3" style="display:none;" id="hidden-depende-fabricante">
<?php echo CHtml::label('Modelos', ''); ?>
            <!-- select populado com os modelos de embarc via ajax (baseado no id do fabricante) -->
            <select id="modelo-embarcacao" name="Embarcacoes[embarcacao_modelos_id]"></select>
            Nao encontrou modelo do fabricante?<input type="checkbox" id="n-encontrou-modelo-fabricante"/>
        </div>
    </div>

    <br/>
    <div id="hidden-depende-modelo" style="display:none;">
        <div class="pure-g">
            <div class="pure-u-1-3">
<?php echo CHtml::label('Tipo', ''); ?>
                <div id="div-embarcacoes-tipo">
                <?php echo CHtml::textField('Embarcacoes[tipo]', ''); ?>
                </div>
            </div>

            <div class="pure-u-1-3">
<?php echo CHtml::label('Tamanho', ''); ?>
                <?php echo CHtml::textField('Embarcacoes[tamanho]', ''); ?>
            </div>

            <div class="pure-u-1-3">
                <label>Numero de passageiros</label>
                <div style="float:left"><?php echo 'Dia ' . CHtml::textField('Embarcacoes[dia]', ''); ?></div>

                <div style="float:left"><?php echo 'Noite ' . CHtml::textField('Embarcacoes[noite]', ''); ?></div>
            </div>

        </div>

        <!-- motor -->
        <label>Motor</label>
        </br>
        <div class="pure-g">
            <div class="pure-u-1-3">
<?php echo CHtml::label('Quantidade', ''); ?>
                <?php echo CHtml::dropDownList('Embarcacoes[qntmotores]', '', array(1, 2, 3, 4, 5), array('id' => 'qnt-motores')); ?>
            </div>
            <div class="pure-u-1-3">
                <label>Sem motor</label><input type="checkbox" id="check-nao-tem-motor"/>
            </div>

            <div id="div-motor">
                <div class="pure-u-1-3">
<?php echo CHtml::label('Marcas', ''); ?>
                    <?php MotorFabricantes::getDropDown('Embarcacoes[motor_marca]', 'Embarcacoes_motor_modelo'); ?>
                </div>
                <div class="pure-u-1-3">
<?php echo CHtml::label('Modelos', ''); ?>
                    <?php echo CHtml::dropDownList('Embarcacoes[motor_modelo]', '', array(), array('prompt' => 'Selecione', 'class' => 'modelo-motor')); ?>
                </div>
                <div class="pure-u-1-3">
<?php echo CHtml::label('Tipo (Motor)', ''); ?>
                    <?php echo CHtml::dropDownList('Embarcacoes[motor_tipo]', '', array(), array('prompt' => 'Selecione', 'class' => 'motor_tipo')); ?>
                </div>
                <div class="pure-u-1-3">
<?php echo CHtml::label('Potencia (Motor)', ''); ?>
                    <?php echo CHtml::dropDownList('Embarcacoes[motor_potencia]', '', array(), array('prompt' => 'Selecione', 'class' => 'motor-potencia')); ?>
                </div>
                <div class="pure-u-1-3">
<?php echo CHtml::label('Horas (Motor)', ''); ?>
                    <?php echo CHtml::textField('Embarcacoes[motor_horas]', ''); ?>
                </div>
            </div>
        </div>
    </div>

    <br/><br/>

    <div id="hidden-depende-macro2">

        <!-- essa div contem os acessorios -->
        <div id="div-acessorios">

            <!-- div de acessorios do jetski -->
            <div id="acessorios-jetski" style="display:none;">
                <div id="equipamentos-jetski">
                    <label>Acessórios e Equipamentos</label>
<?php
foreach ($acessoriosJetSki as $acessorio) {
    print '<br/>';
    print '<input type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][jetski][]"/>';
    print $acessorio->titulo;
}
?>
                </div>
            </div>
            <!-- fim acessorios jetski -->

            <!-- div de acessorios de lancha -->
            <div id="acessorios-lancha" style="display:none;">
                <div id="equipamentos-lancha" style="float:left;">
                    <label>Acessórios e Equipamentos</label>
                    <?php
                    foreach ($acessoriosLancha as $acessorio) {
                        if ($acessorio->acessorio_tipos_id == 1) {
                            print '<br/>';
                            print '<input type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                            print $acessorio->titulo;
                        }
                    }
                    ?>
                </div>
                <div id="navegacao-lancha" style="float:left;">
                    <label>Comunicação e Navegação</label>
                    <?php
                    foreach ($acessoriosLancha as $acessorio) {
                        if ($acessorio->acessorio_tipos_id == 2) {
                            print '<br/>';
                            print '<input type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                            print $acessorio->titulo;
                        }
                    }
                    ?>
                </div>
                <div id="eletronicos-lancha" style="float:left;">
                    <label>Eletrônicos</label>
                    <?php
                    foreach ($acessoriosLancha as $acessorio) {
                        if ($acessorio->acessorio_tipos_id == 3) {
                            print '<br/>';
                            print '<input type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                            print $acessorio->titulo;
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- fim acessorios lancha -->
        </div>
        <!-- fim div acessorios -->


        <!-- div de acessorios de pesca -->
            <div id="acessorios-pesca" style="display:none;">
                <div id="equipamentos-pesca" style="float:left;">
                    <label>Acessórios e Equipamentos</label>
                    <?php
                    foreach ($acessoriosPesca as $acessorio) {
                        if ($acessorio->acessorio_tipos_id == 1) {
                            print '<br/>';
                            print '<input type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                            print $acessorio->titulo;
                        }
                    }
                    ?>
                </div>
                <div id="navegacao-pesca" style="float:left;">
                    <label>Comunicação e Navegação</label>
                    <?php
                    foreach ($acessoriosPesca as $acessorio) {
                        if ($acessorio->acessorio_tipos_id == 2) {
                            print '<br/>';
                            print '<input type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                            print $acessorio->titulo;
                        }
                    }
                    ?>
                </div>
                <div id="eletronicos-pesca" style="float:left;">
                    <label>Eletrônicos</label>
                    <?php
                    foreach ($acessoriosPesca as $acessorio) {
                        if ($acessorio->acessorio_tipos_id == 3) {
                            print '<br/>';
                            print '<input type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                            print $acessorio->titulo;
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- fim acessorios pesca -->

        </div>
        <!-- fim div acessorios -->

        <div style="clear:both;"></div>
        <br/><br/>

        <div class="row">
            <?php echo $form->labelEx($model, 'descricao'); ?>
            <?php echo $form->textArea($model, 'descricao'); ?>
            <?php echo $form->error($model, 'descricao'); ?>
        </div><!-- row -->

        <div class="row">
            <?php echo $form->labelEx($model, 'titulo'); ?>
            <?php echo $form->textArea($model, 'titulo'); ?>
            <?php echo $form->error($model, 'titulo'); ?>
        </div><!-- row -->


        <br/>

        <div style="float:left;">
            <h2>Adicionar fotos</h2>
        </div>

        <div style="float:left;" id="fotos">

<?php
// gerar campos de seleção de imagem
for ($i = 0; $i < 6; $i++) {
    echo CHtml::image(Yii::app()->theme->baseUrl . '/img/addfoto.png', "this is alt tag of image", array('id' => $i, 'class' => 'img-upload img-preview'));
    echo CHtml::fileField('Embarcacoes[foto][' . $i . ']', null, array('id' => 'file-' . $i, 'class' => 'hide'));
}
?>
        </div>


        <div style="clear:both;"></div>

        <h1>Turbine seu anúncio</h1>
        <br/>

<?php
// gerar os checkboxes dos recursos adicionais
for ($i = 0; $i < count($recursosAdicionais); $i++) {

    echo '<br/><br/>';
    echo '<label>' . $recursosAdicionais[$i]->titulo . '</label>';
    echo '<label id="valor' . $recursosAdicionais[$i]->id . '">' . $recursosAdicionais[$i]->valor . '</label>';
    echo CHtml::CheckBox('Embarcacoes[recursos_adicionais][' . $i . ']', false, array('value' => $recursosAdicionais[$i]->id, 'class' => 'recursos-adicionais'));

    // testar se é o ID de turbinado de vídeo
    if ($recursosAdicionais[$i]->id == 3) {
        echo '<div class="row" id="turbinado-video">';
        echo '<label>Video</label>';
        echo CHtml::textArea('Embarcacoes[video]', '');
        echo '</div>';
    }
    // testar se é o ID do turbinado das fotos para gerar os campos de imagem
    if ($recursosAdicionais[$i]->id == 2) {
        echo '<div id="turbinado-foto">';
        for ($j = 6; $j < 14; $j++) {
            echo CHtml::image(Yii::app()->theme->baseUrl . '/img/addfoto.png', "this is alt tag of image", array('id' => $j, 'class' => 'img-upload img-turbinada img-preview'));
            //echo '<input id="file-'.$j.'" style="display:none;" type="file" name="Embarcacoes[foto-turbinada]['.$j.']"/>';
            echo CHtml::fileField('Embarcacoes[foto-turbinada][' . $j . ']', null, array('id' => 'file-' . $j, 'class' => 'hide'));
        }
        echo '</div>';
    }
}
?>
        <br/><br/>
        <?php
        echo GxHtml::submitButton(Yii::t('app', 'Add outro anuncio'));
        echo '<br/>';


        if ($qntAnunciosCadastrados == 1) {
            echo CHtml::link('Pagamento', array('anuncioPagamento'));
        }
        $this->endWidget();
        ?>

        <br/>
        <a href="#" id="link-preview-anuncio">Preview do Anuncio</a>

        <div id="div-valor-anuncio">
            <h1>Valor do anuncio R$</h1>
            <span id="valor-anuncio"><?php echo Yii::app()->request->getParam('valor'); ?></span>
        </div>
        <div id="div-valor-turbinada">
            <h1>Valor turbinados R$</h1>
            <span id="valor-turbinada"></span>
        </div>
        <div id="div-valor-total">
            <h1>Valor total R$</h1>
            <span id="valor-total"><?php echo Yii::app()->request->getParam('valor'); ?></span>
        </div>

    </div>
</div><!-- form -->


<div id="preview-anuncio" style="margin-top:300px;">
    <div style="float:left;">
        <div id="foto-principal" style="height: 400px; width: 400px;"></div>
        <div id="fotos-preview"></div>
    </div>
    <div id="info-embarcacao-preview" style="float:left;"></div>
</div>

<script>
    
    $(document).ready(function() {
        alert("teste");
    });
</script>