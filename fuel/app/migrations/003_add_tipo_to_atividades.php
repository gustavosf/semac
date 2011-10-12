<?php

namespace Fuel\Migrations;

class Add_tipo_to_atividades {

	public function up()
	{
		\DBUtil::add_fields('atividades', array(
			'tipo' => array('constraint' => 1, 'type' => 'int'),
		));	
	}

	public function down()
	{
		\DBUtil::drop_fields('atividades', array('tipo'));
	}
}