<div class="content">
	<div class="hero-unit">
		<p>Você está tentando se inscrever na atividade <strong><?php echo $atividade ?></strong>. Para prosseguir, você precisa cadastrar-se no sistema, ou caso já possuas um registro, identificar-se utilizando as suas credenciais.</p>
	</div>
	<div class="row">
		<div class="span8">
			<div class="page-header">
				<h1>Não possuo um cadastro</h1>
			</div>
			<form method="post" action="<?php echo URI::create('a/cadastro') ?>">
				<input type="hidden" name="form" value="cadastro">
				<input type="hidden" name="atividade" value="<?php echo $atividade_id ?>">
				<fieldset>
					<div class="clearfix<?php if (isset($error['nome'])) echo ' error'; ?>">
						<label for="xlInput">Nome Completo</label>
						<div class="input">
							<input class="xlarge<?php if (isset($error['nome'])) echo ' error'; ?>" name="nome" type="text" value="<?php echo @$cad_nome; ?>">
							<?php if (isset($error['nome'])): ?>
								<br><span class="help-inline"><?php echo $error['nome']; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix<?php if (isset($error['matricula'])) echo ' error'; ?>">
						<label for="xlInput">Nro de Matrícula</label>
						<div class="input">
							<input class="xlarge span2<?php if (isset($error['matricula'])) echo ' error'; ?>" maxlength=8 name="matricula" type="text" value="<?php echo @$cad_matricula; ?>">
							<?php if (isset($error['matricula'])): ?>
								<br><span class="help-inline"><?php echo $error['matricula']; ?></span>
							<?php else: ?>
								<span class="help-block">8 Dígitos (adicione 0s a esquerda caso necessário)</span>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix<?php if (isset($error['email'])) echo ' error'; ?>">
						<label for="xlInput">E-Mail</label>
						<div class="input">
							<input class="xlarge<?php if (isset($error['email'])) echo ' error'; ?>" name="email" type="text" value="<?php echo @$username; ?>">
							<?php if (isset($error['email'])): ?>
								<br><span class="help-inline"><?php echo $error['email']; ?></span>
							<?php endif; ?>
						</div>
					</div><!-- /clearfix -->
					<hr/>
					<center>
						<input type="submit" class="btn primary" value="Inscrever">
					</center>
				</fieldset>
			</form>
		</div>
	
		<div class="span8">
			<div class="page-header">
				<h1>Já possuo um cadastro</h1>
			</div>
			<?php if ($error_form == 'login'): ?>
				<div class="alert-message error">
					<a class="close" href="#">×</a>
					<p>Senha inválida ou cadastro não encontrado no sistema</p>
				</div>
			<?php endif ?>
			<form method="post" action="<?php echo URI::create('a/cadastro') ?>">
				<input type="hidden" name="form" value="login">
				<input type="hidden" name="atividade" value="<?php echo $atividade_id ?>">
				<fieldset>
					<div class="clearfix">
						<label for="xlInput">E-Mail</label>
						<div class="input">
							<input class="xlarge" name="email" type="text" value="<?php echo @$email; ?>">
						</div>
					</div><!-- /clearfix -->
					<div class="clearfix">
						<label for="xlInput">Senha</label>
						<div class="input">
							<input class="xlarge" name="senha" type="password">
						</div>
					</div>
					<hr/>
					<center>
						<input type="submit" class="btn primary" value="Inscrever">
					</center>
				</fieldset>
			</form>
		</div>
		<div class="span8">
			

		</div>
	</div>
</div>