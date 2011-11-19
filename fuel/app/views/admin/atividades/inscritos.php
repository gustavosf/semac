<h2>Inscritos <small><?php echo $titulo; ?></small></h2>
<hr>
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
					   <?php if ($inscrito->status == 1): ?>class="inscrito"<?php endif;?>
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
<hr>

<span id="inscritos"><?php echo sizeof($inscritos) ?></span> inscritos /
<span id="aceitos"></span> aceitos /
<span id="vagas"><?php echo $vagas; ?></span> vagas

<hr>

<a class="btn" data-controls-modal="my-modal" data-backdrop="static" >Confirmar Inscrições</a>

<div id="my-modal" class="modal hide fade">
	<div class="modal-header">
		<a href="#" class="close">&times;</a>
		<h3>Confirmar Inscrições</h3>
	</div>
	<div class="modal-body">
		<p>
			Você tem certeza que deseja confirmar as incrições?<br>
			Este processo irá enviar e-mails para os inscritos, informando da confirmação ou recusa da matrícula nesta atividade.
		</p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn primary">Confirmar</a>
		<a href="#" class="btn secondary" onclick="$('#my-modal').modal('toggle')">Cancelar</a>
	</div>
</div>

<style>
td > a:not(.inscrito) {
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
			$(el).toggleClass('inscrito');
			updateAceitos();
		},
		'json'
	);
};
var updateAceitos = function() {
	var aceitos = $("a.inscrito").length,
		vagas = parseInt($("#vagas").text(), 10);

	$("#aceitos").text(aceitos);
	if (aceitos > vagas) $("#aceitos").css('color', 'red');
	else $("#aceitos").css('color', null);
};
updateAceitos();
</script>