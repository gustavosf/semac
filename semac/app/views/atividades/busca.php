<header class="jumbotron">
<div class="container">
	<h1>Busca</h1>
	<p>Retornado(s) <?php echo count($atividades) ?> resultado(s) para a sua consulta: <b><?php echo $termo ?></b></p>
</div>
</header>
<div class="container">
	<div>
		<?php foreach ($atividades as $id => $atividade): ?>
			<h3><a href="<?php echo Uri::create('atividades/'.$atividade->tipo->nome_canonico.'/'.$atividade->id) ?>"><?php echo $atividade->titulo ?></a> <small><?php echo $atividade->responsavel ?></small></h3>
			<p><?php echo $atividade->more->descricao ?></p>
			<p>
				<?php foreach ($atividade->getData() as $data): ?>
					<span class='label'><?php echo "{$data['data']}, {$data['as']}-{$data['ate']}" ?></span>
				<?php endforeach ?>
			</p>
			<hr>
		<?php endforeach ?>
	</div>
</div>