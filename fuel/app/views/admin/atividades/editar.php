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
				<?php if (isset($erros['vagas'])): ?>
					<span class="help-inline"><?php echo $erros['vagas']; ?></span>
				<?php endif; ?>
			</div>
		</div><!-- /clearfix -->

		<div class="clearfix<?php echo @$erros['data']||@$erros['as']||@$erros['ate']?' error':'' ?>">
			<label for="xlInput">Data</label>
			<?php foreach ($atividade->getData() as $data): ?>
				<div class="input">
					<input class="span2" name="data[]" type="date" value="<?php echo $data['data'] ?>"> ás 
					<input class="span2" name="as[]" type="time" value="<?php echo $data['as'] ?>"> até 
					<input class="span2" name="ate[]" type="time" value="<?php echo $data['ate'] ?>">
					<a data-original-title="Adicionar nova data" class="plus" href="javascript:;" onclick="novaData(this)">+</a>
				</div>
			<?php endforeach ?>
			<?php if (isset($erros['data'])||isset($erros['as'])||isset($erros['ate'])): ?>
				<span class="help-inline"><?php echo implode('<br>',array(@$erros['data'],@$erros['as'],@$erros['ate'])); ?></span>
			<?php endif; ?>
		</div><!-- /clearfix -->

		<br><br>

		<h6>Campos Opcionais</h6>

		<div class="clearfix<?php echo @$erros['descricao']?' error':'' ?>">
			<label for="xlInput">Resumo da Atividade</label>
			<div class="input">
				<textarea class="span8<?php echo @$erros['descricao']?' error':'' ?>" name="descricao" maxlength=255 id="descricao" rows="5"><?php echo $atividade->more('descricao'); ?></textarea>
				<span class="help-block">Máximo de 255 caracteres</span>
			</div>
		</div><!-- /clearfix -->

		<div class="clearfix">
			<label for="xlInput">Descrição Extensa da Atividade</label>
			<div class="input">
				<textarea class="span8" name="descricao_ext" id="descricao_ext" rows="10"><?php echo $atividade->more('descricao_ext'); ?></textarea>
				<span class="help-block">Este campo aceita o formato <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a></span>
			</div>
		</div><!-- /clearfix -->

		<div class="clearfix">
			<label for="xlInput">Short-Bio do Responsável</label>
			<div class="input">
				<textarea class="span8" name="shortbio" id="shortbio" rows="5"><?php echo $atividade->more('shortbio'); ?></textarea>
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

<script>
$(function() {
	$.datepicker.setDefaults({'dateFormat': 'dd/mm/yy'});
	$('.plus').twipsy();
});

$("body").delegate("input[type=date]", "focusin", function(){
	$(this).datepicker();
});

var novaData = function(el) {
	var html = '<div class="input">' +
		'<input class="span2" name="data[]" type="date"> ás ' + 
		'<input class="span2" name="as[]" type="time"> até ' + 
		'<input class="span2" name="ate[]" type="time"> ' +
		'<a data-original-title="Adicionar nova data" class="plus" href="javascript:;" onclick="novaData(this)">+</a>' +
		'</div>';
	$(el).parent().after($(html));
	$('.plus').twipsy();
};
</script>
<?php endif ?>