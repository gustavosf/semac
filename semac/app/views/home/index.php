<!-- Main hero unit for a primary marketing message or call to action -->
<div class="jumbotron">
	<div class="container">
		<h1>Bem-Vindo a SEMAC!</h1>
		<p>A Semana Acadêmica do Instituto de Informática da UFRGS (SEMAC 2011/2) ocorrerá de 03 a 07 de outubro nas dependências do próprio Instituto, em conjunto com a XXIII Semana Acadêmica do Programa de Pós-Graduação em Computação.</p>
	</div>
</div>

<div class="container">
	<?php $i = 0; ?>
	<?php foreach ($tipos_atividade as $id => $tipo): ?>
		<?php if ( ! ($i % 3)): ?>
			<?php if ($i !== 0): ?>
				</div>
				<hr>
			<?php endif ?>
			<div class="row">
		<?php endif ?>
		<div class="span4">
			<h2><?php echo $tipo->nome ?></h2>
			<p><?php echo $tipo->descricao ?></p>
			<p><a class="btn" href="<?php echo URI::create("atividades/{$tipo->nome_canonico}") ?>">Ver atividades &raquo;</a></p>
		</div>
		<?php $i += 1 ?>
	<?php endforeach ?>
	</div>
</div>