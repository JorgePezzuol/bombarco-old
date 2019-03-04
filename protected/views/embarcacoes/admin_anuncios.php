
<div class="container">
	<h1>Anúncios de embarcações para validar</h1>
	<br/>

	<style>
	    .items {
            margin-left: -150px !important;
        }
		.grid-view table.items th, .grid-view table.items td {
		    font-size: 0.9em;
		    border: 1px white solid;
		    padding: 0.3em;
		}
		td .fa {
            padding: 7px;
        }
	</style>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'embarcacoes-grid',
	'dataProvider' => $model->searchAdminAnunciosParaValidar(),
	//'itemsCssClass' => "table table-bordered table-hover",
	'filter' => $model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}", //THIS DOES WHAT YOU WANT
	'columns' => array(
		'id',
		/*array(
			'header'=>'Pedido',
			'value'=>'$data->getReference()',
			'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
			),*/
		/*array(
			'name'=>'nome_usuario',
			'header'=>"Proprietário",
			'value'=>'Usuarios::buscarNomeDonoEmbarc($data->id)',
			'filter'=>false,
		),*/
		/*array(
			'header'=>'Pagamento',
			'value'=>'$data->getPagamento()',
			),*/
		array(
			'name'=>'gratuito',
			'header'=>"Gratuito?",
			'value' =>'($data->planoUsuarios->gratuito == 1) ? "Sim" : "Não"',
			'filter'=>array(1=>'Gratuitos', 0=>'Pagos'),
		),
		array(
			'header' => 'Data',
			'name' => 'dataregistro',
			'value' => 'Utils::formatDateTimeToView($data->dataregistro)',
			'filter' => false
		),
		array(
			'name'=>'email',
			'value'=>'$data->email'
		),
		array(
			'name'=>'embarcacao_macros_id',
			'value'=>'$data->embarcacaoModelos->embarcacaoFabricantes->embarcacaoMacros->titulo',
			'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'embarcacao_fabricantes_id',
			'header'=>'Fabricante',
			'value'=>'GxHtml::valueEx($data->embarcacaoFabricantes)'
			),
		array(
			'name'=>'embarcacao_modelos_id',
			'value'=>'GxHtml::valueEx($data->embarcacaoModelos)',
			'filter'=>GxHtml::listDataEx(EmbarcacaoModelos::model()->findAllAttributes(null, true)),
			),


		array(
			'name'=>'estados_id',
			'value'=>'GxHtml::valueEx($data->estados)',
			'filter'=>GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'cidades_id',
			'value'=>'GxHtml::valueEx($data->cidades)',
			'filter'=>GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'valor',
			'value' =>'($data->valor == "") ? "Não informado" : "R$ ".number_format($data -> valor, 2, ",", ".")',
		),
		array(
			'name'=> 'estado',
			'header'=>'Estado',
			'value' =>'($data->estado == "U") ? "Usado" : "Novo"',
			'filter'=>array('U'=>'Usado', 'N'=>'Novo'),
		),
		array(
			'name' => 'editado',
			'header' => 'Edição',
			'value' => 'Anuncio::$_status_editado_anuncio_by_number[(int)$data->editado]',
			'filter'=>array(0=>'OK', 1=>'Dados Editados', 2=>'Não Autorizado'),
		),
		array(
			'header'=>'Turbinada',
			'value'=>'count($data->turbinadas)',
			'value' =>'(count($data->turbinadas) == 0) ? "Não" : "Sim"',
			'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
		),

		array(
			'class' => 'CButtonColumn',
			'header' => 'Ações',
			'template' => '{view}{update}{activate}{deny}{delete}',
			'buttons' => array(
				'view' => array(
					'label' => '',
					'url' => 'Embarcacoes::mountUrl($data)',
					'options'=>array('class'=>'fa fa-search'),
					'imageUrl' => ''
				),
				'update'=> array(
					'label' => '',
					'options'=>array('class'=>'fa fa-pencil'),
					'imageUrl' => ''
				),
				'activate' => array(
					'label' => "",
					'url' => 'Yii::app()->createUrl("Embarcacoes/ativarAnuncio", array("id"=>$data->id))',
					'options'=>array('id'=>'btn-ativar', 'class'=>'fa fa-check pure-button btn-ativar'),
					'click'=>"function() {
						if(!confirm('".Yii::t('warnings','Confirme para ativar o anúncio')."')) return false;
							$.ajax({
							type:'GET',
							url:$(this).attr('href'),
								success:function(resp) {
									//console.log(resp);
									if(resp != '-1') {
										$.fn.yiiGridView.update('embarcacoes-grid');
										alert('Anúncio ativado com sucesso');
										//location.href = Yii.app.createUrl('embarcacoes/adminAnunciosParaValidar?t='+Math.random());
									}
									else {
										alert('Falha ao ativar o anúncio. Tente mais tarde.');
									}
								},
								error:function(x, h,z) {
									//console.log(h);
								}
							});
							return false;
						}",
				),
				'deny' => array(
					// só aparecer o botao de cancelar se tiver editado (editado = 1)
					//'visible' => '$data->editado == 1',
					'label' => "",
					'url' => 'Yii::app()->createUrl("Embarcacoes/anuncioNaoAutorizado", array("id"=>$data->id))',
					'options'=>array('id'=>'btn-desativar', 'class'=>'fa fa-remove pure-button btn-desativar'),
					'click'=>"function() {
						if(!confirm('".Yii::t('warnings','Ao informar o cliente que seu anúncio não foi autorizado pela equipe do BomBarco, ele ainda poderá alterar as informações e voltar a ser re-avaliado. Confirma?')."')) return false;
							$.ajax({
							type:'GET',
							url:$(this).attr('href'),
								success:function(resp) {
									if(resp != '-1') {
										$.fn.yiiGridView.update('embarcacoes-grid');
										alert('Operação Realizada com sucesso. Um e-mail foi enviado ao dono do anúncio.');
										//location.reload();
									}
									else {
										alert('Falha ao realizar a operação. Tente mais tarde.');
									}
								}
							});
							return false;
						}",
				),
                /*'delete' => array(
                    // só aparecer o botao de cancelar se tiver editado (editado = 1)
                    //'label' => "deletar",
                    'visible'=>'$data->status != Anuncio::$_status_anuncio["ANUNCIO_DELETADO"]',
                    'url' => 'Yii::app()->createUrl("Embarcacoes/deletarAnuncio", array("embarcacoes_id"=>$data->id))',
                    'options'=>array('class'=>'fa fa-remove'),
                    'click'=>"function(e) {
                        e.preventDefault();

                        if (!confirm('Tem certeza que deseja realizar esta operação?')) return false;

                        $.ajax({
                            type:'GET',
                            url:$(this).attr('href'),
                                success:function(resp) {
                                    if(resp != '-1') {
                                        $.fn.yiiGridView.update('embarcacoes-grid');
                                        alert('Operação Realizada com sucesso.');

                                    }
                                    else {
                                        alert('Falha ao realizar a operação. Tente mais tarde.');
                                    }
                                }
                            });
                        return false;
                    }",
                ),*/
			),
		),
	),

));
?>

