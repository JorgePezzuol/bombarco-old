<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<section id="estatisticas">
    <div class="estatisticas-line">
        <div class="container">
            <a data-link="mensagens" class="botao-minha-conta btninst aba-minha-conta estatisticas-title" href="<?php echo Yii::app()->createUrl('contatos/mensagens'); ?>">Mensagens</a>
            <a href="javascript:window.history.back(-1);" class="bt-voltar">Voltar</a>
        </div>
    </div>
</section>

<section id="mensagens">
    <div class="container">
        <div class="mensagens-individual-box">

            <?php
            // mensagem de embarcação de anuncio ou catalogo
            if ($model->tipo == Anuncio::$_tipo_contato['EMBARCACAO_CLASSIFICADO'] || $model->tipo == Anuncio::$_tipo_contato['EMBARCACAO_CATALOGO']) {

                $embarcacao = Embarcacoes::model()->findByPk($model->embarcacoes_id);
                $fabricante = $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo;
                $modelo = $embarcacao->embarcacaoModelos->titulo;

                if ($embarcacao->macros_id == 3) {
                    $texto = 'Catálogo > ';
                } else {
                    $texto = 'Classificado > ';
                }

                echo '<span class="mensagem-assunto">' . $texto . '<a class="mensagem-assunto-link" href="' . Embarcacoes::mountUrl($embarcacao) . '">' . $fabricante . ' ' . $modelo . '</a></span>';

                $perguntas = Contatos::model()
                        ->findAll('usuarios_id_dest=:usuarios_id_dest and embarcacoes_id=:embarcacoes_id and email_rem=:email_rem', array(':usuarios_id_dest' => Yii::app()->user->id, ':embarcacoes_id' => $model->embarcacoes_id, ':email_rem' => $model->email_rem));

                $respostas = Contatos::model()
                        ->findAll('email_dest=:email_rem and embarcacoes_id=:embarcacoes_id and usuarios_id_rem=:usuarios_id_rem', array(':email_rem'=>$model->email_rem, ':embarcacoes_id' => $model->embarcacoes_id, ':usuarios_id_rem' => Yii::app()->user->id));



                // perguntas do usuario do email em questão
                /* $perguntas = Contatos::model()
                  ->findAll('email=:email and usuarios_id=:usuarios_id and embarcacoes_id=:embarcacoes_id',
                  array(':email'=>$model->email, ':usuarios_id'=>Yii::app()->user->id, ':embarcacoes_id'=>$model->embarcacoes_id));

                  // minhas respostas para o usuario do email em questão
                  $usuario = Usuarios::model()->find('email=:email', array(':email'=>$model->email));
                  $respostas = Contatos::model()
                  ->findAll('usuarios_id=:usuarios_id and email_dest=:email_dest and embarcacoes_id=:embarcacoes_id and email=:email',
                  array(':usuarios_id'=>$usuario->id, ':email_dest'=>$usuario->email, ':embarcacoes_id'=>$model->embarcacoes_id, ':email'=>Usuarios::getUsuarioLogado()->email)); */
            }

            // mensagens para a empresa
            else {

                $empresa = Empresas::model()->findByPk($model->empresas_id);
                if ($empresa->macros_id == 3) {
                    $texto = "Estaleiro";
                } else {
                    $texto = "Guia de Empresa";
                }
                echo '<a href="' . Empresas::mountUrl($empresa, $empresa->macros_id) . '" class="mensagem-assunto">' . $texto . ' - ' . $empresa->razao . '</a>';

                $perguntas = Contatos::model()
                        ->findAll('usuarios_id_dest=:usuarios_id_dest AND empresas_id=:empresas_id AND email_rem=:email_rem', array(':usuarios_id_dest' => Yii::app()->user->id, ':empresas_id' => $model->empresas_id, ':email_rem' => $model->email_rem));

                $respostas = Contatos::model()
                        ->findAll('email_dest=:email_dest AND empresas_id=:empresas_id AND usuarios_id_rem=:usuarios_id_rem', array(':email_dest'=>$model->email_rem, ':empresas_id' => $model->empresas_id, ':usuarios_id_rem' => Yii::app()->user->id));
            }
            ?>

            <?php
                echo '<span class="mensagem-dados-remetente">' . $model->nome_rem . ' <b>(' . $model->email_rem . ') </b><span>' . $model->telefone_rem . '</span></span>';
            ?>

            <br class="clr">

            <textarea id="mensagem-contato-anunciante" class="mensagens-resposta"></textarea>
            <input type="text" name="j8BSVuvy" class="j8BSVuvy" value="" style="display:none !important;">

            <!-- se for empresa muda o id do botao -->
            <?php if ($model->tipo == Anuncio::$_tipo_contato['ESTALEIRO'] || $model->tipo == Anuncio::$_tipo_contato['GUIA_DE_EMPRESAS']): ?>
                <a id="btn-contato-empresa" class="bt-action" href="#">RESPONDER</a>
            <?php else: ?>
                <a id="btn-contato-anunciante" class="bt-action" href="#">RESPONDER</a>
            <?php endif; ?>


        </div>
        <br class="clr">
    </div>
</section>

