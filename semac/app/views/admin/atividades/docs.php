<div class="page-header">
	<h1>Documentação <small><?php echo $atividade->titulo ?></small></h1>
</div>

<?php if (@$salvo): ?>
	<div class="alert alert-success fade in">
		<a class="close" data-dismiss="alert" href="#">×</a>
		Os dados desta atividade foram salvos com sucesso!
	</div>
<?php endif ?>

<table class="table table-striped">
	<thead>
		<th>Documento</th>
		<th>Descrição</th>
		<th>Data de Envio</th>
		<th>Arquivo</th>
		<th>Ação</th>
	</thead>
	<tbody>
		<?php foreach ($docs as $id => $doc): ?>
			<tr>
				<td><?php echo $doc->titulo ?></td>
				<td><?php echo $doc->descricao ?></td>
				<td><?php echo $doc->data_upload ?></td>
				<td><?php echo $doc->arquivo ?></td>
				<td>
					<a href="javascript:;" data-document-id="<?php echo $doc->id ?>)">
						<?php echo Asset::img('ico/cancel.png') ?></a>
				</td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! isset($doc)): ?>
			<td colspan=5><center>Nenhum documento foi anexado a esta atividade</center></td>
		<?php endif ?>
	</tbody>
</table>


<form method="post" class="form-horizontal" novalidate enctype="multipart/form-data">
	<legend>Novo Documento</legend>
	<fieldset>
		<div class="control-group<?php echo @$erros['titulo']?' error':'' ?>">
			<label class="control-label" for="titulo">Título</label>
			<div class="controls">
				<input class="span6" name="titulo" type="text" value="<?php echo @$titulo; ?>">
				<?php if (isset($erros['titulo'])): ?>
					<span class="help-inline"><?php echo $erros['titulo']; ?></span>
				<?php endif; ?>
			</div>
		</div>

		<div class="control-group<?php echo @$erros['descricao']?' error':'' ?>">
			<label class="control-label" for="descricao">Descrição</label>
			<div class="controls">
				<textarea class="span6" name="descricao" maxlength=255 id="descricao" rows="5"><?php echo @$descricao ?></textarea>
				<p class="help-block">Máximo de 255 caracteres</p>
			</div>
		</div>

		<div class="control-group<?php echo isset($erros_upload) ?' error':'' ?>">
			<label class="control-label" for="documento">Documento</label>
			<div class="controls">
				<input class="input-file" name="documento" type="file">
				<p class="help-block">Tamanho máximo de 10MiB</p>
			</div>
		</div>

		<hr>

		<div class="form-actions">
			<input type="submit" class="btn btn-primary" value="Salvar">
		</div>
	</fieldset>
</form>
<script>
$(document).ready(function(){
	$("a[data-document-id]").click(function(){
		var line = $(this).parent().parent(),
			doc = $(this).attr('data-document-id');

		$.post(
			'<?php echo URI::create("admin/atividades/docs_delete"); ?>',
			{'id': doc},
			function(resp) {
				line.fadeOut()
			},
			'json'
		).error(function(resp) {
			alert('Não foi possível remover este documento');
		});
	})
});
</script>