</div>


<script>
    $( document ).ajaxComplete(function() {

    	if($("td").length) {
    		$("td").each(function() {
	            var td = $(this).text();

	            if(validateEmail(td)) {

	                var email = td; 
	                var id_embarc = $(this).prev().prev().prev().prev().text();

	                $(this).prev().prev().prev().css("word-wrap", "break-word");
	                $(this).prev().prev().prev().css("max-width", "80px");

	                $(this).empty();
	                $(this).append("<a data-idembarc='"+id_embarc+"' class='email-minhaconta' href='#'>"+email+"</a>");

	                
	            }
	        });

	        $(".email-minhaconta").on("click", function(e) {
	            e.preventDefault();
	            var idembarc = $(this).data("idembarc");
	            window.open(Yii.app.createUrl("usuarios/updateIndoPelaEmbarc", {id: idembarc}), '_blank'); 
	        });
    	}

    });

    $(document).ready(function() {
        
        $("td").each(function() {
            var td = $(this).text();
            
            if(validateEmail(td)) {

                var email = td; 
                var id_embarc = $(this).prev().prev().prev().prev().text();

                $(this).prev().prev().prev().css("word-wrap", "break-word");
                $(this).prev().prev().prev().css("max-width", "80px");

                $(this).empty();
                $(this).append("<a data-idembarc='"+id_embarc+"' class='email-minhaconta' href='#'>"+email+"</a>");

                
            }
        });

        $(".email-minhaconta").on("click", function(e) {
            e.preventDefault();
            var idembarc = $(this).data("idembarc");
            window.open(Yii.app.createUrl("usuarios/updateIndoPelaEmbarc", {id: idembarc}), '_blank'); 
        }); 
    });

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>