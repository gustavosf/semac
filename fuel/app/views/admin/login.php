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

	<form method="post" class="form-horizontal">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="username">E-Mail</label>
				<div class="controls">
					<input class="input-xlarge" placeholder="email" id="username" name="username" type="text" value="<?php echo @$username; ?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password">Senha</label>
				<div class="controls">
					<input class="input-xlarge" placeholder="senha" id="password" name="password" size="30" type="password">
				</div>
			</div>
			<hr>
			<input type="submit" class="btn btn-primary" value="Acessar">&nbsp;<input type="reset" class="btn" value="Cancelar"><br>
			<br>
			<a href="<?php echo Uri::create('admin/esqueci_minha_senha') ?>">Esqueceu a senha?</a>
		</fieldset>
	</form>
</div>