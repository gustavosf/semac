<div class="page-header">
	<h1>Edição de Atividade</h1>
</div>

<?php if (!isset($atividade)): ?>
	<div class="alert alert-error">
		Atividade não foi encontrada, ou você não tem acesso a edição!
	</div>
<?php else: ?>

<?php if ($salvo): ?>
	<div class="alert alert-success fade in">
		<a class="close" data-dismiss="alert" href="#">×</a>
		Os dados desta atividade foram salvos com sucesso!
	</div>
<?php endif ?>

<form method="post" class="form-horizontal" novalidate>
	<fieldset>
		<legend>Campos Obrigatórios</legend>

		<div class="control-group<?php echo @$erros['titulo']?' error':'' ?>">
			<label for="titulo" class="control-label">Título</label>
			<div class="controls">
				<input class="span5" placeholder="Título da Atividade" id="titulo" name="titulo" size="30" type="text" value="<?php echo $atividade->titulo; ?>">
				<?php if (isset($erros['titulo'])): ?>
					<span class="help-inline"><?php echo $erros['titulo']; ?></span>
				<?php endif; ?>
			</div>
		</div>

		<div class="control-group<?php echo @$erros['responsavel']?' error':'' ?>">
			<label class="control-label" for="responsavel">Nome do Responsável</label>
			<div class="controls">
				<input class="span5" placeholder="Nome do Responsável" id="responsavel" name="responsavel" size="30" type="text" value="<?php echo $atividade->responsavel ?>">
				<?php if (isset($erros['responsavel'])): ?>
					<span class="help-inline"><?php echo $erros['responsavel']; ?></span>
				<?php endif; ?>
			</div>
		</div>

		<div class="control-group<?php echo @$erros['carga_horaria']?' error':'' ?>">
			<label class="control-label" for="carga_horaria">Carga Horária</label>
			<div class="controls">
				<input class="span2" placeholder="HH" id="carga_horaria" name="carga_horaria" type="number" min=0 max=100 value="<?php echo $atividade->carga_horaria ?>">
				<?php if (isset($erros['carga_horaria'])): ?>
					<span class="help-inline"><?php echo $erros['carga_horaria']; ?></span>
				<?php endif; ?>
			</div>

		</div>

		<div class="control-group<?php echo @$erros['vagas']?' error':'' ?>">
			<label class="control-label" for="vagas">Vagas</label>
			<div class="controls">
				<input class="span2" id="vagas" name="vagas" type="number" min=0 max=100 value="<?php echo $atividade->vagas ?>">
				<select id="selecao" name="selecao">
					<option value="0" <?php echo ( ! $atividade->selecao ? 'selected="selected"' : '') ?>>Por ordem de chegada</option>
					<option value="1" <?php echo ($atividade->selecao ? 'selected="selected"' : '') ?>>Por seleção</option>
				</select>
				<?php if (isset($erros['vagas'])): ?>
					<span class="help-inline"><?php echo $erros['vagas']; ?></span>
				<?php endif; ?>
			</div>
		</div>

		<div class="control-group<?php echo @$erros['data']||@$erros['as']||@$erros['ate']?' error':'' ?>">
			<label class="control-label">Data</label>
			<?php foreach ($atividade->getData() as $id => $data): ?>
				<div class="controls">
					<input type="hidden" name="id_data[]" value="<?php echo $id; ?>">
					<input class="span2" name="data[]" type="text" rel="date" value="<?php echo $data['data'] ?>"> ás
					<input class="span2" name="as[]" type="time" value="<?php echo $data['as'] ?>"> até
					<input class="span2" name="ate[]" type="time" value="<?php echo $data['ate'] ?>">
					<a rel="tooltip" title="Adicionar nova data" class="plus" href="javascript:;" onclick="novaData(this)">+</a>
					<a rel="tooltip" title="Remover esta data" class="del" href="javascript:;" onclick="removeData(this)">-</a>
				</div>
			<?php endforeach ?>
			<?php if (isset($erros['data'])||isset($erros['as'])||isset($erros['ate'])): ?>
				<span class="help-inline"><?php echo implode('<br>',array(@$erros['data'],@$erros['as'],@$erros['ate'])); ?></span>
			<?php endif; ?>
		</div>

		<legend>Campos Opcionais</legend>

		<div class="control-group<?php echo @$erros['descricao']?' error':'' ?>">
			<label class="control-label" for="descricao">Resumo da Atividade</label>
			<div class="controls">
				<textarea class="span6" name="descricao" maxlength=255 id="descricao" rows="5"><?php echo @$atividade->more->descricao; ?></textarea>
				<small class="help-block">Máximo de 255 caracteres</small>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="descricao_ext">Descrição Extensa da Atividade</label>
			<div class="controls">
				<textarea class="span6" name="descricao_ext" id="descricao_ext" rows="10"><?php echo @$atividade->more->descricao_ext; ?></textarea>
				<small class="help-block">
					Este campo aceita o formato <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">Markdown</a>.<br>
					Clique <a href="javascript:preview()">aqui</a> para prever o resultado da formatação
				</small>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="shortbio">Short-Bio do Responsável</label>
			<div class="controls">
				<textarea class="span6" name="shortbio" id="shortbio" rows="5"><?php echo @$atividade->more->shortbio; ?></textarea>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="afiliacao">Afiliação do Responsável</label>
			<div class="controls">
				<input class="span5" id="afiliacao" name="afiliacao" type="text" value="<?php echo @$atividade->more->afiliacao ?>">
			</div>
		</div>

		<div class="form-actions">
			<input type="submit" class="btn btn-primary" value="Salvar">
		</div>
	</fieldset>
</form>

<script>
$(function() {
	$.datepicker.setDefaults({'dateFormat': 'dd/mm/yy'});
	$(document.body).tooltip({ selector: '[rel=tooltip]'});
	$(document.body).delegate("input[rel=date]", "focusin", function(){
		$(this).datepicker();
	});
});


var novaData = function(el) {
	html = $(el).parent().clone();
	html.children('input[type=hidden]').val('');
	html.children('input[rel=date]').attr('id', null).removeClass('hasDatepicker');
	$(el).parent().after($(html));
};
var removeData = function(el) {
	$(el).parent().remove();
};

var preview = function () {
	var text = $('#descricao_ext').val();
	$.post(
		'<?php echo Uri::create("admin/atividades/preview_descricao") ?>',
		{'text': text},
		function (resp) {
			$.modal({
				header: 'Preview',
				content: resp.text,
			});
		},
		'json'
	);
}
</script>
<?php endif ?>