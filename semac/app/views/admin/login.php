<div style="text-align:center;padding-top:20px;width:500px;margin:auto">
	<span style="font-size:120%"><b>Área de Administração da Semana Acadêmica</b></span><br/>
	Para acessar, você precisa digitar o seu usuário e senha

	<hr/>

	<?php if (isset($error) || Session::get_flash('error')): ?>
		<?php $error = (@$error ?: Session::get_flash('error')) ?>
		<div class="alert-message error"><?php echo $error ?></div>
		<hr/>
	<?php endif; ?>

	<?php if (Session::get_flash('success')): ?>
		<div class="alert-message success"><?php echo Session::get_flash('success') ?></div>
		<hr/>
	<?php endif; ?>

	<form method="post">
		<fieldset>
			<div class="clearfix">
				<label for="xlInput">E-Mail</label>
				<div class="input">
					<input class="xlarge" placeholder="email" id="login" name="username" size="30" type="text" value="<?php echo @$username; ?>">
				</div>
			</div><!-- /clearfix -->
			<div class="clearfix">
				<label for="xlInput">Senha</label>
				<div class="input">
					<input class="xlarge" placeholder="senha" id="passwd" name="password" size="30" type="password">
				</div>
			</div><!-- /clearfix -->
			<hr>
			<input type="submit" class="btn primary" value="Acessar">&nbsp;<input type="reset" class="btn" value="Cancelar"><br>
			<br>
			<a href="<?php echo Uri::create('admin/esqueci_minha_senha') ?>">Esqueceu a senha?</a>
		</fieldset>
	</form>
</div>