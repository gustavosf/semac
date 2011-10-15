<h2>Lista de Atividades</h2>
<hr/>
<table>
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Data</th>
			<th>Título</th>
			<th>Responsável</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($atividades as $id => $atividade): ?>
			<tr>
				<td><?php echo $atividade->getTipo(); ?></td>
				<td><?php echo $atividade->getDataFormatada('d/m H:i'); ?></td>
				<td><?php echo $atividade->titulo ?: '-'; ?></td>
				<td><?php echo $atividade->responsavel ?: '-'; ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>