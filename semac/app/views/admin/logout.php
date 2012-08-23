<div class="container">
	<div class="row">
		<div class="span12" style="text-align:center">
			<h1>Você foi deslogado do sistema</h1>
			<p>Aguarde enquanto te redirecionamos à página principal, ou clique <a href="<?php echo Uri::create('/'); ?>">aqui</a>.</p>
		</div>
	</div>
</div>
<script>
	setTimeout(function(){
		window.location = '<?php echo Uri::create("/"); ?>';
	}, 4000)
</script>