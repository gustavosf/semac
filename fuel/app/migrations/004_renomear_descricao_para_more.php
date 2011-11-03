<?php

namespace Fuel\Migrations;

class Renomear_descricao_para_more {

	public function up()
	{
		\DB::query("ALTER TABLE atividades CHANGE COLUMN detalhes more text")->execute();
	}

	public function down()
	{
		\DB::query("ALTER TABLE atividades CHANGE COLUMN more detalhes text")->execute();
	}
}