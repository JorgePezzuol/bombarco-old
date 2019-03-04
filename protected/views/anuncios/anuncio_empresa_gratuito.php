<?php
$form = $this->beginWidget('GxActiveForm', array(
    'id' => 'empresas-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
// usuario logado
$usuarioLogado = Usuarios::getUsuarioLogado();
?>

<?php

            echo '<div class="line-header-cad">
                <div class="container">
                    <div class="box-cadastro-line-header">
                        <div class="quadro-box-cadastro-lh-a">';
                            echo '<a href="'.Yii::app()->homeUrl.'" class="icone-foto-cadastro-lh1"></a>
                        </div>  
                        <div class="quadro-box-cadastro-lh-b">
                            <div class="div-text-cadastro-lh1">
                                <span class="text-cadastro-lh1">';
                                    
                                    echo ' ANÚNCIO GRATUITO';
                                echo '</span>
                            </div>  
                            <icon class="icone-foto-cadastro-lh4"></i>
                        </div>
                        <div class="quadro-box-cadastro-lh-c">
                            
                            <div class="div-text-cadastro-lh1">
                                <span class="text-cadastro-lh1">CADASTRO DO ANÚNCIO</span>
                            </div>  
                            <div class="div-text-cadastro-lh2">
                                <span class="text-cadastro-lh2"></span>
                            </div>  
                        </div>
                    </div>  
                </div>  
            </div>';
   
    ?>


<section class="preloader">
    <img src="<?php echo Yii::app()->createUrl('img/loader.gif'); ?>" alt=""/>
</section>

<section class="content">

    <div class="line-cadastro-1">
        <div class="container">
            <div class="box-cadastro-1">
                <span class="title-cad-2"> <a style="color: #FFF; text-decoration:none;" href="<?php echo Yii::app()->homeUrl; ?>">Home ></a> Anunciar > Cadastro </span>
                <span class="title-cad-1"> Cadastre sua empresa </span>
                <span class="title-cad-3">Preencha os campos abaixo para cadastrar sua empresa</span>
            </div>	
        </div>
    </div>
    <div class="empresa-form-content">
        <div class="container">
            <div class="span-cadastro-top">
                <span class="text-cadastro-top"><b>Atenção:</b> Os campos com * são de preenchimento obrigatório.</span>
            </div>
            <div style="font-weight:bolder; color:red; font-style:italic;">
                <?php
//echo $erro;
//echo $form->errorSummary($empresa);


                $flashMessages = Yii::app()->user->getFlashes();
                if ($flashMessages) {
                    echo '<ul class="flashes">';
                    foreach ($flashMessages as $key => $message) {
                        echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
                    }
                    echo '</ul>';
                }
                ?>
            </div>

            <?php
            // se for estaleiro, temos que exibir os planos de estaleiro para o 
            // usuario escolher
            if ($flgEstaleiro) {
                echo '<div class="row">';
                echo CHtml::label('Plano', 'pid');
                echo Planos::dropDownPlanos('pid', 'estaleiro');
                echo '</div>';
            }
            ?>

            <div class="row row-2">
                <div class="row-1">
                    <?php echo $form->labelEx($empresa, 'email'); ?>
                    <?php
                    echo CHtml::textField('Empresas[email]', Usuarios::getUsuarioLogado()->email, array('id' => 'Empresas_email',
                        'style'=>'width:265px;',
                        'maxlength' => 100));
                    ?>
                    <div class="errorMessage" id="error-email"></div>
                </div>

                <div class="row-1">
                    <?php echo $form->labelEx($empresa, 'cnpj'); ?>
                    <?php if ($usuarioLogado->cnpj != ""): ?>

                        <?php echo $form->textField($empresa, 'cnpj', array('maxlength' => 45, 'value' => $usuarioLogado->cnpj, 'style'=>'width:300px;') ); ?>

                    <?php else: ?>
                        <?php echo $form->textField($empresa, 'cnpj', array('maxlength' => 45, 'style'=>'width:300px;')); ?>
                    <?php endif; ?>
                    <?php echo $form->error($empresa, 'cnpj'); ?>
                </div>

            </div>

            <div class="row row-2">	

                <div class="row-1">
                    <?php echo $form->labelEx($empresa, 'razao'); ?>

                    <?php if ($usuarioLogado->razaosocial != ""): ?>
                        <?php echo $form->textField($empresa, 'razao', array('maxlength' => 45, 'value' => $usuarioLogado->razaosocial, 'style'=>'width:300px;')); ?>
                    <?php else: ?>
                        <?php echo $form->textField($empresa, 'razao', array('maxlength' => 45, 'style'=>'width:300px;')); ?>
                    <?php endif; ?>

                    <?php echo $form->error($empresa, 'razao'); ?>
                    <div class="errorMessage" id="error-razao"></div>

                </div>

                <div class="row-1">
                    <?php echo $form->labelEx($empresa, 'nomefantasia'); ?>
                    <?php if ($usuarioLogado->nomefantasia != ""): ?>

                        <?php echo $form->textField($empresa, 'nomefantasia', array('maxlength' => 120, 'style'=>'width:265px;', 'value' => $usuarioLogado->nomefantasia)); ?>

                    <?php else: ?>
                        <?php echo $form->textField($empresa, 'nomefantasia', array('maxlength' => 120, 'style'=>'width:265px;')); ?>
                    <?php endif; ?>
                    <?php echo $form->error($empresa, 'nomefantasia'); ?>
                </div>
            </div><!-- row -->


            <div class="row row-2">
                <div class="row-1 rowempresacat">
                    <?php echo $form->labelEx($empresa, 'empresa_categorias_id'); ?>
                    <?php echo $form->dropDownList($empresa, 'empresa_categorias_id', GxHtml::listDataEx(EmpresaCategorias::model()->findAll(array('condition' => 'status=1', 'order' => 'titulo asc'))), array('empty' => 'Selecione')); ?>
                    <?php echo $form->error($empresa, 'empresa_categorias_id'); ?>
                    <div class="errorMessage" id="error-categoria"></div>
                </div>

                <div class="row-1 rowempresauf">
                    <?php echo $form->labelEx($empresa,'estados_id'); ?>
                    <?php echo $form->dropDownList($empresa, 'estados_id', GxHtml::listDataEx(Estados::model()->findAll()), array('empty'=>'Selecione')); ?>
                    <?php echo $form->error($empresa,'estados_id'); ?>
                    <div class="errorMessage" id="error-categoria"></div>
                </div>

            </div><!-- row -->

        </div>	

 
        <div class="line-cadastro-15">
            <div class="container">
                <div class="box-cadastro-15" style="margin: 0;">
                    <div class="quadro-box-cadastro-15c" style="float:none; display:block; margin: 0 auto;">
                        <div class="errorMessage" id="error-termo"></div>
                        <div>
                            <?php
                            echo $form->hiddenField($empresa, 'usuarios_id');

                            if (isset($meses)) {
                                // hidden que indica a qtde de mes do anuncio
                                echo CHtml::hiddenField('duracaomeses', $meses, array('id' => 'duracaomeses'));
                            }

                            echo CHtml::hiddenField('hidden-valor-cpm', 99.00, array('id' => 'hidden-valor-cpm'));

                            echo GxHtml::submitButton(Yii::t('app', 'FINALIZAR'), array('class' => 'botao-cadastro-2 ', 'id' => 'btn-form', 'onclick' => '_gaq.push(["_trackEvent", "Empresa", "click", "Finalizar"]);'));
                            $this->endWidget();
                            ?>
                        </div>

                    </div>	
                </div>	
            </div>
        </div>
    </div>
</section><!-- form -->
<footer class="footerr">
    <div class="line-footer-cad">
        <div class="container" style="text-align:center;">
            <div class="box-mfoter-6">
                <div class="">
                    <a href="<?php echo Yii::app()->homeUrl; ?>" class="icone-footer"></a>

                    <div id="armored_website" style="width: 115px; height: 32px; position: absolute; top: 20px;  right: 15px;"></div>
                </div>  
            </div>      
        </div>
</footer>

<!-- campo hidden valor total turbinada -->
<input type="hidden" id="valor-total-turbinada" value="0"/>
<input type="hidden" id="valor-anuncio-hidden" value="<?php echo Yii::app()->request->getParam('valor'); ?>"/>