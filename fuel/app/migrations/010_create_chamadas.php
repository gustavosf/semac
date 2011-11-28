<?php

namespace Fuel\Migrations;

class Create_chamadas {

	public function up()
	{
		\DBUtil::create_table('chamadas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'id_user' => array('constraint' => 11, 'type' => 'int'),
			'id_data' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('type' => 'bool', 'null' => true, 'default' => 0),
			'inicio' => array('type' => 'timestamp'),
		), array('id'), false, 'InnoDB');

		/* Adiciona as benditas chaves estrangeiras */
		\DB::Query('ALTER TABLE chamadas ADD CONSTRAINT fk_chamadas_user FOREIGN KEY (id_user) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE')->execute();
		\DB::Query('ALTER TABLE chamadas ADD CONSTRAINT fk_chamadas_data FOREIGN KEY (id_data) REFERENCES datas(id) ON UPDATE CASCADE ON DELETE CASCADE')->execute();
	}

	public function down()
	{
		\DBUtil::drop_table('chamadas');
	}
}