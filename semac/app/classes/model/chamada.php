<?php

class Model_Chamada extends Orm\Model {

	protected static $_properties = array(
		'id',
		'id_user',
		'id_data',
		'status',
	);

	protected static $_belongs_to  = array(
		'datas' => array(
			'key_from' => 'id_data',
		),
		'user' => array(
			'key_from' => 'id_user',
		),
	);

}