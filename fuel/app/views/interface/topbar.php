<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="<?php echo URI::create('/') ?>">SEMAC</a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Atividades <b class='caret'></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo URI::create('/coding_dojos') ?>">Coding Dojos</a></li>
							<li><a href="<?php echo URI::create('/cursos') ?>">Cursos</a></li>
							<li><a href="<?php echo URI::create('/lightning_talks') ?>">Lightning Talks</a></li>
							<li><a href="<?php echo URI::create('/maratonas') ?>">Maratonas de Prog.</a></li>
							<li><a href="<?php echo URI::create('/minicursos') ?>">Minicursos</a></li>
							<li><a href="<?php echo URI::create('/paineis') ?>">Painéis</a></li>
							<li><a href="<?php echo URI::create('/palestras') ?>">Palestras</a></li>
							<li><a href="<?php echo URI::create('/reunioes') ?>">Reuniões</a></li>
						</ul>
					</li>
				</ul>
				<!--
				<form action="">
					<input type="text" placeholder="Search">
				</form>
				-->
				<?php if ($user != 'guest'): ?>
					<ul class="nav secondary-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle"><?php echo $user; ?></a>
							<ul class="dropdown-menu">
								<?php if (Auth::has_access('usuarios.novo')): ?>
									<li><a href="<?php echo URI::create('admin/usuarios/novo') ?>">Adicionar novo Usuário</a></li>
								<?php endif ?>
								<?php if (Auth::has_access('usuarios.organizador_geral')): ?>
									<li><a href="<?php echo URI::create('admin/usuarios/organizador_geral') ?>">Cadastrar OG</a></li>
								<?php endif ?>
								<?php if (Auth::has_access('atividades.locais')): ?>
									<li><a href="<?php echo URI::create('admin/atividades/locais') ?>">Locais das Atividades</a></li>	
								<?php endif ?>
								<?php if (Auth::has_access('atividades.nova')): ?>
									<li><a href="<?php echo URI::create('admin/atividades/nova') ?>">Nova Atividade</a></li>	
								<?php endif ?>
								<?php if (Auth::has_access('atividades.extrato_chamadas')): ?>
									<li><a href="<?php echo URI::create('admin/atividades/extrato_chamadas') ?>">Extrato das Chamadas</a></li>
								<?php endif ?>
								<?php if (Auth::has_access('a.minhas')): ?>
									<li><a href="<?php echo URI::create('a/minhas') ?>">Minhas Atividades</a></li>	
								<?php endif ?>
								<?php if (Auth::has_access('atividades.listar')): ?>
									<li><a href="<?php echo URI::create('admin/atividades/listar') ?>">Listar Atividades</a></li>	
								<?php endif ?>
								<?php if (Auth::has_access('admin.index')): ?>
									<li class="divider"></li>
									<li><a href="<?php echo URI::create('admin') ?>">Administração</a></li>	
								<?php endif ?>
								<li class="divider"></li>
								<li><a href="<?php echo Uri::create('admin/logout'); ?>">Sair</a></li>
							</ul>
						</li>
					</ul>
				<?php else: ?>
					<a href="<?php echo Uri::create('admin/login')?>"
						class="btn btn-primary pull-right"
						style="margin-top:6px;">Login</a>
				<?php endif; ?>
			</div>
		</div>
	</div><!-- /navbar-inner -->
</div>