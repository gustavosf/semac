<?php

class Model_Documento extends Orm\Model {

	/* Relacionamentos */
	protected static $_belongs_to  = array(
		'atividade' => array('key_from' => 'id_atividade'),
	);

}