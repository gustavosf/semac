<ul class="nav nav-list">

	<li<?php if ($action == 'index') echo ' class="active"'; ?>>
		<a href='<?php echo URI::create('admin'); ?>'>Dashboard</a>
	</li>

	<?php if (Auth::member(Auth::get_group_id('Comex'))): ?>
		<li class="nav-header">Administração</li>
		<li<?php if ($action == 'novo') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/usuarios/novo'); ?>'>Cadastro de Usuários</a>
		</li>
		<li<?php if ($action == 'organizador_geral') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/usuarios/organizador_geral'); ?>'>Organizador Geral</a>
		</li>
		<li<?php if ($action == 'extrato_chamadas') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/extrato_chamadas'); ?>'>Lista de Presenças</a>
		</li>
	<?php endif; ?>

	<?php if (Auth::member(Auth::get_group_id('Organizador Geral'))): ?>
		<li class="nav-header">Organizador Geral</li>
		<li<?php if ($action == 'nova') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/nova'); ?>'>Nova Atividade</a>
		</li>
		<li<?php if ($action == 'locais') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/locais'); ?>'>Locais das Atividades</a>
		</li>
	<?php endif; ?>

	<?php if (Auth::member(Auth::get_group_id('Chair'))): ?>
		<li class="nav-header">Chair</li>
		<li<?php if ($action == 'listar') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/listar'); ?>'>Listar Atividades</a>
		</li>
	<?php endif; ?>

</ul>