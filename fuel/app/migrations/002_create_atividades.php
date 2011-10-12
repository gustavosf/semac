<?php

namespace Fuel\Migrations;

class Create_atividades {

	public function up()
	{
		\DBUtil::create_table('atividades', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'chair' => array('constraint' => 11, 'type' => 'int'),
			'responsavel' => array('constraint' => 255, 'type' => 'varchar'),
			'carga_horaria' => array('constraint' => 2, 'type' => 'int'),
			'vagas' => array('constraint' => 3, 'type' => 'int'),
			'detalhes' => array('type' => 'text'),
			'status' => array('constraint' => 1, 'type' => 'int'),
		), array('id'));

		\DB::Query('ALTER TABLE atividades ADD FOREIGN KEY (chair) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT');
	}

	public function down()
	{
		\DBUtil::drop_table('atividades');
	}
}