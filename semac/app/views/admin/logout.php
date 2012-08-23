<header class="jumbotron">
	<div class="container" style="text-align:center">
		<h2>Você foi deslogado do sistema</h2>
	</div>
</header>

<div class="container" style="text-align:center">
	<p>Aguarde enquanto te redirecionamos à página principal, ou clique <a href="<?php echo Uri::create('/'); ?>">aqui</a>.</p>
</div>

<script>
	setTimeout(function(){
		window.location = '<?php echo Uri::create("/"); ?>';
	}, 4000)
</script>