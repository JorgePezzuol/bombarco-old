<?php
        
        $htmlClassificados = "";

        // loop para cada registro de planoUsuario => pegamos o plano
        foreach ($planos as $p) {

            if (empty($p->inicio) || empty($p->fim)) {
                continue;
            }

            $dias = 999;

            // gambs caso o plano gratuito seja feito mas o admin ainda n aprovou
            $p->inicio = implode("-",array_reverse(explode("/",$p->inicio)));

            $inicio = date('Y-m-d', strtotime($p->inicio));

            $dataexpiracao = date('Y-m-d', strtotime($inicio.' + 1 month'));

            $dia = date('d', strtotime($dataexpiracao));
            $ano = date("Y", strtotime($dataexpiracao));
            $mes = date("m", strtotime($dataexpiracao));

            // gambiarra p n bugar na hora de listar o plano gratis
            if($p->planos->gratuito == "1") {
                $fim = DateTime::createFromFormat('d/m/Y', "07/12/2099");
            }
            else {
                $fim = DateTime::createFromFormat('d/m/Y', $p->fim);
            }

            // verificar se o plano está perto da data de validade para exibir o plano de renovação
            $hoje = new DateTime('now');
            @$dias = $hoje->diff($fim)->format('%a');
            @$dias = ($hoje > $fim) ? $dias * -1 : $dias;

            // AGORA FALTA FAZER O CASO DE VENCER E ELE N TER AGENDADO NENHUMA RENOVACAO
            if($p->planos->gratuito == 1) {
                $htmlClassificados .= '<div class="plano-line"><div class="plano-tipo">Anúncio Gratuíto <br></div>';
                $htmlClassificados .= '<div class="plano-vencimento"><span>Ativo</span></div>';
            }
            else {

                // ver se tem renovacao de plano agendada ou paga
                $renovacao = PlanosUsuariosRenovados::consultar($p->id);

                if($p->qntpermitida == 1) {
                    $texto = "anúncio";
                }
                else {
                    $texto = "anúncios";
                }
                /*$htmlClassificados .= '<div class="plano-line"><div class="plano-tipo">'.$p->qntpermitida . ' ' .$texto . ' por ' . $p->planos->duracaomeses . ' meses ' . 'R$ ' . Utils::formataValorView($p->planos->valor) . '</div>';*/
                $htmlClassificados .= '<div class="plano-line"><div class="plano-tipo">'.$p->qntpermitida . ' ' .$texto . ' por ' . $p->planos->duracaomeses . ' meses </div>';

                // se a diferença for de 6~7 dias, exiberemos o botão, indicando que o plano está vencendo
                if ( ($dias <= 7 || $dias < 0) && $renovacao == null ) {

                    //$htmlClassificados .= '<a class="bt-renew-plan link-renovar" href="' . Yii::app()->createUrl('/planoUsuarios/upgradePlano', array('id' => $p->id)) . '">Renovar Plano</a>';    
                }

                if ($dias < 0) {
                    $htmlClassificados .= '<div class="plano-vencimento"><span>Vencido ('.$fim->format('d/m/Y').')</span></div>';
                } else {

                    $vencimento = "";
                    // so mostra o vencimento se estiver ativo
                    if($p->status == 2) {

                        $vencimento = ' - Vencimento ' . $fim->format('d/m/Y') . '</span>';
                    }

                    if($renovacao != null) {

                        switch($renovacao->status) {
                            case Anuncio::$_status_plano["RENOVACAO_CRIADA"]:
                                $status = "Pagamento da renovação pendente";
                            break;

                            case Anuncio::$_status_plano["RENOVACAO_PAGA"]:
                                $status = "Renovação paga";
                            break;
                        }
                    }

                    else {
                        $status = PlanoUsuarios::$_status_plano_id[$p->status];
                    }


                    $htmlClassificados .= '<div class="plano-vencimento"><span>' . $status . $vencimento.'</span></div>';
                }
            }
        }


        if ($htmlClassificados != "") {
            echo '<span class="title-planos">Classificados</span>';
            echo $htmlClassificados;
            echo '</div>';
        }

?>
