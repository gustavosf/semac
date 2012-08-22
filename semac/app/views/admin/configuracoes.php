<div class="page-header">
	<h1>Configurações</h1>
</div>

<?php if (Session::get_flash('error')): ?>
	<?php $error = (@$error ?: Session::get_flash('error')) ?>
	<div class="alert alert-error"><?php echo $error ?></div>
<?php endif; ?>

<?php if (Session::get_flash('success')): ?>
	<div class="alert alert-success"><?php echo Session::get_flash('success') ?></div>
<?php endif; ?>

<form method="post" class="form-horizontal">
	<fieldset>
		<legend>Dados Pessoais</legend>
		<div class="control-group">
			<label class="control-label" for="nome">Nome</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="Nome completo" id="nome" name="nome" type="text" value="<?php echo $nome; ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="matricula">Número de matrícula</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="Número de matrícula" id="matricula" name="matricula" type="text" maxlength=8 value="<?php echo $matricula; ?>">
			</div>
		</div>

		<legend>Senha</legend>
		<div class="control-group">
			<label class="control-label" for="senha_atual">Senha Atual</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="Senha atual" id="senha_atual" name="senha_atual" size="30" type="password">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Nova senha</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="Nova senha" id="nova_senha" name="nova_senha" size="30" type="password">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Confirmação da nova senha</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="Redigite a sua nova senha" id="confirmacao_nova_senha" name="confirmacao_nova_senha" size="30" type="password">
			</div>
		</div>
		<div class="form-actions">
			<input type="submit" class="btn btn-primary" value="Salvar">
		</div>
	</fieldset>
</form>