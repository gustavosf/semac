<div class="topbar-wrapper" style="z-index: 5;">
	<div class="topbar">
		<div class="topbar-inner">
			<div class="container">
				<h3><a href="<?php echo URI::create('/') ?>">SEMAC</a></h3>
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">Atividades</a>
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
						class="nav secondary-nav btn primary"
						style="margin-top:6px;">Login</a>
				<?php endif; ?>

			</div>
		</div><!-- /topbar-inner -->
	</div><!-- /topbar -->
</div>