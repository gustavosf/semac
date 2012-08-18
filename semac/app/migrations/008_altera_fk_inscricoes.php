<?php

namespace Fuel\Migrations;

class Altera_fk_inscricoes {

	public function up()
	{
		/* Troca RESTRICT por CASCADE em ambos ON DELETE e UPDATE */
		\DB::Query('ALTER TABLE inscricoes DROP FOREIGN KEY fk_inscricoes_atividade')->execute();
		\DB::Query('ALTER TABLE inscricoes 
					ADD CONSTRAINT fk_inscricoes_atividade
					FOREIGN KEY fk_inscricoes_atividade (id_atividade)
    					REFERENCES atividades (id)
    						ON DELETE CASCADE
    						ON UPDATE CASCADE')->execute();
	}

	public function down()
	{
		\DB::Query('ALTER TABLE inscricoes DROP FOREIGN KEY fk_inscricoes_atividade')->execute();
		\DB::Query('ALTER TABLE inscricoes 
					ADD CONSTRAINT fk_inscricoes_atividade
					FOREIGN KEY fk_inscricoes_atividade (id_atividade)
    					REFERENCES atividades (id)
    						ON DELETE RESTRICT
    						ON UPDATE RESTRICT')->execute();
	}
}