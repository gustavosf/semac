<div class="page-header">
	<h1>Cadastro de Usuários no Sistema</h1>
</div>

<?php if ($_POST): ?>
	<?php if (! $error): ?>
		<div class="alert alert-block alert-success">
			<p>
				<h4 class="alert-heading">Usuário cadastrado no sistema!</h4>
				<p>O usuário <b><?php echo $nome; ?></b> foi cadastrado no sistema, com os direitos de acesso <b><?php echo $grupo; ?></b>.</p>
				<p>Um e-mail foi enviado para o endereço <b><?php echo $email; ?></b> com as credenciais para acesso.</p>
			</p>
		</div>
		<hr/>
		<?php unset($nome, $email, $grupo); ?>
	<?php elseif (isset($error['global'])): ?>
		<div class="alert alert-error">
			<p><?php echo $error['global']; ?></p>
		</div>
		<hr/>
	<?php endif; ?>
<?php endif; ?>

<form method="post" class="form-horizontal">
	<fieldset>
		<div class="control-group<?php if (isset($error['nome'])) echo ' error'; ?>">
			<label class="control-label" for="nome">Nome</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="nome do usuario" id="nome" name="nome" size="30" type="text" value="<?php echo @$nome ?>">
				<?php if (isset($error['nome'])): ?>
					<span class="help-inline"><?php echo $error['nome']; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="control-group<?php if (isset($error['email'])) echo ' error'; ?>">
			<label class="control-label" for="email">E-Mail</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="email" id="email" name="email" size="30" type="text" value="<?php echo @$email ?>">
				<?php if (isset($error['email'])): ?>
					<span class="help-inline"><?php echo $error['email']; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="grupo">Tipo</label>
			<div class="controls">
				<select name="grupo" id="grupo">
					<option>COMEX</option>
					<option>COMGRAD</option>
					<option>Organizador Geral</option>
					<option>Secretaria</option>
				</select>
			</div>
		</div>
		<hr/>
		Submetendo este formulário, o usuário receberá um e-mail com informações para acesso ao sistema.
		<div class="form-actions">
			<input type="submit" class="btn btn-primary" value="Salvar">&nbsp;<input type="reset" class="btn" value="Cancelar">
		</div>
	</fieldset>
</form>