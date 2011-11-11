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
			<?php endif ?>
			<?php if ($inscricao_efetuada === 'already'): ?>
				<div class="alert-message block-message error">
					<a class="close" href="#">×</a>
					<p>Você já está inscrito nesta atividade!</p>
				</div>
			<?php endif ?>
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