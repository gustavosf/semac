<header class="jumbotron subhead">
	<div class="container">
		<h2><?php echo $atividade->titulo ?></h2>
		<?php echo $atividade->responsavel ?>
	</div>
</header>

<div class="container">
	<div class="row">
		<div class="span9">
			<?php if ($inscricao_efetuada === true): ?>
				<div class="alert alert-success alert-block">
					<a class="close" data-dismiss="alert" href="#">×</a>
					<p>Sua inscrição foi efetuada com sucesso!</p>
				</div>
			<?php elseif ($inscricao_efetuada): ?>
				<div class="alert alert-block alert-error">
					<a class="close" data-dismiss="alert" href="#">×</a>
					<p><?php echo $inscricao_efetuada ?></p>
				</div>
			<?php endif ?>
			<p><?php echo $atividade->more->descricao ?></p>
			<?php if ($atividade->more->descricao_ext): ?>
				<hr>
				<?php echo html_entity_decode($atividade->more->descricao_ext); ?>
			<?php endif ?>
			<?php if ($atividade->more->shortbio): ?>
				<hr>
				<div class="row">
					<div class="span9">
						<h3>Sobre <?php echo $atividade->responsavel ?>:</h3>
						<?php echo $atividade->more->shortbio ?>
					</div>
				</div>
			<?php endif ?>
			<hr>
			<div class="row">
				<div class="span9">
					<div class="fb-comments" data-href="<?php echo Uri::current() ?>" data-num-posts="4" data-width="470"></div>
				</div>
			</div>
		</div>
		<div class="span3">
			<table class='table table-striped'>
				<tbody>
					<?php foreach ($atividade->getData() as $data): ?>
						<tr>
							<td>
								<strong><?php echo $data['data'].' - '.$data['as'].' até '.$data['ate'] ?></strong><br>
								<?php echo $data['local'] ?>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<b>Trilha:</b> <?php //echo $trilha ?><br>
			<?php if ($vagas): ?>
				<hr><strong>Vagas:</strong> <?php echo $vagas ?>
			<?php endif ?>
			<hr>
			<strong>Documentação Extra</strong><br><br>
			<?php foreach ($atividade->documentos as $key => $documento): ?>
				<a href="<?php echo $documento->getPath() ?>"
				   target="_blank"
				   rel="popover"
				   data-original-title="<?php echo $documento->titulo ?> <small>(<?php echo $documento->get_size() ?>)</small>"
				   data-content="<?php echo $documento->descricao ?>">
					<img src="<?php echo $documento->getIco() ?>"></a>
			<?php endforeach ?>
			<?php if (count($atividade->documentos) === 0): ?>
				Nenhuma documentação foi anexada para esta atividade
			<?php endif ?>
			<hr>
			<?php if ($inscrito === false): ?>
				<?php if ($vagas_disponiveis === 0): ?>
					<span class="label label-important">Limite de vagas atingido</span>
				<?php else: ?>
					<a href="<?php echo URI::create("atividades/{$atividade->tipo->nome_canonico}/{$atividade->get_readable_id()}/inscricao") ?>"><button class="btn btn-info">Inscrição</button></a>
				<?php endif ?>
			<?php elseif ($inscrito == 0): ?>
				<span class="label label-warning">Cadastrado nesta atividade</span>
			<?php elseif ($inscrito == 1): ?>
				<span class="label label-success">Inscrito nesta atividade</span>
			<?php elseif ($inscrito == 2): ?>
				<span class="label label-important">Inscrição recusada nesta atividade</span>
			<?php endif ?>
			<hr>
			<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $clean_uri ?>&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=260679840614937" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
			<div class="g-plusone" data-size="medium" data-width="120" data-href="<?php echo $clean_uri ?>"></div>
			<hr>
			<img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&choe=UTF-8&chl=<?php echo urlencode(Uri::current()) ?>" class="qrcode"/>
		</div>
	</div>
</div>