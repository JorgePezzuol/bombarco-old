<div class="search-box" style="width: 655px !important;">

    <?php
    $form = $this->beginWidget('GxActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <span class="search-box-title">Opções: </span>

    <span class="search-box-select">

        <?php
        // gerar array com os valores dos filtros
        $filtros = array();
        $filtros["M"] = "Listar todas";
        $filtros["N"] = "Listar não lidas";
        $filtros["Z"] = "Marcar como lidas";
        $filtros["V"] = "Marcar como não lidas";
        $filtros["D"] = "Deletar mensagens";

        if (PlanoUsuarios::model()->with('planos')->exists('usuarios_id=:usuarios_id and planos.flag = "plano_empresa"', array(':usuarios_id' => Yii::app()->user->id))) {
        }

        if (PlanoUsuarios::model()->with('planos')->exists('usuarios_id=:usuarios_id and planos.flag = "plano_estaleiro"', array(':usuarios_id' => Yii::app()->user->id))) {
            //$filtros[Anuncio::$_tipo_contato['ESTALEIRO']] = "Estaleiro";
        }

        if (PlanoUsuarios::model()->with('planos')->exists('usuarios_id=:usuarios_id and (planos.flag = "plano_embarcacao" OR planos.flag = "plano_individual")', array(':usuarios_id' => Yii::app()->user->id))) {
        }
        ?>
        
        <?php echo $form->dropDownList($model, 'tipo', $filtros, array('id' => 'tipo', 'prompt' => Yii::t('app', 'Selecione'))); ?>	
    </span>

    <span class="search-box-input-text">
        <?php echo $form->textField($model, 'mensagem', array('maxlength' => 255, 'id' => 'input-busca')); ?>	
        <?php
        if (!empty($model->mensagem))
            echo CHtml::link('X', array('contatos/mensagens'), array('class'=>'search-clear', 'alt'=>'Zerar a busca', 'title'=>'Zerar a busca'));        
        ?>
    </span>


    <?php $this->endWidget(); ?>

</div>

