<?php

class Model_Inscricao extends Orm\Model {

	/* Configuração */
	protected static $_table_name = 'inscricoes';
	
	/* Relacionamentos */
	protected static $_belongs_to  = array(
		'user' => array('key_from' => 'id_user'),
		'atividade' => array('key_from' => 'id_atividade'),
	);
	
}