<h2>Locais das Atividades</h2>
<hr/>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Tipo</th>
			<th>Título</th>
			<th>Datas</th>
			<th>Local</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($atividades as $id => $atividade): ?>
		<tr>
			<td><?php echo $atividade->getTipo(); ?></td>
			<td><?php echo $atividade->more('titulo'); ?></td>
			<td>
				<?php foreach ($atividade->getData() as $data): ?>
					<?php echo "{$data['data']} ás {$data['as']}-{$data['ate']}<br>" ?>
				<?php endforeach ?>
			</td>
			<td>
				<?php foreach ($atividade->getData() as $data_id => $data): ?>
					<a href="javascript:;" onclick="setarLocal(<?php echo $id ?>, <?php echo $data_id ?>, this)">
						<?php echo $data['local'] ?: "Setar" ?>
					</a><br>
				<?php endforeach ?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>

<script>
var setarLocal = function(id, data_id, el) {

	var content = 'Local do evento:&nbsp;&nbsp;&nbsp;<input id="evento-local" class="input-xlarge"/>';

	var setar = function(local, all, cb){
		$.post('<?php echo Uri::current(); ?>', {'local': local, 'id': id, 'data_id': all ? 0 : data_id}, function() {
			$(el).text(local);
			if (all) $(el).siblings().text(local);
			cb();
		}).error(function() {
			alert("Um erro ocorreu. Favor contate o administrador do sistema");
			cb();
		});
	};
	
	$.modal({
		'header': 'Setar local para atividade',
		'content': content,
		'primary_btn': 'Salvar',
		'buttons': [
			{
				type: 'primary',
				text: 'Salvar',
				click: function(modal) {
					setar($('#evento-local').val(), false, function(){
						modal.modal('hide');
					});
				}
			},{
				type: 'primary',
				text: 'Salvar para todos os dias',
				click: function(modal) {
					setar($('#evento-local').val(), true, function(){
						modal.modal('hide');
					});
				}
			}
		]

	});

};

var old_setarLocal = function(id, el) {
	var local = prompt('Qual o local para esta atividade?');
	if (!local) return;
	$.post('<?php echo Uri::current(); ?>', {'local': local, 'id': id}, function() {
		$(el).text(local);
	}).error(function() {
		alert("Um erro ocorreu. Favor contate o administrador do sistema");
	});
};
</script>