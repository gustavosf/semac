<h2>Cadastro de Novas Atividades</h2>
<hr/>
<?php if ($_POST): ?>
	<?php if (! $error): ?>
		<div class="alert-message block-message success">
			<p>
				<strong>Usuário cadastrado no sistema!</strong><br/><br/>
				O usuário <b><?php echo $nome; ?></b> foi cadastrado no sistema, com os direitos de acesso <b><?php echo $grupo; ?></b>.<br/>
				Um e-mail foi enviado para o endereço <b><?php echo $email; ?></b> com as credenciais para acesso.
			</p>
		</div>
		<hr/>
		<?php unset($nome, $email, $grupo); ?>
	<?php elseif (isset($error['global'])): ?>
		<div class="alert-message error">
			<p><?php echo $error['global']; ?></p>
		</div>
		<hr/>
	<?php endif; ?>
<?php endif; ?>

<form method="post">
	<fieldset>
		<div class="clearfix<?php if (isset($error['nome'])) echo ' error'; ?>">
			<label for="xlInput">Nome do Chair</label>
			<div class="input">
				<input class="xlarge<?php if (isset($error['nome'])) echo ' error'; ?>" placeholder="nome do usuario" id="nome" name="nome" size="30" type="text" value="<?php echo @$nome ?>">
				<?php if (isset($error['nome'])): ?>
					<span class="help-inline"><?php echo $error['nome']; ?></span>
				<?php endif; ?>
			</div>
		</div><!-- /clearfix -->
		<div class="clearfix<?php if (isset($error['email'])) echo ' error'; ?>">
			<label for="xlInput">E-Mail do Chair</label>
			<div class="input">
				<input class="xlarge<?php if (isset($error['email'])) echo ' error'; ?>" placeholder="email" id="email" name="email" size="30" type="text" value="<?php echo @$email ?>">
				<?php if (isset($error['email'])): ?>
					<span class="help-inline"><?php echo $error['email']; ?></span>
				<?php endif; ?>
			</div>
		</div><!-- /clearfix -->
		<div class="clearfix">
			<label for="xlInput">Tipo de Atividade</label>
			<div class="input">
				<select name="grupo" id="grupo">
					<?php foreach ($atividades as $id => $atividade): ?>
						<option value='<?php echo $id; ?>'><?php echo $atividade; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div><!-- /clearfix -->
		<hr/>
		Submetendo este formulário, uma nova atividade será criada no sistema. O Chair designado receberá um e-mail com instruções de como gerenciar esta atividade.
		<hr/>
		<input type="submit" class="btn primary" value="Salvar">&nbsp;<input type="reset" class="btn" value="Cancelar">
	</fieldset>
</form>