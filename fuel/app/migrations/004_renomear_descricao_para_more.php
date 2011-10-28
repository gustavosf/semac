<?php

namespace Fuel\Migrations;

class Renomear_descricao_para_more {

	public function up()
	{
		\DB::query("ALTER TABLE atividades CHANGE COLUMN descricao more text")->execute();
	}

	public function down()
	{
		\DB::query("ALTER TABLE atividades CHANGE COLUMN more descricao text")->execute();
	}
}