<div class="page-header">
	<h1>Lista de Organizadores Gerais Ativos</h1>
</div>

<?php if (isset($revogado)): ?>
	<div class="alert alert-block alertsuccess">
		<p>Foi revogado o acesso de <strong><?php echo $revogado; ?></strong> como Organizador Geral</p>
	</div>
<?php endif ?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Email</th>
			<th width=100>Revogar Acesso</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($organizadores as $id => $organizador): ?>
		<tr>
			<td><?php echo $organizador->profile_fields->nome; ?></td>
			<td><?php echo $organizador->email; ?></td>
			<td><a class="del" href="<?php echo URI::create('admin/usuarios/organizador_geral/'.$organizador->id.'/delete') ?>">×</a></td>
		</tr>
	<?php endforeach ?>
	<?php if (sizeof($organizadores) == 0): ?>
		<tr><td colspan=3><center>Nenhum Organizador Geral Cadastrado</center></td></tr>
	<?php endif ?>
	</tbody>
</table>