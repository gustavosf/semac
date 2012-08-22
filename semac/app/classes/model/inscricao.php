<?php

class Model_Inscricao extends Orm\Model {

	protected static $_properties = array(
		'id',
		'id_user',
		'id_atividade',
		'dados' => array(
			'data_type' => 'serialize',
		),
		'cadastrado_em', /* observed */
		'status' => array('default' => 0),
	);


	/* Observers */
	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
			'property' => 'cadastrado_em',
		),
		'Orm\\Observer_Typing' => array('before_save', 'after_save', 'after_load')
	);

	private static $statuses = array(
		0 => 'Cadastrado',
		1 => 'Inscrito',
		2 => 'Recusado',
	);

	/* Configuração */
	protected static $_table_name = 'inscricoes';

	/* Relacionamentos */
	protected static $_belongs_to  = array(
		'user' => array('key_from' => 'id_user'),
		'atividade' => array('key_from' => 'id_atividade'),
	);

	/* Métodos */
	public static function inscreve($user, $atividade)
	{
		$atividade = Model_Atividade::find($atividade);
		$user = Model_User::get_from_auth();

		if ( ! $atividade->vagas_disponiveis())
		{
			throw new Exception('O limite de vagas para esta atividade ('.$atividade->vagas.') já foi atingido.');
		}

		$datas_atividade = $atividade->getData();
		$toRange = function($d) {
			return array(
				strtotime(substr($d['data'], 6).'-'.substr($d['data'],3,2).'-'.substr($d['data'],0,2).' '.str_replace('h',':',$d['as']).':00'),
				strtotime(substr($d['data'], 6).'-'.substr($d['data'],3,2).'-'.substr($d['data'],0,2).' '.str_replace('h',':',$d['ate']).':00'),
			);
		};

		/* Checagem de conflito de horários */
		foreach ($user->inscricoes as $inscricao)
		{
			$datas = $inscricao->atividade->getData();
			foreach ($datas_atividade as $d)
			{
				$drange = $toRange($d);
				foreach ($datas as $d2)
				{
					$d2range = $toRange($d2);
					if (max($drange[0], $d2range[0]) < min($drange[1], $d2range[1]))
						throw new Exception('Conflito de horário com a atividade "'.$inscricao->atividade->titulo.'".');
				}
			}
		}

		$ins = new Model_Inscricao(array(
			'id_user' => $user->id,
			'id_atividade' => $atividade->id,
			'status' => $atividade->selecao ? 0 : 1,
		));
		$ins->save();
	}

	public function getStatus()
	{
		return Model_Inscricao::$statuses[$this->status];
	}

	public function estaInscrito()
	{
		return $this->status == 1;
	}

	public function getStatusDesc()
	{
		$desc = array(
			0 => 'Você está cadastrado na atividade e aguarda confirmação do responsável',
			1 => 'Você está inscrito na atividade',
			2 => 'Sua inscrição nesta atividade não foi aceita',
		);
		return $desc[$this->status];
	}

}