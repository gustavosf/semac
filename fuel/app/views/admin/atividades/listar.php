<h2>Lista de Atividades</h2>
<hr/>
<table>
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Título</th>
			<th>Responsável</th>
			<th width=16></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($atividades as $id => $atividade): ?>
			<tr>
				<td><?php echo $atividade->getTipo(); ?></td>
				<td><?php echo $atividade->titulo ?: '-'; ?></td>
				<td><?php echo $atividade->responsavel ?: '-'; ?></td>
				<td>
					<a href="<?php echo URI::create('admin/atividades/editar/'.$atividade->id); ?>">
						<?php echo Asset::img('ico/edit.png', array('alt' => 'editar')); ?>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! sizeof($atividades)): ?>
			<tr><td colspan=4>Você não possui nenhuma atividade associada</td></tr>
		<?php endif ?>
	</tbody>
</table>