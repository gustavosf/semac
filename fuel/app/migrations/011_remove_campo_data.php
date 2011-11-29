<?php

namespace Fuel\Migrations;

class Remove_campo_data {

	public function up()
	{
		\DBUtil::drop_fields('atividades', 'data');
	}

	public function down()
	{
		\DBUtil::add_fields('atividades', array(
			'data' => array('type' => 'datetime', 'null' => true),
		));
	}
}