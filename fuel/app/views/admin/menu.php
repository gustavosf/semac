<ul class="nav nav-list">
	<li class="nav-header">Administração</li>
	<li<?php if ($action == 'index') echo ' class="active"'; ?>>
		<a href='<?php echo URI::create('admin'); ?>'>Dashboard</a>
	</li>
	<?php if (Auth::has_access('usuarios.novo')): ?>
		<li<?php if ($action == 'novo') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/usuarios/novo'); ?>'>Cadastro de Usuários</a>
		</li>
	<?php endif; ?>
	<?php if (Auth::has_access('usuarios.organizador_geral')): ?>
		<li<?php if ($action == 'organizador_geral') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/usuarios/organizador_geral'); ?>'>Organizador Geral</a>
		</li>
	<?php endif; ?>
	<?php if (Auth::has_access('atividades.nova')): ?>
		<li<?php if ($action == 'nova') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/nova'); ?>'>Nova Atividade</a>
		</li>
	<?php endif; ?>
	<?php if (Auth::has_access('atividades.listar')): ?>
		<li<?php if ($action == 'listar') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/listar'); ?>'>Listar Atividades</a>
		</li>
	<?php endif; ?>
	<?php if (Auth::has_access('atividades.locais')): ?>
		<li<?php if ($action == 'locais') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/locais'); ?>'>Locais das Atividades</a>
		</li>
	<?php endif; ?>
	<?php if (Auth::has_access('atividades.extrato_chamadas')): ?>
		<li<?php if ($action == 'extrato_chamadas') echo ' class="active"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/extrato_chamadas'); ?>'>Extrato das Chamadas</a>
		</li>
	<?php endif; ?>
</ul>