<?php

class Model_Tipo_Atividade extends \Orm\Model
{
	protected static $_table_name = 'tipos_atividade';

	protected static $_properties = array(
		'id',
		'nome',
		'nome_canonico',
		'descricao',
	);

	protected static $_has_many = array(
		'atividades' => array(
			'model_to' => 'Model_Atividade',
			'key_to'   => 'id_tipo',
			'key_from' => 'id',
		),
	);

}
