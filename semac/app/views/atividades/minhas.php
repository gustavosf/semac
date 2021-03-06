<div class="page-header">
	<h1>Minhas Atividades</h1>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Atividade</th>
			<th>Data</th>
			<th>Status</th>
			<th>Presença</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($inscricoes as $id => $inscricao): ?>
		<tr>
			<td>
				<?php echo $inscricao->atividade->titulo ?>
				<a href="<?php echo URI::CREATE("atividades/{$inscricao->atividade->tipo->nome_canonico}/{$inscricao->atividade->id}") ?>">
					<?php echo ASSET::img('ico/link.png') ?>
				</a>
			</td>
			<td><?php echo $inscricao->atividade->getDataSerial() ?></td>
			<td>
				<a href="#" rel='twipsy' title='<?php echo $inscricao->getStatusDesc(); ?>'>
					<?php echo $inscricao->getStatus() ?>
				</a>
			</td>
			<td>
				<?php if ($inscricao->estaInscrito()): ?>
					<?php foreach ($inscricao->atividade->datas as $key => $data): ?>
						<?php if ($data->jaPassou()): ?>
							<?php if ($data->isPresente($user_id)): ?>
								<?php echo Asset::img('ico/presente.png', array(
									'rel' => 'twipsy',
									'title' => 'Presente no dia '.$data->getData(),
								)); ?>
							<?php else: ?>
								<?php echo Asset::img('ico/cancel.png', array(
									'rel' => 'twipsy',
									'title' => 'Ausente no dia '.$data->getData(),
								)); ?>
							<?php endif ?>
						<?php else: ?>
							-
						<?php endif ?>
					<?php endforeach ?>
				<?php else: ?>
					-
				<?php endif ?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
<script type="text/javascript">
$(document).ready(function(){
	$('a[rel=twipsy],img[rel=twipsy]').tooltip();
});
</script>