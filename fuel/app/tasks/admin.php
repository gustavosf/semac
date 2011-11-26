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

		return "Inicialização concluída. Você deve editar o arquivo ".\Cli::color('fuel/app/config/db.php', 'red')." e atualizar as informações para acesso ao banco de dados";
	}

	public static function initdb()
	{
		system('php oil r migrate');
		static::createuser('comex@test.mail', '12345', 32, 'Test User');
		static::createuser('og@test.mail', '12345', 64, 'Test User');
		static::createuser('adm@test.mail', '12345', 128, 'Test User');
	}
	
	public static function test()
	{
		$auth = \Auth::instance();
		$auth->login('gustavosf@gmail.com', 'TtdoNcM5gK');
		print_r($auth->has_access('welcome.update'));
	}


	public static function novaAtividade()
	{
		$atividades = file('/home/gustavo/Desktop/eventos.txt');
		foreach ($atividades as $atividade)
		{
			$atividade = explode("\t", $atividade);
			$a = new \Model_Atividade;
			$a->chair = 53;
			$a->tipo = array_search($atividade[1], \Model_Atividade::$atividades);
			$a->titulo = $atividade[2];
			$a->responsavel = $atividade[3];
			$a->setMore('descricao', $atividade[4]);
			$a->local = $atividade[5];
			$a->vagas = 60;
			$a->carga_horaria = 8;
			$datas = array_map(function($d){
				$d1 = explode(',', $d);
				$d2 = explode('-', $d1[1]);
				return array('data' => $d1[0], 'as' => $d2[0], 'ate' => $d2[1]);
			}, explode(';', $atividade[0]));
			$a->setData($datas);
			$a->save();
		}
	}
}
