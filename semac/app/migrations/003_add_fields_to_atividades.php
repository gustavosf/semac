<?php

namespace Fuel\Migrations;

class Add_fields_to_atividades {

	public function up()
	{
		\DBUtil::add_fields('atividades', array(
			'data' => array('type' => 'datetime', 'null' => true),
			'local' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'titulo' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
		));	
	}

	public function down()
	{
		\DBUtil::drop_fields('atividades', array(
			'data','local','titulo',
		));
	}

}