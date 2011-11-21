<div class="content">
	<div class="page-header">
		<h1><?php echo $tipo ?></h1>
	</div>
	<div class="row">
		<div class="span12">
			<?php if ($inscricao_efetuada === true): ?>
				<div class="alert-message block-message success">
					<a class="close" href="#">×</a>
					<p>Sua inscrição foi efetuada com sucesso!</p>
				</div>
			<?php elseif ($inscricao_efetuada): ?>
				<div class="alert-message block-message error">
					<a class="close" href="#">×</a>
					<p><?php echo $inscricao_efetuada ?></p>
				</div>
			<?php endif ?>
			<h2><?php echo $titulo ?> <small><?php echo $responsavel ?></small></h2>
			<br>
			<p><?php echo $descricao ?></p>
			<?php if ($descricao_ext): ?>
				<hr>
				<?php echo html_entity_decode($descricao_ext); ?>
				<hr>
			<?php endif ?>
		</div>
		<div class="span4">
			<b>Local:</b> <?php echo $local ?><br>
			<b>Trilha:</b> <?php echo @$trilha ?><br>
			<b>Horário(s):</b> <?php echo $data ?><br>
			<hr>
			<strong>Documentação Extra</strong><br><br>
			<?php foreach ($documentos as $key => $documento): ?>
				<a href="<?php echo $documento->getPath() ?>"
				   target="_blank"
				   rel="popover"
				   data-content="<?php echo $documento->descricao ?>"
				   data-original-title="<?php echo $documento->titulo ?>">
					<img src="<?php echo $documento->getIco() ?>"></a>
			<?php endforeach ?>
			<?php if ( ! isset($documento)): ?>
				Nenhuma documentação foi anexada para esta atividade
			<?php endif ?>
			<hr>
			<?php if ( ! $inscrito): ?>
				<a href="<?php echo URI::create("a/{$id}/inscricao") ?>"><button class="btn large info">Inscrição</button></a>
			<?php else: ?>
				<span class="label success">Você está inscrito nesta atividade</span>	
			<?php endif ?>
		</div>
	</div>
	<?php if ($shortbio): ?>
		<div class="row">
			<div class="span16">
				<h3>Sobre <?php echo $responsavel ?>:</h3>
				<?php echo $shortbio ?>
			</div>
		</div>
	<?php endif ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('a[rel=popover]').popover({
		placement: 'below'
	});
});
</script>