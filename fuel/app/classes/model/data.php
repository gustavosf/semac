<?php

class Model_Data extends Orm\Model {

	protected static $_belongs_to  = array(
		'atividade' => array(
			'key_from' => 'id_atividade',
		),
	);

	protected static $_has_many  = array(
		'chamadas' => array(
			'key_to' => 'id_data',
		),
	);

	public function getData($format = 'd/m')
	{
		$data = strtotime($this->inicio);
		return date($format, $data);
	}

	/**
	 * Marca a presença de um determinado usuário em uma determinada chamada
	 *
	 * @return mixed 0 (nao-presente), 1 (presente) ou false (erro)
	 *
	 */
	public function marcaPresenca($user)
	{
		foreach ($this->chamadas as $id => $c)
		{
			if ($c->user->id == $user) {
				$c->delete();
				return 0;
			}
		}

		try
		{
			$c = new Model_Chamada;
			$c->id_data = $this->id;
			$c->id_user = $user;
			$c->status = 1;
			$c->save();
		}
		catch (Database_Exception $e)
		{
			return false;
		}

		return 1;
	}

}