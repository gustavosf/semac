<ul>
	<li<?php if ($action == 'index') echo ' class="selected"'; ?>>
		<a href='<?php echo URI::create('admin'); ?>'>Administração</a>
	</li>
	<li<?php if ($action == 'novousuario') echo ' class="selected"'; ?>>
		<a href='<?php echo URI::create('admin/novousuario'); ?>'>Cadastro de Usuários</a>
	</li>
</ul>