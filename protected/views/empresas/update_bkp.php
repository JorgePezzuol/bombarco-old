<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/update_empresa.js', CClientScript::POS_END);
?>

<?php
$form = $this->beginWidget('GxActiveForm', array(
    'id' => 'empresas-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<section id="dados-cliente">
    <div class="container">

        <div class="box-info-3-3">

            <h1 class="title-box-info bot-border">
                Alteração de dados - <?php echo $empresa->razao; ?>
                <a href="<?php echo Empresas::mountUrl($empresa, $empresa->macros_id); ?>" class="bt-voltar">Voltar</a>
            </h1>

            <div class="sucessmsg">
                <?php
                echo $erro;
                ?>
            </div>

            <div class="info-dados">

                <!-- Dados da empresa -->
                <h3 class="title-box-info">Dados</h3>

                <div class="input-box-1-3">
                    <span class="info-label">E-mail de contato* :</span>
                    <!-- <input type="password" id="confirmaSenha" name="Usuarios[confirmaSenha]" class="info-input-2-3" /> -->
                    <?php echo $form->textField($empresa, 'email', array('maxlength' => 45, 'class' => 'info-input')); ?>
                    <?php echo $form->error($empresa, 'email'); ?>
                </div>

                <div class="input-box-1-3">
                    <span class="info-label">CNPJ* :</span>
                    <?php echo $form->textField($empresa, 'cnpj', array('maxlength' => 45, 'class' => 'info-input')); ?>
                    <?php echo $form->error($empresa, 'cnpj'); ?>
                </div>

                <?php if ($empresa->macros_id != 3): ?>
                    <div class="input-box-1-3">
                        <span class="info-label">Categoria da Empresa* :</span>
                        <?php echo $form->dropDownList($empresa, 'empresa_categorias_id', GxHtml::listDataEx(EmpresaCategorias::model()->findAll(array('condition' => 'status=1', 'order' => 'titulo asc'))), array('class' => 'info-input', 'empty' => 'Selecione')); ?>
                        <?php echo $form->error($empresa, 'empresa_categorias_id'); ?>
                    </div>
                <?php endif; ?>

                <div class="input-box-2-3">
                    <span class="info-label">Razão:</span>
                    <!-- <input type="password" id="confirmaSenha" name="Usuarios[confirmaSenha]" class="info-input-2-3" /> -->
                    <?php echo $form->textField($empresa, 'razao', array('maxlength' => 45, 'class' => 'info-input')); ?>
                    <?php echo $form->error($empresa, 'razao'); ?>
                </div>

                <div class="input-box-1-3">
                    <span class="info-label">Nome fantasia:</span>
                    <?php
                    $usuario = Usuarios::getUsuarioLogado();
                    $nomefantasia = "";
                    if ($usuario->nomefantasia != null) {
                        $nomefantasia = $usuario->nomefantasia;
                    }
                    ?>
                    <?php echo $form->textField($empresa, 'nomefantasia', array('maxlength' => 150, 'class' => 'info-input', 'value' => $nomefantasia)); ?>
                    <?php echo $form->error($empresa, 'nomefantasia'); ?>
                </div>

                <!-- Endereço da empresa -->

                <br class="clr">
                <h3 class="title-box-info">Endereço</h3>

                <div class="input-box-1-3">
                    <span class="info-label">CEP:</span>
                    <?php echo $form->textField($empresa, 'cep', array('maxlength' => 45, 'class' => 'info-input')); ?>
                    <?php echo $form->error($empresa, 'cep'); ?>
                </div>

                <div class="input-box-2-3">
                    <span class="info-label">Endereço:</span>
                    <?php echo $form->textField($empresa, 'endereco', array('maxlength' => 100, 'class' => 'info-input')); ?>
                    <?php echo $form->error($empresa, 'endereco'); ?>
                </div>

                <div class="input-box-1-3">
                    <span class="info-label">Número:</span>
                    <?php echo $form->textField($empresa, 'numero', array('class' => 'info-input')); ?>
                    <?php echo $form->error($empresa, 'numero'); ?>
                </div>

                <div class="input-box-1-3">
                    <span class="info-label">Bairro:</span>
                    <?php echo $form->textField($empresa, 'bairro', array('maxlength' => 45, 'class' => 'info-input')); ?>
                    <?php echo $form->error($empresa, 'bairro'); ?>
                </div>

                <div class="input-box-1-3">
                    <span class="info-label">Complemento:</span>
                    <input type="text" class="info-input" />
                </div>



                <!-- <div id="div-estado-cidade" style="display:none;"> -->
                <div class="input-box-1-3">
                    <span class="info-label">Estado</span>
                    <div class="input-text" >
                        <?php echo $form->dropDownList($empresa, 'estados_id', Estados::model()->findAll(), array('class' => 'info-input')); ?>
                    </div>
                </div>

                <div class="input-box-2-3">
                    <span class="info-label">Cidade</span>
                    <div class="input-text" >
                        <?php
                        if ($empresa->cidades != null) {
                            echo $form->dropDownList($empresa, 'cidades_id', GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true, 'estados_id=:estado', array(':estado' => $empresa->estados->id))));
                        } else {
                            echo $form->dropDownList($empresa, 'cidades_id', Cidades::model()->findAllAttributes(null, true), array('class' => 'info-input'));
                        }
                        ?>
                    </div>
                </div>
                <!-- </div> -->



                <div class="input-box-1-3">
                    <span class="info-label">Logotipo:</span>
                    <?php
                    $logo = Yii::app()->request->baseUrl . '/img/addfoto.png';
                    if($empresa->logo != "") {
                        $logo = Yii::app()->request->baseUrl . '/public/empresas/'.$empresa->logo;
                    }
                    echo '<div class="upload-img-box">';
                    echo '<div class="img-crop">' . CHtml::image($logo, "logo", array('id' => 'logo', 'class' => 'img-upload img-turbinada img-preview')) . '</div>';
                    echo $form->fileField($empresa, 'logo', array('id' => 'logo-file'));
                    if ($empresa->logo != "" && $empresa->logo != null) {
                        echo '<span data-capalogo="2" id="remover-logo" class="remover bt-remover-img">Excluir</span>';
                    }

                    echo '</div>';
                    ?>

                </div>

                <div class="input-box-1-3">
                    <span class="info-label">Capa:</span>
                     <?php
                    $capa = Yii::app()->request->baseUrl . '/img/addfoto.png';
                    if($empresa->capa != "") {
                         $capa = Yii::app()->request->baseUrl . '/public/empresas/'.$empresa->capa;
                    }
                    echo '<div class="upload-img-box">';
                    echo '<div class="img-crop">' . CHtml::image($capa, "capa", array('id' => 'capa', 'class' => 'img-upload img-turbinada img-preview ')) . '</div>';
                    echo $form->fileField($empresa, 'capa', array('id' => 'capa-file'));
                    if ($empresa->capa != "" && $empresa->capa != null) {
                        echo '<span data-capalogo="1" id="remover-capa" class="remover bt-remover-img">Excluir</span>';
                    }
                    
                    echo '</div>';
                    ?>

                </div>

                <?php if (Empresas::checkTurboNaoPago($empresa, 'telefone')): ?>
                    <div class="input-box-1-3">
                        <span class="info-label">Telefone:</span>
                        <?php echo $form->textField($empresa, 'telefone', array('maxlength' => 20, 'class' => 'info-input')); ?>
                        <?php echo $form->error($empresa, 'telefone'); ?>
                    </div>
                <?php endif; ?>				

                <?php if (Empresas::checkTurboNaoPago($empresa, 'video')): ?>
                    <div class="input-box-2-3">
                        <span class="info-label">Vídeo:</span>
                        <?php echo $form->textField($empresa, 'video', array('maxlength' => 45, 'class' => 'info-input')); ?>
                        <?php echo $form->error($empresa, 'video'); ?>
                    </div>
                <?php endif; ?>

                <!-- empresa tem minidescrição -->
                <?php if ($empresa->macros_id == 2): ?>
                    <div class="input-box-3-3">
                        <span class="info-label">Minidescrição (Máx 150 caractéres):</span>
                        <?php echo $form->textArea($empresa, 'minidescricao', array('maxlength' => 150, 'class' => 'info-textarea',));
                        ?>
                        <?php echo $form->error($empresa, 'minidescricao'); ?>
                    </div><!-- row -->

                    <?php if (Empresas::checkTurboNaoPago($empresa, 'descricao')): ?>
                        <div class="input-box-3-3">
                            <span class="info-label">Descrição (Máx 1000 caractéres):</span>
                            <?php echo $form->textArea($empresa, 'descricao', array('maxlength' => 1000, 'class' => 'info-textarea'));
                            ?>
                            <?php echo $form->error($empresa, 'descricao'); ?>
                        </div><!-- row -->
                    <?php endif; ?>

                    <!-- estaleiro tem descrição -->
                <?php else: ?>
                    <div class="input-box-3-3">
                        <span class="info-label">Descrição (Máx 1000 caractéres):</span>
                        <?php echo $form->textArea($empresa, 'descricao', array('maxlength' => 1000, 'class' => 'info-textarea'));
                        ?>
                        <?php echo $form->error($empresa, 'descricao'); ?>
                    </div><!-- row -->
                <?php endif; ?>

                <div class="input-box-1-3">
                    <span class="info-label">Facebook</span>
                    <?php echo $form->textField($empresa, 'fanpage', array('maxlength' => 100, 'class' => 'info-input')); ?>
                    <?php echo $form->error($empresa, 'fanpage'); ?>
                </div>

                <br class="clr">

                <!-- Imagens para plano turbinado	 -->

                <?php if (Empresas::checkTurboNaoPago($empresa, 'fotos')): ?>

                    <div id="fotos-turbinadas">

                        <h3 class="title-box-info">Imagens</h3>
                        <div class="input-box-3-3">
                            <p>Formatos Aceitos: JPEG, PNG.
                                Tamanho Máximo: 1mb</p>
                            <?php
                            for ($j = 0; $j < Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMPRESA']; $j++) {
                                $imagem = "/img/addfoto.png";
                                if (isset($empresa->empresaImagens[$j])) {

                                    $imagem = '/public/empresas/' . $empresa->empresaImagens[$j]->imagem;
                                    echo '<div class="upload-img-box">';
                                    echo '<div class="img-crop">' . CHtml::image(Yii::app()->request->baseUrl . $imagem, "alt", array('id' => $empresa->empresaImagens[$j]->id, 'class' => 'img-upload update img-turbinada')) . '</div>';

                                    echo '<span id="' . $empresa->empresaImagens[$j]->id . '" class="deletar-foto bt-remover-img">Excluir</span>';
                                    echo '</div>';

                                    echo CHtml::fileField('Empresas[foto-turbinada][]', null, array('style' => 'display:none;', 'class' => 'file-turbinada', 'id' => $empresa->empresaImagens[$j]->id));
                                } else {
                                    echo '<div class="upload-img-box">';
                                    echo '<div class="img-crop create">' . CHtml::image(Yii::app()->request->baseUrl . $imagem, "alt", array('class' => 'img-upload create img-turbinada')) . '</div>';

                                    echo CHtml::fileField('Empresas[foto-turbinada][]', null, array('style' => 'display:none;', 'class' => 'file-turbinada'));
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>


                <br class="clr" /> <!-- clear fix -->

                <?php
                echo GxHtml::submitButton(Yii::t('app', 'ALTERAR'), array('class' => 'bt-action', 'id' => 'btn-form-empresa'));
                $this->endWidget();
                ?>

                <!-- hidden id da empresa -->
                <input type="hidden" value="<?php echo $empresa->id; ?>" id="id_empresa"/>

            </div>			<!-- fim box -->

        </div>

        <br class="clr">

    </div>
</section>















