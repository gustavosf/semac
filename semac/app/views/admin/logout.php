<header class="jumbotron">
	<div class="container">
		<h1>Você foi deslogado do sistema</h1>
		<p>A página que você procura não foi encontrada</p>
	</div>
</header>

<div class="container">
	<p>Aguarde enquanto te redirecionamos à página principal, ou clique <a href="<?php echo Uri::create('/'); ?>">aqui</a>.</p>
</div>

<script>
	setTimeout(function(){
		window.location = '<?php echo Uri::create("/"); ?>';
	}, 4000)
</script>