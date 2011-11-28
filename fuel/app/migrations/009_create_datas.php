<?php

namespace Fuel\Migrations;

class Create_datas {

	public function up()
	{
		\DBUtil::create_table('datas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'id_atividade' => array('constraint' => 11, 'type' => 'int'),
			'data' => array('type' => 'timestamp'),
			'local' => array('constraint' => 255, 'type' => 'varchar'),
		), array('id'), false, 'InnoDB');

		/* Adiciona as benditas chaves estrangeiras */
		\DB::Query('ALTER TABLE datas ADD CONSTRAINT fk_datas_atividade FOREIGN KEY (id_atividade) REFERENCES atividades(id) ON UPDATE CASCADE ON DELETE CASCADE')->execute();
	}

	public function down()
	{
		\DBUtil::drop_table('datas');
	}
}