<?php

namespace Fuel\Migrations;

class Add_tags_to_atividades {

	public function up()
	{
		\DBUtil::add_fields('atividades', array(
			'tags' => array('type' => 'varchar', 'constraint' => 255, 'null' => true),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('atividades', 'tags');
	}
}