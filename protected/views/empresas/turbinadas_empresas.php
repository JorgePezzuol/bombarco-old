<div class="form">

<?php $form = $this->beginWidget('GxActiveForm', array(
    'id' => 'empresas-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
?>


<div class="line-admin-top2">
    <div class="container">
        <h1 class="title-admin-form"><?php echo $empresa->nomefantasia;?></h1>
        <div class="sucessmsg"></div>
    </div>
</div>

<div class="line-admin-cad-mod">
    <div class="container">
        <div class="box-admin-form2">

            <div class="box-admin-form">

                <?php if($mensagem != ''): ?>
                    <a style="color:#0F2E44;" href="<?php echo Yii::app()->createUrl('empresas/admin');?>">Voltar a lista</a>
                <?php endif;?>

                <span class="text-admin-form2" style="color:#0F2E44;"><?php echo $mensagem;?></span>

            </div><!-- row -->

            <div class="box-admin-form">
                <input type="checkbox" name="turbinadas[]" value="video" <?php echo (Empresas::checkTurbo($empresa, 'video')) ? 'checked' : ''; ?> />
                <span class="text-admin-form2">Vídeo</span>
            </div><!-- row -->

            <div class="box-admin-form">
                <input type="checkbox" name="turbinadas[]" value="telefone" <?php echo (Empresas::checkTurbo($empresa, 'telefone')) ? 'checked' : ''; ?> />
                <span class="text-admin-form2">Telefone</span>
            </div><!-- row -->

            <div class="box-admin-form">
                <input type="checkbox" name="turbinadas[]" value="descricao" <?php echo (Empresas::checkTurbo($empresa, 'descricao')) ? 'checked' : ''; ?> />
                <span class="text-admin-form2">Descrição Completa</span>
            </div><!-- row -->

            <div class="box-admin-form">
                <input type="checkbox" name="turbinadas[]" value="fotos" <?php echo (Empresas::checkTurbo($empresa, 'fotos')) ? 'checked' : ''; ?> />
                <span class="text-admin-form2">Fotos</span>
            </div><!-- row -->

            <div class="box-admin-form">
                <span class="text-admin-form2">CPM</span>
                <div>
                    <?php $limitviews = (isset($empresa->empresasImpressoes) && !empty($empresa->empresasImpressoes)) ? (int) $empresa->empresasImpressoes[0]->limitviews : 0; ?>
                    <select id="qtde-impressoes" name="cpm">
                        <option value="" <?php echo (empty($limitviews)) ? 'selected' : ''; ?>>Selecione</option>
                        <option value="10" <?php echo ($limitviews == 10000) ? 'selected' : ''; ?>>10 mil impressões</option>
                        <option value="20" <?php echo ($limitviews == 20000) ? 'selected' : ''; ?>>20 mil impressões</option>
                        <option value="30" <?php echo ($limitviews == 30000) ? 'selected' : ''; ?>>30 mil impressões</option>
                        <option value="40" <?php echo ($limitviews == 40000) ? 'selected' : ''; ?>>40 mil impressões</option>
                        <option value="50" <?php echo ($limitviews == 50000) ? 'selected' : ''; ?>>50 mil impressões</option>
                        <option value="60" <?php echo ($limitviews == 60000) ? 'selected' : ''; ?>>60 mil impressões</option>
                    </select>
                </div>
            </div>
                <input type="checkbox" name="turbinadas[]" value="cpm" checked="checked" style="display:none;"/>

            <div class="box-admin-form">
                <?php
                    echo GxHtml::submitButton(Yii::t('app', 'SALVAR'),array('class'=>'botao-cad-admin'));
                    $this->endWidget();
                ?>

            </div><!-- row -->

    </div>

</div><!-- form -->




