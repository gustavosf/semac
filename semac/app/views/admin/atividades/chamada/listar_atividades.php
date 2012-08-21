<div class="page-header">
	<h1>Lista de Presenças</h1>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Título</th>
			<th>Responsável</th>
			<th width=76></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($atividades as $id => $atividade): ?>
			<tr>
				<td><?php echo $atividade->getTipo(); ?></td>
				<td><?php echo $atividade->titulo ?: '-'; ?></td>
				<td><?php echo $atividade->responsavel ?: '-'; ?></td>
				<td>
					<a href="<?php echo URI::create('admin/atividades/extrato_chamadas/'.$atividade->id); ?>">
						<?php echo Asset::img('ico/presenca.png', array('title' => 'Lista de Chamada')); ?></a>
				</td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! sizeof($atividades)): ?>
			<tr><td colspan=4 style="text-align:center">Você não possui nenhuma atividade associada</td></tr>
		<?php endif ?>
	</tbody>
</table>