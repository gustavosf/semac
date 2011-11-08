<div class="content">
	<div class="page-header">
		<h1><?php echo $tipo ?></h1>
	</div>
	<div class="row">
		<div class="span12">
			<h2><?php echo $titulo ?> <small><?php echo $responsavel ?></small></h2>
			<br>
			<p><?php echo $descricao ?></p>
		</div>
		<div class="span4">
			<b>Local:</b> <?php echo $local ?><br>
			<b>Trilha:</b> <?php echo @$trilha ?><br>
			<b>Horário(s):</b> <?php echo $data ?><br>
			<hr>
			Documentação Extra
			<hr>
			<a href="<?php echo URI::create("a/{$id}/inscricao") ?>"><button class="btn large info">Inscrição</button></a>
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