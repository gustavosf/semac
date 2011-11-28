<?php

class Model_Chamada extends Orm\Model {

	protected static $_belongs_to  = array(
		'data' => array(
			'key_from' => 'id_data',
		),
		'user' => array(
			'key_from' => 'id_user',
		),
	);

}