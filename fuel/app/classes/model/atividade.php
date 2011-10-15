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
	
}

/* End of file atividade.php */