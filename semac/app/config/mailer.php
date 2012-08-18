<?php

return array(

	/*
	 * Configuração do servidor SMTP
	 */
	'smtp' => array(
		'secure' => 'ssl',
		'host'   => 'smtp.email.com',
		'port'   => 465,
		'credentials' => array(
			'user' => 'user@email.com',
			'pass' => 'sua_senha',
		),
	),

	/*
	 * Configuração do e-mail
	 */
	'charset' => 'utf-8',
	'from'    => array(
		'name'  => 'Seu nome',
		'email' => 'user@email.com',
	),

	// 'forced_redirection' => 'email_to_force_redirection',

);
