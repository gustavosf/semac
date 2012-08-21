<?php

namespace Fuel\Migrations;

class Add_field_to_atividades {

	public function up()
	{
		\DBUtil::add_fields('atividades', array(
			'selecao' => array('type' => 'tinyint', 'constraint' => 1, 'null' => true, 'default' => 0),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('atividades', 'selecao');
	}
}