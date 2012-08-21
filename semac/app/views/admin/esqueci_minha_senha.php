<div style="text-align:center;padding-top:20px;width:500px;margin:auto">
	<span style="font-size:120%"><b>Área de Administração da Semana Acadêmica</b></span><br/>
	Para resetar a sua senha, digite o endereço de e-mail no campo abaixo. Você receberá um e-mail com a nova senha.

	<hr/>

	<?php if (Session::get_flash('error')): ?>
		<div class="alert alert-error"><?php echo Session::get_flash('error'); ?></div>
		<hr/>
	<?php endif; ?>

	<form method="post" class="form-horizontal">
		<fieldset>
			<div class="control-group">
				<label for="username" class="control-label">E-Mail</label>
				<div class="controls">
					<input class="input-xlarge" placeholder="email" id="username" name="email" size="30" type="text" value="<?php echo @$email; ?>">
				</div>
			</div>
			<hr/>
			<input type="submit" class="btn btn-primary" value="Enviar nova senha">
		</fieldset>
	</form>
</div>