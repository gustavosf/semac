<?php

class Model_Datas extends Orm\Model {

	protected static $_belongs_to  = array(
		'atividade' => array(
			'key_from' => 'atividade_id',
		),
	);	

}