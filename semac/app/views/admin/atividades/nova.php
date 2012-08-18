<div class="page-header">
	<h1>Cadastro de Novas Atividades</h1>
</div>

<?php if ($_POST): ?>
	<?php if (! $error): ?>
		<div class="alert alert-block alert-success">
			<h4>Atividade cadastrada no sistema!</h4>
			<p>O usuário <b><?php echo $nome; ?></b> foi cadastrado como Chair da atividade, com os direitos para edição dos dados da mesma.</p>
			<p>Um e-mail foi enviado para o endereço <b><?php echo $email; ?></b> com as credenciais para acesso, bem como informações de como proceder para a configuração da atividade.</p>
		</div>
		<hr/>
		<?php unset($nome, $email, $grupo); ?>
	<?php endif; ?>
<?php endif; ?>

<form method="post" class="form-horizontal">
	<fieldset>
		<div class="control-group<?php if (isset($error['nome'])) echo ' error'; ?>">
			<label class="control-label" for="nome">Nome do Chair</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="nome do Chair" id="nome" name="nome" size="30" type="text" value="<?php echo @$nome ?>">
				<?php if (isset($error['nome'])): ?>
					<span class="help-inline"><?php echo $error['nome']; ?></span>
				<?php endif; ?>
			</div>
		</div>

		<div class="control-group<?php if (isset($error['email'])) echo ' error'; ?>">
			<label class="control-label" for="email">E-Mail do Chair</label>
			<div class="controls">
				<input class="input-xlarge" placeholder="email" id="email" name="email" size="30" type="text" value="<?php echo @$email ?>">
				<?php if (isset($error['email'])): ?>
					<span class="help-inline"><?php echo $error['email']; ?></span>
				<?php endif; ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="atividade">Tipo de Atividade</label>
			<div class="controls">
				<select name="atividade" id="atividade">
					<?php foreach ($atividades as $id => $atividade): ?>
						<option value='<?php echo $id; ?>'><?php echo $atividade; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<hr/>
		Submetendo este formulário, uma nova atividade será criada no sistema. O Chair designado receberá um e-mail com instruções de como gerenciar esta atividade.
		<div class="form-actions">
			<input type="submit" class="btn btn-primary" value="Salvar">&nbsp;<input type="reset" class="btn" value="Cancelar">
		</div>
	</fieldset>
</form>