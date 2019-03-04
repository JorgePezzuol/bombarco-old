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

            <?php 


                $criteria = new CDbCriteria;
                $criteria->condition = 'id_usuario=:id_usuario and status = 2';
                $criteria->order = "id DESC";
                $criteria->params = array(":id_usuario"=>Yii::app()->user->getId());
                $criteria->limit = 1;
                $contrato = Contrato::model()->find($criteria);
                
            ?>
            <?php if($contrato != null): ?>
                <?php $link_ver = "http://www.bombarco.com.br/contrato/assinar/".$contrato->slug; ?>
                <?php //$link_dl = "http://www.bombarco.com.br/public/contratos/".$contrato->slug.".pdf?e=2".microtime(); ?>
                <span class="title-box-info bot-border">Contrato: <a target="_blank" href="<?php echo $link_ver; ?>"><small>Ver online</small></a></span>
            <?php endif; ?>
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

        <?php if(count($ativos) > 0 || count($expirados) > 0): ?>
            <div class="box-info-3-3" style="margin-top: 45px;">

                <?php if(count($ativos) > 0): ?>
                    <div data-planos="ativos" class="aba-renovar" style="cursor:pointer;float:left;margin-top:-50px;">
                        <span style="color: #00918e !important;" class="title-box-info">Planos ativos <?php echo '('.count($ativos).')';?></span>
                    </div>
                <?php endif;?>

                <?php if(count($expirados) > 0): ?>
                    <div data-planos="expirados" class="aba-renovar" style="cursor:pointer; float:left;margin-top:-50px;">
                        <span class="title-box-info">Planos expirados <?php echo '('.count($expirados).')';?></span>
                    </div>
                <?php endif;?>

                <div style="clear:both;":></div>

                <div class="tabela-planos">

                    <?php if(count($ativos) > 0 && Yii::app()->user->id != 3907): ?>
                        <div id="planos_ativos">
                            <?php $this->renderPartial('_listagem_planos', array("planos" => $ativos)); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(count($expirados) > 0 && Yii::app()->user->id != 3907): ?>
                        <?php if(count($ativos) == 0): ?>
                            <div id="planos_expirados">
                        <?php else:?>
                            <div id="planos_expirados" style="display:none;">
                        <?php endif; ?>
                            <?php $this->renderPartial('_listagem_planos', array("planos" => $expirados)); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>

                <br class="clr">

            </div>
        <?php endif;?>

    </div>


</section>
