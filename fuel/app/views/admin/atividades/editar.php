<h2>Edição de Atividade</h2><hr/>

<?php if (!isset($atividade)): ?>
	<div class="alert-message block-message error">
		<p><strong>Atividade não foi encontrada, ou você não tem acesso a edição!</strong></p>
	</div>
<?php else: ?>

<?php if ($salvo): ?>
	<div class="alert-message success fade in" data-alert="alert">
		<a class="close" href="#">×</a>
		<p>Os dados desta atividade foram salvos com sucesso!</p>
	</div>
<?php endif ?>

<form method="post" novalidate>
	<fieldset>
		<h6>Campos Obrigatórios</h6>

		<div class="clearfix<?php echo @$erros['titulo']?' error':'' ?>">
			<label for="xlInput">Título</label>
			<div class="input">
				<input class="span5<?php echo @$erros['titulo']?' error':'' ?>" placeholder="Título da Atividade" id="titulo" name="titulo" size="30" type="text" value="<?php echo $atividade->titulo; ?>">
				<?php if (isset($erros['titulo'])): ?>
					<span class="help-inline"><?php echo $erros['titulo']; ?></span>
				<?php endif; ?>
			</div>
		</div><!-- /clearfix -->
		
		<div class="clearfix<?php echo @$erros['responsavel']?' error':'' ?>">
			<label for="xlInput">Nome do Responsável</label>
			<div class="input">
				<input class="span5<?php echo @$erros['responsavel']?' error':'' ?>" placeholder="Nome do Responsável" id="responsavel" name="responsavel" size="30" type="text" value="<?php echo $atividade->responsavel ?>">
				<?php if (isset($erros['responsavel'])): ?>
					<span class="help-inline"><?php echo $erros['responsavel']; ?></span>
				<?php endif; ?>
			</div>
		</div><!-- /clearfix -->

		<div class="clearfix<?php echo @$erros['carga_horaria']?' error':'' ?>">
			<label for="xlInput">Carga Horária</label>
			<div class="input">
				<input class="span2<?php echo @$erros['carga_horaria']?' error':'' ?>" placeholder="HH" id="carga_horaria" name="carga_horaria" type="number" min=0 max=100 value="<?php echo $atividade->carga_horaria ?>">
				<?php if (isset($erros['carga_horaria'])): ?>
					<span class="help-inline"><?php echo $erros['carga_horaria']; ?></span>
				<?php endif; ?>
			</div>

		</div><!-- /clearfix -->

		<div class="clearfix<?php echo @$erros['vagas']?' error':'' ?>">
			<label for="xlInput">Vagas</label>
			<div class="input">
				<input class="span2<?php echo @$erros['vagas']?' error':'' ?>" id="vagas" name="vagas" type="number" min=0 max=100 value="<?php echo $atividade->vagas ?>">
			</div>
			<?php if (isset($erros['vagas'])): ?>
					<span class="help-inline"><?php echo $erros['vagas']; ?></span>
				<?php endif; ?>
		</div><!-- /clearfix -->		

		<br><br>

		<h6>Campos Opcionais</h6>

		<div class="clearfix">
			<label for="xlInput">Descrição da Atividade</label>
			<div class="input">
				<textarea class="span5" name="descricao" id="descricao" rows="5"><?php echo $atividade->more('descricao'); ?></textarea>
			</div>
		</div><!-- /clearfix -->

		<div class="clearfix">
			<label for="xlInput">Short-Bio do Responsável</label>
			<div class="input">
				<textarea class="span5" name="shortbio" id="shortbio" rows="5"><?php echo $atividade->more('shortbio'); ?></textarea>
			</div>
		</div><!-- /clearfix -->

		<div class="clearfix">
			<label for="xlInput">Afiliação do Responsável</label>
			<div class="input">
				<input class="span5" id="afiliacao" name="afiliacao" type="text" value="<?php echo $atividade->more('afiliacao') ?>">
			</div>
		</div><!-- /clearfix -->

		<hr>
		<input type="submit" class="btn primary" value="Salvar">
	</fieldset>
</form>

<?php endif ?>