<div class="page-header">
	<h1>Lista de Atividades</h1>
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
					<a href="<?php echo URI::create('admin/atividades/editar/'.$atividade->id); ?>"
						rel="tooltip" title="Editar atividade">
						<?php echo Asset::img('ico/edit.png'); ?></a>
					<a href="<?php echo URI::create('admin/atividades/docs/'.$atividade->id); ?>"
						rel="tooltip" title="Adicionar/Editar documentação">
						<?php echo Asset::img('ico/file-add.png'); ?></a>
					<a href="<?php echo URI::create('admin/atividades/inscritos/'.$atividade->id); ?>"
						rel="tooltip" title="Inscritos">
						<?php echo Asset::img('ico/user.png'); ?></a>
					<a href="<?php echo URI::create('admin/atividades/chamada/'.$atividade->id); ?>"
						rel="tooltip" title="Lista de Chamada">
						<?php echo Asset::img('ico/presenca.png'); ?></a>
				</td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! sizeof($atividades)): ?>
			<tr><td colspan=4>Você não possui nenhuma atividade associada</td></tr>
		<?php endif ?>
	</tbody>
</table>
<script>
$(document).ready(function(){
	$('a[rel=tooltip]').tooltip();
});
</script>