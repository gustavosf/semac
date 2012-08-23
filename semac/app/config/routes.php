<?php

return array(
	'_root_'                                     => 'home/index',
	'atividades/(:segment)'                      => 'home/atividades/$1',
	'atividades/(:segment)/(:segment)'           => 'home/atividades/$1/$2',
	'atividades/(:segment)/(:segment)/inscricao' => 'home/inscricao/$1/$2',
	'cadastro'                                   => 'home/cadastro',
	'busca'                                      => 'home/busca',

	'configuracoes'     => 'admin/configuracoes',
	'minhas_atividades' => 'admin/minhas_atividades',

	'login'               => 'admin/login',
	'logout'              => 'admin/logout',
	'esqueci_minha_senha' => 'admin/esqueci_minha_senha',

	'_404_'   => 'e/404',
);