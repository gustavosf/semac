<h2>Lista de Chamada <small><?php echo $titulo; ?></small></h2>
<hr>

<table class="table table-striped">
	<thead>
		<tr>
			<th width=15>P</th>
			<th>Nome</th>
			<th>Cartão</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($chamada as $id => $user): ?>
			<tr>
				<td>
					<a href="javascript:;"
					   onclick="presenca(<?php echo $id_data.','.$user['id'] ?>, this)"
					   <?php if ($user['presente']): ?>class="presente"<?php endif;?>>
						<?php echo Asset::img('ico/presente.png'); ?>
					</a>
				</td>
				<td><?php echo $user['nome'] ?></td>
				<td><?php echo $user['cartao'] ?></td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! isset($user)): ?>
			<tr>
				<td colspan=3><center>Nenhum inscrito nesta atividade</center></td>
			</tr>
		<?php endif ?>
	</tbody>
</table>

<style>
td > a:not(.presente) {
	opacity: 0.1;
	-moz-opacity: 0.1;
	filter:alpha(opacity=1);
}
</style>
<script>
var presenca = function(data, user, el) {
	$.post(
		'<?php echo URI::create("admin/atividades/presenca"); ?>',
		{'data': data, 'user': user},
		'json'
	).success(function(data) {
		$(el).toggleClass('presente');
	}).error(function(data) {
		alert('Não foi possível marcar este usuário como presente');
	})
};
</script>