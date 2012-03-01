<?php

class Model_Atividade extends Orm\Model {

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

	protected static $_belongs_to  = array(
		'user' => array(
			'key_from' => 'chair',
		),
	);	

	/* Variávies */
	static $atividades = array(
		0 => 'Coding Dojo',
		1 => 'Curso',
		2 => 'Lightning Talk',
		3 => 'Maratona de Programação',
		4 => 'Mini-Curso',
		5 => 'Painel',
		6 => 'Palestra',
		7 => 'Reunião',
	);

	static $status = array(
		0 => 'Inativo',
		1 => 'Ativo',
		2 => 'Cancelado',
	);

	/* Métodos */
	/**
	 * Retorna o tipo de atividade
	 *
	 * @return string
	 */
	public function getTipo()
	{
		return Model_Atividade::$atividades[$this->tipo];
	}

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
		return $datas ?: array(array('data' => null, 'as' => null, 'ate' => null));
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
	 * Retorna valores do campo "more" do banco de dados
	 * 
	 * Este campo é um array PHP serializado, o que permite a inclusão
	 * dinâmica de novos campos nas atividades, ao gosto do chair
	 *
	 * Retorna null caso campo não esteja setado
	 *
	 * @param $property string
	 * @return mixed
	 */
	public function more($property)
	{
		$more = unserialize(base64_decode($this->more));
		return @$more[$property] ?: null;
	}

	/**
	 * Seta valores do campo "more" do banco de dados
	 * 
	 * Retorna null caso campo não esteja setado
	 *
	 * @param $property string
	 * @param $value mixed
	 */
	public function setMore($property, $value)
	{
		$more = unserialize(base64_decode($this->more));
		$more[$property] = $value;
		$this->more = base64_encode(serialize($more));
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

}

/* End of file atividade.php */