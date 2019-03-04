<div class="info-dados">
    <span class="info-text">Nome: <span><?php echo $model->nome; ?></span></span>
    <span class="info-text">Sobrenome: <span><?php echo $model->sobrenome; ?></span></span>
    <span class="info-text">CPF: <span><?php echo $model->cpf; ?> </span></span>
    <span class="info-text">Data de nascimento: <span><?php echo Usuarios::formatDateTimeToView($model->data_nascimento); ?></span></span>

    <?php if ($model->endereco != "" && $model->endereco != null): ?>
        <span class="info-text">Endereço: <span><?php echo $model->endereco . ', ' . $model->numero . ' - (' . $model->complemento . ') - ' . $model->bairro; ?></span>	</span>
    <?php endif; ?>

    <span class="info-text">

        <?php
        if ($model->estados != null && $model->cidades != null) {
            echo $model->estados->uf . ' / ' . $model->cidades->nome;
        }
        ?>
    </span></br>

    <?php if (!empty($model->telefone)): ?>
        <span class="info-text">Telefone Fixo: <span><?php echo $model->telefone; ?> </span></span>
    <?php endif ?>

    <?php if (!empty($model->celular)): ?>
        <span class="info-text">Celular: <span><?php echo $model->celular; ?> </span></span>
    <?php endif ?>

    <?php if (!empty($model->nextel)): ?>
        <span class="info-text">Nextel: <span><?php echo $model->nextel; ?> </span></span>
    <?php endif ?>

    <br class="clr">

    <?php if (!empty($model->logo)): ?>
        <!--<span class="info-text">Logotipo:</span>-->
        <?php
        if ($model->logo != "" && $model->logo != null) {
            $imagem = $model->logo;
        } else {
            $imagem = 'addfoto.png';
        }
        echo '<div class="upload-img-box" style="margin-top: 15px;">';
        echo '<div class="img-crop" >' . CHtml::image(Yii::app()->request->baseUrl . '/public/usuarios/' . $imagem, "logo", array('id' => 'logo', 'class' => 'img-upload img-turbinada img-preview')) . '</div>';
        // echo CHtml::activeFileField($model, 'logo', array('style'=>'display: none;', 'name'=>'logo', 'id'=>'logo-file'));
        // echo '<span id="remover-logo" class="remover bt-remover-img">Excluir</span>';
        echo '</div>';
        ?>
    <?php endif ?>
    
</div>

<br class="clr">

<a id="alterar-dados-pf" class="bt-action" href="#">Editar</a>


