<?php

class Model_Atividade extends Orm\Model {

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

	public function getTipo()
	{
		return Model_Atividade::$atividades[$this->tipo];
	}

	public function getDataFormatada($format = 'd/m H:i')
	{
		if ( ! $this->data)
		{
			return '-';
		}
		$date = new DateTime($this->data);
		return $date->format($format);
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
		$more = unserialize(html_entity_decode($this->more));
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
		$more = unserialize(html_entity_decode($this->more));
		$more[$property] = $value;
		$this->more = serialize($more);
	}
	
}

/* End of file atividade.php */