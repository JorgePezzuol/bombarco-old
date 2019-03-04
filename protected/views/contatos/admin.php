<?php
$count = Contatos::model()->count('usuarios_id_dest=:usuarios_id_dest and status = 0', array(':usuarios_id_dest' => Yii::app()->user->id));
?>
<!--<div class="line-admin-top2">
        <div class="container">
                <h1 class="title-admin-form">Gerenciar Mensagens</h1>
        </div>
</div>-->

<section id="menu-acesso">
    <?php
    $this->renderPartial('/minhaConta/menu');
    ?>
    <br class="clr">
</section>

<section id="estatisticas">
    <div class="estatisticas-line">
        <div class="container">

            <?php
                $flgNaoLidas = false;
                if(isset($_GET["filtro"]) && $_GET["filtro"] == 0) {
                    $flgNaoLidas = true;
                }
            ?>
            <!--<a class="bt-action" href="#">Marcar como lidas</a>-->
            <span class="estatisticas-title">
                Total de Mensagens
                <?php 
                    if($flgNaoLidas) {
                        echo " não lidas ";
                    }
                ?>
                (<?php  echo $count; ?>)
            </span>
            
            <!-- campos de busca -->
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>

            <?php if($count > 0): ?>
                <br/><br/>
                <div style="margin-left:14px;">
                    <input id="check_todas" style="display:none;" type="checkbox"/>
                    <span id="span_selecionar_todas" style="cursor:pointer;margin-left: 5px;color: #0f2e44;font-weight: bolder;">Selecionar todas</span>
                    <span style="color: #0f2e44;font-weight: bolder;" id="qtde_msg_selecionadas"> (0)</span>
                </div>
            <?php endif; ?>
            
            
            <!--<a id="selecionar-todas" style="margin-left: 20px;position: relative;color: #00918e; top: 35px;" href="#">#</a>-->
        </div>
    </div>
</div>
</section>
<section id="mensagens">

    <div class="container">

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $model->search(),
             'ajaxUpdate'=>false,
            'id' => 'mensagens-lista',
            'itemView' => '_mensagens', // refers to the partial view
            'sortableAttributes' => array(
                'nome_rem',
                'email_rem',
                'mensagem',
                'data',
            ),
        ));
        ?>

    </div>

</section>


<script>
    $(document).ready(function () {        

        $("#tipo").on("change", function () {

            var array_ids_checks = [];

            /*
                $filtros["M"] = "Listar todas";
                $filtros["N"] = "Listar não lidas";
                $filtros["Z"] = "Marcar como lidas";
                $filtros["V"] = "Marcar como não lidas";
                $filtros["D"] = "Deletar"
            */
            if($(this).val() == "N") {

                setUrlParameters("filtro", 0);
            }

            else if($(this).val() == "D") {

                $(".check_msg").each(function() {
                    if($(this).prop("checked") == true) {
                        array_ids_checks.push($(this).data("id"));
                    }
                });

                if(array_ids_checks.length > 0) {

                    $.ajax({

                        url: Yii.app.createUrl("contatos/deletarMsgs"),
                        data: {
                            ids: JSON.stringify(array_ids_checks),
                            // 1 => lida
                            // 0 => nao lida
                            status: 1
                        },
                        type: "POST",

                        success: function(resp) {
                            location.reload();
                        },
                        error: function(x, h, z) {

                        }
                    });
                }

            }

            else if($(this).val() == "M") {

                setUrlParameters("filtro", 1);
            }

            else if($(this).val() == "Z") {

                $(".check_msg").each(function() {
                    if($(this).prop("checked") == true) {
                        array_ids_checks.push($(this).data("id"));
                    }
                });

                if(array_ids_checks.length > 0) {
                    $.ajax({

                        url: Yii.app.createUrl("contatos/alterarStatusVariasMsgs"),
                        data: {
                            ids: JSON.stringify(array_ids_checks),
                            // 1 => lida
                            // 0 => nao lida
                            status: 1
                        },
                        type: "POST",

                        success: function(resp) {
                            location.reload();
                        },
                        error: function(x, h, z) {

                        }
                    });     
                }
            }

            else if($(this).val() == "V") {

                $(".check_msg").each(function() {
                    if($(this).prop("checked") == true) {
                        array_ids_checks.push($(this).data("id"));
                    }
                });

                if(array_ids_checks.length > 0) {

                    $.ajax({

                        url: Yii.app.createUrl("contatos/alterarStatusVariasMsgs"),
                        data: {
                            ids: JSON.stringify(array_ids_checks),
                            // 1 => lida
                            // 0 => nao lida
                            status: 0
                        },
                        type: "POST",

                        success: function(resp) {
                            location.reload();
                        },

                        error: function(x, h, z) {

                        }
                    }); 
                }

            }

            else { }
            

        });

        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('contatos-grid', {
                data: $(this).serialize()
            });
            return false;
        });


        $('.mensagens-data, .mensagens-texto, .mensagens-dados').on('click', function (e) {

            e.preventDefault(); 

            var contato_id = $(this).data('id');

            // ajax contabilizar msgs lidas
            $.ajax({
                url: Yii.app.createUrl('contatos/marcarComoLida'),
                data: {
                    id: contato_id
                },
                type: 'post',
                success: function (c) {
                    location.href = Yii.app.createUrl('contatos/view', {id: contato_id});
                }
            });
        });

        // <checkbox> selecionar msg
        $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter(".check_msg");
        $('.span-checkbox').on('click', function (e) {

            e.preventDefault();

            $(this).prev().trigger('click');

            if ($(this).hasClass('active-radio')) {
                $(this).removeClass('active-radio');
            } else {
                $(this).addClass('active-radio');
            }

            atualizarTextoMsgSelecionadas();
            
        });

        // <checkbox> selecionar todas as msgs
        $("<span class='span-checkbox-todas'><i class='ico-radio'></i></span>").insertAfter("#check_todas");
        $(".span-checkbox-todas").on("click", function(e) {

            e.preventDefault();

            $(this).prev().trigger('click');

            if ($(this).hasClass('active-radio')) {
                $(this).removeClass('active-radio');
            } else {
                $(this).addClass('active-radio');
            }

            // cada check ao lado da msg eh selecionado
            $(".span-checkbox").each(function() {

                $(this).trigger("click");
            });

        });

        // <span> selecionar todas as msgs
        $("#span_selecionar_todas").on("click", function(e) {

            $(".span-checkbox-todas").trigger("click");
        });

        function atualizarTextoMsgSelecionadas() {

            var qtde_msg_selecionadas = $(".span-checkbox.active-radio").length;
            $("#qtde_msg_selecionadas").empty();
            $("#qtde_msg_selecionadas").text(" ("+qtde_msg_selecionadas+")");
        }

    });
</script>

