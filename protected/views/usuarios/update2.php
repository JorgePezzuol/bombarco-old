<?php


/*Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/countdown/countdown.css');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/countdown/countdown_plugin.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/countdown/countdown.js?32', CClientScript::POS_END);*/

Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/usuarios_update.js?'.microtime(), CClientScript::POS_END);

?>
<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<section id="dados-cliente">
    <div class="container">
        <!-- Box com os dados de acesso -->
        <div class="box-info-1-3">
            <span class="title-box-info bot-border">
                Dados de Acesso
                <?php if (Yii::app()->user->hasFlash('sucesso')): ?>
                    <?php echo '<br>' . Yii::app()->user->getFlash('sucesso'); ?>
                <?php endif; ?>
            </span>

            <div class="info-dados">
                <span class="info-text">E-mail: <span><?php echo $model->email; ?></span></span><br/>
                <span id="div-senha-antiga" class="info-text">Senha: <span>*********</span></span>
            </div>

            <a id="alterar-senha" class="bt-action" href="#">Alterar senha</a>

            <div id="inputs-senha" style="display:none;">
                <?php echo CHtml::beginForm('usuarios/alterarSenha/' . $model->id); ?>

                <div class="input-box-3-3" style="padding:0 30px;">
                    <span class="info-label">Senha *</span>
                    <input type="password" id="senha" name="Usuarios[senha]" class="info-input" />
                </div>

                <div class="input-box-3-3" style="padding:0 30px;">
                    <span class="info-label">Confirmar *</span>
                    <input type="password" id="confirmaSenha" name="Usuarios[confirmaSenha]" class="info-input" />
                </div>

                <input type="hidden" id="idUsuario" value="<?php echo $model->id; ?>"/>

                <div id="div-atualizar-senha">
                    <a id="atualizar-senha" class="bt-action" href="#">Atualizar</a>
                </div>

                <?php echo CHtml::endForm(); ?>
                <br class="clr">
            </div>
        </div>

        <div class="box-info-2-3">
            <span class="title-box-info bot-border">Dados Pessoais</span>
            <!-- pessoa fisica -->
            <?php if ($model->pessoa == 'F'): ?>

                <div id="campos-pf">
                    <div id="campos-pf-travado">
                        <?php $this->renderPartial('_campos_pf_travado', array('model' => $model)); ?>
                    </div>

                    <div id="campos-pf-liberado" style="display:none;">
                        <?php $this->renderPartial('_campos_pf_liberado', array('model' => $model)); ?>
                    </div>
                </div>

            <?php else: ?>

                <!-- campos pessoa juridica -->

                <div id="campos-pj">
                    <div id="campos-pj-travado">
                        <?php $this->renderPartial('_campos_pj_travado', array('model' => $model)); ?>
                    </div>

                    <div id="campos-pj-liberado" style="display:none;">
                        <?php $this->renderPartial('_campos_pj_liberado', array('model' => $model)); ?>
                    </div>

                </div>

            <?php endif; ?>


        </div>

        <br class="clr" />

        

    </div>


</section>
