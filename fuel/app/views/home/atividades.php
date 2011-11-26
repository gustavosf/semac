<div class="content">
	<div class="hero-unit">
		<h2><?php echo $tipo ?></h2>
		<p><?php echo $descricao ?></p>
	</div>
	<div class="row">
		<div class="span16">
			<table class="zebra-striped">
				<thead>
					<th>Atividade</th>
					<th>Responsável</th>
					<th width=160>Dia/Horário</th>
				</thead>
				<tbody>
					<?php foreach ($atividades as $id => $atividade): ?>
						<tr style='cursor:pointer'>
							<td><a href="<?php echo URI::create($uri.'/'.$atividade->id) ?>"><?php echo $atividade->titulo ?></a></td>
							<td><?php echo $atividade->responsavel ?></td>
							<td><?php echo str_replace("\n", "<br>", $atividade->getDataSerial()) ?></td>
						</tr>
					<?php endforeach ?>
					<?php if ( ! isset($atividade)): ?>
						<tr>
							<td colspan="3"><center>Nenhuma atividade deste tipo foi cadastrada até o momento</center></td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>