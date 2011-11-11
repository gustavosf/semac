<div class="content">
	<div class="page-header">
		<h1>Minhas Atividades</h1>
	</div>
	<div class="row">
		<div class="span16">
			<table>
				<thead>
					<tr>
						<th>Atividade</th>
						<th>Data</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($inscricoes as $id => $inscricao): ?>
					<tr>
						<td>
							<?php echo $inscricao->atividade->titulo ?>
							<a href="<?php echo URI::CREATE('a/'.$inscricao->atividade->id) ?>">
								<?php echo ASSET::img('ico/link.png') ?>
							</a>
						</td>
						<td><?php echo $inscricao->atividade->getDataSerial() ?></td>
						<td><?php echo $inscricao->getStatus() ?></td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>