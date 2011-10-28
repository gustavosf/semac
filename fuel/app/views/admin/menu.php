<ul>
	<li<?php if ($action == 'index') echo ' class="selected"'; ?>>
		<a href='<?php echo URI::create('admin'); ?>'>Administração</a>
	</li>
	<?php if (Auth::has_access('usuarios.novo')): ?>
		<li<?php if ($action == 'novo') echo ' class="selected"'; ?>>
			<a href='<?php echo URI::create('admin/usuarios/novo'); ?>'>Cadastro de Usuários</a>
		</li>
	<?php endif; ?>
	<?php if (Auth::has_access('usuarios.organizador_geral')): ?>
		<li<?php if ($action == 'organizador_geral') echo ' class="selected"'; ?>>
			<a href='<?php echo URI::create('admin/usuarios/organizador_geral'); ?>'>Organizador Geral</a>
		</li>
	<?php endif; ?>
	<?php if (Auth::has_access('atividades.nova')): ?>
		<li<?php if ($action == 'nova') echo ' class="selected"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/nova'); ?>'>Nova Atividade</a>
		</li>
	<?php endif; ?>
	<?php if (Auth::has_access('atividades.listar')): ?>
		<li<?php if ($action == 'listar') echo ' class="selected"'; ?>>
			<a href='<?php echo URI::create('admin/atividades/listar'); ?>'>Listar Atividades</a>
		</li>
	<?php endif; ?>
</ul>