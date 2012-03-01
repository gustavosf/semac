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
		<?php 
			foreach ($atividade->getData() as $data)
				$datas[] = "{$data['data']} ás {$data['as']}-{$data['ate']}";
		?>
		<tr>
			<td><?php echo $atividade->getTipo(); ?></td>
			<td><?php echo $atividade->more('titulo'); ?></td>
			<td><?php echo implode('<br>', $datas); ?></td>
			<td>
				<a href="javascript:;" onclick="setarLocal(<?php echo $id ?>, this)">
					<?php echo $atividade->local ?: "Setar"; ?>
				</a>

			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>

<script>
var setarLocal = function(id, el) {

	var content = 'Local do evento:&nbsp;&nbsp;&nbsp;<input id="evento-local" class="input-xlarge"/>';

	var setar = function(local, all, cb){
		$.post('<?php echo Uri::current(); ?>', {'local': local, 'id': id, 'all': all}, function() {
			$(el).text(local);
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