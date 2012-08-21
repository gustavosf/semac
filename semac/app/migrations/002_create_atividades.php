<?php

namespace Fuel\Migrations;

class Create_atividades {

	public function up()
	{
		\DBUtil::create_table('atividades', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'tipo' => array('constraint' => 1, 'type' => 'int'),
			'chair' => array('constraint' => 11, 'type' => 'int'),
			'responsavel' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'carga_horaria' => array('constraint' => 2, 'type' => 'int', 'null' => true),
			'vagas' => array('constraint' => 3, 'type' => 'int', 'null' => true),
			'detalhes' => array('type' => 'text', 'null' => true),
			'status' => array('constraint' => 1, 'type' => 'int', 'null' => true, 'default' => 0),
			'criado_em' => array('type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')),
		), array('id'));

		\DB::Query('ALTER TABLE atividades ADD FOREIGN KEY (chair) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT');
	}

	public function down()
	{
		\DBUtil::drop_table('atividades');
	}
}