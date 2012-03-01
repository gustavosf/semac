<div class="content">
	<div class="page-header">
		<h1><?php echo $tipo ?></h1>
	</div>
	<div class="row">
		<div class="span8">
			<?php if ($inscricao_efetuada === true): ?>
				<div class="alert alert-success alert-block">
					<a class="close" href="#">×</a>
					<p>Sua inscrição foi efetuada com sucesso!</p>
				</div>
			<?php elseif ($inscricao_efetuada): ?>
				<div class="alert-message alert-block alert-error">
					<a class="close" href="#">×</a>
					<p><?php echo $inscricao_efetuada ?></p>
				</div>
			<?php endif ?>
			<h2><?php echo $titulo ?> <small><?php echo $responsavel ?></small></h2>
			<br>
			<p><?php echo $descricao ?></p>
			<?php if ($descricao_ext): ?>
				<hr>
				<?php echo utf8_encode(html_entity_decode($descricao_ext)); ?>
				<hr>
			<?php endif ?>
		</div>
		<div class="span4">
			<table class='table table-striped'>
				<tbody>
					<?php foreach ($datas as $data): ?>
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
			<?php if ($inscrito === false): ?>
				<a href="<?php echo URI::create("a/{$id}/inscricao") ?>"><button class="btn btn-info">Inscrição</button></a>
			<?php elseif ($inscrito == 0): ?>
				<span class="label label-warning">Cadastrado nesta atividade</span>	
			<?php elseif ($inscrito == 1): ?>
				<span class="label label-success">Inscrito nesta atividade</span>	
			<?php elseif ($inscrito == 2): ?>
				<span class="label label-important">Inscrição recusada nesta atividade</span>	
			<?php endif ?>
		</div>
	</div>
	<?php if ($shortbio): ?>
		<div class="row">
			<div class="span12">
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