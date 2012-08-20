<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * DB connection, leave null to use default
	 */
	'db_connection' => null,

	/**
	 * DB table name for the user table
	 */
	'table_name' => 'users',

	/**
	 * Choose which columns are selected, must include: username, password, email, last_login,
	 * login_hash, group & profile_fields
	 */
	'table_columns' => array('*'),

	/**
	 * This will allow you to use the group & acl driver for non-logged in users
	 */
	'guest_login' => true,

	/**
	 * Groups as id => array(name => <string>, roles => <array>)
	 */
	'groups' => array(
		// -1  => array('name' => 'Banned', 'roles' => array('banned')),
		0   => array('name' => 'Visitante', 'roles' => array()),
		1   => array('name' => 'Visitante', 'roles' => array()),
		2   => array('name' => 'Participante', 'roles' => array('participante')),
		4   => array('name' => 'Secretaria', 'roles' => array('secretaria')),
		8   => array('name' => 'Comgrad', 'roles' => array('comgrad')),
		16  => array('name' => 'Chair', 'roles' => array('chair')),
		32  => array('name' => 'Comex', 'roles' => array('comex')),
		64  => array('name' => 'Organizador Geral', 'roles' => array('og')),
		128 => array('name' => 'Admin', 'roles' => array('super')),
	),

	/**
	 * Roles as name => array(location => rights)
	 */
	'roles' => array(
		'super'             => true,
		'banned'            => false,
		'#'                 => array(
			'admin' => array('login', 'logout', 'esqueci_minha_senha'),
			'e'     => array('forbidden', '404'),
			'a'     => array('index', 'inscricao', 'cadastro'),
			'home'  => array('index', 'atividades'),
		),
		'participante' => array(
			'a' => array('minhas'),
		),
		'secretaria' => array(
			'admin'      => array('index'),
			'atividades' => array('locais'),
			'usuarios'   => array('extrato_chamadas'),
		),
		'comgrad' => array(
			'admin'      => array('index'),
			'atividades' => array('extrato_chamadas'),
		),
		'chair' => array(
			'admin'      => array('index'),
			'atividades' => array(
				'listar',
				'editar',
				'inscritos',
				'inscrever',
				'docs',
				'docs_delete',
				'chamada',
				'presenca',
			),
		),
		'comex' => array(
			'admin'      => array('index'),
			'atividades' => array('locais'),
			'usuarios'   => array('novo', 'organizador_geral', 'extrato_chamadas'),
		),
		'og' => array(
			'admin'      => array('index'),
			'atividades' => array('nova'),
		),
	),

	/**
	 * $_POST key for login username
	 */
	'username_post_key' => 'username',

	/**
	 * $_POST key for login password
	 */
	'password_post_key' => 'password',
);
