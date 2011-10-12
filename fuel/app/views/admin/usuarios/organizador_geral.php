<h2>Lista de Organizadores Gerais Ativos</h2>

<hr>
<?php if (isset($revogado)): ?>
	<div class="alert-message block-message success">
		<p>Foi revogado o acesso de <strong><?php echo $revogado; ?></strong> como Organizador Geral</p>
	</div>	
<?php endif ?>

<table>
	<thead>
		<tr>
			<th>Nome</th>
			<th>Email</th>
			<th width=50>Revogar<br>Acesso</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($organizadores as $id => $organizador): ?>
		<tr>
			<td><?php echo $organizador->getProfile('nome'); ?></td>
			<td><?php echo $organizador->email; ?></td>
			<td><a class="del" href="<?php echo URI::create('admin/usuarios/organizador_geral/'.$organizador->id.'/delete') ?>">×</a></td>
		</tr>
	<?php endforeach ?>
	<?php if (sizeof($organizadores) == 0): ?>
		<tr><td colspan=3><center>Nenhum Organizador Geral Cadastrado</center></td></tr>
	<?php endif ?>
	</tbody>
</table>

<hr>

