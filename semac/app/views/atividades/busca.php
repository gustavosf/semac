<div class="page-header">
	<h1>
		Busca <small>Retornado(s) <?php echo count($atividades) ?> resultado(s) para a sua consulta: <b><?php echo $termo ?></b></small>
		<form class="pull-right" action="<?php echo Uri::create('a/search') ?>" method="post">
			<input name="search" type="text" class="search-query pull-right" placeholder="Busca" value="<?php echo $termo ?>">
		</form>
	</h1>
</div>
<div>
	<?php foreach ($atividades as $id => $atividade): ?>
		<h3><a href="<?php echo Uri::create('a/'.$atividade->id) ?>"><?php echo $atividade->titulo ?></a> <small><?php echo $atividade->responsavel ?></small></h3>
		<p><?php echo $atividade->more->descricao ?></p>
		<p>
			<?php foreach ($atividade->getData() as $data): ?>
				<span class='label'><?php echo "{$data['data']}, {$data['as']}-{$data['ate']}" ?></span>
			<?php endforeach ?>
		</p>
		<hr>
	<?php endforeach ?>
</div>