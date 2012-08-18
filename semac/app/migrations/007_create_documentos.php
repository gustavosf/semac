<?php

namespace Fuel\Migrations;

class Create_documentos {

	public function up()
	{
		\DBUtil::create_table('documentos', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'id_atividade' => array('constraint' => 11, 'type' => 'int'),
			'arquivo' => array('constraint' => 255, 'type' => 'varchar'),
			'titulo' => array('constraint' => 255, 'type' => 'varchar'),
			'descricao' => array('constraint' => 255, 'type' => 'varchar'),
			'data_upload' => array('type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')),
		), array('id'), false, 'InnoDB');

		/* Adiciona as benditas chaves estrangeiras */
		\DB::Query('ALTER TABLE documentos ADD CONSTRAINT fk_documentos_atividade FOREIGN KEY (id_atividade) REFERENCES atividades(id) ON UPDATE CASCADE ON DELETE CASCADE')->execute();
	}

	public function down()
	{
		\DBUtil::drop_table('documentos');
	}
}