<?php

class Model_Atividade extends Orm\Model {

	protected static $_properties = array(
		'id',
		'id_tipo',
		'chair',
		'responsavel',
		'carga_horaria',
		'vagas',
		'more' => array('data_type' => 'serialize'),
		'status' => array('default' => 0),
		'criado_em',
		'local',
		'titulo',
		'selecao',
	);

	/* Observers */
	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
			'property' => 'criado_em',
		),
		'Orm\\Observer_Typing' => array('before_save', 'after_save', 'after_load')
	);


	/* Relacionamentos */
	protected static $_has_many  = array(
		'inscricoes' => array(
			'model_to' => 'Model_Inscricao',
			'key_to' => 'id_atividade',
		),
		'documentos' => array(
			'key_to' => 'id_atividade'
		),
		'datas' => array(
			'key_to' => 'id_atividade'
		),
	);

	protected static $_has_one = array(
		'tipo' => array(
			'model_to' => 'Model_Tipo_Atividade',
			'key_to'   => 'id',
			'key_from' => 'id_tipo',
		),
	);

	protected static $_belongs_to  = array(
		'user' => array(
			'key_from' => 'chair',
		),
	);

	static $status = array(
		0 => 'Inativo',
		1 => 'Ativo',
		2 => 'Cancelado',
	);

	/**
	 * Retorna as datas setadas
	 *
	 * Como o campo data pode permitir mais de uma entrada, foi escolhido
	 * serializar os campos na forma de um array
	 *
	 * @return array
	 */
	public function getData()
	{
		$datas = array();
		foreach ($this->datas as $id => $data)
		{
			$time_i = strtotime($data->inicio);
			$time_f = strtotime($data->fim);
			$datas[$id]['data']  = date('d/m/Y', $time_i);
			$datas[$id]['as']    = date('H:i', $time_i);
			$datas[$id]['ate']   = date('H:i', $time_f);
			$datas[$id]['local'] = $data->local;
		}
		return $datas ?: array(array('data' => null, 'as' => null, 'ate' => null, 'local' => null));
	}

	/**
	 * Retorna as datas setadas serializado em uma string
	 *
	 * @return string
	 */
	public function getDataSerial()
	{
		$data = $this->getData();
		foreach ($data as $k => $d)
			$data[$k] = substr($d['data'], 0, 5).', '.substr($d['as'], 0, 5).' - '.substr($d['ate'], 0, 5);
		return implode("\n", $data);
	}

	/**
	 * Seta datas
	 *
	 * Pega um array contendo datas, serializa e salva no banco de dados
	 *
	 * @param $data array Array com as datas
	 */

	public function setData($data = array())
	{
		$datas_atuais = $this->datas;

		$r_in = '/([0-9]+)\/([0-9]+)\/([0-9]+) ([0-9]+)[h:]([0-9]+)/';
		$r_out = '\3-\2-\1 \4:\5:00';
		foreach ($data as $d)
		{
			$data_inicio = preg_replace($r_in, $r_out, $d['data'].' '.$d['as']);
			$data_fim = preg_replace($r_in, $r_out, $d['data'].' '.$d['ate']);

			if ($d['id']) $data_model = Model_Data::find($d['id']);
			else $data_model = new Model_Data;
			$data_model->id_atividade = $this->id;
			$data_model->inicio = $data_inicio;
			$data_model->fim = $data_fim;
			$data_model->save();
			$this->datas[$data_model->id] = $data_model;

			unset($datas_atuais[$d['id']]);
		}

		foreach ($datas_atuais as $id => $data)
		{
			$this->datas[$id]->delete();
			unset($this->datas[$id]);
		}
	}

	/**
	 * Adiciona uma data ao array de datas
	 *
	 * Deserializa as datas no bd, adiciona a data e salva novamente
	 *
	 * @param $nova_data array
	 */
	public function addData($nova_data)
	{
		$data = $this->getData();
		$data[] = $nova_data;
		$this->setData($data);
	}

	/**
	 * Atualiza o local de uma (ou várias) datas associadas a essa atividade
	 * @param  string $place
	 * @param  int    $data_id id da data no banco de dados
	 */
	public function update_locais($place, $data_id)
	{
		$query = DB::update('datas')
					->value('local', $place)
					->where('id_atividade', $this->id);

		if ($data_id != 0) $query->and_where('id', $data_id);

		$query->execute();
	}

	/**
	 * Retorna o número de vagas disponíveis
	 * @return  mixed  número de vagas disponíveis (true para infinito)
	 */
	public function vagas_disponiveis()
	{
		$inscricoes = Model_Inscricao::find()
			->where('id_atividade', $this->id)
			->where('status', 1)->count();

		return $this->vagas > 0 ? $this->vagas - $inscricoes : true;
	}

}