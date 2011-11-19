<h2>Inscritos <small><?php echo $titulo; ?></small></h2>
<hr/>
<table>
	<thead>
		<tr>
			<th>Nome</th>
			<th>Matrícula</th>
			<th>Data de Inscrição</th>
			<th>Inscrito</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($inscritos as $id => $inscrito): ?>
			<tr>
				<td><?php echo $inscrito->user->getProfile('nome'); ?></td>
				<td><?php echo $inscrito->user->getProfile('cartao'); ?></td>
				<td><?php echo $inscrito->cadastrado_em; ?></td>
				<td>
					<a href="javascript:;"
					   onclick="inscrever(<?php echo $inscrito->id ?>, this)"
					   <?php if ($inscrito->status == 0): ?>class="nao-inscrito"<?php endif;?>
					>
						<?php echo Asset::img('check-alt.png'); ?>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! sizeof($inscritos)): ?>
			<tr><td colspan=3>Nenhum inscrito nesta atividade ainda</td></tr>
		<?php endif ?>
	</tbody>
</table>

<style>
.nao-inscrito {
	opacity: 0.1;
	-moz-opacity: 0.1;
	filter:alpha(opacity=1);
}
</style>
<script>
var inscrever = function(id, el) {
	$.post(
		'<?php echo URI::create("admin/atividades/inscrever"); ?>',
		{'inscricao': id},
		function(data) {
			$(el).toggleClass('nao-inscrito');
			console.log(data);
		},
		'json'
	);
};
</script>