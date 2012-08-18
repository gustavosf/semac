<?php

namespace Fuel\Tasks;

/**
 * Database Tasks
 */

class Db {

	/**
	 * Método para a configuração do banco de dados
	 *
	 * @access public
	 * @return string
	 */
	public static function config()
	{
		\Migrate::latest();
		return "Banco de dados atualizado.\n".
				"Caso queira popular o mesmo com dados da Semana Acadêmica passada, digite ".
				\Cli::color('php oil db:populate', 'green');
	}

	/**
	 * Método para a população do banco de dados
	 *
	 * @access public
	 * @return string
	 */
	public static function populate()
	{
		static::createuser('chair@test.mail', '12345', 16, 'Test Chair');
		static::createuser('comex@test.mail', '12345', 32, 'Test Comex');
		static::createuser('og@test.mail', '12345', 64, 'Test OG');
		static::createuser('adm@test.mail', '12345', 128, 'Test Admin');
		return "- Criados usuários ".
				\Cli::color('chair@test.mail', 'green').", ".
				\Cli::color('comex@test.mail', 'green').", ".
				\Cli::color('og@test.mail', 'green')." e ".
				\Cli::color('adm@test.mail', 'green').", ".
				"todos com senha ".\Cli::color('12345', 'red');
	}

	/**
	 * Método para a criação de usuários
	 *
	 * @access private
	 * @param email string
	 * @param pass string
	 * @param group int
	 * @param nome string
	 * @return string
	 */
	private static function createuser($email = null, $pass = null, $group = 0, $nome = null)
	{
		$auth = \Auth::instance();
		$params = array('nome' => $nome);
		if (!$pass) $pass = substr(str_shuffle('abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789'),0,10);
		return $auth->create_user($email, $pass, $email, $group, $params);
	}
}