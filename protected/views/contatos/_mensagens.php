<div style="cursor:pointer; <?php echo ($index % 2) ? 'background-color:#f1f1f1' : ''; ?>" class="mensagens-row view">


    <div class="div-check" style="width:50px !important;">
        <input class="check_msg" data-id="<?php echo $data->id; ?>" style="display:none;" type="checkbox"/>
    </div>

    <div class="mensagens-dados" data-id="<?php echo $data->id; ?>">
        <span class="mensagens-assunto">
            <?php
            if ($data->embarcacoes_id != null) {
                $emb = Embarcacoes::model()->findByPk($data->embarcacoes_id);

                // mensagem de anuncio 
                if ($emb->macros_id != 3) {
                    echo 'Classificado - ' . $emb->embarcacaoFabricantes->titulo . ' ' . $emb->embarcacaoModelos->titulo;
                }

                // mensagem de barco de estaleiro
                else {
                    echo 'Catálogo - ' . $emb->embarcacaoFabricantes->titulo . ' ' . $emb->embarcacaoModelos->titulo;
                }
            } else {

                if ($data->empresas_id != null) {

                    $emp = Empresas::model()->findByPk($data->empresas_id);

                    // guia 
                    if ($emp->macros_id != 3) {
                        echo 'Guia de Empresas';
                    }

                    // estaleiro
                    else {
                        echo 'Estaleiro';
                    }
                }
            }
            ?> 
            <br/>
            <span class="mensagens-remetente">
                <?php
                echo GxHtml::encode($data->nome_rem);
                ?> 
                (<?php
                echo GxHtml::encode($data->email_rem);
                ?>)
            </span>
        </span>
    </div>

    <div class="mensagens-texto" data-id="<?php echo $data->id; ?>">
        <span>
            <?php
            $titulo_mensagem = $data->titulo_mensagem;
            if ($titulo_mensagem == null) {
                $titulo_mensagem = $data->mensagem;
            }

            echo GxHtml::encode($titulo_mensagem);
            ?>
        </span>
    </div>

    <div class="mensagens-data" data-id="<?php echo $data->id; ?>">
        <span class="mensagens-recebido">
            <?php
            $data_mensagem = $data->data_do_titulo;
            if ($data_mensagem == null) {
                $data_mensagem = $data->data;
            }

            echo Utils::formatDateTimeToView(GxHtml::encode($data_mensagem));
            ?>
        </span>


        <?php
        // contador de conversas de mensagens do tipo catalogo/classificado
        if ($data->tipo == 'S' || $data->tipo == 'X') {
            $contadorConversas = Contatos::model()
                    ->count('usuarios_id_dest=:usuarios_id_dest and usuarios_id_rem=:usuarios_id_rem and embarcacoes_id=:embarcacoes_id', array(':usuarios_id_dest' => $data->usuarios_id_dest, ':usuarios_id_rem' => $data->usuarios_id_rem, ':embarcacoes_id' => $data->embarcacoes_id));

            $contadorConversas += Contatos::model()
                    ->count('usuarios_id_dest=:usuarios_id_dest and usuarios_id_rem=:usuarios_id_rem and embarcacoes_id=:embarcacoes_id', array(':usuarios_id_dest' => $data->usuarios_id_rem, ':usuarios_id_rem' => $data->usuarios_id_dest, ':embarcacoes_id' => $data->embarcacoes_id));

            // indica se existe alguma conversa nao lida
            $flg = Contatos::model()
                    ->exists('usuarios_id_dest=:usuarios_id_dest and usuarios_id_rem=:usuarios_id_rem and embarcacoes_id=:embarcacoes_id and status = 0', array(':usuarios_id_dest' => $data->usuarios_id_dest, ':usuarios_id_rem' => $data->usuarios_id_rem, ':embarcacoes_id' => $data->embarcacoes_id));
        }

        // contador de conversas de mensagens do tipo empresa
        else {
            $contadorConversas = Contatos::model()
                    ->count('usuarios_id_dest=:usuarios_id_dest and usuarios_id_rem=:usuarios_id_rem and empresas_id=:empresas_id', array(':usuarios_id_dest' => $data->usuarios_id_dest, ':usuarios_id_rem' => $data->usuarios_id_rem, ':empresas_id' => $data->empresas_id));

            $contadorConversas += Contatos::model()
                    ->count('usuarios_id_dest=:usuarios_id_dest and usuarios_id_rem=:usuarios_id_rem and empresas_id=:empresas_id', array(':usuarios_id_dest' => $data->usuarios_id_rem, ':usuarios_id_rem' => $data->usuarios_id_dest, ':empresas_id' => $data->empresas_id));

            // indica se existe alguma conversa nao lida
            $flg = Contatos::model()
                    ->exists('usuarios_id_dest=:usuarios_id_dest and usuarios_id_rem=:usuarios_id_rem and empresas_id=:empresas_id and status = 0', array(':usuarios_id_dest' => $data->usuarios_id_dest, ':usuarios_id_rem' => $data->usuarios_id_rem, ':empresas_id' => $data->empresas_id));
        }


        echo '<span class="mensagens-status">';

        if ($data->status == 0) {
            echo '<i class="carta-fechada"></i>';
        } else {

            if ($contadorConversas > 0) {
                // icone de carta respondida
                // echo $contadorConversas;
                if ($flg) {
                    echo '<i class="carta-fechada"></i><span class="msg-counter">' . $contadorConversas . '</span>';
                } else {
                    echo '<i class="mensagem-tick"></i><span class="msg-counter">' . $contadorConversas . '</span>';
                }
            } else {
                // carta aberta
                echo '<i class="carta-aberta"></i>';
            }
        }
        echo '</span>';
        ?>
    </div>

</div>


