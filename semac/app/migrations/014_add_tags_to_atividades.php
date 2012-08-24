<?php

namespace Fuel\Migrations;

class Add_tags_to_atividades {

	public function up()
	{
		\DBUtil::add_fields('atividades', array(
			'tags' => array('type' => 'text', 'null' => true, 'defailt' => 'a:0:{}'),
		));
	}

	public function down()
	{
		\DBUtil::drop_fields('atividades', 'tags');
	}
}