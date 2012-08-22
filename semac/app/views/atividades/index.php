<header class="jumbotron subhead">
	<div class="container">
		<h2><?php echo $atividade->titulo ?></h2>
		<?php echo $atividade->responsavel ?>
	</div>
</header>

<div class="container">
	<div class="row">
		<div class="span9">
			<?php if ($inscricao_efetuada === true): ?>
				<div class="alert alert-success alert-block">
					<a class="close" data-dismiss="alert" href="#">×</a>
					<p>Sua inscrição foi efetuada com sucesso!</p>
				</div>
			<?php elseif ($inscricao_efetuada): ?>
				<div class="alert alert-block alert-error">
					<a class="close" data-dismiss="alert" href="#">×</a>
					<p><?php echo $inscricao_efetuada ?></p>
				</div>
			<?php endif ?>
			<p><?php echo $atividade->more->descricao ?></p>
			<?php if ($atividade->more->descricao_ext): ?>
				<hr>
				<?php echo html_entity_decode($atividade->more->descricao_ext); ?>
				<hr>
			<?php endif ?>
		</div>
		<div class="span3">
			<table class='table table-striped'>
				<tbody>
					<?php foreach ($atividade->getData() as $data): ?>
						<tr>
							<td>
								<strong><?php echo $data['data'].' - '.$data['as'].' até '.$data['ate'] ?></strong><br>
								<?php echo $data['local'] ?>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<b>Trilha:</b> <?php //echo $trilha ?><br>
			<?php if ($vagas): ?>
				<hr><strong>Vagas:</strong> <?php echo $vagas ?>
			<?php endif ?>
			<hr>
			<strong>Documentação Extra</strong><br><br>
			<?php foreach ($atividade->documentos as $key => $documento): ?>
				<a href="<?php echo $documento->getPath() ?>"
				   target="_blank"
				   rel="popover"
				   data-original-title="<?php echo $documento->titulo ?> <small>(<?php echo $documento->get_size() ?>)</small>"
				   data-content="<?php echo $documento->descricao ?>">
					<img src="<?php echo $documento->getIco() ?>"></a>
			<?php endforeach ?>
			<?php if (count($atividade->documentos) === 0): ?>
				Nenhuma documentação foi anexada para esta atividade
			<?php endif ?>
			<hr>
			<?php if ($inscrito === false): ?>
				<?php if ($vagas_disponiveis === 0): ?>
					<span class="label label-important">Limite de vagas atingido</span>
				<?php else: ?>
					<a href="<?php echo URI::create("a/{$atividade->id}/inscricao") ?>"><button class="btn btn-info">Inscrição</button></a>
				<?php endif ?>
			<?php elseif ($inscrito == 0): ?>
				<span class="label label-warning">Cadastrado nesta atividade</span>
			<?php elseif ($inscrito == 1): ?>
				<span class="label label-success">Inscrito nesta atividade</span>
			<?php elseif ($inscrito == 2): ?>
				<span class="label label-important">Inscrição recusada nesta atividade</span>
			<?php endif ?>
		</div>
	</div>
	<?php if ($atividade->more->shortbio): ?>
		<div class="row">
			<div class="span12">
				<h3>Sobre <?php echo $atividade->responsavel ?>:</h3>
				<?php echo $atividade->more->shortbio ?>
			</div>
		</div>
	<?php endif ?>
</div>