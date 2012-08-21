<div class="page-header">
	<h1>Lista de Chamada <small><?php echo $titulo; ?></small></h1>
</div>
<p>Escolha a lista de chamada dentre as datas abaixo</p>

<?php foreach ($datas as $id => $data): ?>
<a class='btn' href="<?php echo URI::create('admin/atividades/chamada/'.$id_atividade.'/'.$data->id) ?>"><?php echo $data->getData('d/m-H:i') ?></a>
<?php endforeach ?>