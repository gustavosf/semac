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
	);

	protected static $_belongs_to  = array(
		'user' => array(
			'key_from' => 'chair',
		),
	);	

	/* Variávies */
	static $atividades = array(
		0 => 'Coding Dojos',
		1 => 'Cursos',
		2 => 'Lightning Talks',
		3 => 'Maratonas de Programação',
		4 => 'Mini-Cursos',
		5 => 'Painéis',
		6 => 'Palestras',
		7 => 'Reuniões',
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
		$data = unserialize(base64_decode($this->data))
			or $data = array(array('data' => null, 'as' => null, 'ate' => null));
		return $data;
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
			$data[$k] = substr($d['data'], 0, 5).", {$d['as']} - {$d['ate']}";
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
		$this->data = base64_encode(serialize($data));
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

}

/* End of file atividade.php */