<div style="text-align:center;padding-top:20px;width:500px;margin:auto">
	<span style="font-size:120%"><b>Área de Administração da Semana Acadêmica</b></span><br/>
	Para resetar a sua senha, digite o endereço de e-mail no campo abaixo. Você receberá um e-mail com a nova senha.

	<hr/>

	<?php if (Session::get_flash('error')): ?>
		<div class="alert-message error"><?php echo Session::get_flash('error'); ?></div>
		<hr/>
	<?php endif; ?>

	<form method="post">
		<fieldset>
			<div class="clearfix">
				<label for="xlInput">E-Mail</label>
				<div class="input">
					<input class="xlarge" placeholder="email" id="login" name="email" size="30" type="text" value="<?php echo @$email; ?>">
				</div>
			</div><!-- /clearfix -->
			<hr/>
			<input type="submit" class="btn primary" value="Enviar nova senha">
		</fieldset>
	</form>
</div>