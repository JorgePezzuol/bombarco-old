$(document).ready(function(){

	/**
	 * AJAX do Plano
	 */
	$('body').on('submit', '#form_plans', function(e){
		e.preventDefault();

		var flg = true;

		$(".required").each(function() {
			if($(this).val() == "") {
				$(this).css("border-color", "red");
				flg = false;
			}
		});

		if(!flg) return false;

		$.post(
			$('#form_plans').attr('action'),
			$('#form_plans').serialize(),
			function(json) {
				
				alert(json.message);

				if (json.success == 1) {
					location.reload();
				}
			},
			'json'
		);

	});


	/**
	 * Editando Plano
	 */
	$('.btn-edit-plan').on('click', function(e){
		e.preventDefault();

		$("#btn-delplano").show();

		$('html, body').animate({scrollTop: 50}, 'slow');

		var id 		= this.getAttribute('data-id');
		var plan_type = this.getAttribute('data-type');
		var plan 	= this.getAttribute('data-plan');
		var qnt 	= this.getAttribute('data-qnt');
		var status 	= this.getAttribute('data-status');
		var inicio 	= this.getAttribute('data-inicio');
		var fim 	= this.getAttribute('data-fim');

		document.getElementById("form_plans").setAttribute('action', Yii.app.createUrl('PlanoUsuarios/AJAXUpdate/'+id));
		$("#PlanoUsuarios_id").val(id);
		document.querySelector("#form_plans .lbox-form-submit").value = 'Editar';

		if (plan_type == '2') {
			document.querySelector('#form_plans #PlanoUsuarios_qntpermitida').style.display = 'none';
		} else {
			document.querySelector('#form_plans #PlanoUsuarios_qntpermitida').style.display = 'block';
		}


		$('#PlanoUsuarios_planos_id option[data-macro!="'+plan_type+'"]').hide(); 
		$('#PlanoUsuarios_planos_id option[data-macro="'+plan_type+'"]').show(); 


		/*select = document.querySelector('#form_plans #PlanoUsuarios_planos_id');

		for (var i=0; i < select.options.length; i++) {

			option = select.options[i];

			if (option.getAttribute('data-macro') != plan_type) {
				option.disabled = 'disabled';
				option.selected = '';
			} else {
				option.disabled = '';
			}

		};*/

		$('#lbox_form_plans').lightbox_me({
			centered: true,
			onLoad: function() {
				document.querySelector('#form_plans #PlanoUsuarios_inicio').value = inicio;
				document.querySelector('#form_plans #PlanoUsuarios_fim').value = fim;
				document.querySelector('#form_plans #PlanoUsuarios_qntpermitida').value = qnt;
				document.querySelector('#form_plans #PlanoUsuarios_status').value = status;
				document.querySelector('#form_plans #PlanoUsuarios_planos_id').value = plan;
			},
			onClose: function(){
				document.getElementById("form_plans").reset();
			}
		});

	});


	/**
	 * Cadastrando Plano
	 */
	$('.btn-create-plan').on('click', function(e){
		e.preventDefault();

		$("#btn-delplano").hide();

		$('html, body').animate({scrollTop: 50}, 'slow');

		var type = this.getAttribute('data-type');

		document.getElementById("form_plans").reset();
		document.querySelector("#form_plans .lbox-form-submit").value = 'Cadastrar';
		document.getElementById("form_plans").setAttribute('action', Yii.app.createUrl('PlanoUsuarios/AJAXCreate'));

		if (type == '2') {
			document.querySelector('#form_plans #PlanoUsuarios_qntpermitida').style.display = 'none';
		} else {
			document.querySelector('#form_plans #PlanoUsuarios_qntpermitida').style.display = 'block';
		}

		$('#PlanoUsuarios_planos_id option[data-macro!="'+type+'"]').hide(); 
		$('#PlanoUsuarios_planos_id option[data-macro="'+type+'"]').show(); 

		if(type == '3') {
			$("#PlanoUsuarios_planos_id option[value='102']").attr("selected", "selected");
			//$('select').prop('selectedIndex',  3);
		}

		/*select = document.querySelector('#form_plans #PlanoUsuarios_planos_id');

		for (var i=0; i < select.options.length; i++) {

			option = select.options[i];

			if (option.getAttribute('data-macro') != type) {
				option.disabled = 'disabled';
				console.log(option);
				option.selected = '';
			} else {
				option.disabled = '';
			}

		};*/

		$('#lbox_form_plans').lightbox_me({
			centered: true,
			onLoad: function() {}
		});

	});

	$(".btn-del-plan").on("click", function(e) {

		e.preventDefault();

		var s = confirm("Deseja realmente excluir o plano selecionado?");

		if(s) {

			var id = $(this).data("id");

			$.ajax({
				url: Yii.app.createUrl("planoUsuarios/delete", {id: id}),
				data: { },
				type: "POST",
				success: function(resp) {
					location.reload();
				}
			});
		}


	});


	/**
	 * Mudança de form de cadastro/edição baseado no Plano
	 */
	$('body').on('change', '#PlanoUsuarios_planos_id', function(){

		var option = this.options[this.selectedIndex];

		var time = option.getAttribute('data-time');
		var qnt = option.getAttribute('data-qnt');
		var macro = option.getAttribute('data-macro');

		if (macro == '2') {
			document.getElementById('PlanoUsuarios_qntpermitida').style.display = 'none';
		} else {
			document.querySelector('#form_plans #PlanoUsuarios_qntpermitida').style.display = 'block';
			document.getElementById('PlanoUsuarios_qntpermitida').value = qnt;
		}

		document.getElementById('PlanoUsuarios_inicio').value = moment().format('DD/MM/YYYY');
		document.getElementById('PlanoUsuarios_fim').value = moment().add(time, 'month').format('DD/MM/YYYY');

	});

});
