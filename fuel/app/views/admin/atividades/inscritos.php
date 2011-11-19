<h2>Inscritos <small><?php echo $titulo; ?></small></h2>
<hr/>
<table>
	<thead>
		<tr>
			<th>Nome</th>
			<th>Matrícula</th>
			<th>Data de Inscrição</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($inscritos as $id => $inscrito): ?>
			<tr>
				<td><?php echo $inscrito->user->getProfile('nome'); ?></td>
				<td><?php echo $inscrito->user->getProfile('cartao'); ?></td>
				<td><?php echo $inscrito->cadastrado_em; ?></td>
			</tr>
		<?php endforeach ?>
		<?php if ( ! sizeof($inscritos)): ?>
			<tr><td colspan=3>Nenhum inscrito nesta atividade ainda</td></tr>
		<?php endif ?>
	</tbody>
</table>