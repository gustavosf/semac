<?php

namespace Fuel\Tasks;

/**
 * Admin tasks
 *
 * Algumas tarefas automatizadas para a administração do sistema
 *
 *
 * @package		Fuel
 * @version		1.0
 * @author		Gustavo Seganfredo
 */

class Admin {

	public static function run()
	{
		return \Cli::color('Você precisa digitar um comando :)', 'red');
	}

	/**
	 * Método para a criação de usuários no formato padrão (grupo 1)
	 *
	 * Usage (from command line):
	 *
	 * php oil r admin:createuser <email>
	 *
	 * @return string
	 */
	public static function createuser($email = null, $pass = null, $group = 0, $nome = null)
	{
		if ( ! isset($email))
		{
			return "Nenhum email foi informado!\nUso: newuser <email>";
		}

		$auth = \Auth::instance();

		$params = array('nome' => $nome);
		if (!$pass) $pass = substr(str_shuffle('abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789'),0,10);

		if ($auth->create_user($email, $pass, $email, $group, $params))
		{
			return "Criado usuário '".\Cli::color($email, 'green')."', senha '".\Cli::color($pass, 'green')."'";
		}
		else
		{
			return "Já existe um usuário cadastrado com o email '".\Cli::color($email, 'red')."'";
		}
	}		
	
	public static function init()
	{
		if (!is_file(APPPATH.'config/db.php'))
		{
			copy(APPPATH.'config/db.php.dist', APPPATH.'config/db.php');
		}
		
		if (!is_file(APPPATH.'config/auth.php'))
		{
			copy(APPPATH.'config/auth.php.dist', APPPATH.'config/auth.php');
		}
		
		if (!is_file(APPPATH.'config/simpleauth.php'))
		{
			copy(APPPATH.'config/simpleauth.php.dist', APPPATH.'config/simpleauth.php');
		}

		system('php oil r migrate');
		static::createuser('test@user.com', 'test', 64, 'Test User');

		return "Inicialização concluída. Você deve editar o arquivo ".\Cli::color('fuel/app/config/db.php', 'red')." e atualizar as informações para acesso ao banco de dados";
	}
	
	public static function test()
	{
		$auth = \Auth::instance();
		$auth->login('gustavosf@gmail.com', 'TtdoNcM5gK');
		print_r($auth->has_access('welcome.update'));
	}
}