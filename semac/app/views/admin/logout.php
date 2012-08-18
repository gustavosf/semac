<div class="span6 offset3">
	<h2>Você foi deslogado do sistema.</h2><br/>
	Aguarde enquanto te redirecionamos à página principal, ou clique <a href="<?php echo Uri::create('/'); ?>">aqui</a>.
</div>
<script>
	setTimeout(function(){
		window.location = '<?php echo Uri::create("/"); ?>';
	}, 4000)
</script>