<?php

class Model_User extends Orm\Model {

	public function novo($email, $nome, $grupo) {

		$grupos = array(
			-1 => 'Banned',
			0 => 'Visitante',
			1 => 'Participante',
			2 => 'Secretaria',
			4 => 'Comgrad',
			8 => 'Chair',
			16 => 'Comex',
			32 => 'Organizador Geral',
			64 => 'Admin',
		);
		$grupo = array_search($grupo, $grupos);
		if ($grupo === false) return false;
		
		$params = array('nome' => $nome);
		$pass = substr(str_shuffle('abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ0123456789'),0,10);
		
		$auth = \Auth::instance();
		try
		{
			return $auth->create_user($email, $pass, $email, $grupo, $params);	
		}
		catch (Exception $e) {
			return false;
		}
	}
    
}