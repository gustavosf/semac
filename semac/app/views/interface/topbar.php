<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="<?php echo URI::create('/') ?>">SEMAC</a>
			<div class="btn-group pull-right">
				<?php if ($user != 'guest'): ?>
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i> <?php echo $user; ?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo URI::create('configuracoes') ?>">Configurações</a></li>
						<?php if (Auth::has_access('admin.minhas_atividades')): ?>
							<li><a href="<?php echo URI::create('minhas_atividades') ?>">Minhas Atividades</a></li>
						<?php endif ?>
						<?php if (Auth::has_access('atividades.listar')): ?>
							<li><a href="<?php echo URI::create('admin/atividades/listar') ?>">Listar Atividades</a></li>
						<?php endif ?>
						<?php if (Auth::has_access('admin.index')): ?>
							<li><a href="<?php echo URI::create('admin') ?>">Administração</a></li>
						<?php endif ?>
						<li class="divider"></li>
						<li><a href="<?php echo Uri::create('admin/logout'); ?>">Sair</a></li>
					</ul>
				<?php else: ?>
					<a href="<?php echo Uri::create('admin/login')?>"
						class="btn btn-primary" style="margin-top:1px;">Login</a>
				<?php endif; ?>
			</div>
			<div class="nav-collapse collapse" style="height: 0px; ">
				<ul class="nav">
					<li><a href="<?php echo URI::create('/coding_dojos') ?>">Coding Dojos</a></li>
					<li><a href="<?php echo URI::create('/cursos') ?>">Cursos</a></li>
					<li><a href="<?php echo URI::create('/lightning_talks') ?>">Lightning Talks</a></li>
					<li><a href="<?php echo URI::create('/maratonas') ?>">Maratonas de Prog.</a></li>
					<li><a href="<?php echo URI::create('/minicursos') ?>">Minicursos</a></li>
					<li><a href="<?php echo URI::create('/paineis') ?>">Painéis</a></li>
					<li><a href="<?php echo URI::create('/palestras') ?>">Palestras</a></li>
					<li><a href="<?php echo URI::create('/reunioes') ?>">Reuniões</a></li>
				</ul>
			</div>
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->