<section id="mensagens">
    <div class="container">
        <div class="mensagens-individual-box" id="div-mensagens">

            <?php
            $mensagens = array();

            foreach ($perguntas as $p) {

                $obj = array();
                $obj["data"] = $p->data;
                $obj["nome"] = $p->nome_rem;
                $obj["mensagem"] = $p->mensagem;

                $mensagens[] = $obj;

                //$mensagens[] = $p->mensagem;
            }
            foreach ($respostas as $r) {

                $obj = array();
                $obj["data"] = $r->data;
                $obj["nome"] = $r->nome_rem;
                $obj["mensagem"] = $r->mensagem;

                $mensagens[] = $obj;

                //$mensagens[] = $r->mensagem;
            }

// ordenar datas (buble sort)
            $nowData = null;
            for ($i = 0; $i < count($mensagens); $i++) {
                for ($j = 0; $j < count($mensagens); $j++) {
                    if (strtotime($mensagens[$i]["data"]) < strtotime($mensagens[$j]["data"])) {
                        $nowData = $mensagens[$i];
                        $mensagens[$i] = $mensagens[$j];
                        $mensagens[$j] = $nowData;
                    }
                }
            }
            $mensagens_reverse = array_reverse($mensagens);

            foreach ($mensagens_reverse as $m) {

                if ($m["nome"] == Usuarios::getUsuarioLogado()->nome) {

                    // muda cor do texto da div se for eu
                    echo '<div class="mensagem-individual-resposta">';
                } else {
                    echo '<div class="mensagem-individual-resposta">';
                }

                echo '<span class="resposta-autor"><b>' . $m["nome"] . '</b> ' . Utils::formatDateTimeToView($m["data"]) . '</span>';
                echo '<p>' . $m["mensagem"] . ' </p>';
                echo '</div>';
            }
            ?>

        </div>
        <br class="clr">
    </div>
</section>


<?php

// se for mensagem de embarcação
if ($model->tipo == Anuncio::$_tipo_contato['EMBARCACAO_CLASSIFICADO'] || $model->tipo == Anuncio::$_tipo_contato['EMBARCACAO_CATALOGO']) {

    // id do usuario destinatário
    echo CHtml::hiddenField('idUsuarioDonoEmbarc', '', array('id' => 'idUsuarioDonoEmbarc'));

    // id da embarcação
    echo CHtml::hiddenField('idEmbarcacao', $model->embarcacoes_id, array('id' => 'idEmbarcacao'));

    // email da embarcação

    // se for o dono da embarc respondendo a pergunta, manda pro email do interessado
    if(Embarcacoes::checarSeEhDono(Yii::app()->user->id, $model->embarcacoes_id) == true) {
        echo CHtml::hiddenField('emailEmbarcacao', $model->email_rem);
    }

    // se for o usuario interessado na embarc manda pro email da embarc
    else {
        echo CHtml::hiddenField('emailEmbarcacao', Embarcacoes::model()->findByPk($model->embarcacoes_id)->email);    
    }
    
    
}

// empresa
else {

    // id da empresa
    echo CHtml::hiddenField('empresas_id', $model->empresas_id, array('id' => 'empresas_id'));
}


if (Usuarios::getUsuarioLogado()->nome != null) {
    echo CHtml::hiddenField('nome', Usuarios::getUsuarioLogado()->nome, array('id' => 'nome-contato-anunciante'));
} else {
    $emp = Usuarios::getEmpresa();
    if ($emp != null) {
        echo CHtml::hiddenField('razaosocial', $emp->razao, array('id' => 'nome-contato-anunciante'));
    } else {
        echo CHtml::hiddenField('razaosocial', Usuarios::getUsuarioLogado()->razaosocial, array('id' => 'nome-contato-anunciante'));
    }
}



// indica que é o form de resposta
echo CHtml::hiddenField('resposta', 1, array('id' => 'resposta'));

// indica se eé form de resposta de anuncio ou empresa
echo CHtml::hiddenField('tipo', $model->tipo, array('id' => 'tipo'));

// nome
echo CHtml::hiddenField('nome', Usuarios::getUsuarioLogado()->nome, array('id' => 'nome-contato-anunciante'));
echo CHtml::hiddenField('nome_destinatario', $model->nome_rem, array('id' => 'nome-contato'));

// email
echo CHtml::hiddenField('email', Usuarios::getUsuarioLogado()->email, array('id' => 'email-contato-anunciante'));

// telefone
$telefone = (!empty(Usuarios::getUsuarioLogado()->celular)) ? Usuarios::getUsuarioLogado()->celular : 'Sem Telefone';
echo CHtml::hiddenField('telefone', $telefone, array('id' => 'telefone-contato-anunciante'));

// data
echo CHtml::hiddenField('data', Utils::formatDateTimeToView(date('Y-m-d H:i:s')), array('id' => 'data'));

// EMAIL do usuario destinatário
echo CHtml::hiddenField('email_dest', $model->email_rem, array('id' => 'email_dest'));

// EMAIL do usuario destinatário
$usuario = Usuarios::model()->findByAttributes(array('email' => $model->email_rem));
if (!empty($usuario))
    echo CHtml::hiddenField('usuarios_id_dest', $usuario->id, array('id' => 'usuarios_id_dest'));
?>





