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

}