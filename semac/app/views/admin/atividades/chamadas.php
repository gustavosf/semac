<div class="page-header">
	<h1>Lista de Chamada <small><?php echo $atividade_titulo; ?></small></h1>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th rowspan=2>Nome</th>
			<th rowspan=2>Cartão</th>
			<th style='text-align:center' colspan=<?php echo sizeof($dias) ?>>Presenças</th>
		</tr>
		<tr>
			<th style='text-align:center'><?php echo implode('</th><th style="text-align:center">', array_keys($dias)); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($presencas as $user): ?>
			<tr>
				<td><?php echo $user['nome'] ?></td>
				<td><?php echo $user['cartao'] ?></td>
				<td style="text-align:center"><?php echo implode('</td><td style="text-align:center">', $user['dias']) ?></td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! isset($user)): ?>
			<tr>
				<td colspan=3><center>Nenhum inscrito nesta atividade</center></td>
			</tr>
		<?php endif ?>
	</tbody>
</table>