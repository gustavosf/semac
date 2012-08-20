<?php

namespace Fuel\Migrations;

class Create_inscricoes {

	public function up()
	{

		/* Usar innodb porque permite chaves estrangeiras */
		\DB::Query('ALTER TABLE users ENGINE = INNODB')->execute();
		\DB::Query('ALTER TABLE atividades ENGINE = INNODB')->execute();

		/* Corrige um problema no migration 2, adicionando a chave estrangeira */
		\DB::Query('ALTER TABLE atividades ADD CONSTRAINT fk_atividades_chair FOREIGN KEY (chair) REFERENCES users(id) ON UPDATE CASCADE ON DELETE RESTRICT')->execute();

		/* Criamos a tabela inscrições */
		\DBUtil::create_table('inscricoes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'id_user' => array('constraint' => 11, 'type' => 'int'),
			'id_atividade' => array('constraint' => 11, 'type' => 'int'),
			'dados' => array('type' => 'text', 'null' => true),
			'cadastrado_em' => array('type' => 'timestamp', 'default' => \DB::expr('CURRENT_TIMESTAMP')),
			'status' => array('constraint' => 1, 'type' => 'int', 'null' => true, 'default' => 0),
		), array('id'), false, 'InnoDB');

		/* Adiciona as benditas chaves estrangeiras */
		\DB::Query('ALTER TABLE inscricoes ADD CONSTRAINT fk_inscricoes_user FOREIGN KEY (id_user) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE')->execute();
		\DB::Query('ALTER TABLE inscricoes ADD CONSTRAINT fk_inscricoes_atividade FOREIGN KEY (id_atividade) REFERENCES atividades(id) ON UPDATE RESTRICT ON DELETE RESTRICT')->execute();

		/* Adiciona um índice UNIQUE para o par user-atividade, impedindo cadastros duplicados */
		\DB::Query('ALTER TABLE inscricoes ADD UNIQUE (id_user, id_atividade)')->execute();

	}

	public function down()
	{
		/* Elimina inscricoes */
		\DBUtil::drop_table('inscricoes');

		/* Corrige um problema no migration 2, adicionando a chave estrangeira */
		\DB::Query('ALTER TABLE atividades DROP FOREIGN KEY fk_atividades_chair')->execute();

		/* Volta o engine anterior */
		\DB::Query('ALTER TABLE atividades ENGINE = MYISAM')->execute();
		\DB::Query('ALTER TABLE users ENGINE = MYISAM')->execute();

	}
}