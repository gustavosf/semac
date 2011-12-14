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
		return "Banco de dados atualizado para a versão ".
				\Cli::color(\Migrate::version(), 'green')."\n".
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
		static::loadAtividades();
		return "- Criados usuários ".
				\Cli::color('chair@test.mail', 'green').", ".
				\Cli::color('comex@test.mail', 'green').", ".
				\Cli::color('og@test.mail', 'green')." e ".
				\Cli::color('adm@test.mail', 'green').", ".
				"todos com senha ".\Cli::color('12345', 'red').".\n".
				"- Banco de dados foi populado com as atividades da SEMAC 2011/2";
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
	
	/**
	 * Método para carga de dados temporários no banco de dados
	 *
	 * @access private
	 * @return boolean
	 */
	private static function loadAtividades()
	{
		$atividades = file(APPPATH.'tmp/db.populate.txt');
		$chair = \Model_User::find()->where('username', 'chair@test.mail')->get_one();
		foreach ($atividades as $atividade)
		{
			$atividade = explode("\t", $atividade);
			$a = new \Model_Atividade;
			$a->chair = $chair->id;
			$a->tipo = array_search($atividade[1], \Model_Atividade::$atividades);
			$a->titulo = $atividade[2];
			$a->responsavel = $atividade[3];
			$a->setMore('descricao', $atividade[4]);
			$a->local = $atividade[5];
			$a->vagas = 60;
			$a->carga_horaria = 4;
			$a->save();
			$datas = explode(';', $atividade[0]);
			$datas = array_map(function($d){
				$d1 = explode(',', $d);
				$d2 = explode('-', $d1[1]);
				return array('id' => 0, 'data' => $d1[0], 'as' => $d2[0], 'ate' => $d2[1]);
			}, $datas);
			$a->setData($datas);
			$a->save();
		}
		return true;
	}
}
