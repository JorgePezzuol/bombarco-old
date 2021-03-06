<?php

// fineuploader
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/fineuploader/fine-uploader-new.css?e='.microtime());
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/fineuploader/jquery.fine-uploader.js?'.microtime(), 
    CClientScript::POS_END);
// scripts
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.price_format.2.0.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/jquery-ui.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/update_embarcacao.js?e='.microtime(), CClientScript::POS_END);

$macros_id = $model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;
?>

<?php $this->renderPartial('/anuncios/templates'); ?>

<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<?php
if (!$flgEstaleiro) {
    if(Embarcacoes::checkTurboNaoPago($model, "fotos")) {
        $max_fotos = Anuncio::$_max_fotos['MAX_FOTOS_EMBARCACAO'] + Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMBARCACAO'];    
    }
    else {
        $max_fotos = Anuncio::$_max_fotos['MAX_FOTOS_EMBARCACAO'];
    }
} else {
    $max_fotos = Anuncio::$_max_fotos['MAX_FOTOS_ESTALEIRO'];
}
?>

<?php
$form = $this->beginWidget('GxActiveForm', array(
    'id' => 'embarcacoes-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableClientValidation' => true,
));
?>

<section id="dados-cliente">
    <div class="container">
        <!-- Box com os dados de acesso -->
        <div class="box-info-3-3">
            <span class="title-box-info bot-border">
                Alteração de Dados - Embarcações <a href="<?php echo Embarcacoes::mountUrl($model); ?>" class="bt-voltar">Voltar</a>
                <div class="sucessmsg"></div>                
            </span>

            <div class="info-dados">

                <?php echo CHtml::errorSummary($model, '', '', array('class'=>'alert')); ?>  

                <div class="input-box-2-3" >
                    <label class="info-label-bold">E-mail para contato</label>
                    <input type="text" value="<?php echo $model->email; ?>" name="Embarcacoes[email]" id="email" class="info-input" />
                </div>

                <br class="clr">

                <div class="input-box-1-3" >
                    <span class="info-label-bold">Categoria:<br/></span>
                    <?php if (Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()): ?>
                        <?php echo $form->dropDownList($model, 'embarcacao_macros_id', Anuncio::$_categoria_por_numero, array('class' => 'info-input'));?>
                    <?php else: ?>
                        <span class="info-label"><b><?php echo $model->embarcacaoMacros->titulo; ?></b></span>
                    <?php endif ?>                    
                </div>

                <div class="input-box-1-3" >
                    <?php if(EmbarcacoesEditadas::isEditada($model, "MARCA") == true): ?>
                        <span style="color:green;" class="info-label-bold">Fabricante (editado):<br/></span>
                    <?php else: ?>
                        <span class="info-label-bold">Fabricante:<br/></span>
                    <?php endif; ?>
                    
                    <?php if (Yii::app()->user->isAdmin() || $model->planoUsuarios->planos->gratuito == 1 || Yii::app()->user->isAtendimento()): ?>
                        <?php echo CHtml::dropDownList('Embarcacoes[embarcacao_fabricantes_id]', $model->embarcacaoModelos->embarcacaoFabricantes->id, EmbarcacaoFabricantes::selectAllFromMacro($macros_id, true), array('class' => 'info-input')); ?>
                    <?php else: ?>
                        <span class="info-label"><b><?php echo $model->embarcacaoModelos->embarcacaoFabricantes->titulo; ?></b></span>
                    <?php endif ?>                    
                </div>

                <div class="input-box-1-3" >
                    <?php if(EmbarcacoesEditadas::isEditada($model, "MODELO") == true): ?>
                        <span style="color:green;" class="info-label-bold">Modelo (editado):<br/></span>
                    <?php else: ?>
                        <span class="info-label-bold">Modelo:<br/></span>
                    <?php endif; ?>
                    <?php if (Yii::app()->user->isAdmin() || $model->planoUsuarios->planos->gratuito == 1 || Yii::app()->user->isAtendimento()): ?>
                        <?php echo $form->dropDownList($model, 'embarcacao_modelos_id', EmbarcacaoModelos::selectAllFromFabricante($model->embarcacaoModelos->embarcacao_fabricantes_id, true), array('class' => 'info-input')); ?>
                    <?php else: ?>
                        <span class="info-label"><b><?php echo $model->embarcacaoModelos->titulo; ?></b></span>
                    <?php endif ?>                                        
                </div>

                <div id="div-alterar-fabricante">

                    <!-- se for jetski, exibiremos campos do modelo de embarc de jetski -->
                    <?php if ($model->embarcacao_macros_id == Anuncio::$_categoria_embarcacao['JETSKI']): ?> 

                        <div class="is-jetski">
                            <?php if ($model->embarcacaoModelos->motor_de_fabrica != null): ?>   

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Motor:<br/></span>
                                    <span class="info-label info-motor"><b><?php echo $model->embarcacaoModelos->motor_de_fabrica == null ? 'Não informado' : $model->embarcacaoModelos->motor_de_fabrica; ?></b></span>
                                </div>


                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Tipo:<br/></span>
                                    <span class="info-label info-tipo"><b><?php echo $model->embarcacaoModelos->embarcacaoTipos == null ? 'Não informado' : $model->embarcacaoModelos->embarcacaoTipos->titulo; ?></b></span>
                                </div>   

                            <?php endif; ?>
                        </div>


                    <!-- não é jetski -->
                    <?php else: ?>

                        <div class="not-jetski">

                            <!-- não é estaleiro -->
                            <?php if ($model->macros_id != 3): ?>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Tipo:<br/></span>
                                    <span class="info-label info-tipo"><b><?php echo $model->embarcacaoModelos->embarcacaoTipos == null ? 'Não informado' : $model->embarcacaoModelos->embarcacaoTipos->titulo; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Tamanho:<br/></span>
                                    <span class="info-label info-tamanho"><b><?php echo $model->embarcacaoModelos->tamanho == null ? 'Não informado' : number_format($model->embarcacaoModelos->tamanho, 0, '.', '') . ' pés'; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Passageiros:<br/></span>
                                    <span class="info-label info-passageiros"><b> Dia: <?php echo $model->embarcacaoModelos->passageiros; ?> / Noite: <?php echo $model->embarcacaoModelos->acomodacoes; ?></b></span>
                                </div>

                                <!-- é estaleiro -->
                            <?php else: ?>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Tipo:<br/></span>
                                    <span class="info-label info-tipo"><b> <?php echo $model->embarcacaoModelos->embarcacaoTipos == null ? 'Não informado' : $model->embarcacaoModelos->embarcacaoTipos->titulo; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Tamanho:<br/></span>
                                    <span class="info-label info-tamanho"><b><?php echo $model->embarcacaoModelos->tamanho == null ? 'Não informado' : number_format($model->embarcacaoModelos->tamanho, 0, '.', '') . ' pés'; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Passageiros:<br/></span>
                                    <span class="info-label info-passageiros"><b>Dia: <?php echo $model->embarcacaoModelos->passageiros; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Acomodações:<br/></span>
                                    <span class="info-label info-acomodacoes"><b><?php echo $model->embarcacaoModelos->acomodacoes; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Boca:<br/></span>
                                    <span class="info-label info-boca"><b><?php echo $model->embarcacaoModelos->boca . ' m'; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Calado:<br/></span>
                                    <span class="info-label info-calado"><b><?php echo $model->embarcacaoModelos->calado . ' m'; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Pé Direito:<br/></span>
                                    <span class="info-label info-pedireito"><b><?php echo $model->embarcacaoModelos->pedireito . ' m'; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Peso do Casco:<br/></span>
                                    <span class="info-label info-pesocasco"><b><?php echo $model->embarcacaoModelos->pesocasco . ' kg'; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Tanque de Água:<br/></span>
                                    <span class="info-label info-tanqueagua"><b><?php echo $model->embarcacaoModelos->tanqueagua . ' L'; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Tanque de Combustível:<br/></span>
                                    <span class="info-label info-tanquecombustivel"><b><?php echo $model->embarcacaoModelos->tanquecombustivel . ' L'; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Camarotes:<br/></span>
                                    <span class="info-label info-ncamarotes"><b><?php echo $model->embarcacaoModelos->ncamarotes; ?></b></span>
                                </div>

                                <div class="input-box-1-3" >
                                    <span class="info-label-bold">Banheiros:<br/></span>
                                    <span class="info-label info-nbanheiros"><b><?php echo $model->embarcacaoModelos->nbanheiros; ?></b></span>
                                </div>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                </div>
                <br class="clr">

                <div class="input-box-1-3" >
                    <label class="info-label-bold">Ano:</label>
                    <input type="text" name="Embarcacoes[ano]" id="ano" value="<?php echo $model->ano; ?>" class="info-input" />
                </div>

                <div class="input-box-1-3" >
                    <label class="info-label-bold">Valor:</label>
                    <input type="text" name="Embarcacoes[valor]" id="valor" value="<?php echo $model->valor; ?>" class="info-input" />
                </div>

                <div class="input-box-1-3" >
                    <label class="info-label-bold">Estado:</label>
                    <?php echo $form->dropDownList($model, 'estado', array('' => 'selecione', 'U' => 'Usado', 'N' => 'Novo'), array('class' => 'info-input'));
                    ?>
                </div>

                <div class="input-box-1-3" >
                    <label class="info-label-bold">UF:</label>
                    <?php echo $form->dropDownList($model, 'estados_id', Estados::model()->findAll(), array('class' => 'info-input')); ?>
                </div>

                <div class="input-box-1-3">
                    <label class="info-label-bold">Cidade:</label>
                    <?php
                    if ($model->cidades != null) {
                        echo $form->dropDownList($model, 'cidades_id', GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true, 'estados_id=:estado', array(':estado' => $model->estados->id))), array('class' => 'info-input'));
                    } else {
                        echo $form->dropDownList($model, 'cidades_id', Cidades::model()->findAllAttributes(null, true), array('class' => 'info-input'));
                    }
                    ?>
                </div>

                <!-- Motorização-->

                <br class="clr">



                <span class="sub-title-box-info">Motorização</span>

                <?php if ($model->embarcacao_macros_id != 1): ?>
                    <!-- div motor (veleiro e lanche) -->
                    <div id="div-motor">


                        <div class="input-box-1-3">
                            <label class="info-label-bold">Quantidade:</label>
                            <?php
                            echo CHtml::dropDownList('Embarcacoes[qntmotores]', $model->qntmotores, array(0, 1, 2, 3, 4, 5), array('id' => 'qnt-motores', 'class' => 'info-input'));
                            ?>
                        </div>


                        <div class="input-box-1-3">
                        <?php if(EmbarcacoesEditadas::isEditada($model, "MOTOR_MARCA") == true): ?>
                            <span style="color:green;" class="info-label-bold">Marcas (editado):<br/></span>
                        <?php else: ?>
                            <span class="info-label-bold">Marcas:<br/></span>
                        <?php endif; ?>

                            <?php
                            echo CHtml::dropDownList('Motores[motor_fabricantes_id]', $motor->motor_fabricantes_id, GxHtml::listDataEx(MotorFabricantes::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status' => 1))), array('prompt' => 'Selecione', 'class' => 'info-input'));
                            ?>
                        </div>
                        <div class="input-box-1-3">
                            <?php if(EmbarcacoesEditadas::isEditada($model, "MOTOR_MODELO") == true): ?>
                                <span style="color:green;" class="info-label-bold">Modelos (editado):<br/></span>
                            <?php else: ?>
                                <span class="info-label-bold">Modelos:<br/></span>
                            <?php endif; ?> 

                            <?php
                                if($motor->motorFabricantes != null) {
                                     echo CHtml::dropDownList('Motores[motor_modelos_id]', $motor->motor_modelos_id, GxHtml::listDataEx(MotorModelos::model()->findAllAttributes(null, true, 'status=:status and motor_fabricantes_id =:fab order by titulo asc', array(':status' => 1, ':fab'=>$motor->motor_fabricantes_id))), array('prompt' => 'Selecione', 'class' => 'info-input'));
                                }
                                else {
                                    echo CHtml::dropDownList('Motores[motor_modelos_id]', $motor->motor_modelos_id, GxHtml::listDataEx(MotorModelos::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status' => 1))), array('prompt' => 'Selecione a marca', 'disabled'=>'disabled', 'class' => 'info-input'));
                                }
                            
                            ?>

                        </div>
                        <div class="input-box-1-3">
                            <span class="info-label-bold">Tipo de Motor</span>


                            <?php
                            if ($motor->motorModelos == null) {
                                echo CHtml::dropDownList('Motores[motor_tipos_id]', '', GxHtml::listDataEx(MotorTipos::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status' => 1))), array("disabled" => "disabled", 'prompt' => 'Selecione o modelo', 'class' => 'info-input'));
                            } else {
                                echo CHtml::dropDownList('Motores[motor_tipos_id]', $motor->motorModelos->motor_tipos_id, GxHtml::listDataEx(MotorTipos::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status' => 1))), array("disabled" => "disabled", 'prompt' => 'Selecione', 'class' => 'info-input'));
                            }
                            ?>
                            </span>

                        </div>
                        <div class="input-box-1-3">
                            <span class="info-label-bold">Potência</span>
                            <?php
                            if ($motor->motorModelos == null) {
                                echo CHtml::dropDownList('Motores[motor_potencia]', '', array(), array("disabled" => "disabled", 'prompt' => 'Selecione o modelo', 'class' => 'motor-potencia info-input'));
                            } else {

                                if ($motor->motorModelos->potencia != "") {
                                    echo CHtml::dropDownList('Motores[motor_potencia]', $motor->motorModelos->potencia, array(), array("disabled" => "disabled", 'class' => 'motor-potencia info-input'));
                                } else {
                                    echo CHtml::dropDownList('Motores[motor_potencia]', '', array(), array("disabled" => "disabled", 'prompt' => 'Não informada', 'class' => 'motor-potencia info-input'));
                                }
                            }
                            ?>


                        </div>



                        <!-- estaleiro n tem horas de motor como campo -->

                        <?php if ($model->macros_id != 3): ?>
                            <div class="input-box-1-3">
                                <span class="info-label-bold">Horas de uso / Motor</span> 
                                <?php echo CHtml::textField('Motores[horas]', $motor->horas, array('maxlength' => 45, 'class' => 'info-input')); ?>
                            <?php endif; ?>
                        </div> 
                        <!-- fim div motor -->

                        <!-- div motor (jetski) -->

                    <?php else: ?>

                        <div class="input-box-1-3" id="div-motor-jetski" style="display:none;">
                            <span class="info-label-bold">Motor</span> 
                            <?php echo CHtml::textField('Embarcacoes[motordefabrica]', '', array('maxlength' => 45, 'class' => 'info-input')); ?>                  
                        </div>

                    <?php endif; ?>
                    <!-- fim div motor -->

                    <br class="clr">

                    <?php if ($model->macros_id != 3): ?>
                        <span class="sub-title-box-info">Acessórios e Equipamentos</span>


                        <div class="input-box-2-3" >

                            <?php
                            if (count($model->embarcacaoAcessorioses) > 0) {

                                $array_acessorios = array();

                                echo '<span class="input-text">';

                                foreach ($model->embarcacaoAcessorioses as $acessorio) {
                                    $array_acessorios[] = $acessorio->acessorios->titulo;
                                }

                                echo implode(' / ', $array_acessorios);

                                echo '</span>';
                            }
                            ?>

                            <br>

                            <span id="alterar-acessorios" class="bt-action alterar">Alterar/Adicionar Acessórios</span>
                        </div>

                        <br class="clr">
                    <?php endif; ?>

                    <?php if($model->embarcacao_macros_id == 1): ?>
                    <div id="acessorios-jetski" style="display:none";>
                        <div class="input-box-3-3">  
                            <div id="equipamentos-jetski">
                                <?php
                                foreach ($acessoriosJetSki as $acessorio) {

                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][jetski][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][jetski][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- fim acessorios jetski -->

                    <!-- div de acessorios de lancha -->
                    <?php if($model->embarcacao_macros_id == 2): ?>
                    <div id="acessorios-lancha" style="display:none;">
                        <div id="equipamentos-lancha" class="input-box-3-3">
                            <span class="text-admin-form5">Acessórios e Equipamentos</span>
                            <br class="clr">
                            <?php
                            foreach ($acessoriosLancha as $acessorio) {
                                if ($acessorio->acessorio_tipos_id == 1) {
                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                            }
                            ?>
                        </div>

                        <div id="navegacao-lancha" class="input-box-3-3">
                            <span class="text-admin-form5">Comunicação e Navegação</span>
                            <br class="clr">
                            <?php
                            foreach ($acessoriosLancha as $acessorio) {
                                if ($acessorio->acessorio_tipos_id == 2) {
                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox "></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                            }
                            ?>
                        </div>

                        <div id="eletronicos-lancha" class="input-box-3-3">
                            <span class="text-admin-form5">Eletrônicos</span>
                            <br class="clr">
                            <?php
                            foreach ($acessoriosLancha as $acessorio) {
                                if ($acessorio->acessorio_tipos_id == 3) {
                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox "></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                            }
                            ?>               
                        </div>
                    </div>
                    <!-- fim acessorios lancha -->
                    <?php endif; ?>

                    <!-- div de acessorios de veleiro -->
                    <div id="acessorios-veleiro" style="display:none;">

                        <div id="eletronicos-lancha" class="input-box-3-3">
                            <span class="text-admin-form5">Vela Genoa</span>
                            <br class="clr">
                            <?php
                            foreach ($acessoriosVeleiro as $acessorio) {
                                if ($acessorio->acessorio_tipos_id == 4) {
                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][lancha][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                            }
                            ?>
                        </div>

                        <div class="input-box-3-3">
                            <span class="text-admin-form5">Vela Mestra</span>
                            <br class="clr">
                            <?php
                            foreach ($acessoriosVeleiro as $acessorio) {
                                if ($acessorio->acessorio_tipos_id == 5) {
                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][veleiro][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][veleiro][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <!-- fim acessorios veleiro -->

                    <!-- div de acessorios de pesca -->
                    <?php if($model->embarcacao_macros_id == 4): ?>
                    <div id="acessorios-pesca" style="display:none;">
                        <div id="equipamentos-pesca" class="input-box-3-3">
                            <span class="text-admin-form5">Acessórios e Equipamentos</span>
                            <br class="clr">
                            <?php
                            foreach ($acessoriosPesca as $acessorio) {
                                if ($acessorio->acessorio_tipos_id == 1) {
                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                            }
                            ?>
                        </div>

                        <div id="navegacao-pesca" class="input-box-3-3">
                            <span class="text-admin-form5">Comunicação e Navegação</span>
                            <br class="clr">
                            <?php
                            foreach ($acessoriosPesca as $acessorio) {
                                if ($acessorio->acessorio_tipos_id == 2) {
                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox "></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                            }
                            ?>
                        </div>

                        <div id="eletronicos-pesca" class="input-box-3-3">
                            <span class="text-admin-form5">Eletrônicos</span>
                            <br class="clr">
                            <?php
                            foreach ($acessoriosPesca as $acessorio) {
                                if ($acessorio->acessorio_tipos_id == 3) {
                                    print '<div class="check-box-acessorios">';
                                    if (in_array($acessorio->id, $acessoriosJatem)) {

                                        print '<input disabled class="check-acessorio" type="checkbox" checked value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox checked"></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    } else {
                                        print '<input disabled class="check-acessorio" type="checkbox" value="' . $acessorio->id . '" name="Embarcacoes[acessorios][pesca][]"/>';
                                        print '<span class="info-label-checkbox"><i class="label-icon-checkbox "></i>';
                                        print $acessorio->titulo;
                                        print '</span>';
                                    }
                                    print '</div>';
                                }
                            }
                            ?>               
                        </div>
                    </div>
                    <?php endif;?>
                    <!-- fim acessorios pesca -->

                    <!-- fim div acessorios -->

                    <br class="clr">

                    <span class="sub-title-box-info">Descrição</span>
                    <div class="input-box-3-3">                     
                        <?php echo $form->textArea($model, 'descricao', array('maxlength' => 4000, 'class' => 'info-textarea')); ?>
                        <?php echo $form->error($model, 'descricao'); ?>    
                    </div><!-- row -->

                    <br class="clr">

                    <?php if (Embarcacoes::checkTurboNaoPago($model, 'titulo')): ?>
                        <span class="sub-title-box-info">Título</span>
                        <div class="input-box-2-3">                     
                            <?php echo $form->textField($model, 'titulo', array('class' => 'info-input')); ?>
                            <?php echo $form->error($model, 'titulo'); ?>   
                        </div><!-- row -->
                    <?php endif; ?>

                    <br class="clr">

                    <?php if (Embarcacoes::checkTurboNaoPago($model, 'video')): ?>

                        <span class="sub-title-box-info">Vídeo</span>
                        <div class="input-box-1-3">                     
                            <?php echo $form->textField($model, 'video', array('class' => 'info-input')); ?>
                            <?php echo $form->error($model, 'video'); ?>   
                        </div><!-- row --> 

                    <?php endif; ?>

                    <!-- fim motores -->

                    <br class="clr">
                    <span class="sub-title-box-info">Imagens</span>
                    <span class="info-text">Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Prefira Imagens na horizontal<!--<br/><br/><a href="#" id="multiple-upload">Clique aqui para subir várias fotos de uma vez</a>--></span>

                    <div class="input-box-3-3" id="foto" style="margin-top: -20px;">
                        <!-- listar imagens da embarcação -->
                        <!-- div do plugin de multiupload -->
                        <div id="uploader"></div>
                        <?php

                        echo '<div>
                            <div class="gallery">
                                <ul class="reorder_ul reorder-photos-list">';
                                
                                    for($i = 0; $i < $max_fotos; $i++) {

                                        $img = Yii::app()->request->baseUrl . '/img/addfoto.png';
                                        $id = "";
                                        $dataid = 0;
                                        $idfile = "";
                                        $class = "img-upload-embarc";
                                        $principal = "";

                                        if(isset($model->embarcacaoImagens[$i]) == true) {
                                        
                                            $img = Yii::app()->request->baseUrl ."/public/embarcacoes/".$model->embarcacaoImagens[$i]->imagem;
                                            $id = "image-".$i;
                                            $dataid = $model->embarcacaoImagens[$i]->id;
                                            $idfile = "file-".$i;

                                            if($model->embarcacaoImagens[$i]->turbo == 1) {
                                                $class .= " img-turbinada";
                                            }

                                            if($model->embarcacaoImagens[$i]->principal == 1) {
                                                $principal = '<span style="margin-top:-37px;" class="aviso-img-principal">Imagem principal</span>';
                                            }

                                            
                                        }

                                        // começar a gerar os campos das imgs turbo caso tenha (a partir do 6 campo de foto)
                                        if($i > Anuncio::$_max_fotos['MAX_FOTOS_EMBARCACAO'] - 1 && isset($model->embarcacaoImagens[$i]) == false) {
                                            $class .= " img-turbinada";
                                        }
                                
                                        echo '<li id="'.$i.'" class="li-imagem ui-sortable-handle">';
                                        echo '<div class="upload-img-box">';
                                        echo $principal;
                                        echo CHtml::image($img, "imagem do anuncio", array("id" => $id, "data-id"=>$dataid, "class" => $class, "width" => "100px", "height" => "100px"));
                                        echo CHtml::fileField("Embarcacoes[foto][]", null, array("class" => "file-upload-embarc", "id"=>$idfile));
                                        if(isset($model->embarcacaoImagens[$i]) == true) {
                                            echo '<span style="width:2 !important; margin-left: 8px;" id="' . $i . '"  class="bt-remover-img">Excluir</span>';
                                        }
                                        echo '</div>';
                                        echo '</li>';                                            
                                    }

                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                        ?>
                    </div>
                </div>

                <div style="margin-right:50px;">    

                    <?php
                    echo GxHtml::submitButton(Yii::t('app', 'ALTERAR'), array('class' => 'bt-action', 'id' => 'btn-alterar'));

                    $this->endWidget();
                    ?>

                </div>   



            </div>

        </div>
        <br class="clr"> 
        </section>

        <input type="hidden" value="<?php echo $model->embarcacaoMacros->id; ?>" id="macro-embarc-hidden"/>
        <input type="hidden" value="<?php echo $model->embarcacaoModelos->embarcacaoFabricantes->id ?>" id="fabricante-embarc-hidden"/>
        <input type="hidden" value="<?php echo Embarcacoes::mountUrl($model); ?>" id="url-anuncio"/>
        <input type="hidden" value="<?php echo $model->primaryKey;?>" id="primary_key"/>
