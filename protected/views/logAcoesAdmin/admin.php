
<?php
	
	// array de classificacoes (tabela usuarios_classificacoes)
	$classificacoes_icone = array(
		8 => "/img/log_acesso_seo.png",
		7 => "/img/log_acesso_atendimento.png",
		9 => "/img/log_acesso_comercial.png",
		6 => "/img/log_acesso_conteudo.png",
		5 => "/img/log_acesso_admin.png",
	);

	$classificacoes_nome = array(
		8 => "SEO",
		7 => "Atendimento",
		9 => "Comercial",
		6 => "Conteúdo",
		5 => "Admin",
	);
?>

<div class="container">
<?php if(count($logs) > 0): ?>

	<div class="list-group">

	<?php foreach($logs as $l): ?>

		<?php $id_classificacao = Usuarios::model()->findByPk($l->username)->usuario_classificacoes_id; ?>
		<?php $email = Usuarios::model()->findByPk($l->username)->email; ?>

		<?php if($email == 'atendimento@bombarco.com.br') $id_classificacao = 7;?>
			<br/>

			<div class="row">

				<div class="col-sm-12 col-md-12 col-xs-12">
				   <div class="col-sm-2 col-md-2 col-xs-12 image-container">
				      <img style="margin: 0 auto; margin-top: 25px;" src="<?php echo $classificacoes_icone[$id_classificacao];?>" class="img-responsive" />
				   </div>
				   <div class="col-sm-10 col-md-10 col-xs-12">
				      <div class="list-group-item list-group-item-action flex-column align-items-start">
				         <div class="d-flex w-100 justify-content-between">
				            <h5 class="mb-1"><b><?php echo $classificacoes_nome[$id_classificacao];?></b> - <?php echo $email;?></h5>
				         </div>
				         <p class="mb-1">Log de acesso: <a href="<?php echo $l->details;?>" target="_blank"><?php echo $l->details;?></a></p>
				         <small class="text-muted">Data: <?php echo Utils::formatDateTimeToView($l->logtime);?></small>
				      </div>
				   </div>
				</div>
			</div>
	
	<?php endforeach; ?>

	</div>
	
	
<?php endif; ?>
</div>