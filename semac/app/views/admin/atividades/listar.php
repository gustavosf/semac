<div class="page-header">
	<h1>Lista de Atividades</h1>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Título</th>
			<th>Responsável</th>
			<th width=100></th>
			<th>Publicar</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($atividades as $id => $atividade): ?>
			<tr>
				<td><?php echo $atividade->tipo->nome; ?></td>
				<td><?php echo $atividade->titulo ?: '-'; ?></td>
				<td><?php echo $atividade->responsavel ?: '-'; ?></td>
				<td>
					<a href="<?php echo URI::create('atividades/'.$atividade->tipo->nome_canonico.'/'.$atividade->id); ?>"
						rel="tooltip" title="Página da atividade">
						<?php echo Asset::img('ico/link.png'); ?></a>
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
				<td>
					<a href="javascript:pub(<?php echo $atividade->id ?>)" rel="tooltip" title="Publicar atividade">
						<?php if ($atividade->status == 1): ?>
							Público
						<?php else: ?>
							Privado
						<?php endif; ?>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! sizeof($atividades)): ?>
			<tr><td colspan=4>Você não possui nenhuma atividade associada</td></tr>
		<?php endif ?>
	</tbody>
</table>

<script>
var pub = function (id) {
	$.post(
		'<?php echo Uri::create('admin/atividades/publicar') ?>',
		{'id': id},
		function (resp) {
			console.log(resp);
			$('a[href$="pub(' + id + ')"]').text(resp.publico ? 'Público' : 'Privado');
		},
		'json'
	);
};
</script>