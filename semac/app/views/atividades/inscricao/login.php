<div class="container">
	<div class="hero-unit">
		<p>Você está tentando se inscrever na atividade <strong><?php echo $atividade ?></strong>. Para prosseguir, você precisa cadastrar-se no sistema, ou caso já possuas um registro, identificar-se utilizando as suas credenciais.</p>
	</div>
	<div class="row">
		<div class="span6">
			<div class="page-header">
				<h1>Não possuo um cadastro</h1>
			</div>
			<form method="post" class="form-horizontal" action="<?php echo URI::create('a/cadastro') ?>">
				<fieldset>
					<input type="hidden" name="form" value="cadastro">
					<input type="hidden" name="atividade" value="<?php echo $atividade_id ?>">

					<div class="control-group<?php if (isset($error['nome'])) echo ' error'; ?>">
						<label for="nome" class="control-label">Nome Completo</label>
						<div class="controls">
							<input class="input-xlarge" name="nome" type="text" value="<?php echo @$cad_nome; ?>">
							<?php if (isset($error['nome'])): ?>
								<br><span class="help-inline"><?php echo $error['nome']; ?></span>
							<?php endif; ?>
						</div>
					</div>

					<div class="control-group<?php if (isset($error['matricula'])) echo ' error'; ?>">
						<label for="matricula" class="control-label">Nro de Matrícula</label>
						<div class="controls">
							<input class="input-xlarge span2" maxlength=8 name="matricula" type="text" value="<?php echo @$cad_matricula; ?>">
							<?php if (isset($error['matricula'])): ?>
								<br><span class="help-inline"><?php echo $error['matricula']; ?></span>
							<?php else: ?>
								<span class="help-block">8 Dígitos (adicione 0s a esquerda caso necessário)</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="control-group<?php if (isset($error['email'])) echo ' error'; ?>">
						<label for="email" class="control-label">E-Mail</label>
						<div class="controls">
							<input class="input-xlarge" name="email" type="text" value="<?php echo @$cad_email; ?>">
							<?php if (isset($error['email'])): ?>
								<br><span class="help-inline"><?php echo $error['email']; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" class="btn btn-primary" value="Inscrever">
					</div>
				</fieldset>
			</form>
		</div>

		<div class="span6">
			<div class="page-header">
				<h1>Já possuo um cadastro</h1>
			</div>
			<?php if ($error_form == 'login'): ?>
				<div class="alert alert-error">
					<a class="close" data-dismiss="alert" href="#">&times;</a>
					Senha inválida ou cadastro não encontrado no sistema
				</div>
			<?php endif ?>
			<form method="post" class="form-horizontal" action="<?php echo URI::create('a/cadastro') ?>">
				<input type="hidden" name="form" value="login">
				<input type="hidden" name="atividade" value="<?php echo $atividade_id ?>">
				<fieldset>
					<div class="control-group">
						<label for="email" class="control-label">E-Mail</label>
						<div class="controls">
							<input class="input-xlarge" name="email" type="text" value="<?php echo @$email; ?>">
						</div>
					</div>
					<div class="control-group">
						<label for="senha" class="control-label">Senha</label>
						<div class="controls">
							<input class="input-xlarge" name="senha" type="password">
						</div>
					</div>
					<div class="form-actions">
						<input type="submit" class="btn btn-primary" value="Inscrever">
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>