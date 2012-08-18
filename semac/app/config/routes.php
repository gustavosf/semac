<?php

return array(
	'_root_'  => 'home/index',  // The default route
	'_404_'   => 'e/404',    // The main 404 route

	'a/cadastro'         => 'a/cadastro',
	'a/minhas'           => 'a/minhas',
	'a/(:num)/inscricao' => 'a/inscricao/$1',
	'a/(:num)'           => 'a/index/$1',

	/* Listagem de atividades, seguindo o código de conversão das atividades */
	'coding_dojos'      => 'home/atividades/0',
	'cursos'            => 'home/atividades/1',
	'lightning_talks'   => 'home/atividades/2',
	'maratonas'         => 'home/atividades/3',
	'minicursos'        => 'home/atividades/4',
	'paineis'           => 'home/atividades/5',
	'palestras'         => 'home/atividades/6',
	'reunioes'          => 'home/atividades/7',

	'coding_dojos/(:num)'      => 'home/atividades/0/$1',
	'cursos/(:num)'            => 'home/atividades/1/$1',
	'lightning_talks/(:num)'   => 'home/atividades/2/$1',
	'maratonas/(:num)'         => 'home/atividades/3/$1',
	'minicursos/(:num)'        => 'home/atividades/4/$1',
	'paineis/(:num)'           => 'home/atividades/5/$1',
	'palestras/(:num)'         => 'home/atividades/6/$1',
	'reunioes/(:num)'          => 'home/atividades/7/$1',
);