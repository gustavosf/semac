<ul>
	<li<?php if ($action == 'index') echo ' class="selected"'; ?>>
		<a href='<?php echo URI::create('admin'); ?>'>Administração</a>
	</li>
	<li<?php if ($action == 'novo') echo ' class="selected"'; ?>>
		<a href='<?php echo URI::create('admin/usuarios/novo'); ?>'>Cadastro de Usuários</a>
	</li>
</ul>